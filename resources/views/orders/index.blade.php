@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <livewire:order/>
    </div>

    {{-- <div class="modal"> --}}
        <div id="print">
         @include('reports.receipt')
        </div>
    {{-- </div> --}}


    <style>
        .modal.right.custom .modal-dialog.custom {
            top: 0;
            right: 0;
            margin-right: 1vh;
            /* position: absolute; */
        }
        #print {
            display: none;
        }
    </style>

@endsection

@section('script')
    <script>


        //Print Section
        function PrintReceiptContent(print) {
            let data = '<input type="button" id="printPageButton" ' +
                       'class="printPageButton" ' +
                       'style="display: block; width: 100%; border: none; background-color: #008B8B; color: #fff; padding: 14px 28px; font-size: 16px; cursor: pointer; text-align: center;" ' +
                       'value="Print Receipt" ' +
                       'onClick="window.print();">';


            let content = document.getElementById(print).innerHTML;

            data += content;

            const myReceipt = window.open("", "myWin", "left=150, top=130, width=900, height=500");
            myReceipt.screenX = 0;
            myReceipt.screenY = 0;
            myReceipt.document.write(data);
            myReceipt.document.title = "";
            myReceipt.focus();

            setTimeout(() => {

                myReceipt.close();
            }, 20000); // You can adjust the delay as needed
        }


    </script>
@endsection
