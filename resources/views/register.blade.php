<x-header title="Register"/>

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="section-title">
                        <h2>Register</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mx-auto">
                    <div class="contact__form">
                        <form action="{{url('/registerUser')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="name" placeholder="Name" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="email" placeholder="Email" required>
                                </div>
                                <div class="col-lg-12">
                                    <input type="file" name="file" required>
                                </div>
                                <div class="col-lg-12">
                                    <input type="password" name="password" placeholder="password" required>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" name="register" class="site-btn">Sign Up</button>
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