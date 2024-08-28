<?php

use Carbon\Carbon;
use App\Models\Process;
use App\Models\Dimond;
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
      <h4>WORKER SUMMARY REPORT</h4>
      <h1 style="margin-top:-10px">DHYANI IMPEX</h1>
      <p style="font-size:10px;margin-top:-12px">E-102, FIRST FLOOR, Happyness Residency, BEHIND S HRUSHTI ROW HOUSE,<br /> Surat Surat, GUJARAT, 394107</p>
    </center>

    <br />
    <?php if (isset($_GET['worker_name']) && $_GET['worker_name'] == 'all') { ?>
      <div class="table-responsive">
        <table id="" class="table align-items-center table-flush table-borderless">
          <thead>
            <tr>
              <th>Worker Name</th>
              <th>Total Diamond</th>
            </tr>
          </thead>
          <tbody>
            <?php $total = 0; ?>
            @foreach($workers as $worker)
            <?php
            $processcount = Process::where('worker_name', $worker->fname)->where('return_weight', null)->count();
            ?>
            <tr>
              <td>{{$worker->fname}}&nbsp;{{$worker->lname}}</td>
              <td>{{$processcount}}</td>
            </tr>
            <?php $total = $total + $processcount; ?>
            @endforeach
            <tr>
              <td align="right">Total</td>
              <td>{{$total}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    <?php } else { ?>
      @foreach($workers as $worker)
      <center>
        <h4>{{$worker->fname}}&nbsp;{{$worker->lname}}</h4>
      </center>
      <div class="table-responsive">
        <table id="" class="table align-items-center table-flush table-borderless">
          <thead>
            <tr>
              <th>Party Name</th>
              <th>Diamond Name</th>
              <th>Issue Date</th>
              <th>Diamond Barcode</th>
              <th>Created Date</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $workerprocess = Process::where('worker_name', $worker->fname)->where('return_weight', null)->get();
            ?>
            @foreach($workerprocess as $workerpro)
            <?php
            $dimond = Dimond::where('barcode_number', $workerpro->dimonds_barcode)->first();
            ?>
            <tr>
              <td>{{$dimond->parties->fname}}</td>
              <td>{{$dimond->dimond_name}}</td>
              <td>{{ \Carbon\Carbon::parse($workerpro->issue_date)->format('d-m-Y') }}</td>
              <td>{{$workerpro->dimonds_barcode}}</td>
              <td>{{ \Carbon\Carbon::parse($dimond->creatd_at)->format('d-m-Y') }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @endforeach
    <?php } ?>
  </div>
</body>

</html>