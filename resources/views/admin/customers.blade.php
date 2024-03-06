<x-adminheader title="Customer"/>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">         
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">Our Customer</p>
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Full Name</th>
                          <th>Picture</th>
                          <th>Email</th>
                          <th>Type</th>
                          <th>Registration Date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>  
                      </thead>
                      <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($customers as $item)
                        @php
                        $i++;
                        @endphp
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$item->fullname}}</td>
                            <td><img class="img-fluid" width="100px" src="{{url('uploads/profiles',$item->picture)}}" alt="image"></td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->type}}</td>
                            <td>{{$item->created_at}}</td>
                            <td><b>{{$item->status}}</b></td>
                            <td>
                                @if ($item->status == 'Active')
                                <a href="{{url('changeUserStatus/Blocked',$item->id)}}" class="badge badge-danger">Block</a></td>
                                    
                                @else
                                <a href="{{url('changeUserStatus/Active',$item->id)}}" class="badge badge-success">Un-Block</a></td>
                                @endif
                                
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