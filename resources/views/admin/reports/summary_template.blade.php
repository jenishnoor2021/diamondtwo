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
      <h4>SUMMARY REPORT</h4>
      <h1 style="margin-top:-10px">DHYANI IMPEX</h1>
      <p style="font-size:10px;margin-top:-12px">E-102, FIRST FLOOR, Happyness Residency, BEHIND S HRUSHTI ROW HOUSE,<br /> Surat Surat, GUJARAT, 394107</p>
    </center>

    <br />
    <?php if (isset($_GET['party_id'])) { ?>
      <div class="table-responsive">
        <?php if ($_GET['party_id'] != 'All') { ?>
          <table id="" class="table align-items-center table-flush table-borderless">
            <thead>
              <tr>
                <th>Dimond Name</th>
                <th>Barcode</th>
                <th>Created</th>
                <th>Modified</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($partyes as $partyList)
              <?php
              $allDimonds = Dimond::where('parties_id', $partyList->id)->where('status', '!=', 'Delivered')->get();
              ?>
              @foreach($allDimonds as $allDimond)
              <tr>
                <td>{{$allDimond->dimond_name}}</td>
                <td>{{$allDimond->barcode_number}}</td>
                <td>{{ \Carbon\Carbon::parse($allDimond->created_at)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($allDimond->updated_at)->format('d-m-Y') }}</td>
                <td>{{$allDimond->status}}</td>
              </tr>
              @endforeach
              @endforeach
            </tbody>
          </table>
        <?php } else { ?>
          <table id="" class="table align-items-center table-flush table-borderless">
            <thead>
              <tr>
                <th>Party Name</th>
                <th>Pending</th>
                <th>Outter</th>
                <th>Processing</th>
                <th>Completed</th>
                <th>Delivered</th>
                <th>Total Dimond</th>
              </tr>
            </thead>
            <tbody>
              @foreach($partyes as $partyList)
              <?php
              $totalDimond = Dimond::where('parties_id', $partyList->id)->count();
              $outterDimond = Dimond::where(['parties_id' => $partyList->id, 'status' => 'OutterProcessing'])->count();
              $pendingDimond = Dimond::where(['parties_id' => $partyList->id, 'status' => 'Pending'])->count();
              $processingDimond = Dimond::where('parties_id', $partyList->id)->where('status', 'Processing')->count();
              $completedDimond = Dimond::where(['parties_id' => $partyList->id, 'status' => 'Completed'])->count();
              $deliveredDimond = Dimond::where(['parties_id' => $partyList->id, 'status' => 'Delivered'])->count();
              ?>
              <tr>
                <td>{{$partyList->fname}}&nbsp;{{$partyList->lname}}</td>
                <td>{{$pendingDimond}}</td>
                <td>{{$outterDimond}}</td>
                <td>{{$processingDimond}}</td>
                <td>{{$completedDimond}}</td>
                <td>{{$deliveredDimond}}</td>
                <td>{{$totalDimond}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</body>

</html>