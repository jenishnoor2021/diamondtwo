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
            // 'address' => 'required',
            // 'mobile' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput($input)->withErrors($validator);
        }

        $input['round_1'] = $input['round_1'] ?? '1050';
        $input['round_2'] = $input['round_2'] ?? '1050';
        $input['round_3'] = $input['round_3'] ?? '900';
        $input['round_4'] = $input['round_4'] ?? '850';
        $input['round_5'] = $input['round_5'] ?? '850';
        $input['round_6'] = $input['round_6'] ?? '850';
        $input['fancy_1'] = $input['fancy_1'] ?? '1400';
        $input['fancy_2'] = $input['fancy_2'] ?? '1400';
        $input['fancy_3'] = $input['fancy_3'] ?? '1350';
        $input['fancy_4'] = $input['fancy_4'] ?? '1200';
        $input['fancy_5'] = $input['fancy_5'] ?? '1100';
        $input['fancy_6'] = $input['fancy_6'] ?? '1050';

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
            // 'address' => 'required',
            // 'mobile' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput($input)->withErrors($validator);
        }

        $input['round_1'] = $input['round_1'] ?? '1050';
        $input['round_2'] = $input['round_2'] ?? '1050';
        $input['round_3'] = $input['round_3'] ?? '900';
        $input['round_4'] = $input['round_4'] ?? '850';
        $input['round_5'] = $input['round_5'] ?? '850';
        $input['round_6'] = $input['round_6'] ?? '850';
        $input['fancy_1'] = $input['fancy_1'] ?? '1400';
        $input['fancy_2'] = $input['fancy_2'] ?? '1400';
        $input['fancy_3'] = $input['fancy_3'] ?? '1350';
        $input['fancy_4'] = $input['fancy_4'] ?? '1200';
        $input['fancy_5'] = $input['fancy_5'] ?? '1100';
        $input['fancy_6'] = $input['fancy_6'] ?? '1050';

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
