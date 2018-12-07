@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> Return</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Sale</li>
        <li class="breadcrumb-item">Return</li>
    </ul>
</div>
<section class="m-t-80 m-b-25">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header bg-dark">
                    <h2 class="text-white">Return</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('return.addReturn') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>Product Barcode</label>
                                <input name="productBarcodeReturn" id="productBarcodeReturn" class="form-control{{ $errors->has('productBarcodeReturn') ? ' is-invalid' : '' }}" autofocus>
                                @if ($errors->has('productBarcodeReturn'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('productBarcodeReturn') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Rate</label>
                                <input type="text" class="form-control{{ $errors->has('salePriceReturn') ? ' is-invalid' : '' }}" name="salePriceReturn" id="salePriceReturn" readonly>
                                @if ($errors->has('salePriceReturn'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('salePriceReturn') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Quantity</label>
                                <input type="text" class="form-control{{ $errors->has('quantityReturn') ? ' is-invalid' : '' }}" name="quantityReturn" id="quantityReturn" value="1">
                                <div style="" id="quantity_errors" class="invalid-feedback"></div>
                                @if ($errors->has('quantityReturn'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('quantityReturn') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Special Rate</label>
                                <input type="text" class="form-control{{ $errors->has('special_price_return') ? ' is-invalid' : '' }}" name="special_price_return" id="special_price_return" value="">
                                @if ($errors->has('special_price_return'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('special_price_return') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col text-right">
                                <a class="btn btn-danger" type="submit" href="{{ route('destroyReturn') }}">Destroy Cart</a>
                                <button class="btn btn-primary" type="submit" id="returnSubmit">Add to Cart</button>
                            </div>
                        </div>
                    </form>

                    <div class="row m-t-25">
                        <div class="col-md-12">
                            <table class="table table-striped table-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Product</th>
                                        <th>Qunatity</th>
                                        <th>Rate</th>
                                        <th>Subtotal</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody id="returnTable">
                                    @if(Cart::instance('returnProduct')->count() > 0)
                                    @foreach(Cart::instance('returnProduct')->content() as $cart)
                                        <tr id="tableRow{{$cart->id}}">
                                            <td id="name{{ $cart->id }}">{{ $cart->name }}</td>
                                            <td style="width:20%;" id="quantity{{ $cart->id }}">
                                                <div class="input-group">
                                                    <input class="form-control form-control-sm" type="number" value="{{ $cart->qty }}" id="qty{{ $cart->id }}" style="width:50px;" onchange="chageReturnProductQty('{{ $cart->id }}','{{ $cart->qty }}','{{ $cart->rowId }}','{{ $cart->options['total_quantity'] }}')" name="qty{{ $cart->id }}">
                                                </div>
                                                <div id="qtyError{{ $cart->id }}" class="invalid-feedback"></div>
                                            </td>
                                            <td id="price{{ $cart->id }}">{{ $cart->price }}</td>
                                            <td id="subTotal{{ $cart->id }}">{{ $cart->total }}</td>
                                            <td id="removeRow{{ $cart->id }}">
                                                <a onclick="delete_returnProduct_row('{{$cart->rowId}}','{{$cart->id}}','{{$cart->price}}')" class="btn btn-sm btn-default"><i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                    <tr class="text-center" id="noItemRow">
                                        <td colspan="5"><span class="text-danger" style="font-size:18px; padding: 10px 0px;">No Item in the cart. Add Some Item</span></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="m-t-80 m-b-25">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header bg-dark">
                    <h2 class="text-white">Sale</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('return.addSale') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>Product Barcode</label>
                                <input name="productBarcodeSale" id="productBarcodeSale" class="form-control{{ $errors->has('productBarcodeSale') ? ' is-invalid' : '' }}" autofocus>
                                @if ($errors->has('productBarcodeSale'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('productBarcodeSale') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Rate</label>
                                <input type="text" class="form-control{{ $errors->has('salePriceSale') ? ' is-invalid' : '' }}" name="salePriceSale" id="salePriceSale" readonly>
                                @if ($errors->has('salePriceSale'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('salePriceSale') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Quantity</label>
                                <input type="text" class="form-control{{ $errors->has('quantitySale') ? ' is-invalid' : '' }}" name="quantitySale" id="quantitySale" value="1">
                                <div style="" id="quantity_errors" class="invalid-feedback"></div>
                                @if ($errors->has('quantitySale'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('quantitySale') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Special Rate</label>
                                <input type="text" class="form-control{{ $errors->has('special_price_sale') ? ' is-invalid' : '' }}" name="special_price_sale" id="special_price_sale" value="">
                                @if ($errors->has('special_price_sale'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('special_price_sale') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col text-right">
                                <a class="btn btn-danger" type="submit" href="{{ route('destroySale') }}">Destroy Cart</a>
                                <button class="btn btn-primary" type="submit" id="saleSubmit">Add to Cart</button>
                            </div>
                        </div>
                    </form>

                    <div class="row m-t-25">
                        <div class="col-md-12">
                            <table class="table table-striped table-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Product</th>
                                        <th>Qunatity</th>
                                        <th>Rate</th>
                                        <th>Subtotal</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody id="saleTable">
                                    @if(Cart::instance('sale')->count() > 0)
                                    @foreach(Cart::instance('sale')->content() as $cart)
                                        <tr id="tableRow{{$cart->id}}">
                                            <td id="name{{ $cart->id }}">{{ $cart->name }}</td>
                                            <td style="width:20%;" id="quantity{{ $cart->id }}">
                                                <div class="input-group">
                                                    <input class="form-control form-control-sm" type="number" value="{{ $cart->qty }}" id="qty{{ $cart->id }}" style="width:50px;" onchange="chageSaleQty('{{ $cart->id }}','{{ $cart->qty }}','{{ $cart->rowId }}','{{ $cart->options['total_quantity'] }}')" name="qty{{ $cart->id }}">
                                                </div>
                                                <div id="qtyError{{ $cart->id }}" class="invalid-feedback"></div>
                                            </td>
                                            <td id="price{{ $cart->id }}">{{ $cart->price }}</td>
                                            <td id="subTotal{{ $cart->id }}">{{ $cart->total }}</td>
                                            <td id="removeRow{{ $cart->id }}">
                                                <a onclick="delete_sale_row('{{$cart->rowId}}','{{$cart->id}}','{{$cart->price}}')" class="btn btn-sm btn-default"><i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                    <tr class="text-center" id="noItemRow">
                                        <td colspan="5"><span class="text-danger" style="font-size:18px; padding: 10px 0px;">No Item in the cart. Add Some Item</span></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="m-b-50 invoiceDetails">
    <form action="{{ route('return.returnSaleStore') }}" method="post">
    @csrf
        <div class="card border-dark m-b-25">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="subtotal">Client</label>
                        <select name="client_id" id="client_id" class="forselect2 form-control{{ $errors->has('client_id') ? ' is-invalid' : '' }}">
                            <option disabled selected>Choose a Client</option>
                            @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('client_id'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('client_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="subtotal">Contact No</label>
                        <input type="text" class="form-control" name="contact_no" id="contact_no" readonly>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="subtotal">Address</label>
                        <input type="text" class="form-control" name="address" id="address" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-dark">
            <div class="card-body">
                <div class="row">                        
                    <div class="col-md-4 form-group">
                        <label for="uniqueItem">Unique Returned Items</label>
                        <input type="text" class="form-control" name="uniqueItemReturn" id="uniqueItemReturn" value="{{ Cart::instance('returnProduct')->content()->count() }}" readonly>
                    </div>                        
                    <div class="col-md-4 form-group">
                        <label for="subtotal">Total Returned Items</label>
                        <input type="text" class="form-control" name="totalItemsReturn" id="totalItemsReturn" value="{{ Cart::instance('returnProduct')->count() }}" readonly>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="subtotal">Returned Total</label>
                        <input type="text" class="form-control" name="subTotalReturn" id="subTotalReturn" value="{{  ceil(+str_replace(',', '', Cart::instance('returnProduct')->subtotal())) }}" readonly>
                    </div>
                                           
                    <div class="col-md-4 form-group">
                        <label for="uniqueItem">Unique Sale Items</label>
                        <input type="text" class="form-control" name="uniqueItemSale" id="uniqueItemSale" value="{{ Cart::instance('sale')->content()->count() }}" readonly>
                    </div>                        
                    <div class="col-md-4 form-group">
                        <label for="subtotal">Total Sale Items</label>
                        <input type="text" class="form-control" name="totalItemsSale" id="totalItemsSale" value="{{ Cart::instance('sale')->count() }}" readonly>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="subtotal">Sale Total</label>
                        <input type="text" class="form-control" name="subTotalSale" id="subTotalSale" value="{{  ceil(+str_replace(',', '', Cart::instance('sale')->subtotal())) }}" readonly>
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection