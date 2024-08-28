<?php

use Carbon\Carbon;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
    }

    .ticket {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      max-width: 800px;
      margin: 20px auto;
      padding: 10px;
    }

    .header {
      margin-bottom: 20px;
      width: 100%;
    }

    .booking-info h1 {
      font-size: 18px;
      margin: 0 0 10px;
    }

    .booking-info p {
      margin: 5px 0;
      color: #555;
      font-size: 13px;
    }

    .barcode-section {
      border: 1px solid #ddd;
      border-radius: 10px;
    }

    .barcode-section p {
      font-size: 16px;
      color: #333;
    }

    .booking-details h2 {
      font-size: 20px;
      color: #1a1a1a;
      margin-top: 20px;
      border-bottom: 2px solid #ccc;
      padding-bottom: 5px;
    }

    .booking-details h3 {
      font-size: 18px;
      color: #1a1a1a;
      margin-top: 10px;
    }

    .booking-details p {
      margin: 5px 0;
      color: #555;
    }

    .flight-info {
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 10px;
      margin-bottom: 20px;
    }

    .flight-segment {
      width: 100%;
      border-bottom: 1px solid #ddd;
      padding-bottom: 10px;
      margin-bottom: 10px;
    }

    .flight-segment img {
      width: 60px;
      margin-right: 10px;
    }

    .flight-times {
      width: 100%;
      text-align: center;
    }

    .flight-times p {
      margin: 0;
    }

    .duration {
      text-align: center;
      font-size: 18px;
      color: #333;
      margin: 10px 0;
    }

    .pnr {
      text-align: center;
      background-color: #e0f7fa;
      border-radius: 10px;
      padding: 10px;
      font-size: 16px;
      color: #00796b;
      margin-top: 20px;
    }

    .prohibited-items {
      border-top: 2px solid #ccc;
      padding-top: 20px;
      margin-top: 20px;
    }

    .prohibited-items h2 {
      font-size: 20px;
      color: #1a1a1a;
      margin-bottom: 20px;
    }

    .items {
      display: table;
      width: 100%;
    }

    .item {
      display: table-cell;
      text-align: center;
    }

    .item img {
      width: 100%;
      margin-bottom: 5px;
    }

    .important-info {
      border-top: 2px solid #ccc;
      padding-top: 20px;
      margin-top: 20px;
    }

    .important-info h2 {
      font-size: 20px;
      color: #1a1a1a;
      margin-bottom: 10px;
    }

    .important-info ul {
      padding: 0;
      list-style: none;
    }

    .important-info li {
      margin-bottom: 10px;
      color: #555;
    }

    .important-info a {
      color: #00796b;
      text-decoration: none;
    }

    .important-info a:hover {
      text-decoration: underline;
    }

    table {
      width: 100%;
      padding: 10px 0px;
    }

    .std1 th {
      border-left: 8px solid #00BFA5;
      background-color: #f5f5f5;
      font-weight: bold;
      padding: 10px;
      text-align: left;
    }
  </style>
</head>

<body>
  <?php //dd($invoice);
  ?>
  <?php //dd($invoicedetail);
  ?>
  <?php //dd($partydetail);
  ?>
  <?php //dd($companydetail);
  ?>
  <div class="ticket">
    <table class="header">
      <tr>
        <td width="50%">
          <div class="booking-info">
            <h1>{{$companydetail->name}}</h1>
            <p>GSTIN: {{$companydetail->gst_no}}</p>
            <p>PAN: {{$companydetail->pan_no}}</p>
            <p>{{$companydetail->address}}</p>
            <p>Mobile: {{$companydetail->contact}}</p>
            <p>Email: {{$companydetail->email}}</p>
          </div>
        </td>
        <td style="text-align:right" width="50%">
          <div class="booking-info">
            <p>{{ $invoice->invoice_no }} </p>
            <p>{{$invoice->invoice_date}}</p>
            <p>{{$invoice->place_to_supply}}</p>
            <p>{{$invoice->due_date}}</p>
          </div>
        </td>
      </tr>
    </table>

    <table class="header">
      <tr>
        <td width="50%">
          <div class="booking-info">
            <p>Customer Details:</p>
            <h1>{{$partydetail->fname}}&nbsp;{{$partydetail->lname}}</h1>
            <p>GSTIN: {{$partydetail->gst_no}}</p>
            <p>Billing Address:</p>
            <p>{{$partydetail->address}}</p>
          </div>
        </td>
        <td style="text-align:right" width="50%">
          <div class="booking-info">
            <p>Shipping Address:</p>
            <p>{{$partydetail->address}} </p>
          </div>
        </td>
      </tr>
    </table>

    <div class="booking-details">
      <table width="100%" cellpadding="5" cellspacing="0">
        <tr>
          <th>#</th>
          <th>Item</th>
          <th>HSN/ SAC</th>
          <th>Tax</th>
          <th>Qty</th>
          <th>Rate / Item</th>
          <th>Per</th>
          <th>Amount</th>
        </tr>
        <?php $i = 1;
        $total = 0;
        foreach ($invoicedetail as $invoicede) { ?>
          @php
          $formattedDateTime = Carbon::parse($invoicede->check_in)->format('d-m-Y g:i A');
          $formattedDateTimeout = Carbon::parse($invoicede->check_out)->format('d-m-Y g:i A');
          @endphp
          <tr>
            <td><?= $i ?></td>
            <td><?= $invoicede->item ?></td>
            <td><?= $invoicede->hsn_no ?></td>
            <td><?= $invoicede->tax ?></td>
            <td><?= $invoicede->quntity ?></td>
            <td><?= $invoicede->rate ?></td>
            <td><?= $invoicede->per ?></td>
            <td><?= $invoicede->total_amount ?></td>
          </tr>
        <?php
          $i++;
          $total += $invoicede->total_amount;
        } ?>
        <tr>
          <td colspan="8"></td>
        </tr>
        <tr>
          <td align="right" colspan="7">Total</td>
          <td align="right"><?= $total ?></td>
        </tr>
        <tr>
          <td align="right" colspan="7">CGST {{$companydetail->cgst}} %</td>
          <?php $cgst = $total * ($companydetail->cgst / 100) ?>
          <td align="right"><?= $cgst ?></td>
        </tr>
        <tr>
          <td align="right" colspan="7">SGST {{$companydetail->sgst}} %</td>
          <?php $sgst = $total * ($companydetail->sgst / 100) ?>
          <td align="right"><?= $sgst ?></td>
        </tr>
        <tr>
          <td align="right" colspan="7">Round Off</td>
          <?php
          $ground_total = $total + $cgst + $sgst;
          $rounded_total = round($ground_total);
          $round_difference = $rounded_total - $ground_total;
          ?>
          <td align="right"> <?= number_format($round_difference, 2); ?></td>
        </tr>
        <tr>
          <td align="right" colspan="7">Ground Total</td>
          <td align="right"><?= $rounded_total ?></td>
        </tr>
      </table>
    </div>

    <?php
    $bank_info = json_decode($companydetail['bank_info'], true);
    ?>

    <p><?= $bank_info['bank_name']; ?></p>
    <p><?= $bank_info['account_no']; ?></p>
    <p><?= $bank_info['ifsc_code']; ?></p>
    <p><?= $bank_info['branch']; ?></p>

  </div>
</body>

</html>