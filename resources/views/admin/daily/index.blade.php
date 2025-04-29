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
         @if (session('error'))
         <div class="alert text-white pl-3 pt-2 pb-2" style="background-color:red">
            {{ session('error') }}
         </div>
         @endif
         <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Direct Issues Return</h4>
            <form method="POST" action="{{ route('admin.daily-status.store') }}">
               @csrf
               <input type="text" id="inputField2" name="inputField" placeholder="Search barcode" required>
            </form>
            <h5></h5>
         </div>
         <div class="row">
            <div class="col-6" style="text-align:start">
               <h5><span class="text-warning ml-3">Total Dimonds:</span> {{$dimondcount}}</h5>
               <h5><span class="text-warning ml-3">Pending Dimonds:</span> {{$pendingcount}}</h5>
               <h5><span class="text-warning ml-3">Processing Dimonds:</span> {{$issuecount}}</h5>
               <h5><span class="text-warning ml-3"> Outer Dimond:</span> {{$outercount}}</h5>
            </div>
            <div class="col-3" style="text-align:end;">
               <h5><span class="text-warning">Count:</span> {{$scancount}}</h5>
            </div>
            <div class="col-3" style="text-align:end;">
               <a href="/admin/daily-status/refresh" class="btn btn-secondary"><i class="fa fa-refresh fa-2x" aria-hidden="true"></i></a>
            </div>
         </div>

         <div class="">
            <table id="dailytable" class="table align-items-center table-flush table-borderless">
               <thead>
                  <tr>
                     <th>Action</th>
                     <th>Dimond Name</th>
                     <th>Barcode</th>
                     <th>Date</th>
                     <!-- <th>Stage</th> -->
                     <th>Current Status</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     @foreach($dailys as $index =>$dimond)
                     <td>
                        <!-- <a href="{{route('admin.daily-status.destroy', $dimond->id)}}" onclick="return confirm('Sure ! You want to delete ?');"><i class="fa fa-trash" style="color:white;font-size:15px;background-color:rgba(255, 255, 255, 0.25);padding:8px;"></i></a> -->
                        <a href="{{route('admin.dimond.show', $dimond->barcode)}}"><i class="fa fa-eye" style="color:white;font-size:15px;background-color:rgba(255, 255, 255, 0.25);padding:8px;"></i></a>
                     </td>
                     <td>{{$dimond->dimonds->dimond_name}}</td>
                     <td>{{$dimond->barcode}}</td>
                     <td>{{ \Carbon\Carbon::parse($dimond->updated_at)->format('d-m-Y') }}</td>
                     <td>{{$dimond->dimonds->status}}</td>
                     <!-- <td><b><span class="{{ $dimond->stage == 'issue' ? 'text-success' : 'text-danger' }}">{{$dimond->stage}}</span></b></td> -->
                     <td><a href="/admin/daily-status/statusupdate/{{ $dimond->id }}" class="btn {{ $dimond->status == 0 ? 'btn-danger' : 'btn-success'}}">{{$dimond->stage}}</a></td>
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
   document.addEventListener('DOMContentLoaded', function() {
      // Auto-focus on the input field when the page loads
      document.getElementById('inputField2').focus();
   });
</script>
@endsection