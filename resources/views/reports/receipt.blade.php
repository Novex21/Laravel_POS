{{-- Printing --}}
<div id="invoice-POS">

    <div class="printed_content">
        <center class="top">
            <div class="logo">Laravel POS</div>
            <h1>Laravel POS</h1>
        </center>
    </div>
    <div class="mid">
        <div class="info">
            <h3>Contact US</h3>
            <small>Address: 123 /Main Street/Anytown, USA 12345
            Email: randomuser@example.com
            Phone: +1 (555) 555-5555</small>
        </div>
    </div>
    <div class="bottom">
        <div id="table">
            <table>
                <tr class="table-title">
                    <td class="item"><h2>Item</h2></td>
                    <td class="Hours"><h2>QTY</h2></td>
                    <td class="Rate"><h2>Unit</h2></td>
                    <td class="Rate"><h2>Discount</h2></td>
                    <td class="Rate"><h2>Sub Total</h2></td>
                </tr>
                @foreach ($order_receipt as $receipt )
                <tr class="service">
                    <td class="tableitem"><p class="item-text">{{$receipt->product->name}}</p> </td>
                    <td class="tableitem"><p class="item-text">{{$receipt->quantity}}</p></td>
                    <td class="tableitem"><p class="item-text">{{number_format($receipt->unitprice,2)}}</p></td>
                    <td class="tableitem"><p class="item-text">{{$receipt->discount ? $receipt->discount : 0}}</p></td>
                    <td class="tableitem"><p class="item-text"> {{number_format($receipt->amount,2)}}</p></td>
                </tr>
                @endforeach

                <tr class="tabel-title">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="Rate"><p class="item-text">Tax</p></td>
                    <td class="Payment"><p class="item-text">{{number_format($order_receipt->sum('amount'),2)}}</p></td>
                </tr>
                <tr class="tabel-title">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="Rate">Total</td>
                    <td class="Payment">
                        {{number_format($order_receipt->sum('amount'),2) }}
                    </td>
                </tr>
            </table>
            <div class="legalcopy">
                <p class="legal">
                    <strong>** Thank You For Your Purchase **</strong>
                    <br>
                    The goods which are subject to TAX, prices includes taxs.
                </p>
                <div class="serial-number">
                    <span class="serial">000142200045</span>
                    <span>24/11/2012 &nbsp; &nbsp; 00:45</span>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    @media print{
        #invoice-POS {
            box-shadow: 0 0 1in -0.25in rgb(0, 0, 0);
            padding: 2mm;
            margin: 0 auto;
            width: 58mm;
            background-color: #ffffff;
        }
        #invoice-POS::selection {
            background-color: #34495e;
            color: #ffffff;
        }
        #invoice-POS::-moz-selection {
            background-color: #34495e;
            color: #ffffff;
        }
        #invoice-POS h1 {
            font-size: 1.5em;
            color: #222;
        }
        #invoice-POS h2 {
            font-size: 0.5em;
            color: #222;
        }
        #invoice-POS h3 {
            font-size: 1em;
            font-weight: 300;
            line-height: 1.5em;
        }
        #invoice-POS p {
            font-size: 0.8em;
            font-weight: 300;
            line-height: 1.2em;
            color: #666;
        }
        #invoice-POS .top, .mid, .bottom {
            border-bottom: 1px solid #eee;

        }
        #invoice-POS .top {
            min-height: 100px;
        }
        #invoice-POS .mid {
            min-height: 80px;
        }
        #invoice-POS .bottom {
            min-height: 50px;
        }
        #invoice-POS .top .logo {
            height: 60px;
            width: 60px;
            background-image: url();
            background-repeat: no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
            margin: 0 auto;
        }
        #invoice-POS .top, .info {
        display: block;
        margin-left: 0;
        text-align: center;
        }
        #invoice-POS .info {
            font-size: 0.8em;
        }
        .info>p {
            margin-bottom: 0;
            padding: 0;
        }
        #invoice-POS .title {
            float: right;
        }
        #invoice-POS .title p {
            text-align: right;
        }
        #invoice-POS table {
            width: 100%;
            border-collapse: collapse;
        }
        #invoice-POS .table-title {
            font-size: 1rem;
            background: #eee;
        }
        #invoice-POS .service {
            border: 1px solid #eee;
        }
        #invoice-POS .item {
            width: 24mm;
        }
        #invoice-POS .Rate, #invoice-POS .Payment {
            font-size: 1rem;
            font-weight: bold;
        }
        #invoice-POS .item-text {
            font-size: 0.5em;
        }
        #invoice-POS .legalcopy {
            margin-top: 5mm;
            text-align: center;
        }
        .serial-number {
            margin-top: 5mm;
            margin-bottom: 2mm;
            text-align: center;
            font-size: 11px;
        }
        .serial {
            font-size: 10px !important;
        }
    }


</style>
