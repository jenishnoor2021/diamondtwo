<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use App\Models\Designation;
use App\Models\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class AdminWorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers = Worker::orderBy('id', 'DESC')->get();
        return view('admin.worker.index', compact('workers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designations = Designation::get();
        return view('admin.worker.create', compact('designations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'fname' => 'required|unique:workers,fname',
            'lname' => 'required',
            'designation' => 'required',
            // 'address' => 'required',
            // 'mobile' => 'required',
            // 'aadhar_no' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput($input)->withErrors($validator);
        }

        $input['round_1'] = $input['round_1'] ?? '1';
        $input['round_2'] = $input['round_2'] ?? '1';
        $input['round_3'] = $input['round_3'] ?? '1';
        $input['fancy_0'] = $input['fancy_0'] ?? '1';
        $input['fancy_1'] = $input['fancy_1'] ?? '1';
        $input['fancy_2'] = $input['fancy_2'] ?? '1';
        $input['fancy_3'] = $input['fancy_3'] ?? '1';
        $input['fancy_4'] = $input['fancy_4'] ?? '1';
        $input['fancy_5'] = $input['fancy_5'] ?? '1';
        $input['fancy_6'] = $input['fancy_6'] ?? '1';
        $input['fancy_7'] = $input['fancy_7'] ?? '1';

        Worker::create($input);
        return redirect('admin/worker')->with('success', "Add Record successfully");
    }

    public function workerExists($name)
    {
        return Worker::where('fname', $name)->exists();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $designations = Designation::get();
        $worker = Worker::findOrFail($id);
        return view('admin.worker.edit', compact('worker', 'designations'));
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
        $worker = Worker::findOrFail($id);

        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'fname' => 'required|unique:workers,fname,' . $worker->id,
            'lname' => 'required',
            'designation' => 'required',
            // 'address' => 'required',
            // 'mobile' => 'required',
            // 'aadhar_no' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput($input)->withErrors($validator);
        }

        Process::where('worker_name', $worker->fname)->update(['worker_name' => $input['fname']]);

        $input['round_1'] = $input['round_1'] ?? '1';
        $input['round_2'] = $input['round_2'] ?? '1';
        $input['round_3'] = $input['round_3'] ?? '1';
        $input['fancy_0'] = $input['fancy_0'] ?? '1';
        $input['fancy_1'] = $input['fancy_1'] ?? '1';
        $input['fancy_2'] = $input['fancy_2'] ?? '1';
        $input['fancy_3'] = $input['fancy_3'] ?? '1';
        $input['fancy_4'] = $input['fancy_4'] ?? '1';
        $input['fancy_5'] = $input['fancy_5'] ?? '1';
        $input['fancy_6'] = $input['fancy_6'] ?? '1';
        $input['fancy_7'] = $input['fancy_7'] ?? '1';

        $worker->update($input);
        return redirect('admin/worker')->with('success', "update Record successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $worker = Worker::findOrFail($id);
        $worker->delete();
        return Redirect::back();
    }

    public function workerActive($id)
    {
        $worker = Worker::where('id', $id)->first();
        if ($worker->is_active == 1) {
            $worker->is_active = 0;
        } else {
            $worker->is_active = 1;
        }
        $worker->save();
        return redirect()->back()->with('success', "update Record Successfully");
    }
}
