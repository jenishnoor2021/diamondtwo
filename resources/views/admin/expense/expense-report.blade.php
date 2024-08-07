@extends('layouts.admin')
@section('content')
<div class="row mt-3">
  <div class="col-lg-8 mx-auto">
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <h4>Expense Report</h4>
        </div>
        <hr>
        @if (session('success'))
        <div class="alert text-white pl-3 pt-2 pb-2" style="background-color:green">
          {{ session('success') }}
        </div>
        @endif
        <form action="{{ route('generate-pdf') }}" method="post">
          @csrf
          <div class="row">
            <div class="col-4">
              <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" class="form-control form-control-rounded" id="start_date" value="{{ old('start_date') }}" required>
                @if($errors->has('start_date'))
                <div class="error text-danger">{{ $errors->first('start_date') }}</div>
                @endif
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" class="form-control form-control-rounded" id="end_date" value="{{ old('end_date') }}" required>
                @if($errors->has('end_date'))
                <div class="error text-danger">{{ $errors->first('end_date') }}</div>
                @endif
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="action">Select Action:</label>
                <select name="action" id="action" class="custom-select form-control form-control-rounded" required>
                  <!-- <option value="view">View</option> -->
                  <option value="download">Download</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-light btn-round px-5">Generate PDF</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div><!--End Row-->

@endsection

@section('script')


@endsection