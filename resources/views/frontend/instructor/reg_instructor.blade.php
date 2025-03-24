@extends('frontend.master')

@section('home')
<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="section__title text-white">Become An Instructor</h2>
            </div>
            <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                <li><a href="index.html">Home</a></li>
                <li>Pages</li>
                <li>Become An Instructor</li>
            </ul>
        </div><!-- end breadcrumb-content -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!--======================================
        START FEATURE AREA
 ======================================-->
<section class="feature-area section--padding bg-gray">
    <div class="container">
        <div class="feature-heading-content-wrap text-center">
            <div class="section-heading">
                <h2 class="section__title">Create an Online Video <br>
                    Course & Earn Money by Teaching</h2>
            </div><!-- end section-heading -->
        </div>
        <div class="row pt-60px">
            <div class="col-lg-4 responsive-column-half">
                <div class="info-box before-none">
                    <div class="icon-element mx-auto shadow-sm">
                        <svg class="svg-icon-color-3" width="40" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <h3 class="info__title">01. Outline Your Lessons</h3>
                    <p class="info__text">Organize your course structure and define key learning objectives before getting started.</p>
                </div><!-- end info-box -->
            </div><!-- end col-lg-3 -->
            <div class="col-lg-4 responsive-column-half">
                <div class="info-box before-none">
                    <div class="icon-element mx-auto shadow-sm">
                        <svg class="svg-icon-color-8" width="40" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                    </div>
                    <h3 class="info__title">02. Record Your Video</h3>
                    <p class="info__text">Produce high-quality video content that keeps your audience engaged and enhances their learning experience.</p>
                </div><!-- end info-box -->
            </div><!-- end col-lg-3 -->
            <div class="col-lg-4 responsive-column-half">
                <div class="info-box before-none">
                    <div class="icon-element mx-auto shadow-sm">
                        <svg class="svg-icon-color-2" width="40" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </div>
                    <h3 class="info__title">03. Engage Your Audience</h3>
                    <p class="info__text">Foster discussions, provide support, and create a community where learners can interact and grow.</p>
                </div><!-- end info-box -->
            </div><!-- end col-lg-3 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end feature-area -->
<!--======================================
       END FEATURE AREA
======================================-->

<!-- ================================
       START FUNFACT AREA
================================= -->
<section class="funfact-area section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 responsive-column-half">
                <div class="counter-item">
                    <div class="counter__icon icon-element mb-3 shadow-sm">
                        <svg class="svg-icon-color-2" width="42" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h4 class="counter__title counter text-color-3">7520</h4>
                    <p class="counter__meta">Expert Instructors</p>
                </div><!-- end counter-item -->
            </div><!-- end col-lg-3 -->
            <div class="col-lg-3 responsive-column-half">
                <div class="counter-item">
                    <div class="counter__icon icon-element mb-3 shadow-sm">
                        <svg class="svg-icon-color-5" width="45" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path d="M16.5 6a3 3 0 0 0-3-3H6a3 3 0 0 0-3 3v7.5a3 3 0 0 0 3 3v-6A4.5 4.5 0 0 1 10.5 6h6Z" />
                        <path d="M18 7.5a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-7.5a3 3 0 0 1-3-3v-7.5a3 3 0 0 1 3-3H18Z" />
                        </svg>
                    </div>
                    <h4 class="counter__title counter text-color-6">54,252</h4>
                    <p class="counter__meta">Total Courses</p>
                </div><!-- end counter-item -->
            </div><!-- end col-lg-3 -->
            <div class="col-lg-3 responsive-column-half">
                <div class="counter-item">
                    <div class="counter__icon icon-element mb-3 shadow-sm">
                        <svg class="svg-icon-color-1" width="45" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                        <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                        </svg>
                    </div>
                    <h4 class="counter__title counter text-color-9">97,220</h4>
                    <p class="counter__meta">Students Enrolled</p>
                </div><!-- end counter-item -->
            </div><!-- end col-lg-3 -->
            <div class="col-lg-3 responsive-column-half">
                <div class="counter-item">
                    <div class="counter__icon icon-element mb-3 shadow-sm">
                        <svg class="svg-icon-color-3" width="45" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path d="M21.721 12.752a9.711 9.711 0 0 0-.945-5.003 12.754 12.754 0 0 1-4.339 2.708 18.991 18.991 0 0 1-.214 4.772 17.165 17.165 0 0 0 5.498-2.477ZM14.634 15.55a17.324 17.324 0 0 0 .332-4.647c-.952.227-1.945.347-2.966.347-1.021 0-2.014-.12-2.966-.347a17.515 17.515 0 0 0 .332 4.647 17.385 17.385 0 0 0 5.268 0ZM9.772 17.119a18.963 18.963 0 0 0 4.456 0A17.182 17.182 0 0 1 12 21.724a17.18 17.18 0 0 1-2.228-4.605ZM7.777 15.23a18.87 18.87 0 0 1-.214-4.774 12.753 12.753 0 0 1-4.34-2.708 9.711 9.711 0 0 0-.944 5.004 17.165 17.165 0 0 0 5.498 2.477ZM21.356 14.752a9.765 9.765 0 0 1-7.478 6.817 18.64 18.64 0 0 0 1.988-4.718 18.627 18.627 0 0 0 5.49-2.098ZM2.644 14.752c1.682.971 3.53 1.688 5.49 2.099a18.64 18.64 0 0 0 1.988 4.718 9.765 9.765 0 0 1-7.478-6.816ZM13.878 2.43a9.755 9.755 0 0 1 6.116 3.986 11.267 11.267 0 0 1-3.746 2.504 18.63 18.63 0 0 0-2.37-6.49ZM12 2.276a17.152 17.152 0 0 1 2.805 7.121c-.897.23-1.837.353-2.805.353-.968 0-1.908-.122-2.805-.353A17.151 17.151 0 0 1 12 2.276ZM10.122 2.43a18.629 18.629 0 0 0-2.37 6.49 11.266 11.266 0 0 1-3.746-2.504 9.754 9.754 0 0 1 6.116-3.985Z" />
                        </svg>
                    </div>
                    <h4 class="counter__title counter text-color-4">20</h4>
                    <p class="counter__meta">Countries Reached</p>
                </div><!-- end counter-item -->
            </div><!-- end col-lg-3 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end funfact-area -->
