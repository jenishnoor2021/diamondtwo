<?php

use Carbon\Carbon;
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
          <h4>Diamond Slip</h4>
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
        <form action="{{ route('admin.diamondslip') }}" method="GET">
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
            <button type="submit" class="btn btn-light btn-round px-5">Report</button>
            <a href="/admin/dimond_slip" class="btn btn-light btn-round px-5">Clear</a>
          </div>
        </form>
      </div>
      <div>
        @if(count($dimonds) > 0)
        <div class="table-responsive">
          <table id="" class="table align-items-center table-flush table-borderless">
            <thead>
              <tr>
                <th><input type="checkbox" id="selectAll"> All</th>
                <th>Dimond Name</th>
                <th>Row Weight</th>
                <th>Polished Weight</th>
                <!-- <th>Barcode</th> -->
                <!-- <th>Status</th> -->
                <th>Shap</th>
                <!-- <th>clarity</th> -->
                <!-- <th>color</th> -->
                <th>cut</th>
                <!-- <th>polish</th> -->
                <!-- <th>symmetry</th> -->
                <th>Amount</th>
                <th>Deliverd</th>
              </tr>
            </thead>
            <form id="checkboxForm" action="{{ route('admin.diamondslippdf') }}" method="POST">
              <tbody>
                @csrf
                <button type="submit">Generate PDF</button>
                <input type="hidden" id="selectedIds" name="selectedIds">
                <button type="submit" formaction="{{ route('admin.diamondslipexcel') }}">Generate Excel</button>
                <tr>
                  @foreach($dimonds as $index =>$dimond)
                  <input type="hidden" id="parties_id" name="parties_id" value="{{$dimond->parties_id}}">

                  <td><input type="checkbox" class="checkbox" name="selected[]" value="{{ $dimond->id }}"></td>
                  <td>{{$dimond->dimond_name}}</td>
                  <td>{{$dimond->weight}}</td>
                  <td>{{$dimond->required_weight}}</td>
                  <!-- <td>{!! $dimond->barcode_number !!}</td> -->
                  <!-- <td>{!! $dimond->status !!}</td> -->
                  <td>{{$dimond->shape}}</td>
                  <!-- <td>{{$dimond->clarity}}</td> -->
                  <!-- <td>{{$dimond->color}}</td> -->
                  <td>{{$dimond->cut}}</td>
                  <!-- <td>{{$dimond->polish}}</td> -->
                  <!-- <td>{{$dimond->symmetry}}</td> -->
                  <td>{{$dimond->amount}}</td>
                  <td>{{ \Carbon\Carbon::parse($dimond->delevery_date)->format('d-m-Y') }}</td>
                </tr>
                @endforeach
              </tbody>
            </form>
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
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const checkboxes = document.querySelectorAll('.checkbox');
    const selectAll = document.getElementById('selectAll');
    const selectedIdsInput = document.getElementById('selectedIds');
    let selectedIds = [];

    // ✅ Select All Checkbox Logic
    selectAll.addEventListener('change', function() {
      selectedIds = [];
      checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
        if (this.checked) {
          selectedIds.push(checkbox.value);
        }
      });
      selectedIdsInput.value = selectedIds.join(',');
    });

    // ✅ Individual Checkbox Logic
    checkboxes.forEach(checkbox => {
      checkbox.addEventListener('change', function() {
        if (this.checked) {
          selectedIds.push(this.value);
        } else {
          selectedIds = selectedIds.filter(id => id !== this.value);
          selectAll.checked = false; // Uncheck "Select All" if one is deselected
        }

        // If all individual boxes are checked, also check "Select All"
        if (checkboxes.length === document.querySelectorAll('.checkbox:checked').length) {
          selectAll.checked = true;
        }

        selectedIdsInput.value = selectedIds.join(',');
      });
    });
  });
</script>
@endsection