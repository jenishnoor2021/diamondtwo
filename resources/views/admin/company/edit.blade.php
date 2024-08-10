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
            {!! Form::model($company, ['method'=>'PATCH', 'action'=> ['AdminCompanyController@update', $company->id],'files'=>true,'class'=>'form-horizontal', 'name'=>'editcompanyform']) !!}
            @csrf
            <div class="row">
               <div class="col-4">
                  <div class="form-group">
                     <label for="name">Comapny Name</label>
                     <input type="text" name="name" class="form-control form-control-rounded" id="name" placeholder="Enter name" value="{{$company->name}}" required>
                     @if($errors->has('name'))
                     <div class="error text-danger">{{ $errors->first('name') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-4">
                  <div class="form-group">
                     <label for="gst_no">GST No</label>
                     <input type="text" name="gst_no" class="form-control form-control-rounded" id="gst_no" placeholder="Enter GST No" value="{{$company->gst_no}}" required>
                     @if($errors->has('gst_no'))
                     <div class="error text-danger">{{ $errors->first('gst_no') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-4">
                  <div class="form-group">
                     <label for="pan_no">PAN No</label>
                     <input type="text" name="pan_no" class="form-control form-control-rounded" id="pan_no" placeholder="Enter PAN No" value="{{$company->pan_no}}" required>
                     @if($errors->has('pan_no'))
                     <div class="error text-danger">{{ $errors->first('pan_no') }}</div>
                     @endif
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label for="address">Address</label>
               <textarea type="text" name="address" class="form-control form-control-rounded" id="address" placeholder="Enter detail">{{$company->address}}</textarea>
            </div>
            <div class="row">
               <div class="col-4">
                  <div class="form-group">
                     <label for="email">Email</label>
                     <input type="email" name="email" class="form-control form-control-rounded" id="email" placeholder="Enter email" value="{{$company->email}}" required>
                     @if($errors->has('email'))
                     <div class="error text-danger">{{ $errors->first('email') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-4">
                  <div class="form-group">
                     <label for="contact">Contact</label>
                     <input type="number" name="contact" class="form-control form-control-rounded" id="contact" placeholder="Enter contact No" value="{{$company->contact}}" required>
                     @if($errors->has('contact'))
                     <div class="error text-danger">{{ $errors->first('contact') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-4">
                  <div class="form-group">
                     <label for="sign">Sign</label>
                     <input type="file" name="sign" class="form-control form-control-rounded" id="sign">
                     <img src="{{$company->sign}}" alt="Your Logo" width="100px">
                     @if($errors->has('sign'))
                     <div class="error text-danger">{{ $errors->first('sign') }}</div>
                     @endif
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-4">
                  <div class="form-group">
                     <label for="cgst">CGST</label>
                     <input type="number" name="cgst" class="form-control form-control-rounded" id="cgst" placeholder="Enter CGST" value="{{$company->cgst}}" required>
                     @if($errors->has('cgst'))
                     <div class="error text-danger">{{ $errors->first('cgst') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-4">
                  <div class="form-group">
                     <label for="sgst">SGST</label>
                     <input type="number" name="sgst" class="form-control form-control-rounded" id="sgst" placeholder="Enter SGST" value="{{$company->sgst}}" required>
                     @if($errors->has('sgst'))
                     <div class="error text-danger">{{ $errors->first('sgst') }}</div>
                     @endif
                  </div>
               </div>
            </div>

            <?php $bank_info = $company['bank_info'] ? json_decode($company['bank_info'], true) : '' ?>

            <div class="row">
               <div class="col-3">
                  <div class="form-group">
                     <label for="bank_name">Bank</label>
                     <input type="name" name="bank_name" class="form-control form-control-rounded" id="bank_name" placeholder="Enter bank name" value="<?= $bank_info['bank_name'] ?? ''; ?>">
                     @if($errors->has('bank_name'))
                     <div class="error text-danger">{{ $errors->first('bank_name') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-3">
                  <div class="form-group">
                     <label for="account_no">Account No</label>
                     <input type="number" name="account_no" class="form-control form-control-rounded" id="account_no" placeholder="Enter account no" value="<?= $bank_info['account_no'] ?? ''; ?>">
                     @if($errors->has('account_no'))
                     <div class="error text-danger">{{ $errors->first('account_no') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-3">
                  <div class="form-group">
                     <label for="ifsc_code">IFSC code</label>
                     <input type="text" name="ifsc_code" class="form-control form-control-rounded" id="ifsc_code" value="<?= $bank_info['ifsc_code'] ?? ''; ?>">
                     @if($errors->has('ifsc_code'))
                     <div class="error text-danger">{{ $errors->first('ifsc_code') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-3">
                  <div class="form-group">
                     <label for="branch">Branch</label>
                     <input type="text" name="branch" class="form-control form-control-rounded" id="branch" placeholder="Enter branch" value="<?= $bank_info['branch'] ?? ''; ?>">
                     @if($errors->has('branch'))
                     <div class="error text-danger">{{ $errors->first('branch') }}</div>
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

      $("form[name='editcompanyform']").validate({
         rules: {
            name: {
               required: true,
            },
            gst_no: {
               required: true,
            },
            pan_no: {
               required: true,
            },
            email: {
               required: true,
            },
            contact: {
               required: true,
            },
            address: {
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