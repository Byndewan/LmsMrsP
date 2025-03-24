@guest

@else
<section class="register-area section-padding dot-bg overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="fs-24 font-weight-semi-bold pb-2">Give your Feedback to Our Course</h3>
                        <div class="divider"><span></span></div>
                        <form method="post" action="{{ route('store.testimonial') }}">
                        @csrf
                            {{-- <div style="display: flex;">
                                <div class="col-lg-6">
                                    <div class="input-box">
                                        <label class="label-text">Name</label>
                                        <div class="form-group">
                                            <input class="form-control form--control" type="text" name="name" placeholder="Your Name">
                                            <span class="la la-user input-icon"></span>
                                        </div>
                                    </div><!-- end input-box -->
                                    <div class="input-box">
                                        <label class="label-text">Who Are You?</label>
                                        <div class="form-group">
                                            <select class="form-control form--control2" name="position">
                                                <option value="">Select Your Position</option>
                                                <option value="Student">Student</option>
                                                <option value="Instructor">Instructor</option>
                                            </select>
                                        </div>
                                    </div><!-- end input-box -->
                                </div>   
                                <div class="col-lg-6">
                                    <div class="input-box">
                                        <label class="label-text">Email</label>
                                        <div class="form-group">
                                            <input class="form-control form--control" type="email" name="email" placeholder="Email Address">
                                            <span class="la la-envelope input-icon"></span>
                                        </div>
                                    </div><!-- end input-box -->
                                </div>
                            </div> --}}

                            {{-- <input type="text" name="user_id" value="{{ $user->user_id }}"> --}}
                            
                            <div class="col-lg-12">
                                <div class="input-box">
                                    <label class="label-text">Message</label>
                                    <div class="form-group">
                                        <div class="leave-rating-wrap pb-4">
                                            <div class="leave-rating leave--rating">
                                                <input type="radio" name='rating' id="star5" value="5"/>
                                                <label for="star5"></label>
                                                <input type="radio" name='rating' id="star4" value="4"/>
                                                <label for="star4"></label>
                                                <input type="radio" name='rating' id="star3" value="3"/>
                                                <label for="star3"></label>
                                                <input type="radio" name='rating' id="star2" value="2"/>
                                                <label for="star2"></label>
                                                <input type="radio" name='rating' id="star1" value="1"/>
                                                <label for="star1"></label>
                                            </div><!-- end leave-rating -->
                                        </div>
                                        <textarea class="form-control form--control2" type="text" rows="10" name="comment" placeholder="Write Message"></textarea>
                                        {{-- <span class="la la-book input-icon"></span> --}}
                                    </div>
                                </div><!-- end input-box -->
                            </div>
                        
                            <div class="btn-box pt-2">
                                <button class="btn theme-btn" type="submit">Submit</button>
                            </div><!-- end btn-box -->
                        </form>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-lg-5 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end register-area -->
@endguest

