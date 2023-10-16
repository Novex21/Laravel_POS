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
        $('document').ready(function() {
            // Initialize row number
            let rowNum = 1;

            // Add Row
            function addNewRow() {
                // Increment row number
                rowNum++;

                // Create a new row with the incremented number
                let newRow = '<tr>' +
                    '<td class="row-number text-center align-middle">' + rowNum + '</td>' +
                    '<td>' +
                    '<select name="product_id[]" id="product_id" class="form-select product_id">' +
                        '<option value="">Select Item</option>' +
                        '@foreach ($products as $product)' +
                            '<option data-price="{{$product->price}}" value="{{ $product->id}}">{{$product->name}}</option>' +
                        '@endforeach' +
                    '</select>' +
                    '</td>' +
                    '<td>' +
                        '<input type="number" name="quantity[]" id="quantity" class="form-control quantity">' +
                    '</td>' +
                    '<td>' +
                        '<input type="number" name="price[]" id="price" class="form-control price" readonly>' +
                    '</td>' +
                    '<td>' +
                        '<input type="number" name="discount[]" id="discount" class="form-control discount">' +
                    '</td>' +
                    '<td>' +
                        '<input type="number" name="total_amount[]" id="total_amount" class="form-control total_amount" readonly>' +
                    '</td>' +
                    '<td class="text-center align-middle">' +
                        '<a href="" class="btn btn-sm btn-danger delete"><i class="fa-solid fa-lg fa-xmark"></i></a>' +
                    '</td>' +
                '</tr>';

                // Append the new row to the table
                $(".addMoreProduct").append(newRow);
            }

            $(".add_more").click(function(e) {
                e.preventDefault();
                addNewRow();
                updateRowNumbers();
            });

            // Delete Row
            $(".addMoreProduct").on("click", ".delete", function(e) {
                e.preventDefault();

                // Check if there is more than one row before deleting
                if ($(".addMoreProduct tr").length > 1) {
                    $(this).closest("tr").remove();

                    // Update row numbers
                    updateRowNumbers();
                    totalAmount();
                } else {
                    alert("Cannot delete the last row.");
                }
            });

            // Function to update row numbers
            function updateRowNumbers() {
                $(".row-number").each(function(index) {
                    $(this).text(index + 1);
                });
            }


            //////////////////////////////////////////////////

            //Function to show Total amount
            function totalAmount() {
                let total = 0;
                $('.total_amount').each(function(i, e) {
                    let amount = parseFloat($(this).val());
                    total += amount;
                })
                $('.total').html(total);
            }

            //to show the price and total amount
            $('.addMoreProduct').on( 'change', '.product_id', function() {
                // Find the closest row (tr element)
                let tr = $(this).closest('tr');

                // Get the selected option's data-price attribute value
                let price = parseFloat(tr.find('option:selected').data('price'));

                // Set the price field in the same row
                tr.find('.price').val(price);

                // Get the quantity, discount, and price values
                let qty = parseFloat(tr.find('.quantity').val()) || 0;
                let disc = parseFloat(tr.find('.discount').val()) || 0;
                let priceVal = parseFloat(tr.find('.price').val()) || 0;

                // Calculate the total amount
                let total_amount = (qty * priceVal * (1 - disc / 100));

                // Set the total_amount field in the same row
                tr.find('.total_amount').val(total_amount.toFixed(2));
                totalAmount();
            })

            //event handling about total  amount
            $('.addMoreProduct').on('input', '.quantity', function() {
                updateTotalAmount($(this));
            });

            $('.addMoreProduct').on('input', '.discount', function() {
                updateTotalAmount($(this));
            });

            function updateTotalAmount(inputField) {
                // Find the closest row (tr element)
                let tr = inputField.closest('tr');

                // Get the quantity, discount, and price values
                let qty = parseFloat(tr.find('.quantity').val()) || 0;
                let disc = parseFloat(tr.find('.discount').val()) || 0;
                let priceVal = parseFloat(tr.find('.price').val()) || 0;


                // Calculate the total amount
                let total_amount = (qty * priceVal * (1 - disc / 100));

                // Set the total_amount field in the same row
                tr.find('.total_amount').val(total_amount.toFixed(2));
                totalAmount();
            }

            $('#paid_amount').keyup(function() {
                let total = $('.total').html();
                let paid_amount = $(this).val();
                let diff = paid_amount - total;
                $('#balance').val(diff.toFixed(2));
            })

        });

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
