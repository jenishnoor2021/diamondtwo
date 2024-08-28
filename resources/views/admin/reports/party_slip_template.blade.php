<?php

use Carbon\Carbon;
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
      width: 50%;
      padding: 5px;
      /* border-right: 1px dotted #000; */
    }

    .column-right {
      float: left;
      width: 50%;
      padding: 5px;
    }

    /* Create four equal columns that floats next to each other */

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
      /* border: 1px solid #ccc; */
      border-bottom: 1px solid #000;
      border-collapse: collapse;
      margin: 0;
      padding: 0;
      width: 100%;
      table-layout: fixed;
      font-size: 9px;
    }

    table tr {
      background-color: #fff;
      /* border: 1px solid #000; */
      padding: .25em;
    }

    thead {
      border-bottom: 1px solid #000;
      border-top: 1px solid #000;
    }

    table th,
    table td {
      /* padding: .625em; */
      /* border: 1px solid #000; */
    }

    .top-b {
      border-top: 1px solid #000;
    }

    /*table end*/
    hr {
      border-top: 1px solid #000;
    }
  </style>
</head>

<body>
  <div class="container">

    <div class="row">
      <div class="column-left">
        <center>
          <h1 style="font-size:12px;">DHYANI IMPEX</h1>
          <p style="font-size:8px;margin-top:-8px">E-102, FIRST FLOOR, Happyness Residency, BEHIND S HRUSHTI ROW HOUSE,<br /> Surat Surat, GUJARAT, 394107</p>
        </center>
        <hr />
        <p style="font-size:9px;">
          <strong>Date:</strong><span> {{ \Carbon\Carbon::parse(Carbon::now())->format('d-m-Y') }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <strong>To:</strong><span> {{$party_name}}</span>
        </p>
        <hr />
        <p style="font-size:9px;">
          <strong>GSTIN:</strong><span> 24AIZPB0708M1Z2</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <strong>HSN:</strong><span> AIZPB0708M</span>
        </p>
        <div class="table-responsive">
          <table class="table align-items-center table-flush table-borderless" cellspacing="1">
            <thead>
              <tr>
                <th>D Name</th>
                <th>R W</th>
                <th>P W</th>
                <th>S</th>
                <th>C</th>
                <th>Col</th>
                <th>D Date</th>
              </tr>
            </thead>
            <tbody>
              <?php $t_w = 0;
              $t_p_w = 0; ?>
              @foreach($process as $proc)
              <tr>
                <td align="center"><?= $proc['dimond_name'] ?></td>
                <td align="center"><?= $proc['weight'] ?></td>
                <td align="center"><?= $proc['required_weight'] ?></td>
                <td align="center"><?= $proc['shape'] ?></td>
                <td align="center"><?= $proc['clarity'] ?></td>
                <td align="center"><?= $proc['color'] ?></td>
                <td align="center"><?= \Carbon\Carbon::parse($proc['delivery_date'])->format('d-m-Y') ?></td>
              </tr>
              <?php $t_w += $proc['weight'];
              $t_p_w += $proc['required_weight']; ?>
              @endforeach
              <tr class="top-b">
                <td align="center">Total</td>
                <td align="center"><?= $t_w ?></td>
                <td align="center"><?= $t_p_w ?></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
              </tr>
            </tbody>
          </table>
          <br>
          <div class="row" style="font-size:10px;">
            <div style="margin-left:70%">
              <p>-----------------------</p>
              <p><strong>Authorized sign</strong></p>
            </div>
          </div>
        </div>
      </div>
      <div class="column-right">
        <center>
          <h1 style="font-size:12px;">HR DIMONDS</h1>
          <p style="font-size:8px;margin-top:-8px">1st Floor, Rajrajeshvar Mahadev Mandir, Near Ambika Vijay Farshan,<br />Ghia Sheri,Mahidharpura, Surat, Guj., Ind.</p>
        </center>
        <hr />
        <p style="font-size:9px;">
          <strong>Date:</strong><span> {{ \Carbon\Carbon::parse(Carbon::now())->format('d-m-Y') }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <strong>To:</strong><span> {{$party_name}}</span>
        </p>
        <hr />
        <p style="font-size:9px;">
          <strong>GSTIN:</strong><span> 24AIZPB0708M1Z2</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <strong>HSN:</strong><span> AIZPB0708M</span>
        </p>
        <div class="table-responsive">
          <table class="table align-items-center table-flush table-borderless" cellspacing="1">
            <thead>
              <tr>
                <th>D Name</th>
                <th>R W</th>
                <th>P W</th>
                <th>S</th>
                <th>C</th>
                <th>Col</th>
                <th>D Date</th>
              </tr>
            </thead>
            <tbody>
              <?php $t_w = 0;
              $t_p_w = 0; ?>
              @foreach($process as $proc)
              <tr>
                <td align="center"><?= $proc['dimond_name'] ?></td>
                <td align="center"><?= $proc['weight'] ?></td>
                <td align="center"><?= $proc['required_weight'] ?></td>
                <td align="center"><?= $proc['shape'] ?></td>
                <td align="center"><?= $proc['clarity'] ?></td>
                <td align="center"><?= $proc['color'] ?></td>
                <td align="center"><?= \Carbon\Carbon::parse($proc['delivery_date'])->format('d-m-Y') ?></td>
              </tr>
              <?php $t_w += $proc['weight'];
              $t_p_w += $proc['required_weight']; ?>
              @endforeach
              <tr class="top-b">
                <td align="center">Total</td>
                <td align="center"><?= $t_w ?></td>
                <td align="center"><?= $t_p_w ?></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
              </tr>
            </tbody>
          </table>
          <br>
          <div class="row" style="font-size:10px;">
            <div style="margin-left:70%">
              <p>-----------------------</p>
              <p><strong>Authorized sign</strong></p>
            </div>
          </div>
        </div>
      </div>
      <div style="clear: both;"></div>
    </div>
  </div>
</body>

</html>