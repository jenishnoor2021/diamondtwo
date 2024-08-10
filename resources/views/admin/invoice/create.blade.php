@extends('layouts.admin')
@section('content')
<div class="row mt-3">
   <div class="col-lg-12 mx-auto">
      <div class="card">
         <div class="card-body">
            @if(session()->has('success'))
            <div class="alert text-white" style="background-color:green">
               {{ session()->get('success') }}
            </div>
            @endif
            <div class="card-title">ADD Invoice</div>
            <hr>
            {!! Form::open(['method'=>'POST', 'action'=> 'AdminInvoiceController@store','files'=>true,'class'=>'form-horizontal','name'=>'addinvoiceform']) !!}
            @csrf
            <div class="row">
               <div class="col-4">
                  <div class="form-group">
                     <label for="parties_id">Party Name</label>
                     <select name="parties_id" id="parties_id" class="custom-select form-control form-control-rounded">
                        <option value="">Select Party</option>
                        @foreach($partyes as $party)
                        <option value="{{$party->id}}">{{$party->fname}}</option>
                        @endforeach
                     </select>
                     @if($errors->has('parties_id'))
                     <div class="error text-danger">{{ $errors->first('parties_id') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-4">
                  <div class="form-group">
                     <label for="companies_id">Company Name</label>
                     <select name="companies_id" id="companies_id" class="custom-select form-control form-control-rounded">
                        <option value="">Select Company</option>
                        @foreach($companyes as $company)
                        <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                     </select>
                     @if($errors->has('companies_id'))
                     <div class="error text-danger">{{ $errors->first('companies_id') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-4">
                  <div class="form-group">
                     <label for="invoice_no">Invoice number</label>
                     <input type="text" name="invoice_no" class="form-control form-control-rounded" id="invoice_no" placeholder="Enter Invoice number" value="{{ old('invoice_no') }}" required>
                     @if($errors->has('invoice_no'))
                     <div class="error text-danger">{{ $errors->first('invoice_no') }}</div>
                     @endif
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-4">
                  <div class="form-group">
                     <label for="invoice_date">Invoice Date</label>
                     <input type="date" name="invoice_date" class="form-control form-control-rounded" id="invoice_date" placeholder="Enter invoice date" value="{{ old('invoice_date') }}" required>
                     @if($errors->has('invoice_date'))
                     <div class="error text-danger">{{ $errors->first('invoice_date') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-4">
                  <div class="form-group">
                     <label for="place_to_supply">Place To Supply</label>
                     <input type="text" name="place_to_supply" class="form-control form-control-rounded" id="place_to_supply" placeholder="Enter Place To Supply" value="{{ old('place_to_supply') }}" required>
                     @if($errors->has('place_to_supply'))
                     <div class="error text-danger">{{ $errors->first('place_to_supply') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-4">
                  <div class="form-group">
                     <label for="due_date">due_date</label>
                     <input type="date" name="due_date" class="form-control form-control-rounded" id="due_date" required>
                     @if($errors->has('due_date'))
                     <div class="error text-danger">{{ $errors->first('due_date') }}</div>
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
      $("form[name='addinvoiceform']").validate({
         rules: {
            parties_id: {
               required: true,
            },
            companies_id: {
               required: true,
            },
            invoice_no: {
               required: true,
            },
            invoice_date: {
               required: true,
            },
            place_to_supply: {
               required: true,
            },
            due_date: {
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