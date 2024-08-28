<?php

use Carbon\Carbon;
use App\Models\Dimond;
use App\Models\Process;
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
          <h4>Worker Slip</h4>
        </div>
        <hr>
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
        <form id="myForm" action="{{ route('admin.workersummary') }}" method="GET">
          @csrf
          <div class="row">
            <div class="col-2">
              <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="custom-select form-control form-control-rounded" required>
                  <option value="">Select category</option>
                  <!-- <option value="all" {{ request()->category == 'all' ? 'selected' : '' }}>ALL</option> -->
                  <!-- <option value="Inner" {{ request()->category == 'Inner' ? 'selected' : '' }}>Inner Worker</option> -->
                  <option value="Outter" {{ request()->category == 'Outter' ? 'selected' : '' }}>Outter Worker</option>
                </select>
                @if($errors->has('designation'))
                <div class="error text-danger">{{ $errors->first('designation') }}</div>
                @endif
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label for="designation">Designation</label>
                <select name="designation" id="designation" class="custom-select form-control form-control-rounded" required>
                  <option value="">Select designation</option>
                  <!-- <option value="all" {{ request()->designation == 'all' ? 'selected' : '' }}>ALL</option> -->
                  @foreach($designations as $designation)
                  <option value="{{$designation->name}}" {{ request()->designation == $designation->name ? 'selected' : '' }}>{{$designation->name}}</option>
                  @endforeach
                </select>
                @if($errors->has('designation'))
                <div class="error text-danger">{{ $errors->first('designation') }}</div>
                @endif
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label for="worker_name">Worker Name</label>
                <select name="worker_name" id="worker_name" class="custom-select form-control form-control-rounded" required>
                  <option value="">Select worker</option>
                  <!-- <option value="all" {{ request()->worker_name == 'all' ? 'selected' : '' }}>ALL</option> -->
                  @foreach($workerLists as $workerList)
                  <option value="{{$workerList->fname}}" {{ request()->worker_name == $workerList->fname ? 'selected' : '' }}>{{$workerList->fname}}&nbsp;&nbsp;{{$workerList->lname}}</option>
                  @endforeach
                </select>
                @if($errors->has('party_id'))
                <div class="error text-danger">{{ $errors->first('party_id') }}</div>
                @endif
              </div>
            </div>
            <div class="col-2">
              <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" class="form-control form-control-rounded" id="start_date" value="{{ request()->start_date }}">
                @if($errors->has('start_date'))
                <div class="error text-danger">{{ $errors->first('start_date') }}</div>
                @endif
              </div>
            </div>
            <div class="col-2">
              <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" class="form-control form-control-rounded" id="end_date" value="{{ request()->end_date }}">
                @if($errors->has('end_date'))
                <div class="error text-danger">{{ $errors->first('end_date') }}</div>
                @endif
              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="button" id="button1" class="btn btn-light btn-round px-5">Report</button>
            <!-- <button type="button" id="button2" class="btn btn-light btn-round px-5">Export Report</button> -->
            <a href="/admin/worker_slip" class="btn btn-light btn-round px-5">Clear</a>
          </div>
        </form>
      </div>
      <div>
        <form id="checkboxForm" action="{{ route('admin.generateslippdf') }}" method="POST">
          @csrf
          @foreach($workers as $worker)
          <center>
            <h4 style="margin-top:20px">{{$worker->fname}}&nbsp;{{$worker->lname}}</h4>
          </center>
          <button type="submit">Generate PDF</button>
          <input type="hidden" id="selectedIds" name="selectedIds">
          <input type="hidden" id="worker_name" name="worker_name" value="{{$worker->fname}}">
          <!-- <button id="generatePdf" class="btn btn-primary">Generate PDF</button> -->
          <div class="table-responsive">
            <table id="" class="table align-items-center table-flush table-borderless">
              <thead>
                <tr>
                  <th>selected</th>
                  <th>Diamond Name</th>
                  <th>Diamond Barcode</th>
                  <th>Issue Date</th>
                  <th>Issue Weight</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
                $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';
                $workerprocess = Process::where('worker_name', $worker->fname)->where('return_weight', null)->get();

                if ($startDate && $endDate) {
                  $workerprocess = Process::where('worker_name', $worker->fname)->where('return_weight', null)->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->get();
                }
                ?>
                @foreach($workerprocess as $workerpro)
                <?php
                $dimond = Dimond::where('barcode_number', $workerpro->dimonds_barcode)->first();
                ?>
                <tr>
                  <td><input type="checkbox" class="checkbox" name="selected[]" value="{{ $workerpro->id }}"></td>
                  <td>{{$dimond->dimond_name}}</td>
                  <td>{{$workerpro->dimonds_barcode}}</td>
                  <td>{{ \Carbon\Carbon::parse($workerpro->issue_date)->format('d-m-Y') }}</td>
                  <td>{{$workerpro->issue_weight}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @endforeach
        </form>
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
    $('#designation').change(function() {
      var designation = $(this).val();
      if (designation == 'all') {
        $('#worker_name').append('<option value="all" selected>ALL</option>');
      } else if (designation && designation != 'all') {
        $.ajax({
          type: 'POST',
          url: '/admin/get-workers',
          data: {
            '_token': '{{ csrf_token() }}',
            'designation': designation,
          },
          success: function(data) {
            $('#worker_name').empty();
            // $('#worker_name').append('<option value="">Select worker</option><option value="all">ALL</option>');
            $.each(data, function(key, value) {
              $('#worker_name').append('<option value="' + value.fname + '">' + value.fname + ' ' + value.lname + '</option>');
            });
          }
        });
      } else {
        $('#worker_name').empty();
      }
    });
    $('#category').change(function() {
      var category = $(this).val();
      if (category) {
        $.ajax({
          type: 'POST',
          url: '/admin/get-designation',
          data: {
            '_token': '{{ csrf_token() }}',
            'category': category,
          },
          success: function(data) {
            $('#designation').empty();
            // $('#designation').append('<option value="">Select designation</option><option value="all">ALL</option>');
            $.each(data, function(key, value) {
              $('#designation').append('<option value="' + value.name + '">' + value.name + '</option>');
            });
          }
        });
      } else {
        $('#designation').empty();
      }
    });
  });
  document.addEventListener("DOMContentLoaded", function() {
    var selectedIds = [];

    var checkboxes = document.querySelectorAll('.checkbox');

    checkboxes.forEach(function(checkbox) {
      checkbox.addEventListener('change', function() {
        if (this.checked) {
          selectedIds.push(this.value);
        } else {
          var index = selectedIds.indexOf(this.value);
          if (index !== -1) {
            selectedIds.splice(index, 1);
          }
        }

        document.getElementById('selectedIds').value = selectedIds.join(',');
      });
    });
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('myForm');
    var button1 = document.getElementById('button1');
    var button2 = document.getElementById('button2');

    button1.addEventListener('click', function() {
      // Change the form action for button 1
      if ($("#worker_name").val() == '') {
        alert("Please Select Worker");
        return false;
      }
      form.action = "{{ route('admin.workerslip') }}";
      // Submit the form
      form.submit();
    });
  });

  $(document).ready(function() {
    $("#workersummaryTable").DataTable({
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