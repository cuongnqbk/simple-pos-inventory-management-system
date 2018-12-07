<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Anwarul Islam & Sons</title>
        <style>
            body{
                font-size:15px;
                font-family: "Calibri Light";
            }
            .wrapper{
                margin:0px auto;
                width:80mm;
                font-family: "Calibri Light";
                border:1px solid #DDD;
            }
            hr{
                margin-bottom:0px;
            }
            .printed-area{
                width: 74mm;
                margin:0mm 2mm;
            }
            .print-header{
                text-align: center;
            }
            .print-header h1{
                font-weight: 600;
                margin-bottom: -30px;
            }
            .print-header p{
                font-weight: 100;
                font-size:12px;
            }
            table{
                width:100%;
                text-align: left;
                font-size: 14px;
                border-collapse: collapse;
            }
                            }
            table thead th{
                border-bottom:1px solid #333;
            }
            table.cart-table td{
                ~border-bottom:1px solid #333;
            }
            table.cart-table tbody tr:nth-child(odd){
                ~background-color: #EEE; 
            }
            tfoot{
                text-align: right;
                font-weight:100;
            }
            button:hover{
                cursor: pointer;                
            }
            .btns{
                margin:0px auto;
                width:90mm;
                margin-top: 25px;
                text-align: center;
            }
            .btn-print{
                background-color: orange;
                color: #FFF; 
                font-size: 16px;
                padding: 10px 15px;
                border-radius: 4px;
                border: 1px solid orange;
                text-decoration: none;
            }
            .btn-danger{
                background-color: #CD3131;
                color: #FFF; 
                font-size: 16px;
                padding: 10px 15px;
                border-radius: 4px;
                border: 1px solid #CD3131;
                text-decoration: none;
            }
            @media print{
                body{
                    font-size:15px;
                }
                .no_print{
                    display: none;
                }
                .wrapper{                   
                    ~font-family: 'Roboto Slab', serif;
                    border:0px solid #DDD;
                }
                hr{
                    margin-bottom:0px;
                }
                .printed-area{
                    font-family: "Calibri Light";
                    width: 74mm;
                    margin:0mm 2mm 0mm 0mm;
                }
                table thead th{
                    border-bottom:1px solid #333;
                }
                table.cart-table td{
                    border-bottom:1px solid #333;
                }
            }
        </style>
    </head>

    <body>
        <div class="wrapper">
            <div class="printed-area">
                <div class="print-header">
                    <h1 style="font-size: 20px;">{{ ucwords(\App\Shop::where('id', $sale->shop_id)->first()->name) }}</h1>
                    <p style="font-weight: 700;font-size: 14px;">
                        <br>
                        Mohajonpotty, Sylhet <br>
                        Mobile: 01713-531693
                    </p>
                </div>
                <div class="print-body">
                    <table class="sale-info">
                        <tbody>
                            <tr>
                                <td style="padding:8px 0px;"><b>Invoice No.:</b> {{ $sale->id }}</td>
                                <td style="text-align: right;"><b>Date: </b>{{ $sale->created_at->format('d-m-y, h:i a') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th style="width:45%;">Product Name</th>
                                <th style="width:10%;text-align: right;">Rate</th>
                                <th style="width:15%;text-align: right;">Qty</th>
                                <th style="width:25%;text-align: right;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($saleDetails as $saleDetail)
                            <tr>
                                <td style="width:45%;"> {{ \App\Product::where('id', $saleDetail->product_id)->first()->productName }} </td>
                                <td style="width:10%;text-align: right;"> {{ $saleDetail->price }} </td>
                                <td style="width:15%;text-align: right;"> {{ $saleDetail->quantity }} </td>
                                <td style="width:25%;text-align: right;">{{ $saleDetail->subTotal }}</td>
                            </tr>   
                            @endforeach                    
                        </tbody>
                    </table>
                    <table style="text-align: right;margin-top: 5px;">
                        <tbody>
                            <tr>
                                <th colspan="2" style="width:40%"></th>
                                <th style="width:35%">Total Items</th>
                                <td style="width:25%">{{ $uniqueItem }}</td>
                            </tr>
                            <tr>
                                <th colspan="2"></th>
                                <th>Sub Total</th>
                                <td>{{ $sale->subTotal }}</td>
                            </tr>
                            <tr>
                                <th colspan="2"></th>
                                <th>Additional Cost</th>
                                <td>{{ $sale->additionalCost }}</td>
                            </tr>
                            <tr>
                                <th colspan="2"></th>
                                <th>Discount</th>
                                <td>{{ $sale->discount }}</td>
                            </tr>
                            <tr>
                                <th colspan="2"></th>
                                <th>Grand Total</th>
                                <td>{{ $sale->totalBill }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <div class="print-footer" style="padding-bottom:10px;">
                        <p style="text-align:center;padding-bottom:5px;border-bottom: 1px solid #000;">
                            Exchange must be made within 3 days from this purchase. An item may be exchanged only once. <br>Please Bring Invoice in such case. 
                        </p>
                        <p style="text-align:center;padding-bottom:5px;border-bottom: 1px solid #000;margin-top: -12px;">
                            <b>☺ Thank you for your Shopping ☺</b>
                        </p>
                        <p style="text-align:center;margin-top: -5px;">Developed By - StarLab IT. (01671-614060) <br>
                        www.starlabit.com.bd
                        </p>
                    </div> 
                </div>             
            </div>
        </div>
        <div class="btns no_print">
            <button type="button" class="btn-print printFocus" onclick="window.print();"> Print</button>
            <a type="button" href="{{ route('addInvoice') }}" class="btn-danger backButton" id="backButton"> Back</a>
        </div>


        
        <script src="{{ asset('vali/js/jquery-3.3.1.min.js') }}" crossorigin="anonymous"></script>
        <script type="text/javascript">       
            $(function(){
                window.onload = function (){
                    window.print(); 
                    document.getElementById('backButton').click();
                }
            });    
        </script>
    </body>

</html>