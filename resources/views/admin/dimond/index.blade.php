<?php

use App\Models\Process;
?>
@extends('layouts.admin')
@section('style')
<style>
   form {
      width: 300px;
      padding: 20px;
      border-radius: 5px;
   }

   input {
      width: 100%;
      padding: 2px;
      margin-bottom: 16px;
      box-sizing: border-box;
      background-color: transparent;
      color: white
   }
</style>
@endsection
@section('content')

<div class="row">
   <div class="col-lg-12">
      <div class="card">
         @if (session('success'))
         <div class="alert text-white pl-3 pt-2 pb-2" style="background-color:green">
            {{ session('success') }}
         </div>
         @endif
         <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Dimond List</h4>
            <div class="flex">
               <form method="GET" action="{{ route('dimond.detail') }}" class="mx-auto">
                  @csrf
                  <input type="text" id="inputField1" name="inputField" placeholder="Search barcode" required>
               </form>
               @if ($errors->any())
               <div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                  <p>{{ $error }}</p>
                  @endforeach
               </div>
               @endif
            </div>

            <div class="card-action d-flex">
               <!-- <div class="dropdown-menu-right"> -->
               <a class="dropdown-item" style="background-color:darkorchid;" href="{{ route('admin.dimond.create') }}">
                  <i class="fa fa-plus editable" style="font-size:15px;">&nbsp;ADD</i>
               </a>
               &nbsp;&nbsp;
               <a class="dropdown-item" style="background-color:blue;" href="{{ route('admin.dimond.import') }}">
                  Import
               </a>
               <!-- </div> -->
            </div>
         </div>
         <div class="table-responsive">
            <table id="dimondtable" class="table align-items-center table-flush table-borderless">
               <thead>
                  <tr>
                     <th>Action</th>
                     <th>PArty Name</th>
                     <th>Dimond Name</th>
                     <th>Row Weight</th>
                     <th>Polished Weight</th>
                     <th>Barcode</th>
                     <!-- <th>Barcode show</th> -->
                     <th>Detail</th>
                     <th>Status</th>
                     <th>Process</th>
                     <!-- <th>Shap</th>
                     <th>clarity</th>
                     <th>color</th>
                     <th>cut</th>
                     <th>polish</th>
                     <th>symmetry</th> -->
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     @foreach($dimonds as $index =>$dimond)
                     @php
                     $process = Process::where('dimonds_id',$dimond->id)->latest()->first();
                     $designation = isset($process) ? $process->designation : '';
                     @endphp
                     <td>
                        <a href="/admin/print-image/{{$dimond->id}}" target="_blank" class="btn btn-secondary">Print</a>
                        <a href="{{route('admin.dimond.show', $dimond->barcode_number)}}"><i class="fa fa-eye" style="color:white;font-size:15px;background-color:rgba(255, 255, 255, 0.25);padding:8px;"></i></a>
                        <a href="{{route('admin.dimond.edit', $dimond->id)}}"><i class="fa fa-edit" style="color:white;font-size:15px;background-color:rgba(255, 255, 255, 0.25);padding:8px;"></i></a>
                        <a href="{{route('admin.dimond.destroy', $dimond->id)}}" onclick="return confirm('Sure ! You want to delete ?');"><i class="fa fa-trash" style="color:white;font-size:15px;background-color:rgba(255, 255, 255, 0.25);padding:8px;"></i></a>
                     </td>
                     <td>{{$dimond->parties->party_code}}</td>
                     <td>{{$dimond->dimond_name}}</td>
                     <td>{{$dimond->weight}}</td>
                     <td>{{$dimond->required_weight}}</td>
                     <td>{!! $dimond->barcode_number !!}</td>
                     <!-- <td><svg id="barcode_{{$index}}" style="display:none"></svg>
                        <button id="{{$index}}" onclick="getbarcode(this.id,<?php echo $dimond->barcode_number ?>)">show</button>
                     </td> -->
                     <td>
                        <div id="animalstatus{{$dimond->id}}" onclick="addappdata(this.id)" style="border:0px solid;"><i class="fa fa-plus-circle mt-2 text-warning" aria-hidden="true"></i>show
                        </div>
                        <div id="showsolddetailsanimalstatus{{$dimond->id}}" style="display:none">
                           <p><span class="text-warning">Shap :</span> {{$dimond->shape}}</p>
                           <p><span class="text-warning">clarity :</span> {{$dimond->clarity}}</p>
                           <p><span class="text-warning">color :</span> {{$dimond->color}}</p>
                           <p><span class="text-warning">cut :</span> {{$dimond->cut}}</p>
                           <p><span class="text-warning">polish :</span> {{$dimond->polish}}</p>
                           <p><span class="text-warning">symmetry :</span> {{$dimond->symmetry}}</p>
                        </div>
                     </td>
                     <td>{!! $dimond->status !!}</td>
                     <td>{{ $designation }}</td>
                     <!-- <td>{{$dimond->shape}}</td>
                     <td>{{$dimond->clarity}}</td>
                     <td>{{$dimond->color}}</td>
                     <td>{{$dimond->cut}}</td>
                     <td>{{$dimond->polish}}</td>
                     <td>{{$dimond->symmetry}}</td> -->
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div><!--End Row-->

@endsection

@section('script')
<script>
   function getbarcode(index, value) {
      document.getElementById('barcode_' + index).style.display = "block";
      JsBarcode("#barcode_" + index, value, {
         format: "CODE128",
         displayValue: true,
         height: 100,
         width: 4,
         fontOptions: "bold",
         fontSize: 40,
      });
   }
</script>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
<script>
   document.addEventListener('DOMContentLoaded', function() {
      // Auto-focus on the input field when the page loads
      document.getElementById('inputField1').focus();
   });

   function addappdata(cli_id) {
      // $("#showsolddetails"+cli_id).show();
      var div = document.getElementById("showsolddetails" + cli_id);
      if (div.style.display !== "block") {
         div.style.display = "block";
      } else {
         div.style.display = "none";
      }
   }
</script>
@endsection