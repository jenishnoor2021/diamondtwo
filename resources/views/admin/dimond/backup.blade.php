@extends('layouts.admin')

@section('content')

<div class="row mt-3">
  <div class="col-lg-12">

    <div class="card shadow-sm">

      <div class="card-body">

        <h4 class="mb-1">Backup</h4>

        <small class="text-danger">
          Select a date to retrieve diamonds delivered before that date. Select the required diamonds and click "Export & Delete Selected". The system will export the data to Excel and then remove the selected diamonds from the database.
        </small>

        <form action="{{ route('admin.backup') }}" class="mt-2" method="GET">

          <div class="row align-items-end">

            <div class="col-md-3">
              <label class="font-weight-bold">Select Date</label>

              <input type="date"
                name="date"
                class="form-control"
                value="{{request()->date}}"
                required>
            </div>

            <div class="col-md-9 text-right">

              <button type="submit" class="btn btn-primary">
                LIST
              </button>

              <a href="/admin/backup" class="btn btn-secondary">
                CLEAR
              </a>

            </div>

          </div>

        </form>

      </div>
    </div>

    @if(count($data) > 0)

    <div class="card mt-4">

      <div class="card-body">

        <form id="exportDeleteForm" action="{{ route('admin.export.delete.dimonds') }}" method="POST">
          @csrf

          <div class="mb-3">

            <button type="submit" class="btn btn-success">
              Export & Delete Selected
            </button>

          </div>

          <div class="table-responsive">

            <table class="table table-bordered table-striped">

              <thead class="thead-dark">

                <tr>

                  <th width="50">
                    <input type="checkbox" id="selectAll">
                  </th>

                  <th width="60">Sr.</th>

                  <th>Diamond Name</th>

                  <th>Barcode</th>

                  <th>Created Date</th>

                  <th>Delivery Date</th>

                </tr>

              </thead>

              <tbody>

                @foreach($data as $da)

                <tr>

                  <td>
                    <input type="checkbox"
                      name="dimond_ids[]"
                      value="{{$da->id}}">
                  </td>

                  <td>{{$loop->iteration}}</td>

                  <td>{{$da->dimond_name}}</td>

                  <td>{{$da->barcode_number}}</td>

                  <td>{{ \Carbon\Carbon::parse($da->created_at)->format('d-m-Y') }}</td>

                  <td>{{ \Carbon\Carbon::parse($da->delevery_date)->format('d-m-Y') }}</td>

                </tr>

                @endforeach

              </tbody>

            </table>

          </div>

        </form>

      </div>
    </div>

    @else

    <div class="card mt-4">
      <div class="card-body text-center">
        No Record Found
      </div>
    </div>

    @endif

  </div>
</div>

@endsection

@section('script')

<script>
  $('#selectAll').click(function() {
    $('input[name="dimond_ids[]"]').prop('checked', this.checked);
  });

  $('#exportDeleteForm').submit(function(e) {

    if ($('input[name="dimond_ids[]"]:checked').length === 0) {

      alert('Please select at least one diamond');

      e.preventDefault();

    }

  });
</script>

@endsection