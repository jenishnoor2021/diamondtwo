@extends('layouts.admin')
@section('content')
<div class="row mt-3">
  <div class="col-lg-3">
    <div class="card">
      <div class="card-body">
        @if(session()->has('message'))
        <div class="alert text-white" style="background-color:green">
          {{ session()->get('message') }}
        </div>
        @endif
        <div class="card-title">
          <h4>Generate Worker Barcode</h4>
        </div>
        <hr>
        {!! Form::open(['method'=>'POST', 'action'=> 'AdminWorkerBarcodeController@store','files'=>true,'class'=>'form-horizontal','name'=>'workerbarcodeform']) !!}
        @csrf
        <div class="form-group">
          <label for="category">Worker List</label>
          <select name="worker_id" id="worker_id" class="custom-select form-control form-control-rounded" style="width:100%" required>
            <option value="">Select worker</option>
            @foreach ($workers as $worker)
            <option value="{{ $worker->id }}">{{$worker->fname}} {{$worker->lname}}</option>
            @endforeach
          </select>
          @if($errors->has('worker_id'))
          <div class="error text-danger">{{ $errors->first('worker_id') }}</div>
          @endif
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-light btn-round px-5"><i class="fa fa-plus"></i> Generate Barcode</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-9">
    <div class="card">
      @if (session('success'))
      <div class="alert text-white pl-3 pt-2 pb-2" style="background-color:green">
        {{ session('success') }}
      </div>
      @endif
      <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Worker Barcode List</h4>
      </div>
      <div class="table-responsive">
        <table id="workerbarcodelist" class="table align-items-center table-flush table-borderless">
          <thead>
            <tr>
              <th>Action</th>
              <th>Print</th>
              <th>Worker Name</th>
              <th>Barcode</th>
            </tr>
          </thead>
          <tbody>
            @foreach($barcodeLists as $barcodeList)
            <tr>
              <td>
                <a href="{{route('admin.worker-barcode.edit', $barcodeList->id)}}"><i class="fa fa-edit" style="color:white;font-size:15px;background-color:#0275d8;padding:8px;border-radius:500px;"></i></a>
                <a href="{{route('admin.worker-barcode.destroy', $barcodeList->id)}}" onclick="return confirm('Sure ! You want to delete ?');"><i class="fa fa-trash" style="color:white;font-size:15px;background-color:red;padding:8px;border-radius:500px;"></i></a>
              </td>
              <td>
                <a href="/admin/print-worker-barcode/{{$barcodeList->id}}" target="_blank" class="btn btn-secondary">Print</a>
              </td>
              <td>{{$barcodeList->worker->fname}}&nbsp;{{$barcodeList->worker->lname}}</td>
              <td>{{$barcodeList->barcode}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div><!--End Row-->
@endsection

@section('script')
<script>
  $(function() {
    $("form[name='workerbarcodeform']").validate({
      rules: {
        worker_id: {
          required: true,
        },
      },
      submitHandler: function(form) {
        form.submit();
      }
    });
  });
</script>
@endsection