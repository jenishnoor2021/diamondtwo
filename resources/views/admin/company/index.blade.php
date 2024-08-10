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
            <h4>Company</h4>
            <div class="card-action">
               <div class="dropdown-menu-right">
                  <a class="dropdown-item" style="background-color:darkorchid;" href="{{route('admin.company.create')}}"><i class="fa fa-plus editable" style="font-size:15px;">&nbsp;ADD</i></a>
               </div>
            </div>
         </div>
         <div class="table-responsive">
            <table id="partytable" class="table align-items-center table-flush table-borderless">
               <thead>
                  <tr>
                     <th>Action</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Contact</th>
                     <th>GST</th>
                     <th>PAN</th>
                     <th>CGST</th>
                     <th>SGST</th>
                     <th>Address</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     @foreach($comapyes as $company)
                     <td>
                        <a href="{{route('admin.company.edit', $company->id)}}"><i class="fa fa-edit" style="color:white;font-size:15px;background-color:rgba(255, 255, 255, 0.25);padding:8px;"></i></a>
                        <a href="{{route('admin.company.destroy', $company->id)}}" onclick="return confirm('Sure ! You want to delete ?');"><i class="fa fa-trash" style="color:white;font-size:15px;background-color:rgba(255, 255, 255, 0.25);padding:8px;"></i></a>
                     </td>
                     <td>{{$company->name}}</td>
                     <td>{{$company->email}}</td>
                     <td>{{$company->contact}}</td>
                     <td>{{$company->gst_no}}</td>
                     <td>{{$company->pan_no}}</td>
                     <td>{{$company->cgst}}</td>
                     <td>{{$company->sgst}}</td>
                     <td>@if(strlen($company->address) > 50)
                        {!!substr($company->address,0,50)!!}
                        <span class="read-more-show hide_content">More<i class="fa fa-angle-down"></i></span>
                        <span class="read-more-content"> {{substr($company->address,50,strlen($company->address))}}
                           <span class="read-more-hide hide_content">Less <i class="fa fa-angle-up"></i></span> </span>
                        @else
                        {{$company->address}}
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

@section('script')
<script>
   $(document).ready(function() {
      // Capture the change event of the dropdown
      $('#status').on('change', function() {
         // Trigger form submission when the dropdown changes
         $('#myForm').submit();
      });
   });
</script>

@endsection