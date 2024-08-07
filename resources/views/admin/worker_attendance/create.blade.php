@extends('layouts.admin')
@section('content')
<div class="row mt-3">
   <div class="col-lg-8 mx-auto">
      @if (session('success'))
      <div class="alert text-white pl-3 pt-2 pb-2" style="background-color:green">
         {{ session('success') }}
      </div>
      @endif
      @if (session('error'))
      <div class="alert text-white pl-3 pt-2 pb-2" style="background-color:red">
         {{ session('error') }}
      </div>
      @endif
      <div class="card">
         <div class="card-body">
            <div class="card-title">Add Worker Attendance</div>
            <hr>
            {!! Form::open(['method'=>'POST', 'action'=> 'AdminWorkerAttendanceController@store','files'=>true,'class'=>'form-horizontal','name'=>'addworkerattendanceform']) !!}
            @csrf
            <div class="row">
               <div class="col-6">
                  <div class="form-group">
                     <label for="worker_id">Worker</label>
                     <select name="worker_id" id="worker_id" class="custom-select form-control form-control-rounded" required>
                        <option value="">Select worker</option>
                        @foreach($workers as $worker)
                        <option value="{{$worker->id}}">{{$worker->fname}}&nbsp;{{$worker->lname}}</option>
                        @endforeach
                     </select>
                     @if($errors->has('worker_id'))
                     <div class="error text-danger">{{ $errors->first('worker_id') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-6">
                  <div class="form-group">
                     <label for="date">Date</label>
                     <input type="date" name="date" class="form-control form-control-rounded" id="date" placeholder="Enter number" value="" required>
                     @if($errors->has('date'))
                     <div class="error text-danger">{{ $errors->first('date') }}</div>
                     @endif
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-6">
                  <div class="form-group">
                     <label for="check_in">Check In time</label>
                     <input type="datetime-local" name="check_in" class="form-control form-control-rounded" id="check_in" placeholder="Enter number" value="">
                     @if($errors->has('check_in'))
                     <div class="error text-danger">{{ $errors->first('check_in') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-6">
                  <div class="form-group">
                     <label for="check_out">Check Out time</label>
                     <input type="datetime-local" name="check_out" class="form-control form-control-rounded" id="check_out" placeholder="Enter aadhar no" value="">
                     @if($errors->has('check_out'))
                     <div class="error text-danger">{{ $errors->first('check_out') }}</div>
                     @endif
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-6">
                  <div class="form-group">
                     <label for="duration">Duration : </label>
                     <input type="text" name="duration" class="form-control form-control-rounded" id="duration" placeholder="Enter aadhar no" value="">
                  </div>
               </div>
            </div>
            <div class="form-group">
               <button type="submit" class="btn btn-light btn-round px-5">Save</button>
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

      $("form[name='addworkerattendanceform']").validate({
         rules: {
            worker_id: {
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
      const checkInInput = document.getElementById('check_in');
      const checkOutInput = document.getElementById('check_out');
      const durationInput = document.getElementById('duration');

      function calculateDuration() {
         const checkInTime = new Date(checkInInput.value);
         const checkOutTime = new Date(checkOutInput.value);

         if (checkInTime > checkOutTime) {
            alert("Check-in time cannot be later than check-out time");
            // checkOutInput.value = '';
            // durationInput.value = '';
            return;
         }

         if (checkInInput.value && checkOutInput.value) {
            const duration = Math.abs(checkOutTime - checkInTime) / 1000;
            const hours = Math.floor(duration / 3600);
            const minutes = Math.floor((duration % 3600) / 60);
            const seconds = Math.floor(duration % 60);
            const formattedDuration = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            durationInput.value = formattedDuration;
         } else {
            durationInput.value = '';
         }
      }

      checkInInput.addEventListener('input', calculateDuration);
      checkOutInput.addEventListener('input', calculateDuration);

      // Initial calculation
      calculateDuration();
   });
</script>
@endsection