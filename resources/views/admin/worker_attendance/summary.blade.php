@extends('layouts.admin')
@section('content')
<style>
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
                  <h4>Attendance Summary</h4>
               </div>
               <div class="col-md-6">
                  {!! Form::open(['method'=>'GET', 'action'=> 'AdminWorkerAttendanceController@attendanceSummary','class'=>'form-horizontal']) !!}
                  @csrf
                  <input type="date" name="start_date" id="start_date" class="border border-dark" value="{{ isset(request()->start_date) ? request()->start_date : date('Y-m-d') }}" onchange="return this.form.submit();">
                  <input type="date" name="end_date" id="end_date" class="border border-dark" value="{{ isset(request()->end_date) ? request()->end_date : date('Y-m-d') }}" onchange="return this.form.submit();">
                  {!! Form::close() !!}
               </div>
               <div class="col-md-2">
               </div>
            </div>
         </div>
         <div class="table-responsive">
            <table id="attendancesummarytable" class="table align-items-center table-flush table-borderless">
               <thead>
                  <tr>
                     <th>Worker Name</th>
                     <th>Total Days</th>
                     <th>Present Days</th>
                     <th>Absent Days</th>
                  </tr>
               </thead>
               <tbody>
                  @if(count($todayattendanceRecords) > 0)
                  @foreach($workers as $index =>$worker)
                  <?php
                  $presentdays = $absentdays = 0;
                  $presentdays = $todayattendanceRecords->where('worker_id', $worker->id)->count();
                  $absentdays = $totaldays - $presentdays;
                  ?>
                  <tr>
                     <td>{{$worker->fname}}&nbsp;{{$worker->lname}}</td>
                     <td>{{$totaldays}}</td>
                     <td>{{$presentdays}}</td>
                     <td>{{$absentdays}}</td>
                  </tr>
                  @endforeach
                  @endif
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
      $("#attendancesummarytable").DataTable({
         dom: 'Blfrtip',
         buttons: [{
            extend: 'csv',
         }]
      });
   });
</script>
@endsection