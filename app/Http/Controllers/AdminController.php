<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dimond;
use App\Models\Process;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{

    public function login(Request $req)
    {
        // return $req->input();
        $user = User::where(['username' => $req->username])->first();
        if (!$user || !Hash::check($req->password, $user->password)) {
            return redirect()->back()->with('alert', 'Username or password is not matched');
            // return "Username or password is not matched";
        } else {
            Auth::loginUsingId($user->id);
            $req->session()->put('user', $user);
            return redirect('/admin/dashboard');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    public function dashboard()
    {
        $pending_count = Dimond::where('status', 'Pending')->count();
        $completed_count = Dimond::where('status', 'Completed')->count();
        $deliverd_count = Dimond::where('status', 'Delivered')->count();
        $total_count = Dimond::where('status', '!=', 'Delivered')->count();
        $processing_count = Dimond::where('status', 'Processing')->count();
        $outercount = Dimond::where('status', 'OutterProcessing')->count();

        // $outerdesignation = Designation::where('category', 'Outter')->pluck('name')->toArray();
        // $distinctDimondIds = Process::select('dimonds_id')->distinct()->pluck('dimonds_id')->toArray();
        // $getdimonds = Dimond::whereIn('id', $distinctDimondIds)->whereNotIn('status', ['Delivered', 'Completed', 'Pending'])->get();
        // $processing_count = 0;
        // $outercount = 0;
        // foreach ($getdimonds as $val) {
        //     $var = Process::where('dimonds_id', $val->id)->latest()->first();
        //     if (in_array($var->designation, $outerdesignation)) {
        //         if (empty($var->return_weight)) {
        //             $outercount += 1;
        //         } else {
        //             $processing_count += 1;
        //         }
        //     } else {
        //         $processing_count += 1;
        //     }
        // }
        return view('admin.index', compact('pending_count', 'processing_count', 'completed_count', 'deliverd_count', 'total_count', 'outercount'));
    }

    public function profiledit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.profile.edit', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        // $user = User::where('id',1)->first();
        // $user->password = Hash::make($request->new_password);
        // $user->save();
        // return redirect()->back()->with("success","Password changed successfully !");
        // return $request;
        $user = Session::get('user');
        if (!(Hash::check($request->get('current_password'), $user->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }

        if (strcmp($request->get('current_password'), $request->get('new_password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Session::get('user');
        $user->password = bcrypt($request->get('new_password'));
        $user->save();

        return redirect()->back()->with("success", "Password changed successfully !");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
