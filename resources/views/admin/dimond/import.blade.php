@extends('layouts.admin')
@section('content')
<div class="row mt-3">
  <div class="col-lg-12 mx-auto">
    <div class="card">
      <div class="card-body">
        <div class="card-title">Dimond Import</div>
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
        <hr>
        <form action="{{ route('import.diamonds') }}" name="diamondImport" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-4">
              <div class="form-group">
                <label for="file">File</label>
                <input type="file" name="file" class="form-control" id="file" required>
                @if($errors->has('file'))
                <div class="error text-danger">{{ $errors->first('file') }}</div>
                @endif
              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-light btn-round px-5"><i class="fa fa-plus"></i> Imports</button>
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

    $("form[name='diamondImport']").validate({
      rules: {
        file: {
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