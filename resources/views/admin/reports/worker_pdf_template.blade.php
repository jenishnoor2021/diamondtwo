<?php

use Carbon\Carbon;
use App\Models\Dimond;
use App\Models\Process;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
  <style>
    * {
      box-sizing: border-box;
    }

    /* general styling */
    body {
      font-family: "Open Sans", sans-serif;
    }

    .column-left {
      float: left;
      width: 60%;
      padding: 10px;
      /* border-right: 1px dotted #000; */
    }

    .column-right {
      float: left;
      width: 40%;
      padding: 10px;
    }

    /* Create four equal columns that floats next to each other */
    .column {
      /* float: left;
      width: 100%;
      padding: 10px;
      border-right: 1px dotted #000;
      height: 50%; */
      /* Should be removed. Only for demonstration */
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0 auto;
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    .d-flex {
      display: flex;
    }

    .flex-col {
      flex-direction: column;
    }

    .justify-content-between {
      justify-content: space-between;
    }

    .justify-content-center {
      justify-content: center;
    }

    .justify-content-end {
      justify-content: end;
    }

    .float-right {
      float: right;
    }

    .float-left {
      float: left;
    }

    .circle-logo {
      width: 60px;
    }

    .logo {
      width: 220px;
    }

    .title {
      margin-top: 5px;
    }

    .student-name {
      margin-bottom: 10px;
    }

    .bar-code {
      width: 200px;
      align-self: center;
      margin-top: 5px;
      margin-bottom: 10px;
    }

    .align-center {
      align-self: center;
    }

    .align-items-center {
      align-items: center;
    }

    /*table*/
    table {
      margin-top: 10px;
      border: 1px solid #ccc;
      border-collapse: collapse;
      margin: 0;
      padding: 0;
      width: 100%;
      table-layout: fixed;
      font-size: 12px;
    }

    table tr {
      background-color: #fff;
      border: 1px solid #000;
      padding: .35em;
    }

    table th,
    table td {
      padding: .625em;
      border: 1px solid #000;
    }

    /*table end*/
    hr {
      border-top: 1px solid #000;
    }
  </style>
</head>

<body>
  <div class="container">
    <center>
      <h4>Worker Report</h4>
      <h1 style="margin-top:-10px">HR DIMONDS</h1>
      <p style="font-size:10px;margin-top:-12px">OFFICE NO.A-4,FIRST FLOOR,ENTW AP PARK,KANSHARA SHERI,<br />SURAT,SURAT,GUJRAT,395003 Gujarat</p>
    </center>
    @foreach ($worker_detail as $worker)
    <div class="row">
      <div class="column-left">
        <div class="d-flex align-items-center justify-content-center">
          <p><strong class="align-center title">Bill Date:</strong>{{ \Carbon\Carbon::parse(Carbon::now())->format('d-m-Y H:i:s') }}</p>
          <p><strong class="align-center title">Worker Name:</strong>{{isset($worker->fname) ?$worker->fname : '' }} {{isset($worker->lname) ?$worker->lname : '' }}</p>
          <p><strong class="align-center title">Designation:</strong>{{isset($worker->designation)?$worker->designation:''}}</p>
          <p><strong class="align-center title">Phones :</strong>{{isset($worker->mobile)?$worker->mobile:''}}</p>
          <p><strong class="align-center title">Address :</strong>{{isset($worker->address)?$worker->address:''}}</p>
          <p><strong class="align-center title">Aadhar No. :</strong>{{isset($worker->aadhar_no)?$worker->aadhar_no:''}}</p>
        </div>
      </div>
      <div class="column-right">
      </div>
      <div style="clear: both;"></div>
    </div>
    <br />
    <table>
      <thead>
        <tr>
          <th>Sr.</th>
          <th>Dimond Name</th>
          <th>Dimond barcode</th>
          <th>Issues Date</th>
          <th>Return Date</th>
          <th>Shape</th>
          <th>Issues Weight</th>
          <th>Return Weight</th>
          <th width="20%">Amount</th>
          <th>Created date</th>
          <th>Delivery date</th>
        </tr>
      </thead>
      @php
      $sum = 0;
      $p = 1;
      @endphp
      <tbody>
        <?php
        $dimondsBarcodeArray = [];
        ?>
        @foreach($data as $key=>$da)
        @if($worker->fname == $da->worker_name)
        <?php
        $category = $_GET['category'];
        $getdimond = Dimond::where('barcode_number', $da->dimonds_barcode)->first();
        $which_diamond = $_GET['which_diamond'];
        if ($which_diamond == 'updated_at') {
          $rw = $da->return_weight;
        } else {
          $returndimond = Process::where('dimonds_barcode', $da->dimonds_barcode)->where('designation', 'Grading')->latest()->first();
          $rw = isset($returndimond->return_weight) ? $returndimond->return_weight : '';
        }
        if (isset($getdimond) && ($da->price != 0) && ($category != "Outter")) { ?>
          <tr>
            <td>{{$p}}</td>
            <td>{{ $da->dimonds->dimond_name }}</td>
            <td>{{ $da->dimonds_barcode }}</td>
            <td>{{ \Carbon\Carbon::parse($da->issue_date)->format('d-m-Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($da->return_date)->format('d-m-Y') }}</td>
            <td>{{ $getdimond->shape }}</td>
            <td>{{ $da->issue_weight }}</td>
            <td>{{ isset($rw) ? $rw : '' }}</td>
            <td>{{ $da->price }}</td>
            <td>{{ \Carbon\Carbon::parse($getdimond->created_at)->format('d-m-Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($getdimond->delevery_date)->format('d-m-Y') }}</td>
            @php
            $sum += ($da->price);
            $p += 1;
            @endphp
          </tr>
        <?php } elseif ($category == "Outter" && !in_array($da->dimonds_barcode, $dimondsBarcodeArray)) {
          $dimondsBarcodeArray[] = $da->dimonds_barcode;
        ?>
          <tr>
            <td>{{$p}}</td>
            <td>{{ $da->dimonds->dimond_name }}</td>
            <td>{{ $da->dimonds_barcode }}</td>
            <td>{{ \Carbon\Carbon::parse($da->issue_date)->format('d-m-Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($da->return_date)->format('d-m-Y') }}</td>
            <td>{{ $getdimond->shape }}</td>
            <td>{{ $da->issue_weight }}</td>
            <td>{{ isset($rw) ? $rw : '' }}</td>
            <td>{{ $da->price }}</td>
            <td>{{ \Carbon\Carbon::parse($getdimond->created_at)->format('d-m-Y')}}</td>
            <td>{{ \Carbon\Carbon::parse($getdimond->delevery_date)->format('d-m-Y') }}</td>
            @php
            $p += 1;
            @endphp
          </tr>
          <?php } else {
          if ($da->price != 0) { ?>
            <tr>
              <td>{{$p}}</td>
              <td>{{ $da->dimonds->dimond_name }}</td>
              <td>{{ $da->dimonds_barcode }}</td>
              <td>{{ \Carbon\Carbon::parse($da->issue_date)->format('d-m-Y') }}</td>
              <td>{{ \Carbon\Carbon::parse($da->return_date)->format('d-m-Y') }}</td>
              <td>{{ $getdimond->shape }}</td>
              <td>{{ $da->issue_weight }}</td>
              <td>{{ isset($rw) ? $rw : '' }}</td>
              <td>{{ $da->price }}</td>
              <td>{{ \Carbon\Carbon::parse($getdimond->created_at)->format('d-m-Y') }}</td>
              <td>{{ \Carbon\Carbon::parse($getdimond->delevery_date)->format('d-m-Y') }}</td>
              @php
              $sum += ($da->price);
              $p += 1;
              @endphp
            </tr>
        <?php }
        } ?>
        @endif
        @endforeach
        <tr>
          <td colspan="7">
            <b>
              <h4>Total Amount</h4>
            </b>
          </td>
          <td>
            <b>
              <h4>{{$sum}}</h4>
            </b>
          </td>
        </tr>
      </tbody>
    </table>
    @endforeach
  </div>
</body>

</html>