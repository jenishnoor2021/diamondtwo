@extends('layouts.admin')
@section('content')
<div class="row mt-3">
   <div class="col-lg-12 mx-auto">
      <div class="card">
         <div class="card-body">
            <div class="card-title">ADD Dimond</div>
            <hr>
            {!! Form::open(['method'=>'POST', 'action'=> 'AdminDimondController@store','files'=>true,'class'=>'form-horizontal','name'=>'adddimondform']) !!}
            @csrf
            <div class="row">
               <div class="col-4">
                  <div class="form-group">
                     <label for="parties_id">Party</label>
                     <select name="parties_id" id="parties_id" class="custom-select" required>
                        <option value="">Select Party</option>
                        @foreach ($partys as $party)
                        <option value="{{$party->id}}">{{$party->party_code}}</option>
                        @endforeach
                     </select>
                     @if($errors->has('parties_id'))
                     <div class="error text-danger">{{ $errors->first('parties_id') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-2">
                  <div class="form-group">
                     <label for="janger_no">Janger no</label>
                     <input type="text" name="janger_no" class="form-control" id="janger_no" placeholder="Enter Janger no" value="{{ old('janger_no') }}" required>
                     @if($errors->has('janger_no'))
                     <div class="error text-danger">{{ $errors->first('janger_no') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-2">
                  <div class="form-group">
                     <label for="dimond_name">Stone Id</label>
                     <input type="text" name="dimond_name" class="form-control" id="dimond_name" placeholder="Enter Stone Id" value="{{ old('dimond_name') }}" required>
                     @if($errors->has('dimond_name'))
                     <div class="error text-danger">{{ $errors->first('dimond_name') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-2">
                  <div class="form-group">
                     <label for="weight">Row Weight</label>
                     <input type="text" name="weight" class="form-control" id="weight" placeholder="00.00" oninput="formatWeight(this);" value="{{ old('weight') }}" required>
                     @if($errors->has('weight'))
                     <div class="error text-danger">{{ $errors->first('weight') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-2">
                  <div class="form-group">
                     <label for="required_weight">Polished Weight</label>
                     <input type="text" name="required_weight" class="form-control" id="required_weight" placeholder="00.00" value="{{ old('required_weight') }}" oninput="formatWeight(this);" required>
                     @if($errors->has('required_weight'))
                     <div class="error text-danger">{{ $errors->first('required_weight') }}</div>
                     @endif
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-4">
                  <div class="form-group">
                     <label for="shape">Shape</label>
                     <select name="shape" id="shape" class="custom-select" style="width:100%" required>
                        <!-- <option value="">Select shape</option> -->
                        <option value="Modifiy">Modifiy</option>
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
                     </select>
                     @if($errors->has('shape'))
                     <div class="error text-danger">{{ $errors->first('shape') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-4">
                  <div class="form-group">
                     <label for="clarity">Clarity</label>
                     <select name="clarity" id="clarity" class="custom-select" required>
                        <!-- <option value="">Select clarity</option> -->
                        <option value="FL">FL</option>
                        <option value="IF">IF</option>
                        <option value="VVS1">VVS1</option>
                        <option value="VVS2">VVS2</option>
                        <option value="VS1">VS1</option>
                        <option value="VS2">VS2</option>
                        <option value="SI1">SI1</option>
                        <option value="SI2">SI2</option>
                        <option value="SI3">SI3</option>
                        <option value="I1">I1</option>
                        <option value="I2">I2</option>
                        <option value="I3">I3</option>
                     </select>
                     @if($errors->has('clarity'))
                     <div class="error text-danger">{{ $errors->first('clarity') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-4">
                  <div class="form-group">
                     <label for="color">Color</label>
                     <select name="color" id="color" class="custom-select" required>
                        <!-- <option value="">Select color</option> -->
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                        <option value="H">H</option>
                        <option value="I">I</option>
                        <option value="J">J</option>
                        <option value="K">K</option>
                        <option value="L">L</option>
                        <option value="M">M</option>
                        <option value="N">N</option>
                        <option value="O">O</option>
                        <option value="P">P</option>
                        <option value="Q">Q</option>
                        <option value="R">R</option>
                        <option value="S">S</option>
                     </select>
                     @if($errors->has('color'))
                     <div class="error text-danger">{{ $errors->first('color') }}</div>
                     @endif
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-4">
                  <div class="form-group">
                     <label for="cut">Cut</label>
                     <select name="cut" id="cut" class="custom-select" required>
                        <option value="EX">EX</option>
                        <option value="Ideal">Ideal</option>
                        <option value="VG">VG</option>
                        <option value="GD">GD</option>
                     </select>
                     @if($errors->has('cut'))
                     <div class="error text-danger">{{ $errors->first('cut') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-4">
                  <div class="form-group">
                     <label for="polish">Polish</label>
                     <select name="polish" id="polish" class="custom-select" required>
                        <option value="EX">EX</option>
                        <option value="Ideal">Ideal</option>
                        <option value="VG">VG</option>
                        <option value="GD">GD</option>
                     </select>
                     @if($errors->has('polish'))
                     <div class="error text-danger">{{ $errors->first('polish') }}</div>
                     @endif
                  </div>
               </div>
               <div class="col-4">
                  <div class="form-group">
                     <label for="symmetry">Symmetry</label>
                     <select name="symmetry" id="symmetry" class="custom-select" required>
                        <option value="EX">EX</option>
                        <option value="Ideal">Ideal</option>
                        <option value="VG">VG</option>
                        <option value="GD">GD</option>
                     </select>
                     @if($errors->has('symmetry'))
                     <div class="error text-danger">{{ $errors->first('symmetry') }}</div>
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

      $("form[name='adddimondform']").validate({
         rules: {
            parties_id: {
               required: true,
            },
            dimond_name: {
               required: true,
            },
            janger_no: {
               required: true,
            },
            shape: {
               required: true,
            },
            weight: {
               required: true,
            },
            clarity: {
               required: true,
            },
            color: {
               required: true,
            },
            cut: {
               required: true,
            },
            polish: {
               required: true,
            },
            symmetry: {
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
   function formatWeight(input) {
      // Remove any non-numeric characters
      var cleanedValue = input.value.replace(/[^0-9.]/g, '');

      // Ensure valid pattern: either empty, '0.00', or '00.00'
      var match = cleanedValue.match(/^(\d{0,2}(\.\d{0,2})?)?$/);

      // Update the input value with the formatted result
      input.value = match ? match[1] || '' : '';
   }
</script>
@endsection