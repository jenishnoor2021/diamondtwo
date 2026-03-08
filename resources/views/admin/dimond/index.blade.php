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
            <h4>Diamond List</h4>
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
            </div>
         </div>
         <div class="table-responsive">
            <table id="dimondtable" class="table align-items-center table-flush table-borderless">
               <thead>
                  <tr>
                     <th>Action</th>
                     <th>Party Name</th>
                     <th>Diamond Name</th>
                     <th>Row Weight</th>
                     <th>Polished Weight</th>
                     <th>Barcode</th>
                     <th>Detail</th>
                     <th>Status</th>
                     <th>Process</th>
                  </tr>
               </thead>
               <tbody>
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

<script>
   $(document).ready(function() {

      $('#dimondtable').DataTable({

         processing: true,
         serverSide: true,
         ajax: "{{ route('admin.dimond.index') }}",

         columns: [

            {
               data: 'action',
               name: 'action',
               orderable: false,
               searchable: false
            },

            {
               data: 'party',
               name: 'parties.party_code'
            },

            {
               data: 'dimond_name',
               name: 'dimond_name'
            },

            {
               data: 'weight',
               name: 'weight'
            },

            {
               data: 'required_weight',
               name: 'required_weight'
            },

            {
               data: 'barcode_number',
               name: 'barcode_number'
            },

            {
               data: 'detail',
               name: 'detail',
               orderable: false,
               searchable: false
            },

            {
               data: 'status',
               name: 'status'
            },

            {
               data: 'process',
               name: 'process.designation'
            }

         ]

      });

   });

   function addappdata1(id) {
      $('#showsolddetails' + id).toggle();
   }
</script>
@endsection