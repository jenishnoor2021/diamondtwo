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
          <h4>Dimond Report</h4>
        </div>
        <hr>
        <form action="{{ route('admin.add-dimond.list') }}" id="myDiamondList" method="get">
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
            <a href="/admin/dimond_list" class="btn btn-light btn-round px-5 mt-4">Clear</a>
          </div>
        </form>
      </div>
      <div>
        @if(count($data) > 0)
        <div class="table-responsive">
          <table id="exportworkerTable" class="table align-items-center table-flush table-borderless">
            <thead>
              <tr>
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
          @else
          No Record Found
          @endif
        </div>
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
    $("#exportworkerTable").DataTable({
      dom: 'Blfrtip',
      buttons: [{
          extend: 'pdf',
        },
        {
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