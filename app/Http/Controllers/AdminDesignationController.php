<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\WorkerRate;
use App\Models\Designation;
use App\Models\Process;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminDesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designations = Designation::orderBy('id', 'DESC')->get();
        return view('admin.designation.index', compact('designations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required',
            'category' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        }

        Designation::create($request->all());

        for ($i = 1; $i < 5; $i++) {
            WorkerRate::create([
                'designation' => $request->name,
                'key' => 'key_' . $i,
                'value' => 0,
            ]);
        }

        return redirect('admin/designation')->with('success', "Add Record Successfully");
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
        $designation = Designation::findOrFail($id);
        return view('admin.designation.edit', compact('designation'));
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
            'name' => 'required',
            'category' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        }

        $designation = Designation::findOrFail($id);
        $workerrates = WorkerRate::where('designation', $designation->name)->get();

        foreach ($workerrates as $workerrate) {
            $workerrate->update(['designation' => $request->name]);
        }

        $process = Process::where('designation', $designation->name)->get();

        foreach ($process as $proces) {
            $proces->update(['designation' => $request->name]);
        }

        $workers = Worker::where('designation', $designation->name)->get();

        foreach ($workers as $worker) {
            $worker->update(['designation' => $request->name]);
        }

        $designation->update($request->all());
        return redirect('admin/designation')->with('success', "Update Record Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $designation = Designation::findOrFail($id);

        $workerrates = WorkerRate::where('designation', $designation->name)->get();

        foreach ($workerrates as $workerrate) {
            $workerrate->delete();
        }

        // $process = Process::where('designation', $designation->name)->get();

        // foreach ($process as $proces) {
        //     $proces->delete();
        // }

        // $workers = Worker::where('designation', $designation->name)->get();

        // foreach ($workers as $worker) {
        //     $worker->delete();
        // }

        $designation->delete();

        return Redirect::back()->with('success', "Delete Record Successfully");
    }
}
