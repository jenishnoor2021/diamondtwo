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
            <div class="card-title">Edit Expense</div>
            <hr>
            {!! Form::model($expense, ['method'=>'PATCH', 'action'=> ['AdminExpenceController@update', $expense->id],'files'=>true,'class'=>'form-horizontal', 'name'=>'editexpenseform']) !!}
            @csrf
            <div class="row">
               <div class="col-12">
                  <div class="form-group">
                     <label for="title">Title</label>
                     <input type="text" name="title" class="form-control form-control-rounded" id="title" placeholder="Enter title" value="{{$expense->title}}" required>
                     @if($errors->has('title'))
                     <div class="error text-danger">{{ $errors->first('title') }}</div>
                     @endif
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label for="description">Description</label>
               <textarea type="text" name="description" class="form-control form-control-rounded" id="description" placeholder="Enter detail">{{$expense->description}}</textarea>
            </div>
            <div class="row">
               <div class="col-6">
                  <div class="form-group">
                     <label for="amount">Amount</label>
                     <input type="test" name="amount" class="form-control form-control-rounded" id="amount" placeholder="Enter amount" value="{{$expense->amount}}" required>
                     @if($errors->has('amount'))
                     <div class="error text-danger">{{ $errors->first('amount') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-6">
                  <div class="form-group">
                     <label for="date">Date</label>
                     <input type="date" name="date" class="form-control form-control-rounded" id="date" placeholder="Enter date" value="{{$expense->date}}" required>
                     @if($errors->has('date'))
                     <div class="error text-danger">{{ $errors->first('date') }}</div>
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

      $("form[name='editexpenseform']").validate({
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
</script>
@endsection