<!-- ================================
       START FUNFACT AREA
================================= -->

<div class="section-block"></div>

<!--======================================
        START REGISTER AREA
======================================-->
<section class="register-area section--padding dot-bg overflow-hidden">
    <div class="container">
        <div class="register-heading-content-wrap text-center">
            <div class="section-heading">
                <h2 class="section__title">Fill Up this Form to Join with Us</h2>
            </div><!-- end section-heading -->
        </div>
        <div class="row pt-50px">
            <div class="col-lg-10 mx-auto">
                <div class="card card-item">
                    <div class="card-body">
                        <form method="post" action="{{ route('instructor.register') }}" class="row">
                        @csrf
                            <div class="input-box col-lg-6">
                                <label class="label-text">Name</label>
                                <div class="form-group">
                                    <input class="form-control form--control @error('name') is-invalid @enderror" type="text" name="name" placeholder="Name">
                                    <span class="la la-user input-icon"></span>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- end input-box -->

                            <div class="input-box col-lg-6">
                                <label class="label-text">User Name</label>
                                <div class="form-group">
                                    <input class="form-control form--control @error('username') is-invalid @enderror" type="text" name="username" placeholder="Username">
                                    <span class="la la-user input-icon"></span>
                                    @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box col-lg-6">
                                <label class="label-text">Email Address</label>
                                <div class="form-group">
                                    <input class="form-control form--control  @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email Address">
                                    <span class="la la-envelope input-icon"></span>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- end input-box -->
                            
                            <div class="input-box col-lg-6">
                                <label class="label-text">Phone</label>
                                <div class="form-group">
                                    <input class="form-control form--control @error('phone') is-invalid @enderror" type="text" name="phone" placeholder="Phone Number">
                                    <span class="la la-phone input-icon"></span>
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- end input-box -->

                            <div class="input-box col-lg-12">
                                <label class="label-text">Address</label>
                                <div class="form-group">
                                    <input class="form-control form--control @error('address') is-invalid @enderror" type="text" name="address" placeholder="Address">
                                    <span class="la la-map-marker input-icon"></span>
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- end input-box -->

                            <div class="input-box col-lg-12">
                                <label class="label-text">Password</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="password" name="password" placeholder="Password">
                                    <span class="la la-lock input-icon"></span>
                                </div>
                            </div><!-- end input-box -->

                            <div class="btn-box col-lg-12">
                                <div class="custom-control custom-checkbox mb-4 fs-15">
                                    <input type="checkbox" class="custom-control-input" id="agreeCheckbox" required>
                                    <label class="custom-control-label custom--control-label" for="agreeCheckbox">by signing i agree to the
                                        <a href="terms-and-conditions.html" class="text-color hover-underline">terms and conditions</a> and
                                        <a href="privacy-policy.html" class="text-color hover-underline">privacy policy</a>
                                    </label>
                                </div><!-- end custom-control -->
                                <button class="btn theme-btn" type="submit">Apply Now <i class="la la-arrow-right icon ml-1"></i></button>
                            </div><!-- end btn-box -->
                        </form>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-lg-10 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end register-area -->
<!--======================================
        END REGISTER AREA
======================================-->
@endsection