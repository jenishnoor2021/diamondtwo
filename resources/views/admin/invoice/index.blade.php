@extends('layouts.admin')
@section('content')

<div class="row">
   <div class="col-lg-12">
      <div class="card">
         @if (session('success'))
         <div class="alert text-white pl-3 pt-2 pb-2" style="background-color:green">
            {{ session('success') }}
         </div>
         @endif
         <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Invoices</h4>
            <div class="card-action">
               <div class="dropdown-menu-right">
                  <a class="dropdown-item" style="background-color:darkorchid;" href="{{route('admin.invoice.create')}}"><i class="fa fa-plus editable" style="font-size:15px;">&nbsp;ADD</i></a>
               </div>
            </div>
         </div>
         <div class="table-responsive">
            <table id="partytable" class="table align-items-center table-flush table-borderless">
               <thead>
                  <tr>
                     <th>Action</th>
                     <th>Party Name</th>
                     <th>Company Name</th>
                     <th>Invoice No</th>
                     <th>Invoice Date</th>
                     <th>Place To Supply</th>
                     <th>Due Date</th>
                     <th>PDF</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     @foreach($invoices as $invoice)
                     <td>
                        <a href="{{route('admin.invoice.edit', $invoice->id)}}"><i class="fa fa-edit" style="color:white;font-size:15px;background-color:rgba(255, 255, 255, 0.25);padding:8px;"></i></a>
                        <a href="{{route('admin.invoice.destroy', $invoice->id)}}" onclick="return confirm('Sure ! You want to delete ?');"><i class="fa fa-trash" style="color:white;font-size:15px;background-color:rgba(255, 255, 255, 0.25);padding:8px;"></i></a>
                     </td>
                     <td>{{$invoice->parties_id}}</td>
                     <td>{{$invoice->companies_id}}</td>
                     <td>{{$invoice->invoice_no}}</td>
                     <td>{{$invoice->invoice_date}}</td>
                     <td>{{$invoice->place_to_supply}}</td>
                     <td>{{$invoice->due_date}}</td>
                     <td>
                        @if($invoice->file != '')
                        <a href="{{asset('invoices/'.$invoice->file)}}" target="_blank"><b>PDF</b></a>
                        @endif
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div><!--End Row-->

@endsection