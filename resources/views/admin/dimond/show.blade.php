@extends('layouts.admin')
@section('style')
<style>
   /* Add your styling here */
   .accordion {
      display: flex;
      flex-direction: column;
      max-width: 100%;
      /* Adjust as needed */
   }

   .accordion-item {
      border: 1px solid #ddd;
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
</style>
@endsection
@section('content')

<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h4>Dimond Detail</h4>
            <div class="card-action">
            </div>
         </div>

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

         <div class="accordion p-3">
            <div class="accordion-item">
               <div class="accordion-header">
                  <span>Show Dimond Detail</span>
                  <span class="accordion-arrow">&#9658;</span>
               </div>
               <div class="accordion-content">
                  <div class="row p-2">
                     <div class="col-md-6">
                        <table class="table border border-white">
                           <tbody>
                              <tr>
                                 <th>Detail</th>
                              </tr>
                              <tr>
                                 <td class="text-warning">Party Name :</td>
                                 <td>{{$barcodeDetail->parties->party_code}}</td>
                              </tr>
                              <tr>
                                 <td class="text-warning">Dimond Name :</td>
                                 <td>{{$barcodeDetail->dimond_name}}</td>
                              </tr>
                              <!-- <tr>
                           <td class="text-warning">Dimond barcode :</td>
                           <td>{!! $barcodeDetail->barcode !!}</td>
                        </tr> -->
                              <tr>
                                 <td class="text-warning">Dimond barcode :</td>
                                 <td>
                                    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
                                    <script>
                                       window.onload = function() {
                                          generateBarcode('{{$barcodeDetail->barcode_number}}');
                                       };
                                    </script>
                                    <svg id="barcode"></svg>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="text-warning">Status :</td>
                                 <td>{{$barcodeDetail->status}}</td>
                              </tr>
                              <tr>
                                 <td class="text-warning">Created At :</td>
                                 <td>{{ \Carbon\Carbon::parse($barcodeDetail->created_at)->format('d-m-Y H:i:s') }}</td>
                              </tr>
                           </tbody>
                        </table>
                        <br />
                     </div>
                     <div class="col-md-6">
                        <table class="table border border-white">
                           <tbody>
                              <tr>
                                 <th>Parameter</th>
                                 <th>Issue</th>
                                 <th>Final/Return</th>
                              </tr>
                              <tr>
                                 <td class="text-warning"><strong>Row Weight :</strong></td>
                                 <td>{{$barcodeDetail->weight}}</td>
                                 <td><?= isset($final_result->return_weight) ? $final_result->return_weight : '' ?></td>
                              </tr>
                              <tr>
                                 <td class="text-warning"><strong>Polished Weight :</strong></td>
                                 <td>{{$barcodeDetail->required_weight}}</td>
                                 <td>-</td>
                              </tr>
                              <tr>
                                 <td class="text-warning"><strong>Shape :</strong></td>
                                 <td>{{$barcodeDetail->shape}}</td>
                                 <td><?= isset($final_result->shape) ? $final_result->shape : '' ?></td>
                              </tr>
                              <tr>
                                 <td class="text-warning"><strong>Color :</strong></td>
                                 <td>{{$barcodeDetail->color}}</td>
                                 <td><?= isset($final_result->r_color) ? $final_result->r_color : '' ?></td>
                              </tr>
                              <tr>
                                 <td class="text-warning"><strong>Clarity :</strong></td>
                                 <td>{{$barcodeDetail->clarity}}</td>
                                 <td><?= isset($final_result->r_clarity) ? $final_result->r_clarity : '' ?></td>
                              </tr>
                              <tr>
                                 <td class="text-warning"><strong>Cut :</strong></td>
                                 <td>{{$barcodeDetail->cut}}</td>
                                 <td><?= isset($final_result->r_cut) ? $final_result->r_cut : '' ?></td>
                              </tr>
                              <tr>
                                 <td class="text-warning"><strong>Polish :</strong></td>
                                 <td>{{$barcodeDetail->polish}}</td>
                                 <td><?= isset($final_result->r_polish) ? $final_result->r_polish : '' ?></td>
                              </tr>
                              <tr>
                                 <td class="text-warning"><strong>Symmetry :</strong></td>
                                 <td>{{$barcodeDetail->symmetry}}</td>
                                 <td><?= isset($final_result->r_symmetry) ? $final_result->r_symmetry : '' ?></td>
                              </tr>
                           </tbody>
                        </table>
                        <br />
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-8">
               @if($barcodeDetail->status != 'Completed' && $barcodeDetail->status != 'Delivered')
               @if(!isset($procee_return))
               <div id="section{{$barcodeDetail->id}}" onclick='addissue(this.id)' style="cursor: pointer;padding-left: 1rem;padding-bottom:1rem;"><i style="color:white;font-size:15px;background-color:green;padding:8px;">Issues</i></div>
               @else
               <div id="editButton{{$procee_return->id}}" onclick='editfun(this)' data-id="{{$procee_return->id}}" style="cursor: pointer; padding-left: 1rem;padding-bottom:1rem;" style="margin-left:10px;cursor: pointer;"><i style="color:white;font-size:15px;background-color:red;padding:8px;">Return</i></div>
               @endif
               @endif
            </div>
         </div>

         <div id="createsection{{$barcodeDetail->id}}" style="display:none;padding:1rem;">
            {!! Form::open(['method'=>'POST', 'action'=> 'AdminProcessController@store','files'=>true,'class'=>'form-horizontal']) !!}
            @csrf
            <input type="hidden" name="dimonds_id" value="{{$barcodeDetail->id}}">
            <input type="hidden" name="dimonds_barcode" value="{{$barcodeDetail->barcode_number}}">
            @if(count($processes) == 0)
            <input type="hidden" name="issue_weight" value="{{$barcodeDetail->weight}}">
            @else
            <input type="hidden" name="issue_weight" value="{{$lastweight->return_weight}}">
            @endif
            <div class="row form-group" style="margin-top:15px;">
               <div class="col-sm-2">
                  <label for="designation">Designation</label>
                  <select name="designation" id="designation" class="custom-select form-control form-control-rounded" required>
                     <option value="">Select designation</option>
                     @foreach($designations as $designation)
                     <option value="{{$designation->name}}">{{$designation->name}}</option>
                     @endforeach
                  </select>
               </div>
               <div class="col-sm-2">
                  <label for="worker_name">Worker</label>
                  <select name="worker_name" id="worker_name" class="custom-select form-control form-control-rounded" required>
                     <option value="">Select worker</option>
                  </select>
               </div>
               <div class="col-sm-2">
                  <label for="issue_date">Issue Date</label>
                  <input type="datetime-local" name="issue_date" class="form-control form-control-rounded" id="issue_date" required>
               </div>
               <div class="col-sm-1">
                  <div class="form-group">
                     <button type="submit" class="btn btn-light btn-round px-5">Save</button>
                  </div>
               </div>
            </div>
            {!! Form::close() !!}
         </div>

         @if(count($processes)>0)
         @foreach($processes as $process)
         <div id="editsection{{$process->id}}" style="display:none;padding:1rem;">
            {!! Form::open(['method'=>'post', 'action'=> 'AdminProcessController@update','files'=>true,'class'=>'form-horizontal']) !!}
            @csrf
            <input type="hidden" name="id" id="id{{$process->id}}" value="">
            <input type="hidden" name="dimonds_id" id="dimonds_id{{$process->id}}" value="">
            <input type="hidden" name="dimonds_barcode" id="dimonds_barcode{{$process->id}}" value="">
            <div class="row form-group" style="margin-top:15px;">
               <div class="col-sm-2">
                  <label for="designation">Designation</label>
                  <input type="text" name="designation" class="form-control form-control-rounded" id="designatio{{$process->id}}" value="" disabled>
               </div>
               <div class="col-sm-2">
                  <label for="worker_name">Worker</label>
                  <input type="text" name="worker_name" class="form-control form-control-rounded" id="worker_nam{{$process->id}}" value="" disabled>
               </div>
               <div class="col-sm-2">
                  <label for="return_date">return Date</label>
                  <input type="datetime-local" name="return_date" class="form-control form-control-rounded" id="return_dat{{$process->id}}" value="">
               </div>
               <div class="col-sm-2">
                  <label for="return_weight">return weight</label>
                  <input type="text" name="return_weight" class="form-control form-control-rounded" id="return_weigh{{$process->id}}" placeholder="00.00" oninput="formatWeight(this);" value="">
               </div>
               <label>
                  <input type="checkbox" name="ratecut" id="ratecut{{$process->id}}">
                  RateCut
               </label>
            </div>

            @if($process->designation == 'Grading')
            <div class="row">
               <div class="col-2">
                  <div class="form-group">
                     <label for="r_shape">Shape</label>
                     <input type="text" name="r_shape" class="form-control form-control-rounded" value="{{$barcodeDetail->shape}}" disabled>
                     <!-- <select name="r_shape" id="r_shape{{$process->id}}" class="custom-select form-control-rounded" style="width:100%">
                        <option value="">Select shape</option>
                        <option value="Round">Round</option>
                        <option value="Oval">Oval</option>
                        <option value="Pear">Pear</option>
                        <option value="Cush Mod">Cush Mod</option>
                        <option value="Cush Brill">Cush Brill</option>
                        <option value="Emeraid">Emeraid</option>
                        <option value="Radiant">Radiant</option>
                        <option value="Princess">Princess</option>
                        <option value="Asscher">Asscher</option>
                        <option value="Square">Square</option>
                        <option value="Marquise">Marquise</option>
                        <option value="Heart">Heart</option>
                        <option value="Trilliant">Trilliant</option>
                        <option value="Euro Cut">Euro Cut</option>
                        <option value="Old Miner">Old Miner</option>
                        <option value="Briolette">Briolette</option>
                     </select> -->
                  </div>
               </div>
               <div class="col-2">
                  <div class="form-group">
                     <label for="r_clarity">Clarity</label>
                     <select name="r_clarity" id="r_clarity" class="custom-select form-control-rounded">
                        <option value="" {{$barcodeDetail->clarity == '' ? 'selected' : ''}}>Select clarity</option>
                        <option value="FL" {{$barcodeDetail->clarity == 'FL' ? 'selected' : ''}}>FL</option>
                        <option value="IF" {{$barcodeDetail->clarity == 'IF' ? 'selected' : ''}}>IF</option>
                        <option value="VVS1" {{$barcodeDetail->clarity == 'VVS1' ? 'selected' : ''}}>VVS1</option>
                        <option value="VVS2" {{$barcodeDetail->clarity == 'VVS2' ? 'selected' : ''}}>VVS2</option>
                        <option value="VS1" {{$barcodeDetail->clarity == 'VS1' ? 'selected' : ''}}>VS1</option>
                        <option value="VS2" {{$barcodeDetail->clarity == 'VS2' ? 'selected' : ''}}>VS2</option>
                        <option value="SI1" {{$barcodeDetail->clarity == 'SI1' ? 'selected' : ''}}>SI1</option>
                        <option value="SI2" {{$barcodeDetail->clarity == 'SI2' ? 'selected' : ''}}>SI2</option>
                        <option value="SI3" {{$barcodeDetail->clarity == 'SI3' ? 'selected' : ''}}>SI3</option>
                        <option value="I1" {{$barcodeDetail->clarity == 'I1' ? 'selected' : ''}}>I1</option>
                        <option value="I2" {{$barcodeDetail->clarity == 'I2' ? 'selected' : ''}}>I2</option>
                        <option value="I3" {{$barcodeDetail->clarity == 'I3' ? 'selected' : ''}}>I3</option>
                     </select>
                  </div>
               </div>
               <div class="col-2">
                  <div class="form-group">
                     <label for="r_color">Color</label>
                     <select name="r_color" id="r_color" class="custom-select form-control-rounded">
                        <option value="" {{$barcodeDetail->color == '' ? 'selected' : ''}}>Select color</option>
                        <option value="D" {{$barcodeDetail->color == 'D' ? 'selected' : ''}}>D</option>
                        <option value="E" {{$barcodeDetail->color == 'E' ? 'selected' : ''}}>E</option>
                        <option value="F" {{$barcodeDetail->color == 'F' ? 'selected' : ''}}>F</option>
                        <option value="G" {{$barcodeDetail->color == 'G' ? 'selected' : ''}}>G</option>
                        <option value="H" {{$barcodeDetail->color == 'H' ? 'selected' : ''}}>H</option>
                        <option value="I" {{$barcodeDetail->color == 'I' ? 'selected' : ''}}>I</option>
                        <option value="J" {{$barcodeDetail->color == 'J' ? 'selected' : ''}}>J</option>
                        <option value="K" {{$barcodeDetail->color == 'K' ? 'selected' : ''}}>K</option>
                        <option value="L" {{$barcodeDetail->color == 'L' ? 'selected' : ''}}>L</option>
                        <option value="M" {{$barcodeDetail->color == 'M' ? 'selected' : ''}}>M</option>
                        <option value="N" {{$barcodeDetail->color == 'N' ? 'selected' : ''}}>N</option>
                        <option value="O" {{$barcodeDetail->color == 'O' ? 'selected' : ''}}>O</option>
                        <option value="P" {{$barcodeDetail->color == 'P' ? 'selected' : ''}}>P</option>
                        <option value="Q" {{$barcodeDetail->color == 'Q' ? 'selected' : ''}}>Q</option>
                        <option value="R" {{$barcodeDetail->color == 'R' ? 'selected' : ''}}>R</option>
                        <option value="S" {{$barcodeDetail->color == 'S' ? 'selected' : ''}}>S</option>
                     </select>
                  </div>
               </div>
               <div class="col-2">
                  <div class="form-group">
                     <label for="r_cut">Cut</label>
                     <select name="r_cut" id="r_cut" class="custom-select form-control-rounded">
                        <option value="" {{$barcodeDetail->cut == '' ? 'selected' : ''}}>Select cut</option>
                        <option value="Ideal" {{$barcodeDetail->cut == 'Ideal' ? 'selected' : ''}}>Ideal</option>
                        <option value="EX" {{$barcodeDetail->cut == 'EX' ? 'selected' : ''}}>EX</option>
                        <option value="VG" {{$barcodeDetail->cut == 'VG' ? 'selected' : ''}}>VG</option>
                        <option value="GD" {{$barcodeDetail->cut == 'GD' ? 'selected' : ''}}>GD</option>
                     </select>
                  </div>
               </div>
               <div class="col-2">
                  <div class="form-group">
                     <label for="r_polish">Polish</label>
                     <select name="r_polish" id="r_polish" class="custom-select form-control-rounded">
                        <option value="" {{$barcodeDetail->polish == '' ? 'selected' : ''}}>Select polish</option>
                        <option value="Ideal" {{$barcodeDetail->polish == 'Ideal' ? 'selected' : ''}}>Ideal</option>
                        <option value="EX" {{$barcodeDetail->polish == 'EX' ? 'selected' : ''}}>EX</option>
                        <option value="VG" {{$barcodeDetail->polish == 'VG' ? 'selected' : ''}}>VG</option>
                        <option value="GD" {{$barcodeDetail->polish == 'GD' ? 'selected' : ''}}>GD</option>
                     </select>
                  </div>
               </div>
               <div class="col-2">
                  <div class="form-group">
                     <label for="r_symmetry">Symmetry</label>
                     <select name="r_symmetry" id="r_symmetry" class="custom-select form-control-rounded">
                        <option value="" {{$barcodeDetail->symmetry == '' ? 'selected' : ''}}>Select symmetry</option>
                        <option value="Ideal" {{$barcodeDetail->symmetry == 'Ideal' ? 'selected' : ''}}>Ideal</option>
                        <option value="EX" {{$barcodeDetail->symmetry == 'EX' ? 'selected' : ''}}>EX</option>
                        <option value="VG" {{$barcodeDetail->symmetry == 'VG' ? 'selected' : ''}}>VG</option>
                        <option value="GD" {{$barcodeDetail->symmetry == 'GD' ? 'selected' : ''}}>GD</option>
                     </select>
                  </div>
               </div>
            </div>
            @endif

            <div class="col-sm-1">
               <div class="form-group">
                  <button type="submit" class="btn btn-light btn-round px-5">update</button>
               </div>
            </div>

            {!! Form::close() !!}
         </div>
         @endforeach
         @endif

         @if(count($processes)>0)
         <div class="table-responsive">
            <table class="table align-items-center table-flush table-borderless">
               <thead>
                  <tr>
                     @if($barcodeDetail->status != 'Delivered')
                     <th>Action</th>
                     @endif
                     <th>Designation</th>
                     <th>Worker</th>
                     <th>Issues date</th>
                     <th>return date</th>
                     <th>Issues weight</th>
                     <th>return weight</th>
                     <th>Price</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     @foreach($processes as $process)
                     @if($barcodeDetail->status != 'Delivered')
                     <td>
                        <a id="editButton{{ $process->id }}" onclick="editfun(this)" data-id="{{ $process->id }}" style="cursor: pointer;"><i class="fa fa-edit" style="color:white;font-size:15px;background-color:rgba(255, 255, 255, 0.25);padding:8px;"></i></a>
                        <!-- <a href="{{route('admin.process.edit', $process->id)}}"><i class="fa fa-edit" style="color:white;font-size:15px;background-color:rgba(255, 255, 255, 0.25);padding:8px;"></i></a> -->
                        <a href="{{route('admin.process.destroy', $process->id)}}" onclick="return confirm('Sure ! You want to delete ?');"><i class="fa fa-trash" style="color:white;font-size:15px;background-color:rgba(255, 255, 255, 0.25);padding:8px;"></i></a>
                     </td>
                     @endif
                     <td>{{$process->designation}}</td>
                     <td>{{$process->worker_name}}</td>
                     <td>{{ \Carbon\Carbon::parse($process->issue_date)->format('d-m-Y') }}</td>
                     <td>{{ \Carbon\Carbon::parse($process->return_date)->format('d-m-Y') }}</td>
                     <td>{{$process->issue_weight}}</td>
                     <td>{{$process->return_weight}}</td>
                     <td>{{$process->price}}</td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
         @endif

      </div>
   </div>
</div><!--End Row-->

@endsection

@section('script')
<script>
   function addissue(cli_id) {
      var div = document.getElementById("create" + cli_id);
      if (div.style.display !== "block") {
         div.style.display = "block";
      } else {
         div.style.display = "none";
      }
   }

   function todaydatetime() {
      var currentDate = new Date();
      // Get today's date in the format "YYYY-MM-DD"
      var today = currentDate.toISOString().split('T')[0];
      var hours = currentDate.getHours();
      var minutes = currentDate.getMinutes();

      // Format hours and minutes as "HH:mm"
      var formattedTime = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2);

      // Concatenate date and time in the expected format
      var formattedDateTime = today + ' ' + formattedTime;
      return formattedDateTime;
   }

   document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('issue_date').value = todaydatetime();
   });

   $(document).ready(function() {
      $('#designation').change(function() {
         var designation = $(this).val();
         if (designation) {
            $.ajax({
               type: 'POST',
               url: '/admin/get-workers',
               data: {
                  '_token': '{{ csrf_token() }}',
                  'designation': designation,
                  'dimond_id': <?= $barcodeDetail->id ?>
               },
               success: function(data) {
                  $('#worker_name').empty();
                  $.each(data, function(key, value) {
                     $('#worker_name').append('<option value="' + value.fname + '">' + value.fname + ' ' + value.lname + '</option>');
                  });
               }
            });
         } else {
            $('#worker_name').empty();
         }
      });
      $('input[type="checkbox"]').on('change', function() {
         // If checkbox is unchecked, set its value to 0
         if (!$(this).prop('checked')) {
            $(this).val(0);
         } else {
            $(this).val(1);
         }
      });
   });
