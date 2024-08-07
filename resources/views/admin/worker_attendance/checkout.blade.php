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
        <h4>Check Out</h4>
        <form method="POST" action="{{ route('admin.check-out.store') }}">
          @csrf
          <input type="number" id="inputField" name="inputField" placeholder="Search barcode" required>
        </form>
        <h5></h5>
      </div>

      <div class="">
        <table id="dailytable" class="table align-items-center table-flush table-borderless">
          <thead>
            <tr>
              <th>Worker Name</th>
              <th>Date</th>
              <th>check In</th>
              <th>check Out</th>
              <th>Duration</th>
            </tr>
          </thead>
          <tbody>
            @foreach($todayattendanceRecords as $index =>$todayattendanceRecord)
            <tr>
              <td>{{$todayattendanceRecord->worker->fname}}&nbsp;{{$todayattendanceRecord->worker->lname}}</td>
              <td>{{ \Carbon\Carbon::parse($todayattendanceRecord->date)->format('d-m-Y') }}</td>
              <td>{{ \Carbon\Carbon::parse($todayattendanceRecord->check_in)->format('g:i A') }}</td>
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
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Auto-focus on the input field when the page loads
    document.getElementById('inputField').focus();
  });
</script>
@endsection