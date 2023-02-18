@extends('base')

<section class="vh-100 bg-image" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-4">
                            <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                            <form action="{{route('registration')}}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example4cdg">Name</label>
                                    <input type="text" id="form3Example1cg" class="form-control form-control-lg" placeholder="Name" name="name" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example4cdg">Email</label>
                                    <input type="email" id="form3Example3cg" class="form-control form-control-lg" placeholder="Email" name="email"/>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example4cdg">Phone No</label>
                                    <input type="tel" id="form3Example3cg" class="form-control form-control-lg" placeholder="Phone Number" name="phone" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example4cdg">Address</label>
                                    <input type="text" id="form3Example3cg" class="form-control form-control-lg" placeholder="City, P.O., Street no" name="address"/>
                                </div>
                                
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example4cdg">Profile Picture</label>
                                    <input type="file" id="form3Example3cg" class="form-control form-control-lg" name="image"/>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example4cdg">Password</label>
                                    <input type="password" id="form3Example4cg" class="form-control form-control-lg" placeholder="********" name="password"/>
                                </div>

                                <div class="form-check d-flex justify-content-center mb-5">
                                    <label class="form-check-label" for="form2Example3g">
                                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg"> </input>
                                        I agree to all of the <a href="#" class="text-body"><u>Terms of service</u></a>
                                    </label>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                                </div>

                                <p class="text-center text-muted mt-5">Have an account? <a href="{{route('user_login')}}" class="fw-bold text-body"><u>Login here</u></a></p>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<style>
    .gradient-custom-3 {
        /* fallback for old browsers */
        background: #84fab0;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5))
    }

    .gradient-custom-4 {
        /* fallback for old browsers */
        background: #84fab0;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1))
    }
</style>