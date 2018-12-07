
@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><strong><i class="fab fa-angellist"></i> Add Invoice</strong></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Sale</li>
        <li class="breadcrumb-item">Add Invoice</li>
    </ul>
</div>
<section class="m-t-80 m-b-25">
    <div class="row">
        <div class="col">
            <div class="card border-dark">
                <div class="card-header bg-dark">
                    <h2 class="text-white">Add Invoice</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('cart.addToCart') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>Product Barcode</label>
                                <input name="productBarcode" id="productBarcode" class="form-control{{ $errors->has('product_id') ? ' is-invalid' : '' }}" autofocus>
                                @if ($errors->has('productBarcode'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('productBarcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Rate</label>
                                <input type="text" class="form-control{{ $errors->has('salePrice') ? ' is-invalid' : '' }}" name="salePrice" id="salePrice" readonly>
                                @if ($errors->has('salePrice'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('salePrice') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Quantity</label>
                                <input type="text" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" name="quantity" id="quantity" value="1">
                                <div style="" id="quantity_errors" class="invalid-feedback"></div>
                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Special Rate</label>
                                <input type="text" class="form-control{{ $errors->has('special_price') ? ' is-invalid' : '' }}" name="special_price" id="special_price" value="">
                                @if ($errors->has('special_price'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('special_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col text-right">
                                <a class="btn btn-danger" type="submit" href="{{ route('destroyCart') }}">Destroy Cart</a>
                                <button class="btn btn-primary" type="submit" id="cartSubmit" onsubmit="" onclick="">Add to Cart</button>
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
                                <tbody id="cartTable">
                                    @if(Cart::count() > 0)
                                    @foreach(Cart::content() as $cart)
                                        <tr id="tableRow{{$cart->id}}">
                                            <td id="name{{ $cart->id }}">{{ $cart->name }}</td>
                                            <td style="width:20%;" id="quantity{{ $cart->id }}">
                                                <div class="input-group">
                                                    <input class="form-control form-control-sm" type="number" value="{{ $cart->qty }}" id="qty{{ $cart->id }}" style="width:50px;" onchange="chageQty('{{ $cart->id }}','{{ $cart->qty }}','{{ $cart->rowId }}','{{ $cart->options['total_quantity'] }}')" name="qty{{ $cart->id }}">

                                                    
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn btn-info btn-custom" onclick="plusQuantity('{{ $cart->rowId }}','{{ $cart->options['total_quantity'] }}','{{ $cart->id }}','{{ $cart->price }}')" >
                                                            <i class="fas fa-angle-up"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-info btn-custom" onclick="minusQuantity('{{ $cart->rowId }}', '{{ $cart->id }}', '{{ $cart->price }}')">
                                                            <i class="fas fa-angle-down"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div id="qtyError{{ $cart->id }}" class="invalid-feedback"></div>
                                            </td>
                                            <td id="price{{ $cart->id }}">{{ $cart->price }}</td>
                                            <td id="subTotal{{ $cart->id }}">{{ $cart->total }}</td>
                                            <td id="removeRow{{ $cart->id }}">
                                                <a onclick="delete_row('{{$cart->rowId}}','{{$cart->id}}','{{$cart->price}}','{{ $cart->options['buyPrice'] }}')" class="btn btn-sm btn-default"><i class="fas fa-trash-alt"></i></a>
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
    <form action="{{ route('cart.cartStore') }}" method="post">
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
                    <div class="col-md-3 form-group">
                        <label for="uniqueItem">Unique Items</label>
                        <input type="text" class="form-control" name="uniqueItem" id="uniqueItem" value="{{ Cart::content()->count() }}" readonly>
                    </div>                        
                    <div class="col-md-3 form-group">
                        <label for="subtotal">Total Items</label>
                        <input type="text" class="form-control" name="totalItems" id="totalItems" value="{{ Cart::count() }}" readonly>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="subtotal">Subtotal</label>
                        <input type="text" class="form-control" name="subTotal" id="subTotal" value="{{  ceil(+str_replace(',', '', Cart::subtotal())) }}" readonly>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="subtotal">Additional Cost</label>
                        <input type="text" class="form-control" name="additionalCost" id="additionalCost" value="0">
                    </div>       
                    <div class="col-md-4 form-group">
                        <label for="subtotal">Total Bill</label>
                        <input type="text" class="form-control" name="totalBill" id="totalBill" value="{{ ceil(+str_replace(',', '', Cart::subtotal())) }}" readonly>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="subtotal">Discount</label>
                        <input type="text" class="form-control" name="discount" id="discount" value="0">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="subtotal">Previous Due</label>
                        <input type="text" class="form-control" name="previousDue" id="previousDue" value="0" readonly>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="subtotal">Grand Total</label>
                        <input type="text" class="form-control" name="grandTotal" id="grandTotal" value="{{ ceil(+str_replace(',', '', Cart::subtotal())) }}" readonly>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="subtotal">Paid Amount</label>
                        <input type="text" class="form-control{{ $errors->has('paidAmount') ? ' is-invalid' : '' }}" name="paidAmount" id="paidAmount" value="">
                         @if ($errors->has('paidAmount'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('paidAmount') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="subtotal">Total Due</label>
                        <input type="text" class="form-control" name="totalDue" id="totalDue" value="" readonly>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="subtotal">Total Profit</label>
                        <input type="text" class="form-control" name="totalProfit" id="totalProfit" value="{{ 0 }}" readonly>
                    </div>
                    <input type="hidden" id="lastSpecialPrice" name="lastSpecialPrice" id="lastSpecialPrice">
                    <div class="col-md-12">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection