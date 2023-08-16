"use strict";
function myFunction() {
    // window.print();
    var printableDiv = document.getElementById("invoice");
    var printWindow = window.open('', '', 'width=1200,height=600');
    printWindow.document.write('<html><head><title>Print</title>');
    printWindow.document.write(`<link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/responsive.css')}}"> <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/vendors/bootstrap.css')}}">`);
    printWindow.document.write(`<style>
    body{
      font-family: "Myriad Pro", Arial, sans-serif;
    }
    table, td {
      border-bottom: 1px solid #D3D3D3;
      
    }
    .reservation_detail_secttion{
      margin-left:100px;
    }
    th{
      border-bottom: 1px solid black;
    }
    td{
      text-align:center;
    }
    .itemtext{
        padding:5px;
        margin-left:10px
    }
    
    table {
      
      width: 100%;
      border-collapse: collapse;
    }
    #table{
      margin-top:50px;
    }
    #legal{
        width:70%;
        margin-top:30px
    }
    #total{
        width:50%;
    }
    .logo_invoice{
      width:70%;
    }
    .invoice_footer{
      margin-top:50px;
    }
    .footer_invvoice_logo{
      margin-top:10px;
      text-align:end;
      width:50%;
    }
    </style>`);
    printWindow.document.write('<style>');
    printWindow.document.write('.invoice_footer {');
printWindow.document.write('  background-color: #BC8E36;');
printWindow.document.write('}');
printWindow.document.write('</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write(printableDiv.innerHTML);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}