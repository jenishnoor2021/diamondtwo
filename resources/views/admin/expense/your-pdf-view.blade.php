<?php

use Carbon\Carbon;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDF Slip</title>
  <style>
    * {
      box-sizing: border-box;
    }

    /* general styling */
    body {
      font-family: "Open Sans", sans-serif;
    }

    /* Create four equal columns that floats next to each other */
    .column {
      float: left;
      width: 100%;
      padding: 10px;
      border-right: 1px dotted #000;
      height: 50%;
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
    <div class="row">
      <div class="column">
        <div class="d-flex align-items-center justify-content-center">
          <h1 class="align-center title">HR Dimond</h1>
        </div>
        <br />
        <div class="d-flex justify-content-center">
          <strong class="align-center title">Slip</strong>&nbsp;
        </div>
        <br />
        <div class="d-flex justify-content-between">
          <div class="d-flex flex-col">
            <span>Bill Date:</span>
            <span>{{ \Carbon\Carbon::parse(Carbon::now())->format('d-m-Y H:i:s') }}</span>
          </div>
          <br />
        </div>
        <br />
        <table>
          <thead>
            <tr>
              <th width="50%">Party</th>
              <th width="50%">Dimond Detail</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <p>Party Name: {{ $data->parties->party_code }}</p>
                <p>Dimond Name: {{ $data->dimond_name }}</p>
                <p>Barcode:</p>
                <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
                <script>
                  window.onload = function() {
                    generateBarcode('{{$data->barcode_number}}');
                  };
                </script>
                <svg id="barcode"></svg>
              </td>
              <td>
                <p>Row Weight: {{ $data->weight }}</p>
                <p>Polished Weight: {{ $data->required_weight }}</p>
                <p>Shap: {{ $data->shape }}</p>
                <p>clarity: {{ $data->clarity }}</p>
                <p>color: {{ $data->color }}</p>
                <p>cut: {{ $data->cut }}</p>
                <p>polish: {{ $data->polish }}</p>
                <p>symmetry: {{ $data->symmetry }}</p>
              </td>
            </tr>
          </tbody>
        </table>
        <div>
          <div style="padding-top:70px;"></div>
          <p>Author Sigh</p>
        </div>
      </div>
    </div>
  </div>
  <script>
    function generateBarcode(value) {
      JsBarcode("#barcode", value, {
        format: "CODE128",
        displayValue: true,
        height: 100,
        width: 4,
        fontOptions: "bold",
        fontSize: 40,
      });
    }
  </script>
</body>

</html>