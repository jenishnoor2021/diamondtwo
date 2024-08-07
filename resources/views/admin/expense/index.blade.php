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
            <h4>Expence List</h4>
            <div class="card-action">
               <div class="dropdown-menu-right">
                  <a class="dropdown-item" style="background-color:darkorchid;" href="{{route('admin.expense.create')}}"><i class="fa fa-plus editable" style="font-size:15px;">&nbsp;ADD</i></a>
               </div>
            </div>
         </div>
         <div class="table-responsive">
            <table id="partytable" class="table align-items-center table-flush table-borderless">
               <thead>
                  <tr>
                     <th>Action</th>
                     <th>Title</th>
                     <th>Description</th>
                     <th>Amount</th>
                     <th>Date</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     @foreach($expenses as $expense)
                     <td>
                        <a href="{{route('admin.expense.edit', $expense->id)}}"><i class="fa fa-edit" style="color:white;font-size:15px;background-color:rgba(255, 255, 255, 0.25);padding:8px;"></i></a>
                        <a href="{{route('admin.expense.destroy', $expense->id)}}" onclick="return confirm('Sure ! You want to delete ?');"><i class="fa fa-trash" style="color:white;font-size:15px;background-color:rgba(255, 255, 255, 0.25);padding:8px;"></i></a>
                     </td>
                     <td>{{$expense->title}}</td>
                     <td>@if(strlen($expense->description) > 100)
                        {!!substr($expense->description,0,100)!!}
                        <span class="read-more-show hide_content">More<i class="fa fa-angle-down"></i></span>
                        <span class="read-more-content"> {{substr($expense->description,100,strlen($expense->description))}}
                           <span class="read-more-hide hide_content">Less <i class="fa fa-angle-up"></i></span> </span>
                        @else
                        {{$expense->description}}
                        @endif
                     </td>
                     <td>{{$expense->amount}}</td>
                     <td>{{ \Carbon\Carbon::parse($expense->date)->format('d-m-Y') }}</td>
                     <td>
                        {!! Form::open(['method'=>'post', 'action'=> 'AdminExpenceController@updateStatus', 'class'=>'form-horizontal', 'id'=>'myForm']) !!}
                        @csrf
                        <input type="hidden" name="id" value="{{$expense->id}}">
                        <div class="form-group">
                           <select name="status" id="status" class="form-control">
                              <option value="Pending" {{ $expense->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                              <option value="Processing" {{ $expense->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                              <option value="Completed" {{ $expense->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                           </select>
                        </div>
                        {!! Form::close() !!}

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