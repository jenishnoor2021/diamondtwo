@extends('layouts.admin')

@section('content')

<?php

use App\Models\Dimond;
use App\Models\Repair; ?>

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

<!-- Party Report -->
<div class="row mt-3">
  <div class="col-lg-12 mx-auto">
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <h4>Party Report</h4>
        </div>
        <hr>
        <div class="table-responsive">
          <table class="table align-items-center table-flush table-borderless">
            <thead>
              <tr>
                <th>Party Name</th>
                <th>Discus</th>
                <th>HPHT</th>
                <th>Pending</th>
                <th>Outter</th>
                <th>Processing</th>
                <th>Completed</th>
                <th>Repair</th>
                <th>Delivered</th>
                <th>Total Dimond</th>
              </tr>
            </thead>
            <tbody>
              @php
              $totalDiscus = 0;
              $totalHpht = 0;
              $totalPending = 0;
              $totalOutter = 0;
              $totalProcessing = 0;
              $totalCompleted = 0;
              $totalRepair = 0;
              $totalDelivered = 0;
              $totalDimonds = 0;
              @endphp

              @foreach($partys as $partyList)
              <?php
              $totalDimond = Dimond::where('status', '!=', 'Delivered')->where('parties_id', $partyList->id)->count();
              $outterDimond = Dimond::where(['parties_id' => $partyList->id, 'status' => 'OutterProcessing'])->count();
              $pendingDimond = Dimond::where(['parties_id' => $partyList->id, 'status' => 'Pending'])->count();
              $processingDimond = Dimond::where(['parties_id' => $partyList->id, 'status' => 'Processing'])->count();
              $completedDimond = Dimond::where(['parties_id' => $partyList->id, 'status' => 'Completed'])->count();
              $deliveredDimond = Dimond::where(['parties_id' => $partyList->id, 'status' => 'Delivered'])->count();
              $dimondIds = Dimond::where('parties_id', $partyList->id)->pluck('id')->toArray();
              $repairCount = $dimondIds ? Repair::whereIn('dimonds_id', $dimondIds)->count() : 0;
              // Discus / HPHT columns currently not available in schema - show 0
              $discus = 0;
              $hpht = 0;

              $totalDiscus += $discus;
              $totalHpht += $hpht;
              $totalPending += $pendingDimond;
              $totalOutter += $outterDimond;
              $totalProcessing += $processingDimond;
              $totalCompleted += $completedDimond;
              $totalRepair += $repairCount;
              $totalDelivered += $deliveredDimond;
              $totalDimonds += $totalDimond;
              ?>
              <tr>
                <td>{{$partyList->fname}} {{$partyList->lname}} ({{$partyList->party_code}})</td>
                <td>{{$discus}}</td>
                <td>{{$hpht}}</td>
                <td><a href="{{ url('admin/dimond') }}?party_id={{ $partyList->id }}&status=Pending">{{$pendingDimond}}</a></td>
                <td><a href="{{ url('admin/dimond') }}?party_id={{ $partyList->id }}&status=OutterProcessing">{{$outterDimond}}</a></td>
                <td><a href="{{ url('admin/dimond') }}?party_id={{ $partyList->id }}&status=Processing">{{$processingDimond}}</a></td>
                <td><a href="{{ url('admin/dimond') }}?party_id={{ $partyList->id }}&status=Completed">{{$completedDimond}}</a></td>
                <td><a href="{{ url('admin/dimond') }}?party_id={{ $partyList->id }}&repair=1">{{$repairCount}}</a></td>
                <td><a href="{{ url('admin/dimond') }}?party_id={{ $partyList->id }}&status=Delivered">{{$deliveredDimond}}</a></td>
                <td><a href="{{ url('admin/dimond') }}?party_id={{ $partyList->id }}">{{$totalDimond}}</a></td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>Total</th>
                <th>{{ $totalDiscus }}</th>
                <th>{{ $totalHpht }}</th>
                <th>{{ $totalPending }}</th>
                <th>{{ $totalOutter }}</th>
                <th>{{ $totalProcessing }}</th>
                <th>{{ $totalCompleted }}</th>
                <th>{{ $totalRepair }}</th>
                <th>{{ $totalDelivered }}</th>
                <th>{{ $totalDimonds }}</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!--start overlay-->
<div class="overlay toggle-menu"></div>
<!--end overlay-->

@endsection