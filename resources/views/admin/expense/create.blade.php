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
            <div class="card-title">ADD Expence</div>
            <hr>
            {!! Form::open(['method'=>'POST', 'action'=> 'AdminExpenceController@store','files'=>true,'class'=>'form-horizontal','name'=>'addexpenceform']) !!}
            @csrf
            <div class="row">
               <div class="col-12">
                  <div class="form-group">
                     <label for="title">Title</label>
                     <input type="text" name="title" class="form-control form-control-rounded" id="title" placeholder="Enter title" value="{{ old('title') }}" required>
                     @if($errors->has('title'))
                     <div class="error text-danger">{{ $errors->first('title') }}</div>
                     @endif
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label for="description">Description</label>
               <textarea type="text" name="description" class="form-control form-control-rounded" id="description" placeholder="Enter detail">{{ old('description') }}</textarea>
            </div>
            <div class="row">
               <div class="col-6">
                  <div class="form-group">
                     <label for="amount">Amount</label>
                     <input type="number" name="amount" class="form-control form-control-rounded" id="amount" placeholder="Enter amount" value="{{ old('amount') }}" required>
                     @if($errors->has('amount'))
                     <div class="error text-danger">{{ $errors->first('amount') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-6">
                  <div class="form-group">
                     <label for="date">Date</label>
                     <input type="date" name="date" class="form-control form-control-rounded" id="date" placeholder="Enter date" value="{{ old('date') }}" required>
                     @if($errors->has('date'))
                     <div class="error text-danger">{{ $errors->first('date') }}</div>
                     @endif
                  </div>
               </div>
            </div>
            <div class="form-group">
               <button type="submit" class="btn btn-light btn-round px-5"><i class="fa fa-plus"></i> ADD</button>
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
      $("form[name='addexpenceform']").validate({
         rules: {
            title: {
               required: true,
            },
            amount: {
               required: true,
            },
         },
         submitHandler: function(form) {
            form.submit();
         }
      });
   });

   document.addEventListener('DOMContentLoaded', function() {
      var today = new Date().toISOString().split('T')[0];
      document.getElementById('date').value = today;
   });
</script>
@endsection