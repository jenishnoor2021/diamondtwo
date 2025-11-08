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
          <h4>VG Report</h4>
        </div>
        <hr>
        <form id="myForm" action="{{ route('admin.vg-report') }}" method="GET">
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
            <button type="button" id="button2" class="btn btn-light btn-round px-5">Export PDF</button>
            <a href="/admin/vg-report" class="btn btn-light btn-round px-5">Clear</a>
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
                    <th>Dimond Name</th>
                    <th>Barcode</th>
                    <th>Workers (POLISH)</th>
                    <th>Delivery Date</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($dimonds as $dimond)
                  <tr>
                    <td>{{ $dimond->dimond_name }}</td>
                    <td>{{ $dimond->barcode_number }}</td>
                    <td>
                      @if($dimond->workers->isNotEmpty())
                      {{ implode(', ', $dimond->workers->toArray()) }}
                      @else
                      -
                      @endif
                    </td>
                    <td>{{ $dimond->delevery_date }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            <?php } else { ?>
              @foreach ($dimonds as $partyId => $partyDimonds)
              @php
              $party = \App\Models\Party::find($partyId);
              @endphp
              <h5 class="mt-3 text-center">{{ $party ? $party->fname.' '.$party->lname : 'Unknown Party' }}</h5>
              <table class="table align-items-center table-flush table-borderless">
                <thead>
                  <tr>
                    <th>Diamond Name</th>
                    <th>Barcode</th>
                    <th>Workers (POLISH)</th>
                    <th>Delivery Date</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($partyDimonds as $dimond)
                  <tr>
                    <td>{{ $dimond->dimond_name }}</td>
                    <td>{{ $dimond->barcode_number }}</td>
                    <td>{{ $dimond->workers->isNotEmpty() ? implode(', ', $dimond->workers->toArray()) : '-' }}</td>
                    <td>{{ $dimond->delevery_date }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @endforeach
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

      form.action = "{{ route('admin.vg-report') }}";
      // Submit the form
      form.submit();
    });

    button2.addEventListener('click', function() {
      if ($("#party_id").val() == '') {
        alert("Please Select Party");
        return false;
      }

      // Change the form action for button 2
      form.action = "{{ route('admin.vg-report.export') }}";
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