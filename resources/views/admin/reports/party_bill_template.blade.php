<?php

use Carbon\Carbon;
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
      <h4>TAX INVOICE</h4>
      <h1 style="margin-top:-10px">HR DIMONDS</h1>
      <p style="font-size:10px;margin-top:-12px">OFFICE NO.A-4,FIRST FLOOR,ENTW AP PARK,KANSHARA SHERI,<br />SURAT,SURAT,GUJRAT,395003 Gujarat</p>
    </center>
    <div class="row">
      <div class="column-left">

      </div>
      <div class="column-right">
        <div class="d-flex align-items-center justify-content-center">
          <p><strong class="align-center title">GST No.:</strong> 24AIZPB0708M1Z2</p>
          <p><strong class="align-center title">PAN No.:</strong> AIZPB0708M</p>
          <p><strong class="align-center title">Phones :</strong> </p>
        </div>
        <!-- ... (rest of the left side content) ... -->
      </div>
      <div style="clear: both;"></div>
      <!-- Rest of your code ... -->
      <!-- Content for the center and table -->
    </div>
    <div class="row">
      <div class="column-left">
        <h3><u>Party Details</u></h3>
        <p><strong class="align-center title">Invoice No: # {{$party->id}}/2024</strong></p>
        <p><strong class="align-center title">Name:</strong>&nbsp;{{$party->fname}}&nbsp;&nbsp;{{isset($party->lname)?$party->lname:''}}</p>
        <p><strong class="align-center title">Address:</strong>&nbsp;{{isset($party->address)?$party->address:''}}</p>
        <p><strong class="align-center title">Phone:</strong>&nbsp;{{isset($party->mobile)?$party->mobile:''}}</p>
        <p><strong class="align-center title">GST No.:</strong>&nbsp;{{isset($party->gst_no)?$party->gst_no:''}}</p>
        <p><strong class="align-center title">Bill Date: {{ \Carbon\Carbon::parse(Carbon::now())->format('d-m-Y H:i:s') }}</strong></p>
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
          <th>Stone Id</th>
          <th>RW</th>
          <th>PW</th>
          <th>SHP</th>
          <th>CL</th>
          <th>PRT</th>
          <th>CUT</th>
          <th>PL</th>
          <th>STN</th>
          <th width="20%">Amount</th>
          <th width="10%">Created At</th>
        </tr>
      </thead>
      @php
      $sum = 0;
      @endphp
      <tbody>
        @foreach($data as $key=>$da)
        <?php
        $process = Process::where(['designation' => 'Grading', 'dimonds_id' => $da->id])->first();
        ?>
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$da->dimond_name}}</td>
          <td>{{$da->weight}}</td>
          <td>{{isset($process->return_weight) ?$process->return_weight: ''}}</td>
          <td>{{isset($process->r_shape) ?$process->r_shape: ''}}</td>
          <td>{{isset($process->r_clarity) ?$process->r_clarity: ''}}</td>
          <td>{{isset($process->r_color) ?$process->r_color: ''}}</td>
          <td>{{isset($process->r_cut) ?$process->r_cut: ''}}</td>
          <td>{{isset($process->r_polish) ?$process->r_polish: ''}}</td>
          <td>{{isset($process->r_symmetry) ?$process->r_symmetry: ''}}</td>
          <td>{{$da->amount}}</td>
          <td>{{\Carbon\Carbon::parse($da->created_at)->format('d-m-Y')}}</td>
          @php
          $sum += ($da->amount);
          @endphp
        </tr>
        @endforeach
        <tr>
          <td colspan="10">
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
        @if($getGst == 'gst')
        <tr>
          <td colspan="10">
            <b>
              <h4>SGST (1.5 %)</h4>
            </b>
          </td>
          <td>
            <b>
              <h4><?php $sgst = ($sum * 1.5) / 100;
                  echo $sgst; ?></h4>
            </b>
          </td>
        </tr>
        <tr>
          <td colspan="10">
            <b>
              <h4>CGST (1.5 %)</h4>
            </b>
          </td>
          <td>
            <b>
              <h4><?php $cgst = ($sum * 1.5) / 100;
                  echo $cgst; ?></h4>
            </b>
          </td>
        </tr>
        <tr>
          <td colspan="10">
            <b>
              <h4>Final Amount</h4>
            </b>
          </td>
          <td>
            <b>
              <h4>{{$sum+$sgst+$cgst}}</h4>
            </b>
          </td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
</body>

</html>