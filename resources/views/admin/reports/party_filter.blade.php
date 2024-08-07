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
          <h4>Party Filter</h4>
        </div>
        <hr>
        <form action="{{ route('party.filter') }}" method="GET">
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
                <label>Status:</label>
                <div>
                  <label>
                    <input type="checkbox" name="status[]" value="Pending" {{ in_array('Pending', (array) request()->status) ? 'checked' : '' }}>
                    Pending
                  </label>
                  <br>
                  <label>
                    <input type="checkbox" name="status[]" value="Processing" {{ in_array('Processing', (array) request()->status) ? 'checked' : '' }}>
                    Processing
                  </label>
                  <br>
                  <label>
                    <input type="checkbox" name="status[]" value="OutterProcessing" {{ in_array('OutterProcessing', (array) request()->status) ? 'checked' : '' }}>
                    Outter Processing
                  </label>
                  <br>
                  <label>
                    <input type="checkbox" name="status[]" value="Completed" {{ in_array('Completed', (array) request()->status) ? 'checked' : '' }}>
                    Completed
                  </label>
                  <br>
                  <label>
                    <input type="checkbox" name="status[]" value="Delivered" {{ in_array('Delivered', (array) request()->status) ? 'checked' : '' }}>
                    Delivered
                  </label>
                </div>
                @if($errors->has('status'))
                <div class="error text-danger">{{ $errors->first('status') }}</div>
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
          </div>
        </form>
      </div>
      <div>
        @if(count($dimonds) > 0)
        @foreach ($partyLists as $partyList)
        <center>
          <h3><u>{{ $partyList->fname }}&nbsp;{{ $partyList->lname }}&nbsp;({{$partyList->party_code}})</u></h3>
        </center>
        @php
        $dimondsForParty = count($dimonds) > 0 ? $dimonds->where('parties_id', $partyList->id) : [];
        @endphp
        @if(count($dimondsForParty)> 0)
        <div class="table-responsive">
          <table id="exportTable" class="table align-items-center table-flush table-borderless partyFTable">
            <thead>
              <tr>
                <th>Action</th>
                <th>Party Code</th>
                <th>Dimond Name</th>
                <th>Row Weight</th>
                <th>Polished Weight</th>
                <th>Barcode</th>
                <th>Status</th>
                <th>Shap</th>
                <th>clarity</th>
                <th>color</th>
                <th>cut</th>
                <th>polish</th>
                <th>symmetry</th>
                <th>Created</th>
                <!-- <th>Last Modified</th> -->
                <th>Deliverd</th>
              </tr>
            </thead>
            <tbody>
              @foreach($dimondsForParty as $index =>$dimond)
              <tr>
                <td><a href="{{route('admin.dimond.show', $dimond->barcode_number)}}"><i class="fa fa-eye" style="color:white;font-size:15px;background-color:rgba(255, 255, 255, 0.25);padding:8px;"></i></a></td>
                <td>{{$dimond->parties->party_code}}</td>
                <td>{{$dimond->dimond_name}}</td>
                <td>{{$dimond->weight}}</td>
                <td>{{$dimond->required_weight}}</td>
                <td>{!! $dimond->barcode_number !!}</td>
                <td>{!! $dimond->status !!}</td>
                <td>{{$dimond->shape}}</td>
                <td>{{$dimond->clarity}}</td>
                <td>{{$dimond->color}}</td>
                <td>{{$dimond->cut}}</td>
                <td>{{$dimond->polish}}</td>
                <td>{{$dimond->symmetry}}</td>
                <td>{{ \Carbon\Carbon::parse($dimond->created_at)->format('d-m-Y') }}</td>
                <!-- <td>{{ \Carbon\Carbon::parse($dimond->updated_at)->format('d-m-Y') }}</td> -->
                <td>{{ \Carbon\Carbon::parse($dimond->delevery_date)->format('d-m-Y') }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <center>
          <h5 style="color:#000">No Record Found</h5>
        </center>
        <br />
        @endif
        @endforeach
        <br />
        @endif
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
    $(".partyFTable").DataTable({
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