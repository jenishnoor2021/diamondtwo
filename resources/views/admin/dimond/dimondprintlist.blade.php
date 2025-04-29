<?php

use App\Models\Dimond;
?>
@extends('layouts.admin')
@section('content')
@section('style')
<style>
  .dt-button.buttons-html5 {
    background-color: aliceblue;
  }
</style>
@endsection
<div class="row mt-3">
  <div class="col-lg-12 mx-auto">
    <div class="card">
      <div class="card-body">

        <div class="card-title">
          <h4>Dimond List</h4>
        </div>
        <hr>
        <form action="{{ route('admin.dimond-print.list') }}" id="myDiamondPrintList" method="get">
          @csrf
          <div class="row">
            <div class="col-2">
              <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" class="form-control form-control-rounded" id="start_date" value="<?= isset(request()->start_date) ? request()->start_date : ''; ?>" required>
                @if($errors->has('start_date'))
                <div class="error text-danger">{{ $errors->first('start_date') }}</div>
                @endif
              </div>
            </div>
            <div class="col-2">
              <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" class="form-control form-control-rounded" id="end_date" value="<?= isset(request()->end_date) ? request()->end_date : ''; ?>" required>
                @if($errors->has('end_date'))
                <div class="error text-danger">{{ $errors->first('end_date') }}</div>
                @endif
              </div>
            </div>
          </div>
          <div class="form-group">
            <!-- <button type="submit" class="btn btn-light btn-round px-5">Generate PDF</button> -->
            <button type="submit" class="btn btn-light btn-round px-5 mt-4">List</button>
            <a href="/admin/diamondprintlist" class="btn btn-light btn-round px-5 mt-4">Clear</a>
          </div>
        </form>
      </div>
      <div>
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        @if(count($data) > 0)
        <div class="table-responsive">
          <form action="{{ route('downloadPDF') }}" method="POST">
            @csrf
            <table id="diamondprintTable" class="table align-items-center table-flush table-borderless">
              <thead>
                <tr>
                  <th><input type="checkbox" id="selectAll"></th>
                  <th>Sr.</th>
                  <th>Dimond Name</th>
                  <th>Dimond barcode</th>
                  <th>Created Date</th>
                  <th>Delivery Date</th>
                </tr>
              </thead>
              @php
              $p = 1;
              @endphp
              <tbody>
                @foreach($data as $key=>$da)
                <tr>
                  <td><input type="checkbox" name="selected_diamonds[]" value="{{ $da->id }}"></td>
                  <td>{{$p}}</td>
                  <td>{{ $da->dimond_name }}</td>
                  <td>{{ $da->barcode_number }}</td>
                  <td>{{ \Carbon\Carbon::parse($da->created_at)->format('d-m-Y') }}</td>
                  <td>{{ \Carbon\Carbon::parse($da->delevery_date)->format('d-m-Y') }}</td>
                  @php
                  $p += 1;
                  @endphp
                </tr>
                @endforeach
              </tbody>
            </table>
            <button type="submit">Download Selected</button>
          </form>
        </div>
        @else
        No Record Found
        @endif
      </div>
    </div>
  </div>
</div><!--End Row-->

@endsection

@section('script')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
  document.getElementById('selectAll').addEventListener('change', function(e) {
    const checkboxes = document.querySelectorAll('input[name="selected_diamonds[]"]');
    checkboxes.forEach(checkbox => {
      checkbox.checked = e.target.checked;
    });
  });
  $(document).ready(function() {
    $("#diamondprintTable").DataTable();
  });
</script>
@endsection