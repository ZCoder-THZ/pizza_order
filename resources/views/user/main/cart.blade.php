@extends('user.layouts.master')
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table id="data-table" class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $cartItem)
                            <tr>
                                {{-- <input type="hidden" id="price"   value="{{ $cartItem->pizza_price }}"> --}}
                                <input class="productId" type="hidden" id="" value="{{ $cartItem->product_id }}"
                                    style="color: #fff !important">
                                <input class="orderId" type="hidden" id="" value="{{ $cartItem->id }}"
                                    style="color: #fff !important">
                                <input class="userId" type="hidden" id="" value="{{ $cartItem->user_id }}"
                                    name="userId" style="color: #fff !important">
                                <td><img class="img-thumbnail shadow-sm" style="width: 100px"
                                        src="{{ asset('storage/' . $cartItem->product_image) }}" alt=""
                                        style="width: 50px;"></td>
                                <td class="align-middle"> {{ $cartItem->pizza_name }} </td>
                                <td id='price' class="align-middle">{{ $cartItem->pizza_price }}kyats</td>
                                <td class="align-middle">


                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button style="color: #fff !important"
                                                class="btn-minus btn btn-sm btn-primary ">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>

                                        <input type="text" id="qty" style="color: #fff !important"
                                            class=" form-control form-control-sm bg-secondary border-0 text-center"
                                            value="{{ $cartItem->qty }} ">
                                        <div class="input-group-btn">
                                            <button style="color: #fff !important"
                                                class="btn-minus btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{ $cartItem->pizza_price * $cartItem->qty }}kyats
                                </td>
                                <td class="align-middle"><button class="btnRemove btn btn-sm btn-danger"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice">{{ $totalPrice }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">3000</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice">{{ $totalPrice + 3000 }}</h5>
                        </div>
                        <button id="orderBtn" class="btn btn-block btn-primary font-weight-bold text-light my-3 py-3"
                            style="color: white !important">Proceed To Checkout</button>
                        <button id="clearBtn" class="btn btn-block btn-danger font-weight-bold text-light my-3 py-3"
                            style="color: white !important">Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('.btn-plus').click(function() {
                $parentNode = $(this).parents('tr');
                $price = Number($parentNode.find('#price').text().replace("kyats", ""));
                $qty = Number($parentNode.find('#qty').val());

                $total = $price * $qty;
                $parentNode.find('#total').html($total + 'kyats')


            })
            $('.btn-minus').click(function() {
                $parentNode = $(this).parents('tr');
                $price = Number($parentNode.find('#price').text().replace("kyats", ""));
                $qty = Number($parentNode.find('#qty').val());
                $total = $price * $qty;

                $parentNode.find('#total').html($total + 'kyats')
                summaryCatulation()
            })

            function summaryCatulation() {
                $totalPrice = 0;
                $('#data-table tr').each(function(index, row) {
                    $totalPrice += $(row).find('#total').text().replace('kyats', '') * 1;
                });
                $('#subTotalPrice').html(`${$totalPrice} kyats`)
                $('#finalPrice').html(`${$totalPrice+3000} kyats`)
            }
            // ***********************************************************
            $('#orderBtn').click(function() {
                $orderList = [];
                $random = Math.floor(Math.random() * 10000001);
                // console.log($random)
                $('#data-table tbody tr').each(function(index, row) {
                    $orderList.push({
                        'user_id': $(row).find('.userId').val(),
                        'product_id': $(row).find('.productId').val(),
                        'qty': $(row).find('#qty').val(),
                        'total': $(row).find('#total').text().replace('kyats', '') * 1,
                        'order_code': 'POS' + $random

                    })
                });
                $.ajax({
                    method: 'get',
                    url: '/user/ajax/order',
                    data: Object.assign({}, $orderList),
                    dataType: 'json',
                    success: function(response) {

                        window.location.href = '/user/homePage'

                    }
                })


            })
            // **********************************************************
            // when clear btn clicked
            $('#clearBtn').click(function() {

                $('#data-table tbody tr').remove();
                $('#subTotalPrice').html('0 kyats');
                $('#finalPrice').html('3000 kyats');

                $.ajax({
                    method: 'get',
                    url: '/user/ajax/clear/cart',

                })
            })
            //
            $('.btnRemove').click(function() {
                $parentNode = $(this).parents('tr');
                $productId = $parentNode.find('.productId').val();
                $orderId = $parentNode.find('.orderId').val();

                $.ajax({
                    method: 'get',
                    url: '/user/ajax/clear/current/product',
                    data: {
                        'productId': $productId,
                        'orderId': $orderId
                    },
                    dataType: 'json',
                    success: function(response) {

                        console.log(response);
                    }

                })
                $parentNode.remove();

                summaryCatulation()

            })
        })
    </script>
@endsection
