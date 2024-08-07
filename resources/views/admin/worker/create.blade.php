@extends('layouts.admin')
@section('content')
<div class="row mt-3">
   <div class="col-lg-8 mx-auto">
      <div class="card">
         <div class="card-body">
            <div class="card-title">ADD Worker</div>
            <hr>
            {!! Form::open(['method'=>'POST', 'action'=> 'AdminWorkerController@store','files'=>true,'class'=>'form-horizontal','name'=>'addworkerform']) !!}
            @csrf
            <div class="row">
               <div class="col-6">
                  <div class="form-group">
                     <label for="fname">First Name</label>
                     <input type="text" name="fname" class="form-control form-control-rounded" id="fname" placeholder="Enter First Name" onkeypress='return (event.charCode != 32)' value="{{ old('fname') }}" required>
                     @if($errors->has('fname'))
                     <div class="error text-danger">{{ $errors->first('fname') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-6">
                  <div class="form-group">
                     <label for="lname">Last Name</label>
                     <input type="text" name="lname" class="form-control form-control-rounded" id="lname" placeholder="Enter Last Name" onkeypress='return (event.charCode != 32)' value="{{ old('lname') }}" required>
                     @if($errors->has('lname'))
                     <div class="error text-danger">{{ $errors->first('lname') }}</div>
                     @endif
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label for="designation">Designation</label>
               <select name="designation" id="designation" class="custom-select form-control form-control-rounded" required>
                  <option value="">Select designation</option>
                  @foreach($designations as $designation)
                  <option value="{{$designation->name}}">{{$designation->name}}</option>
                  @endforeach
               </select>
               @if($errors->has('designation'))
               <div class="error text-danger">{{ $errors->first('designation') }}</div>
               @endif
            </div>
            <div class="form-group">
               <label for="address">Address</label>
               <textarea type="text" name="address" class="form-control form-control-rounded" id="address" placeholder="Enter Address" required>{{ old('address') }}</textarea>
               @if($errors->has('address'))
               <div class="error text-danger">{{ $errors->first('address') }}</div>
               @endif
            </div>
            <div class="row">
               <div class="col-6">
                  <div class="form-group">
                     <label for="mobile">Mobile no</label>
                     <input type="number" name="mobile" class="form-control form-control-rounded" id="mobile" placeholder="Enter number" value="{{ old('mobile') }}" required>
                     @if($errors->has('mobile'))
                     <div class="error text-danger">{{ $errors->first('mobile') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-6">
                  <div class="form-group">
                     <label for="aadhar_no">Aadhar Number</label>
                     <input type="text" name="aadhar_no" class="form-control form-control-rounded" id="aadhar_no" oninput="formatAadharInput(this)" placeholder="Enter aadhar no" value="{{ old('aadhar_no') }}" required>
                     @if($errors->has('aadhar_no'))
                     <div class="error text-danger">{{ $errors->first('aadhar_no') }}</div>
                     @endif
                  </div>
               </div>
            </div>
            <input type="checkbox" id="myCheckbox"> Add Bank detail
            <!-- Your div tag -->
            <div id="myDiv" style="display: none;">
               <div class="row">
                  <div class="col-6">
                     <div class="form-group">
                        <label for="bank_name">Bank name</label>
                        <input type="text" name="bank_name" class="form-control form-control-rounded" id="bank_name" placeholder="Enter bank name">
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group">
                        <label for="ifsc_code">IFSC code</label>
                        <input type="text" name="ifsc_code" class="form-control form-control-rounded" id="ifsc_code" placeholder="Enter IFSC code">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-6">
                     <div class="form-group">
                        <label for="account_holder_name">Account Holder name</label>
                        <input type="text" name="account_holder_name" class="form-control form-control-rounded" id="account_holder_name" placeholder="Enter Account Holder name">
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group">
                        <label for="account_no">Account Number</label>
                        <input type="number" name="account_no" class="form-control form-control-rounded" id="account_no" placeholder="Enter Account number">
                     </div>
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
      $("form[name='addworkerform']").validate({
         rules: {
            fname: {
               required: true,
            },
            lname: {
               required: true,
            },
            address: {
               required: true,
            },
            mobile: {
               required: true,
            },
            designation: {
               required: true,
            },
            aadhar_no: {
               required: true,
            }
         },
         submitHandler: function(form) {
            form.submit();
         }
      });
   });
</script>
<script>
   document.addEventListener('DOMContentLoaded', function() {
      var checkbox = document.getElementById('myCheckbox');
      var div = document.getElementById('myDiv');

      checkbox.addEventListener('change', function() {
         // If the checkbox is checked, show the div; otherwise, hide it
         div.style.display = checkbox.checked ? 'block' : 'none';
      });
   });
</script>
@endsection