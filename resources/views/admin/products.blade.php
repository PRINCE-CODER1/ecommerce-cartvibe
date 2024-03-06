<x-adminheader title="Products"/>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">         
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addNewModel">
                        Add New
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="addNewModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Product</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{-- encryption data to kyunki picture bhi add krni hai isliye --}}
                                <form action="{{url('addNewProduct')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <label for="title">Title</label>
                                <input type="text" name="title" placeholder="Enter Title" class="form-control mb-2" id="title">
                                <label for="price">Price</label>
                                <input type="text" name="price" placeholder="Enter Price" class="form-control mb-2" id="price">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantity" placeholder="Enter Quantity" class="form-control mb-2" id="quantity">
                                <label for="picture">Picture</label>
                                <input type="file" name="file" class="form-control mb-2" id="picture">
                                <label for="description">Description</label>
                                <input type="description" name="description" placeholder="Enter Description" class="form-control mb-2" id="description">
                                <label for="category">Category</label>
                                <select name="category" class="form-control mb-2" id="category">
                                    <option value="">Select Category</option>
                                    <option value="Shoes">Shoes</option>
                                    <option value="Shirts">Shirts</option>
                                    <option value="accessories">accessories</option>
                                    <option value="Bags">Bags</option>
                                </select>
                                <label for="type">Type</label>
                                <select name="type" class="form-control mb-2" id="type">
                                    <option value="">Select Type</option>
                                    <option value="Best Sellers">Best Sellers</option>
                                    <option value="new-arrivals">arrivals</option>
                                    <option value="accessories">accessories</option>
                                    <option value="sales">sales</option>
                                </select>
                                <input type="submit" name="save" class="btn btn-success" value="Save Now">
                                
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                  <p class="card-title mb-0">Top Products</p>
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Picture</th>
                          <th>Price</th>
                          <th>Description</th>
                          <th>Quantity</th>
                          <th>Category</th>
                          <th>Type</th>
                          <th>Update</th>
                          <th>Delete</th>
                        </tr>  
                      </thead>
                      <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($products as $item)
                        @php
                        $i++;
                        @endphp
                        <tr>
                            <td>{{$item->title}}</td>
                            <td><img class="img-fluid" width="100px" src="{{url('uploads/profiles',$item->picture)}}" alt="image"></td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->quantity}}</td>
                            <td class="font-weight-medium"><div class="badge badge-success">{{$item->category}}</div></td>
                            <td class="font-weight-medium"><div class="badge badge-info">{{$item->type}}</div></td>
                            <td>
                            <button type="button" class="btn badge badge-warning" data-bs-toggle="modal" data-bs-target="#updateModel{{$i}}">
                                Update
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="updateModel{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Product</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{-- encryption data to kyunki picture bhi add krni hai isliye --}}
                                        <form action="{{url('updateProduct')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <label for="title">Title</label>
                                        <input type="text" name="title" value="{{$item->title}}" placeholder="Enter Title" class="form-control mb-2" id="title">
                                        <label for="price">Price</label>
                                        <input type="text" name="price" value="{{$item->price}}" placeholder="Enter Price" class="form-control mb-2" id="price">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" name="quantity" value="{{$item->quantity}}" placeholder="Enter Quantity" class="form-control mb-2" id="quantity">
                                        <label for="picture">Picture</label>
                                        <input type="file" name="file" class="form-control mb-2" id="picture">
                                        <label for="description">Description</label>
                                        <input type="description" name="description" value="{{$item->description}}" placeholder="Enter Description" class="form-control mb-2" id="description">
                                        <label for="category">Category</label>
                                        <select name="category" class="form-control mb-2" id="category">
                                            <option value="{{$item->category}}">{{$item->category}}</option>
                                            <option value="Shoes">Shoes</option>
                                            <option value="Shirts">Shirts</option>
                                            <option value="accessories">accessories</option>
                                            <option value="Bags">Bags</option>
                                        </select>
                                        <label for="type">Type</label>
                                        <select name="type" class="form-control mb-2" id="type">
                                            <option value="{{$item->type}}">{{$item->type}}</option>
                                            <option value="Best Sellers">Best Sellers</option>
                                            <option value="new-arrivals">arrivals</option>
                                            <option value="accessories">accessories</option>
                                            <option value="sales">sales</option>
                                        </select>
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <input type="submit" name="save" class="btn btn-success" value="Save Changes">
                                        
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </td>
                            <td><a href="{{url('deleteproduct',$item->id)}}" class="badge badge-danger">Delete</a></td>
                          </tr>
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