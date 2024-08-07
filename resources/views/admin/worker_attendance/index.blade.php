@extends('layouts.admin')
@section('content')
<style>
   select option {
      background: none;
   }

   .buttons-html5 {
      background-color: aliceblue !important;
   }
</style>

<div class="row">
   <div class="col-lg-12">
      <div class="card">
         @if (session('success'))
         <div class="alert text-white pl-3 pt-2 pb-2" style="background-color:green">
            {{ session('success') }}
         </div>
         @endif
         <div class="card-header">
            <div class="row">
               <div class="col-md-4">
                  <h4>Attendance List</h4>
               </div>
               <div class="col-md-6">
                  {!! Form::open(['method'=>'GET', 'action'=> 'AdminWorkerAttendanceController@index','class'=>'form-horizontal']) !!}
                  @csrf
                  <input type="date" name="start_date" id="start_date" class="border border-dark" value="{{ isset(request()->start_date) ? request()->start_date : date('Y-m-d') }}" onchange="return this.form.submit();">
                  <input type="date" name="end_date" id="end_date" class="border border-dark" value="{{ isset(request()->end_date) ? request()->end_date : date('Y-m-d') }}" onchange="return this.form.submit();">
                  <select name="worker_id" id="worker_id" class="border border-dark" onchange="return this.form.submit();">
                     <option value="">Select worker</option>
                     @foreach($workers as $worker)
                     <option value="{{$worker->id}}" {{$worker->id == request()->worker_id ? "selected" : ''}}>{{$worker->fname}}&nbsp;{{$worker->lname}}</option>
                     @endforeach
                  </select>
                  {!! Form::close() !!}
               </div>
               <div class="col-md-2">
                  <a class="dropdown-item" style="background-color:darkorchid;" href="{{route('admin.attendance.create')}}"><i class="fa fa-plus" style="font-size:15px;">&nbsp;ADD</i></a>
               </div>
            </div>
         </div>
         <div class="table-responsive">
            <table id="workerattendancetable" class="table align-items-center table-flush table-borderless">
               <thead>
                  <tr>
                     <th>Action</th>
                     <th>Worker Name</th>
                     <th>Date</th>
                     <th>Check In</th>
                     <th>Check Out</th>
                     <th>Duration</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($todayattendanceRecords as $index =>$todayattendanceRecord)
                  <tr>
                     <td>
                        <a href="{{route('admin.attendance.edit', $todayattendanceRecord->id)}}"><i class="fa fa-edit" style="color:white;font-size:15px;background-color:rgba(255, 255, 255, 0.25);padding:8px;"></i></a>
                        <a href="{{route('admin.attendance.destroy', $todayattendanceRecord->id)}}" onclick="return confirm('Sure ! You want to delete ?');"><i class="fa fa-trash" style="color:white;font-size:15px;background-color:rgba(255, 255, 255, 0.25);padding:8px;"></i></a>
                     </td>
                     <td>{{$todayattendanceRecord->worker->fname}}&nbsp;{{$todayattendanceRecord->worker->lname}}</td>
                     <td>{{ \Carbon\Carbon::parse($todayattendanceRecord->date)->format('d-m-Y') }}</td>
                     <td>
                        {{ $todayattendanceRecord->check_in ? \Carbon\Carbon::parse($todayattendanceRecord->check_in)->format('g:i A') : '' }}
                     </td>
                     <td>{{ $todayattendanceRecord->check_out ? \Carbon\Carbon::parse($todayattendanceRecord->check_out)->format('g:i A') : '' }}</td>
                     <td>{{ $todayattendanceRecord->duration }}</td>
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
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

<script>
   $(document).ready(function() {
      $("#workerattendancetable").DataTable({
         dom: 'Blfrtip',
         buttons: [{
               extend: 'csv',
            },
            {
               extend: 'excel',
            }
         ]
      });
   });
</script>
@endsection