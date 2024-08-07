@extends('layouts.admin')

@section('content')


<div class="row mt-3">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Change Password</div>
                <hr>
                @if (session('error'))
                <div class="alert text-white pl-3 pt-2 pb-2" style="background-color:red">
                    {{ session('error') }}
                </div>
                @endif
                @if (session('success'))
                <div class="alert text-white pl-3 pt-2 pb-2" style="background-color:green">
                    {{ session('success') }}
                </div>
                @endif
                <form class="form-horizontal" name=editprofile method="POST" action="{{ route('profile.update') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" name="current_password" class="form-control form-control-rounded" id="current_password" placeholder="Enter Your current password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" class="form-control form-control-rounded" id="new_password" placeholder="Enter Your new password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password-confirm">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" class="form-control form-control-rounded" id="new_password-confirm" placeholder="Enter Confirm New Password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-light btn-round px-5">Change Password</button>
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

        $("form[name='editprofile']").validate({
            rules: {
                current_password: {
                    required: true,
                },
                new_password: {
                    required: true,
                },
                new_password_confirmation: {
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