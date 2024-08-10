@extends('layouts.admin')
@section('style')
<style>
   /* Add your styling here */
   .accordion {
      display: flex;
      flex-direction: column;
      max-width: 100%;
      margin: 0px 10px;
      /* Adjust as needed */
   }

   .accordion-item {
      border: 1px solid #000;
      margin-bottom: 5px;
      overflow: hidden;
   }

   .accordion-header {
      background-color: transparent;
      padding: 10px;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
   }

   .accordion-content {
      display: none;
      padding: 10px;
   }

   .accordion-arrow {
      transition: transform 0.3s ease-in-out;
   }

   .accordion-item.active .accordion-arrow {
      transform: rotate(180deg);
   }

   .remove-bottom-space {
      margin-bottom: 0px;
   }

   .tox .tox-notification--in {
      opacity: 0 !important;
   }

   .box-body {
      padding: 10px 20px;
   }
</style>
@endsection
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

            @if (session('error'))
            <div class="alert pl-3 pt-2 pb-2" style="background-color:red;color:#fff;">
               {{ session('error') }}
            </div>
            @endif

            <div class="card-title">Edit Invoice</div>

            <div class="accordion p-3">
               <div class="accordion-item">
                  <div class="accordion-header">
                     <span><b>Invoice and Customer Detail</b></span>
                     <span class="accordion-arrow">&#9658;</span>
                  </div>
                  <div class="accordion-content">

                     {!! Form::model($invoice, ['method'=>'PATCH', 'action'=> ['AdminInvoiceController@update', $invoice->id],'files'=>true,'class'=>'form-horizontal', 'name'=>'editinvoiceform']) !!}
                     @csrf

                     <div class="row">
                        <div class="col-4">
                           <div class="form-group">
                              <label for="parties_id">Party Name</label>
                              <select name="parties_id" id="parties_id" class="custom-select form-control form-control-rounded">
                                 <option value="">Select Party</option>
                                 @foreach($partyes as $party)
                                 <option value="{{$party->id}}" {{$invoice->parties_id == $party->id ? 'selected' : ''}}>{{$party->fname}}</option>
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
                                 <option value="{{$company->id}}" {{$invoice->companies_id == $company->id ? 'selected' : ''}}>{{$company->name}}</option>
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
                              <input type="text" name="invoice_no" class="form-control form-control-rounded" id="invoice_no" placeholder="Enter Invoice number" value="{{$invoice->invoice_no}}" required>
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
                              <input type="date" name="invoice_date" class="form-control form-control-rounded" id="invoice_date" placeholder="Enter invoice date" value="{{$invoice->invoice_date}}" required>
                              @if($errors->has('invoice_date'))
                              <div class="error text-danger">{{ $errors->first('invoice_date') }}</div>
                              @endif
                           </div>
                        </div>
                        <div class="col-4">
                           <div class="form-group">
                              <label for="place_to_supply">Place To Supply</label>
                              <input type="text" name="place_to_supply" class="form-control form-control-rounded" id="place_to_supply" placeholder="Enter Place To Supply" value="{{$invoice->place_to_supply}}" required>
                              @if($errors->has('place_to_supply'))
                              <div class="error text-danger">{{ $errors->first('place_to_supply') }}</div>
                              @endif
                           </div>
                        </div>
                        <div class="col-4">
                           <div class="form-group">
                              <label for="due_date">due_date</label>
                              <input type="date" name="due_date" class="form-control form-control-rounded" id="due_date" value="{{$invoice->due_date}}" required>
                              @if($errors->has('due_date'))
                              <div class="error text-danger">{{ $errors->first('due_date') }}</div>
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


            <div class="box-body" id="addInvoiceDetail">

               {!! Form::open(['method'=>'POST', 'action'=> 'AdminInvoiceController@storeInvoiceData','files'=>true,'class'=>'form-horizontal', 'name'=>'addInvoiceDetailForm']) !!}
               @csrf
               <input type="hidden" name="invoice_id" value="{{$invoice->id}}">

               <div class="form-group row">
                  <div class="col-sm-4">
                     <label for="item" class="control-label">Items :</label>
                     <input type="text" class="form-control" name="item" id="item" placeholder="Enter items" required>
                     @if($errors->has('item'))
                     <div class="error text-danger">{{ $errors->first('item') }}</div>
                     @endif
                  </div>
                  <div class="col-sm-2">
                     <label for="hsn_no" class="control-label">HSN Number :</label>
                     <input type="text" class="form-control" name="hsn_no" id="hsn_no" placeholder="Enter HSN No" required>
                     @if($errors->has('hsn_no'))
                     <div class="error text-danger">{{ $errors->first('hsn_no') }}</div>
                     @endif
                  </div>
                  <div class="col-sm-2">
                     <label for="tax" class="control-label">Tax:</label>
                     <input type="text" class="form-control" name="tax" id="tax" placeholder="Enter Tax" required>
                     @if($errors->has('tax'))
                     <div class="error text-danger">{{ $errors->first('tax') }}</div>
                     @endif
                  </div>
                  <div class="col-sm-2">
                     <label for="quntity" class="control-label">Quntity:</label>
                     <input type="number" class="form-control" name="quntity" id="quntity" oninput="calculateAmounts()" placeholder="Enter quntity" required>
                     @if($errors->has('check_in'))
                     <div class="error text-danger">{{ $errors->first('check_in') }}</div>
                     @endif
                  </div>
               </div>

               <div class="form-group row">
                  <div class="col-sm-2">
                     <label for="rate" class="control-label">Rate :</label>
                     <input type="number" class="form-control" name="rate" id="rate" placeholder="Enter rate" oninput="calculateAmounts()" placeholder="Enter rate" required>
                     @if($errors->has('rate'))
                     <div class="error text-danger">{{ $errors->first('rate') }}</div>
                     @endif
                  </div>
                  <div class="col-sm-2">
                     <label for="per" class="control-label">per :</label>
                     <input type="text" class="form-control" name="per" id="per" placeholder="Enter per" required>
                     @if($errors->has('per'))
                     <div class="error text-danger">{{ $errors->first('per') }}</div>
                     @endif
                  </div>
                  <div class="col-sm-2">
                     <label for="total_amount" class="control-label">Total Amount :</label>
                     <input type="number" class="form-control" name="total_amount" id="total_amount" placeholder="Enter Total amout" required>
                     @if($errors->has('total_amount'))
                     <div class="error text-danger">{{ $errors->first('total_amount') }}</div>
                     @endif
                  </div>
                  <div class="col-md-3 col-sm-2 control-label">
                     <div class="col-md-3 col-sm-2 control-label">
                        {!! Form::submit('Add', ['class'=>'btn btn-success text-white mt-1']) !!}
                     </div>
                  </div>
               </div>
               {!! Form::close() !!}

            </div>

            @if(count($invoicedatas)>0)
            @foreach($invoicedatas as $invoicedata)
            <div class="box-body" id="editInvoiceDetail{{$invoicedata->id}}" style="display:none;">

               {!! Form::model($invoicedata, ['method'=>'PATCH', 'action'=> ['AdminInvoiceController@updateInvoiceData', $invoicedata->id],'files'=>true,'class'=>'form-horizontal', 'name'=>'editInvoiceDataForm']) !!}
               @csrf
               <input type="hidden" name="invoice_id" value="{{$invoice->id}}">

               <div class="form-group row">
                  <div class="col-sm-4">
                     <label for="item" class="control-label">Items :</label>
                     <input type="text" class="form-control" name="item" id="item{{$invoicedata->id}}" placeholder="Enter items" value="{{ $invoicedata->item }}" required>
                     @if($errors->has('item'))
                     <div class="error text-danger">{{ $errors->first('item') }}</div>
                     @endif
                  </div>
                  <div class="col-sm-2">
                     <label for="hsn_no" class="control-label">HSN Number :</label>
                     <input type="text" class="form-control" name="hsn_no" id="hsn_no{{$invoicedata->id}}" placeholder="Enter HSN No" value="{{ $invoicedata->hsn_no }}" required>
                     @if($errors->has('hsn_no'))
                     <div class="error text-danger">{{ $errors->first('hsn_no') }}</div>
                     @endif
                  </div>
                  <div class="col-sm-2">
                     <label for="tax" class="control-label">Tax:</label>
                     <input type="text" class="form-control" name="tax" id="tax{{$invoicedata->id}}" placeholder="Enter Tax" value="{{ $invoicedata->tax }}" required>
                     @if($errors->has('tax'))
                     <div class="error text-danger">{{ $errors->first('tax') }}</div>
                     @endif
                  </div>
                  <div class="col-sm-2">
                     <label for="quntity" class="control-label">Quntity:</label>
                     <input type="number" class="form-control" name="quntity" id="quntity{{$invoicedata->id}}" oninput="editcalculateAmounts({{$invoicedata->id}})" placeholder="Enter quntity" value="{{ $invoicedata->quntity }}" required>
                     @if($errors->has('check_in'))
                     <div class="error text-danger">{{ $errors->first('check_in') }}</div>
                     @endif
                  </div>
               </div>

               <div class="form-group row">
                  <div class="col-sm-2">
                     <label for="rate" class="control-label">Rate :</label>
                     <input type="number" class="form-control" name="rate" id="rate{{$invoicedata->id}}" placeholder="Enter quntity" oninput="editcalculateAmounts({{$invoicedata->id}})" value="{{ $invoicedata->rate }}" placeholder="Enter rate" required>
                     @if($errors->has('rate'))
                     <div class="error text-danger">{{ $errors->first('rate') }}</div>
                     @endif
                  </div>
                  <div class="col-sm-2">
                     <label for="per" class="control-label">per :</label>
                     <input type="text" class="form-control" name="per" id="per{{$invoicedata->id}}" placeholder="Enter per" value="{{ $invoicedata->per }}" required>
                     @if($errors->has('per'))
                     <div class="error text-danger">{{ $errors->first('per') }}</div>
                     @endif
                  </div>
                  <div class="col-sm-2">
                     <label for="total_amount" class="control-label">Total Amount :</label>
                     <input type="number" class="form-control" name="total_amount" id="total_amount{{$invoicedata->id}}" placeholder="Enter Total amout" value="{{ $invoicedata->total_amount }}" required>
                     @if($errors->has('total_amount'))
                     <div class="error text-danger">{{ $errors->first('total_amount') }}</div>
                     @endif
                  </div>
                  <div class="col-md-3 col-sm-2 control-label">
                     <div class="col-md-3 col-sm-2 control-label">
                        {!! Form::submit('Add', ['class'=>'btn btn-success text-white mt-1']) !!}
                     </div>
                  </div>
               </div>


               {!! Form::close() !!}

            </div>
            @endforeach
            @endif


            <div class="box box-info" style="margin-left:15px; margin-right:15px;">
               <div class="box-header with-border">
                  <a href="{{route('admin.invoice.pdf', $invoice->id)}}" class="bg-success text-white text-decoration-none" style="padding:8px 12px;margin-left:15px;font-size:20px">Generate Invoice</a>
                  @if($invoice->file != '')
                  <a href="{{asset('invoices/'.$invoice->file)}}" target="_blank" class="bg-info text-white text-decoration-none" style="padding:8px 12px;margin-left:15px;font-size:20px">View Invoice</a>
                  @endif
               </div>

               <div class="box-body">
                  @if(count($invoicedatas)>0)
                  <table id="" class="table table-bordered table-striped">
                     <thead class="bg-primary">
                        <tr>
                           <th>Action</th>
                           <th>Item</th>
                           <th>Hsn No</th>
                           <th>Tax</th>
                           <th>Quntity</th>
                           <th>Rate</th>
                           <th>Per</th>
                           <th>Total Amount</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($invoicedatas as $invoicedata)
                        <tr>
                           <td>
                              <a id="{{ $invoicedata->id }}" onclick="editfun(this.id)" style="cursor: pointer;"><i class="fa fa-edit" style="color:white;font-size:15px;background-color:rgba(255, 255, 255, 0.25);color:blue;padding:8px;"></i></a>
                              <!-- <a href="{{route('admin.invoice.editdata', $invoicedata->id)}}"><i class="fa fa-edit" style="font-size:15px;background-color:rgba(255, 255, 255, 0.25);padding:8px;"></i></a> -->
                              <a href="{{route('admin.invoicedata.destroy', $invoicedata->id)}}" onclick="return confirm('Sure ! You want to delete reocrd ?');"><i class="fa fa-trash" style="font-size:15px;background-color:rgba(255, 255, 255, 0.25);color:red;padding:8px;"></i></a>
                           </td>
                           <td>{{$invoicedata->item}}</td>
                           <td>{{$invoicedata->hsn_no}}</td>
                           <td>{{$invoicedata->tax}}</td>
                           <td>{{$invoicedata->quntity}}</td>
                           <td>{{$invoicedata->rate}}</td>
                           <td>{{$invoicedata->per}}</td>
                           <td>{{$invoicedata->total_amount}}</td>
                        </tr>
                        @endforeach
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td>
                              <h4><b>Total</b></h4>
                           </td>
                           <td>
                              <h4><b>{{$invoice->invoice_total}}</b></h4>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  @endif
               </div>
            </div>

         </div>
      </div>
   </div>
