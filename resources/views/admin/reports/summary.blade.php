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
          <h4>Summary</h4>
        </div>
        <hr>
        <form id="myForm" action="{{ route('admin.summary') }}" method="GET">
          @csrf
          <div class="row">
            <div class="col-3">
              <div class="form-group">
                <label for="party_id">Party Name</label>
                <select name="party_id" id="party_id" class="custom-select form-control form-control-rounded" required>
                  <option value="">Select party</option>
                  <option value="All" {{ request()->party_id == 'All' ? 'selected' : '' }}>ALL</option>
                  @foreach($partyLists as $partyList)
                  <option value="{{$partyList->id}}" {{ request()->party_id == $partyList->id ? 'selected' : '' }}>{{$partyList->fname}}&nbsp;&nbsp;{{$partyList->lname}}</option>
                  @endforeach
                </select>
                @if($errors->has('party_id'))
                <div class="error text-danger">{{ $errors->first('party_id') }}</div>
                @endif
              </div>
            </div>

            <div class="col-3">
              <div class="form-group">
                <a href="/admin/summary" class="btn btn-light btn-round px-5">Clear</a>
              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="button" id="button1" class="btn btn-light btn-round px-5">Report</button>
            <button type="button" id="button2" class="btn btn-light btn-round px-5">Export Report</button>
          </div>
        </form>
      </div>
      <div>
        <?php if (isset($_GET['party_id'])) { ?>
          <div class="table-responsive">
            <?php if ($_GET['party_id'] != 'All') { ?>
              <table id="" class="table align-items-center table-flush table-borderless">
                <thead>
                  <tr>
                    <th>Action</th>
                    <th>Dimond Name</th>
                    <th>Barcode</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($partyes as $partyList)
                  <?php
                  $allDimonds = Dimond::where('parties_id', $partyList->id)->where('status', '!=', 'Delivered')->get();
                  ?>
                  @foreach($allDimonds as $allDimond)
                  <tr>
                    <td><a href="{{route('admin.dimond.show', $allDimond->barcode_number)}}"><i class="fa fa-eye" style="color:white;font-size:15px;background-color:rgba(255, 255, 255, 0.25);padding:8px;"></i></a></td>
                    <td>{{$allDimond->dimond_name}}</td>
                    <td>{{$allDimond->barcode_number}}</td>
                    <td>{{ \Carbon\Carbon::parse($allDimond->created_at)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($allDimond->updated_at)->format('d-m-Y') }}</td>
                    <td>{{$allDimond->status}}</td>
                  </tr>
                  @endforeach
                  @endforeach
                </tbody>
              </table>
            <?php } else { ?>
              <table id="" class="table align-items-center table-flush table-borderless">
                <thead>
                  <tr>
                    <th>Party Name</th>
                    <th>Pending</th>
                    <th>Outter</th>
                    <th>Processing</th>
                    <th>Completed</th>
                    <th>Delivered</th>
                    <th>Total Dimond</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($partyes as $partyList)
                  <?php
                  $totalDimond = Dimond::where('parties_id', $partyList->id)->count();
                  $outterDimond = Dimond::where(['parties_id' => $partyList->id, 'status' => 'OutterProcessing'])->count();
                  $pendingDimond = Dimond::where(['parties_id' => $partyList->id, 'status' => 'Pending'])->count();
                  $processingDimond = Dimond::where('parties_id', $partyList->id)->where('status', 'Processing')->count();
                  $completedDimond = Dimond::where(['parties_id' => $partyList->id, 'status' => 'Completed'])->count();
                  $deliveredDimond = Dimond::where(['parties_id' => $partyList->id, 'status' => 'Delivered'])->count();
                  ?>
                  <tr>
                    <td>{{$partyList->fname}}&nbsp;{{$partyList->lname}}</td>
                    <td>{{$pendingDimond}}</td>
                    <td>{{$outterDimond}}</td>
                    <td>{{$processingDimond}}</td>
                    <td>{{$completedDimond}}</td>
                    <td>{{$deliveredDimond}}</td>
                    <td>{{$totalDimond}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            <?php } ?>
          </div>
        <?php } ?>
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
  document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('myForm');
    var button1 = document.getElementById('button1');
    var button2 = document.getElementById('button2');

    button1.addEventListener('click', function() {
      // Change the form action for button 1
      if ($("#party_id").val() == '') {
        alert("Please Select Party");
        return false;
      }

      form.action = "{{ route('admin.summary') }}";
      // Submit the form
      form.submit();
    });

    button2.addEventListener('click', function() {
      if ($("#party_id").val() == '') {
        alert("Please Select Party");
        return false;
      }

      // Change the form action for button 2
      form.action = "{{ route('admin.summary.export') }}";
      // Submit the form
      form.submit();
    });
  });

  $(document).ready(function() {
    $("#summaryTable").DataTable({
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