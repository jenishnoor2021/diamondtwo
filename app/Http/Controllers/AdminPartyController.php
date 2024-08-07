<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class AdminPartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partys = Party::orderBy('id', 'DESC')->get();
        return view('admin.party.index', compact('partys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.party.create');
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
            'fname' => 'required',
            'lname' => 'required',
            'party_code' => 'required',
            'address' => 'required',
            'mobile' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput($input)->withErrors($validator);
        }

        Party::create($input);
        return redirect('admin/party')->with('success', "Add Record Successfully");
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
        $party = Party::findOrFail($id);
        return view('admin.party.edit', compact('party'));
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
        $push = Party::findOrFail($id);

        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'party_code' => 'required',
            'address' => 'required',
            'mobile' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput($input)->withErrors($validator);
        }

        $push->update($input);
        return redirect('admin/party')->with('success', "Update Record Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $party = Party::findOrFail($id);
        $party->delete();
        return Redirect::back()->with('success', "Delete Record Successfully");
    }

    public function partyActive($id)
    {
        $party = Party::where('id', $id)->first();
        if ($party->is_active == 1) {
            $party->is_active = 0;
        } else {
            $party->is_active = 1;
        }
        $party->save();
        return redirect()->back()->with('success', "Update Record Successfully");
    }
}
