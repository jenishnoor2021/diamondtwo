@extends('layouts.admin')

@section('content')

<!--Start Dashboard Content-->

<div class="card mt-3">
  <div class="card-content">
    <div class="row row-group m-0">
      <div class="col-12 col-lg-6 col-xl-3 border-light">
        <div class="card-body">
          <a href="/admin/processed/Delivered">
            <p class="mb-0 text-warning small-font" style="font-size:20px;">Delivered Dimonds </p>
          </a>
          <div class="progress my-3" style="height:3px;">
            <div class="progress-bar" style="width:55%"></div>
          </div>
          <h5 class="text-white mb-0">{{ $deliverd_count }} <span class="float-right"></span></h5>
        </div>
      </div>
      <div class="col-12 col-lg-6 col-xl-3 border-light">
        <div class="card-body">
          <a href="/admin/processed/Completed">
            <p class="mb-0 text-warning medium-font" style="font-size:20px;">Completed Dimonds </p>
          </a>
          <div class="progress my-3" style="height:3px;">
            <div class="progress-bar" style="width:55%"></div>
          </div>
          <h5 class="text-white mb-0">{{ $completed_count }} <span class="float-right"></span></h5>
        </div>
      </div>

      <div class="col-12 col-lg-6 col-xl-3 border-light">
        <div class="card-body">
          <a href="/admin/processed/Processing">
            <p class="mb-0 text-warning small-font" style="font-size:20px;">Processing Dimonds </p>
          </a>
          <div class="progress my-3" style="height:3px;">
            <div class="progress-bar" style="width:55%"></div>
          </div>
          <h5 class="text-white mb-0">{{ $processing_count }} <span class="float-right"></span></h5>
        </div>
      </div>
      <div class="col-12 col-lg-6 col-xl-3 border-light">
        <div class="card-body">
          <a href="/admin/processed/Pending">
            <p class="mb-0 text-warning small-font" style="font-size:20px;">Pending Dimonds</p>
          </a>
          <div class="progress my-3" style="height:3px;">
            <div class="progress-bar" style="width:55%"></div>
          </div>
          <h5 class="text-white mb-0">{{ $pending_count }} <span class="float-right"></span></h5>
        </div>
      </div>
      <div class="col-12 col-lg-6 col-xl-3 border-light">
        <div class="card-body">
          <a href="/admin/processed/OutterProcessing">
            <p class="mb-0 text-warning small-font" style="font-size:20px;">Outter Dimonds</p>
          </a>
          <div class="progress my-3" style="height:3px;">
            <div class="progress-bar" style="width:55%"></div>
          </div>
          <h5 class="text-white mb-0">{{ $outercount }} <span class="float-right"></span></h5>
        </div>
      </div>
      <div class="col-12 col-lg-6 col-xl-3 border-light">
        <div class="card-body">
          <p class="mb-0 text-warning small-font" style="font-size:20px;">Total Dimonds</p>
          <div class="progress my-3" style="height:3px;">
            <div class="progress-bar" style="width:55%"></div>
          </div>
          <h5 class="text-white mb-0">{{ $total_count }} <span class="float-right"></span></h5>
        </div>
      </div>
    </div>
  </div>
</div>

<!--End Dashboard Content-->

<!--start overlay-->
<div class="overlay toggle-menu"></div>
<!--end overlay-->

@endsection