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
      <h4>Expance Report</h4>
      <h1 style="margin-top:-10px">DHYANI IMPEX</h1>
      <p style="font-size:10px;margin-top:-12px">E-102, FIRST FLOOR, Happyness Residency, BEHIND S HRUSHTI ROW HOUSE,<br /> Surat Surat, GUJARAT, 394107</p>
    </center>
    <div class="row">
      <div class="column-left">
        <div class="d-flex align-items-center justify-content-center">
          <p><strong class="align-center title">Bill Date:</strong>{{ \Carbon\Carbon::parse(Carbon::now())->format('d-m-Y H:i:s') }}</p>
        </div>
      </div>
      <div class="column-right">
      </div>
      <div style="clear: both;"></div>
      <!-- Rest of your code ... -->
      <!-- Content for the center and table -->
    </div>
    <br />
    <table>
      <thead>
        <tr>
          <th>Sr.</th>
          <th>Title</th>
          <th>Date</th>
          <th width="20%">Amount</th>
        </tr>
      </thead>
      @php
      $sum = 0;
      @endphp
      <tbody>
        @foreach($data as $key=>$item)
        <tr>
          <td>{{ $key+1 }}</td>
          <td>{{ $item->title }}</td>
          <td>{{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}</td>
          <td>{{ $item->amount }}</td>
          @php
          $sum += ($item->amount);
          @endphp
        </tr>
        @endforeach
        <tr>
          <td colspan="3">
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
  </div>
</body>

</html>