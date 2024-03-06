<x-header title="Cart"/>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="{{url('/')}}">Home</a>
                            <a href="{{url('/shop')}}">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($cartItems as $item)
                                    
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="{{url('uploads/profiles',$item->picture)}}"width="100px" alt="">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>{{$item->title}}</h6>
                                            <h5>&#x20b9;{{$item->price}}</h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <form action="{{url('updateCart')}}" method="post">
                                            @csrf
                                        <div class="quantity">
                                            <input class="form-control" style="width:80px" min="1" max="{{$item -> pQuantity}}" name="quantity" type="number" value="{{$item->quantity}}">
                                        </div>
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <input type="submit" name="update"style="width:80px" class="btn-sm btn-success mt-1" value="update">
                                        </form>
                                    </td>
                                    <td class="cart__price">&#x20b9; {{$item->price * $item->quantity}}</td>
                                    <td class="cart__close"><a href="{{url('deleteCartItem',$item->id)}}"><i class="fa fa-close"></i></a></td>
                                </tr>
                                @php
                                    $total += ($item->price * $item->quantity);
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{url('/')}}">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal <span>&#x20b9;{{$total}}</span></li>
                            <li>Total <span>&#x20b9;{{$total}}</span></li>
                        </ul>
                        <form action="{{url('/stripe')}}">
                            <input type="text" name="fullname" class="form-control mt-2" placeholder="enter full name" required>
                            <input type="text" name="address" class="form-control mt-2" placeholder="enter address" required>
                            <input type="text" name="phone" class="form-control mt-2" placeholder="enter no" required>
                            <input type="hidden" name="bill" class="form-control mt-2" value="{{$total}}" required>
                            <input type="submit" name="checkout" class="primary-btn mt-2 btn-block" value="Proceed to checkout" required>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

<x-footer />