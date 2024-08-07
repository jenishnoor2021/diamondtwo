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
            <div class="card-title">Edit Designation</div>
            <hr>
            {!! Form::model($designation, ['method'=>'PATCH', 'action'=> ['AdminDesignationController@update', $designation->id],'files'=>true,'class'=>'form-horizontal','name'=>'editdesignationform']) !!}
            @csrf
            <div class="row">
               <div class="col-6">
                  <div class="form-group">
                     <label for="category">Designation Category</label>
                     <select name="category" id="category" class="custom-select form-control form-control-rounded" style="width:100%" required>
                        <option value="">Select category</option>
                        <option value="Inner" {{ $designation->category == 'Inner' ? 'selected' : '' }}>Inner</option>
                        <option value="Outter" {{ $designation->category == 'Outter' ? 'selected' : '' }}>Outter</option>
                     </select>
                     @if($errors->has('category'))
                     <div class="error text-danger">{{ $errors->first('category') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-6">
                  <div class="form-group">
                     <label for="name">Designation Name</label>
                     <input type="text" name="name" class="form-control form-control-rounded" id="name" placeholder="Enter First name" onkeypress='return (event.charCode != 32)' value="{{$designation->name}}">
                     @if($errors->has(' name')) <div class="error text-danger">{{ $errors->first('name') }}
                     </div>
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

      $("form[name='editdesignationform']").validate({
         rules: {
            name: {
               required: true,
            },
            category: {
               required: true,
            }
         },
         submitHandler: function(form) {
            form.submit();
         }
      });
   });
</script>
@endsection