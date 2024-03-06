<x-header title="Profile"/>

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="section-title">
                        <h2>My Account</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mx-auto">
                    <div class="contact__form">
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                <p class="mb-0">{{ session()->get('success') }}</p>
                            </div>
                        @endif
                        <div class="prof-img mx-auto d-block mb-2">
                            <img src="{{url('uploads/profiles/',$user->picture)}}" alt="">
                        </div>
                        <form action="{{url('/updateUser')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="name" value="{{$user->fullname}}" placeholder="Name" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="email" value="{{$user->email}}" placeholder="Email" readonly>
                                </div>
                                <div class="col-lg-12">
                                    <input type="file" name="file">
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" name="password" value="{{$user->password}}" placeholder="password" required>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" name="register" class="site-btn">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

 <x-footer />