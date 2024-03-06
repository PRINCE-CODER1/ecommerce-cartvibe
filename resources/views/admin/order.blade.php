<x-adminheader title="Orders"/>

    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">         
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">Our Orders</p>
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Customer</th>
                          <th>Bill</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>Order Status</th>
                          <th>Order Date</th>
                          <th>Products</th>
                          <th>Action</th>
                        </tr>  
                      </thead>
                      <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($order as $item)
                        @php
                            $i++;
                        @endphp
                        <tr>
                            <td>{{$item->fullname}}</td>
                            <td class="fw-bold">&#8377; {{$item->bill}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->address}}</td>
                            <td>
                                <div class="badge badge-success">
                                    {{$item->status}}
                                </div>
                            </td>
                            <td>{{$item->created_at}}</td>
                            <td>
                                <button type="button" class="btn badge badge-warning" data-bs-toggle="modal" data-bs-target="#updateModel{{$i}}">
                                    Product
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="updateModel{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Products</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-stripped table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Picture</th>
                                                        <th>Price/Item</th>
                                                        <th>Quantity</th>
                                                        <th>Sub Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orderItems as $itm)
                                                    @if ($itm->orderId == $item->id)
                                                        <tr>
                                                            <td>{{$itm->title}}</td>
                                                            <td><img width="100px" src="{{url('uploads/profiles',$itm->picture)}}" alt=""></td>
                                                            <td>&#x20b9;{{$itm->price}}</td>
                                                            <td>{{$itm->quantity}}</td>
                                                            <td>&#x20b9;{{$itm->price * $itm->quantity}}</td>
                                                        </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if ($item->status =="Paid")   
                                <a href="{{url('changeOrderStatus/Accepted',$item->id)}}" class="badge badge-success">Accept</a>
                                <a href="{{url('changeOrderStatus/Rejected',$item->id)}}" class="badge badge-danger">Reject</a>
                                @elseif($item->status =="Accepted")
                                <a href="{{url('changeOrderStatus/Delivered',$item->id)}}" class="badge badge-success">Delivered</a>
                                @elseif($item->status =="Delivered")
                                <h6 class="mb-0">Already Delivered</h6>
                                @else
                                <a href="{{url('changeOrderStatus/Accepted',$item->id)}}" class="badge badge-success">Accepted</a>
                                @endif
                            </td>
                        @endforeach
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
           
          </div>
          
        </div>
        <!-- content-wrapper ends -->
<x-adminfooter />