</div><!--End Row-->
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(function() {
      $("form[name='editinvoiceform']").validate({
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
      $("form[name='addInvoiceDetailForm']").validate({
         rules: {
            item: {
               required: true,
            },
            hsn_no: {
               required: true,
            },
            tax: {
               required: true,
            },
            quntity: {
               required: true,
            },
            rate: {
               required: true,
            },
            per: {
               required: true,
            },
            total_amount: {
               required: true,
            },
         },
         submitHandler: function(form) {
            form.submit();
         }
      });
      $("form[name='editInvoiceDataForm']").validate({
         rules: {
            item: {
               required: true,
            },
            hsn_no: {
               required: true,
            },
            tax: {
               required: true,
            },
            quntity: {
               required: true,
            },
            rate: {
               required: true,
            },
            per: {
               required: true,
            },
            total_amount: {
               required: true,
            },
         },
         submitHandler: function(form) {
            form.submit();
         }
      });
   });

   $(document).ready(function() {
      // Toggle accordion content and arrow rotation when clicking on the header
      $('.accordion-header').click(function() {
         $(this).parent('.accordion-item').toggleClass('active');
         $(this).find('.accordion-arrow').text(function(_, text) {
            return text === '►' ? '▼' : '►';
         });
         $(this).next('.accordion-content').slideToggle();
         $(this).parent('.accordion-item').siblings('.accordion-item').removeClass('active').find('.accordion-content').slideUp();
         $(this).parent('.accordion-item').siblings('.accordion-item').find('.accordion-arrow').text('►');
      });
   });

   function calculateAmounts() {
      const quntity = parseFloat(document.getElementById('quntity').value) || 0;
      const amount = parseFloat(document.getElementById('rate').value) || 0;

      // Calculate the total amount including GST
      const totalAmount = quntity * amount;

      // Update the total_amount field
      document.getElementById('total_amount').value = totalAmount.toFixed(2);
   }

   function editcalculateAmounts(id) {
      const quntity = parseFloat(document.getElementById('quntity' + id).value) || 0;
      const amount = parseFloat(document.getElementById('rate' + id).value) || 0;

      // Calculate the total amount including GST
      const totalAmount = quntity * amount;

      // Update the total_amount field
      document.getElementById('total_amount' + id).value = totalAmount.toFixed(2);
   }

   function editfun(element) {
      var id = element;
      var div = document.getElementById("editInvoiceDetail" + id);
      var divadd = document.getElementById("addInvoiceDetail");

      @foreach($invoicedatas as $invoicedata)
      document.getElementById('editInvoiceDetail{{ $invoicedata->id }}').style.display = 'none';
      @endforeach

      if (div.style.display !== "block") {
         div.style.display = "block";
         divadd.style.display = "none";
      } else {
         div.style.display = "none";
         divadd.style.display = "block";
      }
   }
</script>
@endsection