<?php

namespace App\Http\Controllers;

use Image;
use Validator;
use App\Models\Daily;
use App\Models\Party;
use App\Models\Dimond;
use App\Models\Repair;
use App\Models\Worker;
use App\Models\Process;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdminDimondController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dimonds = Dimond::orderBy('id', 'DESC')->get();
        return view('admin.dimond.index', compact('dimonds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partys = Party::where('is_active', 1)->orderBy('id', 'DESC')->get();
        return view('admin.dimond.create', compact('partys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'parties_id' => 'required',
            'dimond_name' => ['required', 'string', 'max:255', 'unique:dimonds'],
            'weight' => 'required',
            'required_weight' => 'required',
            'shape' => 'required',
            'clarity' => 'required',
            'color' => 'required',
            'cut' => 'required',
            'polish' => 'required',
            'symmetry' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        }

        $number = mt_rand(1000000000, 9999999999);

        if ($this->dimondCodeExists($number)) {
            $number = mt_rand(1000000000, 9999999999);
        }

        $urlToRedirect = 'http://127.0.0.1:8000/admin/dimond/show/' . $number;

        $qrCode = QrCode::size(100)->generate($urlToRedirect);

        $request['barcode'] = $qrCode;
        $request['barcode_number'] = $number;
        $request['status'] = 'Pending';

        $dimond = Dimond::create($request->all());

        Daily::create([
            'dimonds_id' => $dimond->id,
            'barcode' => $number,
            'stage' => 'No',
            'status' => 0,
        ]);

        return redirect('admin/dimond')->with('success', "Add Record Successfully");
    }

    public function dimondCodeExists($number)
    {
        return Dimond::where('barcode_number', $number)->exists();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($barcode)
    {
        $designations = Designation::get();
        $processes = Process::where('dimonds_barcode', $barcode)->get();
        $barcodeDetail = Dimond::where('barcode_number', $barcode)->first();
        $procee_return = Process::where('dimonds_barcode', $barcode)->where('return_weight', null)->first();
        $final_result = Process::where('dimonds_barcode', $barcode)->where('designation', 'Grading')->latest()
            ->first();
        $lastweight = Process::where('dimonds_barcode', $barcode)->orderBy('id', 'DESC')->first();
        return view('admin.dimond.show', compact('designations', 'barcodeDetail', 'processes', 'procee_return', 'final_result', 'lastweight'));
    }

    public function dimondDetail(Request $request)
    {
        $barcode = $request->inputField;
        $designations = Designation::get();
        $barcodeDetail = Dimond::where('barcode_number', $barcode)->first();
        if (isset($barcodeDetail)) {
            $processes = Process::where('dimonds_barcode', $barcode)->get();
            $procee_return = Process::where('dimonds_barcode', $barcode)->where('return_weight', null)->first();
            $final_result = Process::where('dimonds_barcode', $barcode)->where('designation', 'Grading')->latest()
                ->first();
            $lastweight = Process::where('dimonds_barcode', $barcode)->orderBy('id', 'DESC')->first();
            return view('admin.dimond.show', compact('designations', 'barcodeDetail', 'processes', 'procee_return', 'final_result', 'lastweight'));
        }
        return redirect('admin/dimond')->withErrors(['error' => 'Barcode not found']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dimond = Dimond::findOrFail($id);
        $partys = Party::where('is_active', 1)->orderBy('id', 'DESC')->get();
        return view('admin.dimond.edit', compact('dimond', 'partys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'parties_id' => 'required',
            'dimond_name' => 'required',
            'weight' => 'required',
            'required_weight' => 'required',
            'shape' => 'required',
            'clarity' => 'required',
            'color' => 'required',
            'cut' => 'required',
            'polish' => 'required',
            'symmetry' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        }

        $dimond = Dimond::findOrFail($id);
        $input = $request->all();
        $dimond->update($input);
        return redirect('admin/dimond')->with('success', "Update Record Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dimond = Dimond::findOrFail($id);
        $daily = Daily::where('dimonds_id', $id)->first();
        isset($daily) ? $daily->delete() : '';
        $dimond->delete();
        return Redirect::back()->with('success', "Delete Record Successfully");
    }

    public function getWorkersByDesignation(Request $request)
    {
        $designation = $request->input('designation');
        $dimond = $request->input('dimond_id');
        $process_count = Process::where(['designation' => $designation, 'dimonds_id' => $dimond, 'ratecut' => 0])->count();
        $process = Process::where(['designation' => $designation, 'dimonds_id' => $dimond, 'ratecut' => 0])->first();
        $workers = Worker::where('is_active', 1)->where('designation', $designation)->get();

        if ($process_count != 0) {
            $workers = Worker::where('is_active', 1)->where(['designation' => $designation, 'fname' => $process->worker_name])->get();
        }

        return response()->json($workers);
    }

    public function getDesignationByCategory(Request $request)
    {
        $category = $request->input('category');

        $designations = Designation::get();

        if ($category != "all") {
            $designations = Designation::where('category', $category)->get();
        }

        return response()->json($designations);
    }

    // public function updateStatus(Request $request)
    // {
    //     $dimond = Dimond::findOrFail($request->id);
    //     $dimond->update(['status' => $request->status]);
    //     return Redirect::back();
    // }

    public function hrDimond()
    {
        $deliveredDimonds = Dimond::where('status', 'Delivered')->orderBy('id', 'DESC')->get();
        $completedDimonds = Dimond::where('status', 'Completed')->orderBy('id', 'DESC')->get();
        $processingDimonds = Dimond::whereIn('status', ['Processing', 'OutterProcessing'])->orderBy('id', 'DESC')->get();
        $pendingDimonds = Dimond::where('status', 'Pending')->orderBy('id', 'DESC')->get();
        $repairDimonds = Repair::orderBy('id', 'DESC')->get();
        return view('admin.dimond.hrdimond', compact('deliveredDimonds', 'completedDimonds', 'processingDimonds', 'pendingDimonds', 'repairDimonds'));
    }

    // public function printImage($id)
    // {
    //     $dimond = Dimond::where('id', $id)->first();

    //     if (!$dimond) {
    //         abort(404);
    //     }

    //     $img = Image::make(public_path('images/dimond-print.jpg'));

    //     $img->text("name", 100, 43, function ($font) {
    //         $font->file(public_path('fonts/Roboto/bitter/Bitter-Bold.otf'));
    //         $font->color('#000000');
    //         $font->size(30);
    //     });

    //     $img->text("name1", 400, 43, function ($font) {
    //         $font->file(public_path('fonts/Roboto/bitter/Bitter-Bold.otf'));
    //         $font->color('#000000');
    //         $font->size(30);
    //     });

    //     $img->text("name2", 700, 43, function ($font) {
    //         $font->file(public_path('fonts/Roboto/bitter/Bitter-Bold.otf'));
    //         $font->color('#000000');
    //         $font->size(30);
    //     });

    //     $img->text("name3", 20, 420, function ($font) {
    //         $font->file(public_path('fonts/Roboto/bitter/Bitter-Bold.otf'));
    //         $font->color('#000000');
    //         $font->size(30);
    //     });

    //     $img->text("name4", 170, 420, function ($font) {
    //         $font->file(public_path('fonts/Roboto/bitter/Bitter-Bold.otf'));
    //         $font->color('#000000');
    //         $font->size(30);
    //     });

    //     $bar = `<script src='https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js'></script>
    //     <script>JsBarcode('#barcode', ` . $dimond->barcode_number . `, {
    //         format: 'CODE128',
    //         displayValue: true,
    //      });</script>
    //     <svg id=barcode></svg>`;

    //     $img->text($bar, 200, 270, function ($font) {
    //         $font->file(public_path('fonts/Roboto/bitter/Bitter-Bold.otf'));
    //         $font->color('#000000');
    //         $font->size(30);
    //     });


    //     $img->text("name5", 320, 420, function ($font) {
    //         $font->file(public_path('fonts/Roboto/bitter/Bitter-Bold.otf'));
    //         $font->color('#000000');
    //         $font->size(30);
    //     });

    //     $img->text("name6", 480, 420, function ($font) {
    //         $font->file(public_path('fonts/Roboto/bitter/Bitter-Bold.otf'));
    //         $font->color('#000000');
    //         $font->size(30);
    //     });

    //     $img->text("name7", 620, 420, function ($font) {
    //         $font->file(public_path('fonts/Roboto/bitter/Bitter-Bold.otf'));
    //         $font->color('#000000');
    //         $font->size(30);
    //     });

    //     $img->text("name8", 770, 420, function ($font) {
    //         $font->file(public_path('fonts/Roboto/bitter/Bitter-Bold.otf'));
    //         $font->color('#000000');
    //         $font->size(30);
    //     });

    //     $name = time();
    //     $img->save(public_path('generateimg/' . $name . '.png'));
    //     $finalImagePath = 'generateimg/' . $name . '.png';

    //     return view('admin.dimond.imageView', compact('finalImagePath'));
    // }

    public function printImage($id)
    {
        $dimond = Dimond::where('id', $id)->first();

        return view('admin.dimond.pdfView', compact('dimond'));
    }
}
