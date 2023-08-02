"use strict";
function myFunction() {
    // window.print();
    var printableDiv = document.getElementById("invoice");
    var printWindow = window.open('', '', 'width=1200,height=600');
    printWindow.document.write('<html><head><title>Print</title>');
    printWindow.document.write(`<link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/responsive.css')}}">`);
    printWindow.document.write('</head><body>');
    printWindow.document.write(printableDiv.innerHTML);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}