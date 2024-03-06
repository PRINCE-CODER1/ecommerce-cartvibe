<x-header title="Order"/>

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="section-title">
                    <h2>My Orders</h2>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Total Bill</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Order Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach ($order as $id)
                            <tr>
                                <td>{{$counter}}</td>
                                <td>{{$id->bill}}</td>
                                <td>{{$id->fullname}}</td>
                                <td>{{$id->address}}</td>
                                <td>{{$id->phone}}</td>
                                <td>{{$id->status}}</td>
                                <td>{{$id->created_at}}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$counter}}">
                                        Products
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$counter}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">All Products</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Quantity</th>
                                                                <th>Price</th>
                                                                <th>Sub Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($items as $itm)
                                                                @if ($id->id == $itm->orderId)
                                                                    <tr>
                                                                        <td>
                                                                            <img src="{{url('uploads/profiles',$itm->picture)}}" class="img-fluid" width="100px" alt="">
                                                                            <br>
                                                                            {{$itm->title}}
                                                                        </td>
                                                                        <td>
                                                                            {{$itm->quantity}}
                                                                        </td>
                                                                        <td>
                                                                            {{$itm->price}}
                                                                        </td>
                                                                        <td>
                                                                            {{$itm->price * $itm->quantity}}
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @php
                                $counter++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<x-footer />
