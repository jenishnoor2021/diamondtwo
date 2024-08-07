@extends('layouts.admin')
@section('content')
<div class="row mt-3">
  <div class="col-lg-12 mx-auto">
    <div class="card">
      <div class="card-body">

        <div class="card-title">
          <h4>Party Bill</h4>
        </div>
        <hr>
        <form action="{{ route('party.bill') }}" id="billform" method="post">
          @csrf
          <div class="row">
            <div class="col-3">
              <div class="form-group">
                <label for="party_id">Party Name</label>
                <select name="party_id" id="party_id" class="custom-select form-control form-control-rounded" required>
                  <option value="">Select party</option>
                  @foreach($partyLists as $partyList)
                  <option value="{{$partyList->id}}">{{$partyList->fname}}&nbsp;&nbsp;{{$partyList->lname}}</option>
                  @endforeach
                </select>
                @if($errors->has('party_id'))
                <div class="error text-danger">{{ $errors->first('party_id') }}</div>
                @endif
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" class="form-control form-control-rounded" id="start_date" value="{{ old('start_date') }}" required>
                @if($errors->has('start_date'))
                <div class="error text-danger">{{ $errors->first('start_date') }}</div>
                @endif
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" class="form-control form-control-rounded" id="end_date" value="{{ old('end_date') }}" required>
                @if($errors->has('end_date'))
                <div class="error text-danger">{{ $errors->first('end_date') }}</div>
                @endif
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label for="add_gst">GST include:</label>
                <select name="add_gst" id="add_gst" class="custom-select form-control form-control-rounded" required>
                  <option value="">Select type</option>
                  <option value="gst">GST</option>
                  <option value="notgst">NOT GST</option>
                </select>
                @if($errors->has('add_gst'))
                <div class="error text-danger">{{ $errors->first('add_gst') }}</div>
                @endif
              </div>
            </div>
          </div>
          <div class="form-group">
            <!-- <button type="submit" class="btn btn-light btn-round px-5">Generate PDF</button> -->
            <button type="button" id="button1" class="btn btn-light btn-round px-5">Generate EXcel</button>
            <button type="button" id="button2" class="btn btn-light btn-round px-5">Generate PDF</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div><!--End Row-->

@endsection

@section('script')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('billform');
    var button1 = document.getElementById('button1');
    var button2 = document.getElementById('button2');

    button1.addEventListener('click', function() {
      form.action = "{{ route('party.bill.excel') }}";
      // Submit the form
      form.submit();
    });

    button2.addEventListener('click', function() {
      // Change the form action for button 2
      form.action = "{{ route('party.bill') }}";
      // Submit the form
      form.submit();
    });
  });
</script>
@endsection