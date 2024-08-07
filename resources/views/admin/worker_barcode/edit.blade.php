@extends('layouts.admin')
@section('content')
<div class="row mt-3">
   <div class="col-lg-8 mx-auto">
      <div class="card">
         <div class="card-body">
            @if(session()->has('message'))
            <div class="alert text-white" style="background-color:green">
               {{ session()->get('message') }}
            </div>
            @endif
            <div class="card-title">Edit Worker Barcode</div>
            <hr>
            {!! Form::model($workerBarcode, ['method'=>'PATCH', 'action'=> ['AdminWorkerBarcodeController@update', $workerBarcode->id],'files'=>true,'class'=>'form-horizontal','name'=>'editbarcodeform']) !!}
            @csrf
            <div class="row">
               <div class="col-6">
                  <div class="form-group">
                     <label for="worker_id">Worker name</label>
                     <input type="text" name="worker_id" class="form-control form-control-rounded" id="worker_id" value="{{$workerBarcode->worker_id}}" readonly>
                  </div>
               </div>
               <div class="col-6">
                  <div class="form-group">
                     <label for="name">Barcode</label>
                     <input type="text" name="barcode" class="form-control form-control-rounded" id="barcode" value="{{$workerBarcode->barcode}}" required pattern="\d{10}" maxlength="10" minlength="10" title="Barcode must be exactly 10 digits">
                     @if($errors->has('barcode'))
                     <div class="error text-danger">{{ $errors->first('barcode') }}</div>
                     @endif
                  </div>
               </div>
            </div>
            <div class="form-group">
               <button type="submit" class="btn btn-light btn-round px-5">Update</button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div><!--End Row-->
@endsection

@section('script')
<script>
   $(function() {

      $("form[name='editbarcodeform']").validate({
         rules: {
            worker_id: {
               required: true,
            },
            barcode: {
               required: true,
            }
         },
         submitHandler: function(form) {
            form.submit();
         }
      });
   });

   document.getElementById('barcode').addEventListener('input', function(e) {
      const value = e.target.value;
      if (value.length > 10) {
         e.target.value = value.slice(0, 10); // Limit to 10 digits
      }
   });
</script>
@endsection