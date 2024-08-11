@extends('layouts.admin')
@section('content')
<div class="row mt-3">
   <div class="col-lg-8 mx-auto">
      <div class="card">
         <div class="card-body">
            <div class="card-title">Edit Party</div>
            <hr>
            {!! Form::model($party, ['method'=>'PATCH', 'action'=> ['AdminPartyController@update', $party->id],'files'=>true,'class'=>'form-horizontal', 'name'=>'editpartyform']) !!}
            @csrf
            <div class="row">
               <div class="col-6">
                  <div class="form-group">
                     <label for="fname">First Name</label>
                     <input type="text" name="fname" class="form-control form-control-rounded" id="fname" placeholder="Enter First name" onkeypress='return (event.charCode != 32)' value="{{$party->fname}}" required>
                     @if($errors->has('fname'))
                     <div class="error text-danger">{{ $errors->first('fname') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-6">
                  <div class="form-group">
                     <label for="lname">Last Name</label>
                     <input type="text" name="lname" class="form-control form-control-rounded" id="lname" placeholder="Enter Last Name" onkeypress='return (event.charCode != 32)' value="{{$party->lname}}" required>
                     @if($errors->has('lname'))
                     <div class="error text-danger">{{ $errors->first('lname') }}</div>
                     @endif
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label for="party_code">Party Code</label>
               <input type="text" name="party_code" class="form-control form-control-rounded" id="party_code" placeholder="Enter party code" onkeypress='return (event.charCode != 32)' value="{{$party->party_code}}" required>
               @if($errors->has('party_code'))
               <div class="error text-danger">{{ $errors->first('party_code') }}</div>
               @endif
            </div>
            <div class="form-group">
               <label for="address">Address</label>
               <textarea type="text" name="address" class="form-control form-control-rounded" id="address" placeholder="Enter Address" required>{{$party->address}}</textarea>
               @if($errors->has('address'))
               <div class="error text-danger">{{ $errors->first('address') }}</div>
               @endif
            </div>
            <div class="row">
               <div class="col-6">
                  <div class="form-group">
                     <label for="mobile">Mobile no</label>
                     <input type="number" name="mobile" class="form-control form-control-rounded" id="mobile" placeholder="Enter number" value="{{$party->mobile}}" required>
                     @if($errors->has('mobile'))
                     <div class="error text-danger">{{ $errors->first('mobile') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-6">
                  <div class="form-group">
                     <label for="gst_no">GST No</label>
                     <input type="text" name="gst_no" class="form-control form-control-rounded" id="gst_no" placeholder="Enter GST No" value="{{$party->gst_no}}">
                  </div>
               </div>
            </div>

            <hr />
            <h5>Party Rate (Round)</h5>
            <hr />
            <div class="row">
               <div class="col-4">
                  <div class="form-group">
                     <label for="round_1">Rate (Small than 2.99)</label>
                     <input type="number" name="round_1" class="form-control form-control-rounded" id="round_1" placeholder="Enter amount" value="{{$party->round_1}}">
                     @if($errors->has('round_1'))
                     <div class="error text-danger">{{ $errors->first('round_1') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-4">
                  <div class="form-group">
                     <label for="round_2">Rate (3.00 to 9.99)</label>
                     <input type="number" name="round_2" class="form-control form-control-rounded" id="round_2" placeholder="Enter amount" value="{{$party->round_2}}">
                     @if($errors->has('round_2'))
                     <div class="error text-danger">{{ $errors->first('round_2') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-4">
                  <div class="form-group">
                     <label for="round_3">Rate (10.00 to more)</label>
                     <input type="number" name="round_3" class="form-control form-control-rounded" id="round_3" placeholder="Enter amount" value="{{$party->round_3}}">
                     @if($errors->has('round_3'))
                     <div class="error text-danger">{{ $errors->first('round_3') }}</div>
                     @endif
                  </div>
               </div>
            </div>
            <hr />
            <h5>Party Rate (Fancy)</h5>
            <hr />
            <div class="row">
               <div class="col-4">
                  <div class="form-group">
                     <label for="fancy_1">Rate (Small than 2.99)</label>
                     <input type="number" name="fancy_1" class="form-control form-control-rounded" id="fancy_1" placeholder="Enter amount" value="{{$party->fancy_1}}">
                     @if($errors->has('fancy_1'))
                     <div class="error text-danger">{{ $errors->first('fancy_1') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-4">
                  <div class="form-group">
                     <label for="fancy_2">Rate (3.00 to 9.99)</label>
                     <input type="number" name="fancy_2" class="form-control form-control-rounded" id="fancy_2" placeholder="Enter amount" value="{{$party->fancy_2}}">
                     @if($errors->has('fancy_2'))
                     <div class="error text-danger">{{ $errors->first('fancy_2') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-4">
                  <div class="form-group">
                     <label for="fancy_3">Rate (10.00 to more)</label>
                     <input type="number" name="fancy_3" class="form-control form-control-rounded" id="fancy_3" placeholder="Enter amount" value="{{$party->fancy_3}}">
                     @if($errors->has('fancy_3'))
                     <div class="error text-danger">{{ $errors->first('fancy_3') }}</div>
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

      $("form[name='editpartyform']").validate({
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
            party_code: {
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