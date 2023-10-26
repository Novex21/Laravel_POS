@extends('layouts.app')

@section('content')


{{-- Printing --}}
    <div id="invoice-POS">

        <div class="top mt-5">
            <center>
                <div class="logo">
                   <img src="{{ asset('images/logo.png') }}" alt="Shop Logo" width="70" height="50">
                </div>
                <h1>Laravel POS</h1>
            </center>
        </div>
        <div class="mid">
            <div class="info text-center">
                <h4>Contact US</h4>
                <small>Address: 123 /Main Street/Anytown, USA 12345
                Email: randomuser@example.com
                Phone: +1 (555) 555-5555</small>
            </div>
        </div>
        <div class="bottom">
            <div class="row">
                <div class="col">
                    <table class="table table-borderless w-50 mx-auto text-center">
                        <tr class="table-title">
                            <td class="item"><h4>Item</h4></td>
                            <td class="Hours"><h4>QTY</h4></td>
                            <td class="Rate"><h4>Unit</h4></td>
                            <td class="Rate"><h4>Discount</h4></td>
                            <td class="Rate"><h4>SubTotal</h4></td>
                        </tr>
                        @foreach ($order_receipt as $receipt )
                        <tr class="table-item">
                            <td><p class="item-text">{{$receipt->product->name}}</p> </td>
                            <td><p class="item-text">{{$receipt->quantity}}</p></td>
                            <td><p class="item-text">{{number_format($receipt->unitprice,2)}}</p></td>
                            <td><p class="item-text">{{$receipt->discount ? $receipt->discount : 0}} %</p></td>
                            <td><p class="item-text">$ {{number_format($receipt->amount,2)}}</p></td>
                        </tr>
                        @endforeach



                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="Rate">Total</td>
                            <td class="Payment">
                                $ {{number_format($order_receipt->sum('amount'),2) }}
                            </td>
                        </tr>
                        <tr class="tabel-title">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="Rate">Received</td>
                            <td class="Payment">
                                $ {{number_format($payment[0]->paid_amount,2)}}
                            </td>
                        </tr>
                        <tr class="tabel-title">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="Rate">Change</td>
                            <td class="Payment">
                                $ {{number_format($payment[0]->balance,2) }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="legalcopy text-center mb-5">
                <p class="legal">
                    <strong>*** Thank You For Your Purchase ***</strong>
                    <br>
                    The goods which are subject to TAX, prices includes taxes.
                </p>
                <div class="serial-number">
                    <span class="serial me-3">S/N {{ random_int(1,1000000) }}</span>
                    <span>{{ $payment[0]->transac_date}} &nbsp; &nbsp; {{ substr($payment[0]->created_at,11,8) }}</span>
                </div>
            </div>
        </div>
    </div>
    <div id="button-print">
        <div class="d-flex justify-content-center">
            <button type="button"
                id="printButton"
                class="btn btn-lg btn-success me-2 mb-4">
                <i class="fa-solid fa-lg fa-print me-2"></i>
                Print the order

            </button>
            <a href="{{ route('orders.index') }}" class="btn btn-lg btn-secondary me-1 mb-4 text-light">Cancel Printing</a>
        </div>
    </div>


@endsection

<style>
    @media print {

        #navbar, footer, #button-print  {
           display:none;
        }
        #invoice-POS {
            width: 90mm;
            margin: 0 auto;
            padding: 0;
            font-family: sans-serif;
        }

        #invoice-POS .row {
            width: 80mm;

            padding: 0;
        }


        #invoice-POS .table-title h4 , #invoice-POS .Rate{
            font-size: small;
            text-align: left;
        }
        #invoice-POS .table-item, #invoice-POS .Payment {
            font-size: 12px;
        }
        #invoice-POS .serial-number {
            font-style: italic;
        }
    }




</style>
@section('script')
    <script>


        //Print Section
        document.getElementById("printButton").addEventListener("click", function () {
            print();
        });


    </script>
@endsection
