<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Slip</title>
  <style>
    p {
      font-size: 8px;
      font-family: Arial, Helvetica, sans-serif;
      margin-left: 27px;
    }

    .barcode-container {
      margin-left: 30px;
      margin-top: -10px;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }

    .barcode {
      width: 40px;
      height: 25px;
    }

    svg {
      width: 150px !important;
      height: 100px !important;
      margin-top: -30px;
      /* margin-bottom: -20px; */
    }

    @media print {
      .no-print {
        display: none;
      }
    }
  </style>
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>

  <script>
    const diamondData = [
      @foreach($data as $diamond) {
        name: '{{ $diamond->dimond_name }}',
        weight: '{{ $diamond->weight }}',
        barcode_number: '{{ $diamond->barcode_number }}'
      },
      @endforeach
    ];

    window.onload = function() {
      diamondData.forEach((diamond, index) => {
        generateBarcode(diamond.barcode_number, index);
      });
    };

    function generateBarcode(value, index) {
      const barcodeDiv = document.createElement('div');
      barcodeDiv.className = 'barcode-container';

      const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
      svg.className = 'barcode';
      svg.id = `barcode${index}`;

      const info = document.createElement('p');
      info.innerHTML = `<b>SID: ${diamondData[index].name}&nbsp;|&nbsp;RW: ${diamondData[index].weight}</b>`;

      const label = document.createElement('p');
      label.style.fontSize = '8px';
      label.style.marginTop = '-20px';
      label.style.marginLeft = '50px';
      label.innerText = 'DI Diamond';

      barcodeDiv.appendChild(info);
      barcodeDiv.appendChild(svg);
      barcodeDiv.appendChild(label);
      document.body.appendChild(barcodeDiv);

      JsBarcode(svg, value, {
        format: "CODE128",
        displayValue: true,
        height: 100,
        width: 4,
        fontOptions: "bold",
        fontSize: 25,
      });
    }
  </script>

  <button class="no-print" onclick="window.print()">Print</button>
</body>

</html>