</script>
<script>
   function editfun(element) {
      var id = element.getAttribute('data-id');
      var div = document.getElementById("editsection" + id);

      if (div.style.display !== "block") {
         div.style.display = "block";
      } else {
         div.style.display = "none";
      }
      $.ajax({
         url: '/admin/process/edit/' + id,
         type: 'GET',
         dataType: 'json',
         success: function(response) {
            $('#id' + id).val(response.data.id);
            $('#designatio' + id).val(response.data.designation);
            $('#worker_nam' + id).val(response.data.worker_name);
            $('#dimonds_barcode' + id).val(response.data.dimonds_barcode);
            $('#dimonds_id' + id).val(response.data.dimonds_id);
            $('#issue_dat' + id).val(response.data.issue_date);
            $('#issue_weigh' + id).val(response.data.issue_weight);
            $('#return_weigh' + id).val(response.data.return_weight);
            $('#r_shape' + id).val(response.data.r_shape);
            $('#r_clarity' + id).val(response.data.r_clarity);
            $('#r_color' + id).val(response.data.r_color);
            $('#r_cut' + id).val(response.data.r_cut);
            $('#r_polish' + id).val(response.data.r_polish);
            $('#r_symmetry' + id).val(response.data.r_symmetry);
            $('#ratecut' + id).prop('checked', response.data.ratecut == 1);

            if (response.data.return_date == null) {
               document.getElementById('return_dat' + id).value = todaydatetime();
            } else {
               $('#return_dat' + id).val(response.data.return_date);
            }

         },
         error: function(error) {
            console.error('Ajax request failed: ' + error.responseText);
         }
      });
      $('#designatio' + id).change(function() {
         var designation = $(this).val();
         if (designation) {
            $.ajax({
               type: 'POST',
               url: '/admin/get-workers',
               data: {
                  '_token': '{{ csrf_token() }}',
                  'designation': designation
               },
               success: function(data) {
                  $('#worker_nam' + id).empty();
                  $.each(data, function(key, value) {
                     $('#worker_nam' + id).append('<option value="' + value.fname + '">' + value.fname + ' ' + value.lname + '</option>');
                  });
               }
            });
         } else {
            $('#worker_nam' + id).empty();
         }
      });
   }
</script>
<script>
   function formatWeight(input) {
      // Remove any non-numeric characters
      var cleanedValue = input.value.replace(/[^0-9.]/g, '');

      // Ensure valid pattern: either empty, '0.00', or '00.00'
      var match = cleanedValue.match(/^(\d{0,2}(\.\d{0,2})?)?$/);

      // Update the input value with the formatted result
      input.value = match ? match[1] || '' : '';
   }
</script>
<script>
   $(document).ready(function() {
      // Capture the change event of the dropdown
      $('#status').on('change', function() {
         // Trigger form submission when the dropdown changes
         $('#myForm').submit();
      });
   });
</script>
<script>
   function generateBarcode(value) {
      JsBarcode("#barcode", value, {
         format: "CODE128",
         displayValue: true,
      });
   }
</script>
<script>
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
</script>

@endsection