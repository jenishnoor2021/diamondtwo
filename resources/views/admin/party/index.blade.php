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
            <h4>Party List</h4>
            <div class="card-action">
               <div class="dropdown-menu-right">
                  <a class="dropdown-item" style="background-color:darkorchid;" href="{{route('admin.party.create')}}"><i class="fa fa-plus editable" style="font-size:15px;">&nbsp;ADD</i></a>
               </div>
            </div>
         </div>
         <div class="table-responsive">
            <table id="partytable" class="table align-items-center table-flush table-borderless">
               <thead>
                  <tr>
                     <th>Action</th>
                     <th>Party id</th>
                     <th>First name</th>
                     <th>Last Name</th>
                     <th>Party code</th>
                     <th>Address</th>
                     <th>Mobile no</th>
                     <th>GST no</th>
                     <th>Active/De-active</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     @foreach($partys as $party)
                     <td>
                        <a href="{{route('admin.party.edit', $party->id)}}"><i class="fa fa-edit" style="color:white;font-size:15px;background-color:rgba(255, 255, 255, 0.25);padding:8px;"></i></a>
                        <a href="{{route('admin.party.destroy', $party->id)}}" onclick="return confirm('Sure ! You want to delete ?');"><i class="fa fa-trash" style="color:white;font-size:15px;background-color:rgba(255, 255, 255, 0.25);padding:8px;"></i></a>
                     </td>
                     <td>{{$party->id}}</td>
                     <td>{{$party->fname}}</td>
                     <td>{{$party->lname}}</td>
                     <td>{{$party->party_code}}</td>
                     <td>@if(strlen($party->address) > 40)
                        {!!substr($party->address,0,40)!!}
                        <span class="read-more-show hide_content">More<i class="fa fa-angle-down"></i></span>
                        <span class="read-more-content"> {{substr($party->address,40,strlen($party->address))}}
                           <span class="read-more-hide hide_content">Less <i class="fa fa-angle-up"></i></span> </span>
                        @else
                        {{$party->address}}
                        @endif
                     </td>
                     <td>{{$party->mobile}}</td>
                     <td>{{$party->gst_no}}</td>
                     <td>
                        @if($party->is_active == 1)
                        <a href="/admin/party/active/{{$party->id}}" class="btn btn-success">Active</a>
                        @else
                        <a href="/admin/party/active/{{$party->id}}" class="btn btn-danger">De-active</a>
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