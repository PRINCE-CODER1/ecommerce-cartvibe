<x-adminheader title="Profile"/>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">         
          <div class="row">
            <div class="col-12 col-md-6 mx-auto grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">My Profile</p>

                  @if (session()->has('success'))
                  <div class="alert alert-success">
                      <p class="mb-0">{{ session()->get('success') }}</p>
                  </div>
              @endif
              <div class="prof-img d-flex justify-content-center align-items-center mb-2 mt-2">
                  <img width="150px"class="img-fluid" src="{{url('uploads/profiles/',$user->picture)}}" alt="">
              </div>
              <form action="{{url('/updateUser')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                      <div class="col-lg-6">
                          <input type="text" name="name" class="form-control mb-2" value="{{$user->fullname}}" placeholder="Name" required>
                      </div>
                      <div class="col-lg-6">
                          <input type="text" name="email" class="form-control mb-2" value="{{$user->email}}" placeholder="Email" readonly>
                      </div>
                      <div class="col-lg-12">
                          <input type="file" class="form-control mb-2" name="file">
                      </div>
                      <div class="col-lg-12">
                          <input type="text" name="password" class="form-control mb-2" value="{{$user->password}}" placeholder="password" required>
                      </div>
                      <div class="col-lg-12">
                          <button type="submit" name="register" class="btn btn-info btn-sm">Save Changes</button>
                      </div>
                  </div>
              </form>
                </div>
              </div>
            </div>
           
          </div>
          
        </div>
        <!-- content-wrapper ends -->
<x-adminfooter />