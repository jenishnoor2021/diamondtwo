@extends('layouts.admin')
@section('content')
<div class="row mt-3">
   <div class="col-lg-12 mx-auto">
      <div class="card">
         <div class="card-body">
            <div class="card-title">Edit Worker</div>
            <hr>
            {!! Form::model($worker, ['method'=>'PATCH', 'action'=> ['AdminWorkerController@update', $worker->id],'files'=>true,'class'=>'form-horizontal','name'=>'editworkerform']) !!}
            @csrf
            <div class="row">
               <div class="col-6">
                  <div class="form-group">
                     <label for="fname">First Name</label>
                     <input type="text" name="fname" class="form-control form-control-rounded" id="fname" placeholder="Enter First name" onkeypress='return (event.charCode != 32)' value="{{$worker->fname}}" required>
                     @if($errors->has('fname'))
                     <div class="error text-danger">{{ $errors->first('fname') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-6">
                  <div class="form-group">
                     <label for="lname">Last Name</label>
                     <input type="text" name="lname" class="form-control form-control-rounded" id="lname" placeholder="Enter Last Name" onkeypress='return (event.charCode != 32)' value="{{$worker->lname}}" required>
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
                  <option value="{{$designation->name}}" {{$worker->designation == $designation->name ? "selected" : ''}}>{{$designation->name}}</option>
                  @endforeach
               </select>
               @if($errors->has('designation'))
               <div class="error text-danger">{{ $errors->first('designation') }}</div>
               @endif
            </div>
            <div class="form-group">
               <label for="remark">Remark / katori</label>
               <textarea type="text" name="remark" class="form-control form-control-rounded" id="remark" placeholder="Enter remark">{{$worker->remark}}</textarea>
               @if($errors->has('remark'))
               <div class="error text-danger">{{ $errors->first('remark') }}</div>
               @endif
            </div>
            <div class="form-group">
               <label for="address">Address</label>
               <textarea type="text" name="address" class="form-control form-control-rounded" id="address" placeholder="Enter Address">{{$worker->address}}</textarea>
               @if($errors->has('address'))
               <div class="error text-danger">{{ $errors->first('address') }}</div>
               @endif
            </div>
            <div class="row">
               <div class="col-6">
                  <div class="form-group">
                     <label for="mobile">Mobile no</label>
                     <input type="number" name="mobile" class="form-control form-control-rounded" id="mobile" placeholder="Enter number" value="{{$worker->mobile}}">
                     @if($errors->has('mobile'))
                     <div class="error text-danger">{{ $errors->first('mobile') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-6">
                  <div class="form-group">
                     <label for="aadhar_no">Aadhar Number</label>
                     <input type="text" name="aadhar_no" class="form-control form-control-rounded" id="aadhar_no" placeholder="Enter aadhar no" oninput="formatAadharInput(this)" value="{{$worker->aadhar_no}}">
                     @if($errors->has('aadhar_no'))
                     <div class="error text-danger">{{ $errors->first('aadhar_no') }}</div>
                     @endif
                  </div>
               </div>
            </div>

            <input type="checkbox" id="roundCheckbox"> Round Rate
            <hr>
            <div id="roundDiv" style="display: none;">
               <div class="row">
                  <div class="col-4">
                     <div class="form-group">
                        <label for="round_1">Rate (0.00 to 1.99)</label>
                        <input type="number" name="round_1" class="form-control form-control-rounded" id="round_1" placeholder="Enter amount" value="{{$worker->round_1}}">
                        @if($errors->has('round_1'))
                        <div class="error text-danger">{{ $errors->first('round_1') }}</div>
                        @endif
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group">
                        <label for="round_2">Rate (2.00 to 4.99)</label>
                        <input type="number" name="round_2" class="form-control form-control-rounded" id="round_2" placeholder="Enter amount" value="{{$worker->round_2}}">
                        @if($errors->has('round_2'))
                        <div class="error text-danger">{{ $errors->first('round_2') }}</div>
                        @endif
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group">
                        <label for="round_3">Rate (5.00 to more)</label>
                        <input type="number" name="round_3" class="form-control form-control-rounded" id="round_3" placeholder="Enter amount" value="{{$worker->round_3}}">
                        @if($errors->has('round_3'))
                        <div class="error text-danger">{{ $errors->first('round_3') }}</div>
                        @endif
                     </div>
                  </div>
               </div>
            </div>

            <input type="checkbox" id="fancyCheckbox"> Fancy Rate
            <hr>
            <div id="fancyDiv" style="display: none;">
               <div class="row">
                  <div class="col-3">
                     <div class="form-group">
                        <label for="fancy_1">Rate (0.00 to 1.99)</label>
                        <input type="number" name="fancy_1" class="form-control form-control-rounded" id="fancy_1" placeholder="Enter amount" value="{{$worker->fancy_1}}">
                        @if($errors->has('fancy_1'))
                        <div class="error text-danger">{{ $errors->first('fancy_1') }}</div>
                        @endif
                     </div>
                  </div>
                  <div class="col-3">
                     <div class="form-group">
                        <label for="fancy_2">Rate (2.00 to 2.99)</label>
                        <input type="number" name="fancy_2" class="form-control form-control-rounded" id="fancy_2" placeholder="Enter amount" value="{{$worker->fancy_2}}">
                        @if($errors->has('fancy_2'))
                        <div class="error text-danger">{{ $errors->first('fancy_2') }}</div>
                        @endif
                     </div>
                  </div>
                  <div class="col-3">
                     <div class="form-group">
                        <label for="fancy_3">Rate (3.00 to 3.99)</label>
                        <input type="number" name="fancy_3" class="form-control form-control-rounded" id="fancy_3" placeholder="Enter amount" value="{{$worker->fancy_3}}">
                        @if($errors->has('fancy_3'))
                        <div class="error text-danger">{{ $errors->first('fancy_3') }}</div>
                        @endif
                     </div>
                  </div>
                  <div class="col-3">
                     <div class="form-group">
                        <label for="fancy_4">Rate (4.00 to 4.99)</label>
                        <input type="number" name="fancy_4" class="form-control form-control-rounded" id="fancy_4" placeholder="Enter amount" value="{{$worker->fancy_4}}">
                        @if($errors->has('fancy_4'))
                        <div class="error text-danger">{{ $errors->first('fancy_4') }}</div>
                        @endif
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-3">
                     <div class="form-group">
                        <label for="fancy_5">Rate (5.00 to 5.99)</label>
                        <input type="number" name="fancy_5" class="form-control form-control-rounded" id="fancy_5" placeholder="Enter amount" value="{{$worker->fancy_5}}">
                        @if($errors->has('fancy_5'))
                        <div class="error text-danger">{{ $errors->first('fancy_5') }}</div>
                        @endif
                     </div>
                  </div>
                  <div class="col-3">
                     <div class="form-group">
                        <label for="fancy_6">Rate (6.00 to 8.99)</label>
                        <input type="number" name="fancy_6" class="form-control form-control-rounded" id="fancy_6" placeholder="Enter amount" value="{{$worker->fancy_6}}">
                        @if($errors->has('fancy_6'))
                        <div class="error text-danger">{{ $errors->first('fancy_6') }}</div>
                        @endif
                     </div>
                  </div>
                  <div class="col-3">
                     <div class="form-group">
                        <label for="fancy_7">Rate (9.00 to more)</label>
                        <input type="number" name="fancy_7" class="form-control form-control-rounded" id="fancy_7" placeholder="Enter amount" value="{{$worker->fancy_7}}">
                        @if($errors->has('fancy_7'))
                        <div class="error text-danger">{{ $errors->first('fancy_7') }}</div>
                        @endif
                     </div>
                  </div>
               </div>
            </div>

            <input type="checkbox" id="myCheckbox"> Show Bank detail
            <div id="myDiv" style="display: none;">
               <div class="row">
                  <div class="col-6">
                     <div class="form-group">
                        <label for="bank_name">Bank name</label>
                        <input type="text" name="bank_name" class="form-control form-control-rounded" id="bank_name" placeholder="Enter bank name" value="{{$worker->bank_name}}">
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group">
                        <label for="ifsc_code">IFSC code</label>
                        <input type="text" name="ifsc_code" class="form-control form-control-rounded" id="ifsc_code" placeholder="Enter IFSC code" value="{{$worker->ifsc_code}}">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-6">
                     <div class="form-group">
                        <label for="account_holder_name">Account Holder name</label>
                        <input type="text" name="account_holder_name" class="form-control form-control-rounded" id="account_holder_name" placeholder="Enter Account Holder name" value="{{$worker->account_holder_name}}">
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group">
                        <label for="account_no">Account Number</label>
                        <input type="number" name="account_no" class="form-control form-control-rounded" id="account_no" placeholder="Enter Account number" value="{{$worker->account_no}}">
                     </div>
                  </div>
               </div>
            </div>

            <hr>
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

      $("form[name='editworkerform']").validate({
         rules: {
            fname: {
               required: true,
            },
            lname: {
               required: true,
            },
            // address: {
            //    required: true,
            // },
            // mobile: {
            //    required: true,
            // },
            designation: {
               required: true,
            },
            // aadhar_no: {
            //    required: true,
            // }
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

      var roundcheckbox = document.getElementById('roundCheckbox');
      var rounddiv = document.getElementById('roundDiv');

      var fancycheckbox = document.getElementById('fancyCheckbox');
      var fancydiv = document.getElementById('fancyDiv');

      checkbox.addEventListener('change', function() {
         div.style.display = checkbox.checked ? 'block' : 'none';
      });

      roundcheckbox.addEventListener('change', function() {
         rounddiv.style.display = roundcheckbox.checked ? 'block' : 'none';
      });

      fancycheckbox.addEventListener('change', function() {
         fancydiv.style.display = fancycheckbox.checked ? 'block' : 'none';
      });
   });
</script>
@endsection