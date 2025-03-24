    @extends('frontend.master')
    @section('home')
    @section('title')
    {{ $category->category_name }} | Linguana
    @endsection
    <!-- ================================
        START BREADCRUMB AREA
    ================================= -->
    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                <div class="section-heading">
                    <h2 class="section__title text-white">{{ $category->category_name }}</h2>
                </div>
                <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                    <li><a href="index.html">Home</a></li>
                    <li>{{ $category->category_name }}</li>
                </ul>
            </div><!-- end breadcrumb-content -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <!--======================================
            START COURSE AREA
    ======================================-->
    <section class="course-area section--padding">
        <div class="container">
            <div class="filter-bar mb-4">
                <div class="filter-bar-inner d-flex flex-wrap align-items-center justify-content-between">
                    <p class="fs-14">We found <span class="text-black">{{ count($course) }}</span> courses available for you</p>
                    <div class="d-flex flex-wrap align-items-center">
                        {{-- <ul class="filter-nav mr-3">
                            <li><a href="course-grid.html" data-toggle="tooltip" data-placement="top" title="Grid View" class="active"><span class="la la-th-large"></span></a></li>
                            <li><a href="course-list.html" data-toggle="tooltip" data-placement="top" title="List View"><span class="la la-list"></span></a></li>
                        </ul> --}}
                        <div class="select-container select--container">
                            {{-- <select class="select-container-select">
                                <option value="all-category">All Category</option>
                                <option value="newest">Newest courses</option>
                                <option value="oldest">Oldest courses</option>
                                <option value="high-rated">Highest rated</option>
                                <option value="popular-courses">Popular courses</option>
                                <option value="high-to-low">Price: high to low</option>
                                <option value="low-to-high">Price: low to high</option>
                            </select> --}}
                        </div>
                    </div>
                </div><!-- end filter-bar-inner -->
            </div><!-- end filter-bar -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="sidebar mb-5">
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">Search Field</h3>
                                <div class="divider"><span></span></div>

                                <script src="{{ mix('js/app.js') }}"></script>

                                <div id="app">
                                    <search-course>

                                    </search-course>
                                </div>

                                {{-- <div class="form-group mb-0">
                                    <input class="form-control form--control pl-3" type="search" id="search" name="search" placeholder="Search courses">
                                    <span class="la la-search search-icon"></span>
                                </div> --}}


                            </div>
                        </div><!-- end card -->
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">Course Categories</h3>
                                <div class="divider"><span></span></div>
                                <ul class="generic-list-item">
                                @foreach ($categories as $cat)
                                    <li><a href="{{ url('category/'.$cat->id.'/'.$cat->category_slug) }}">{{ $cat->category_name }}</a></li>
                                @endforeach
                                </ul>
                            </div>
                        </div><!-- end card -->
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">Level</h3>
                                <div class="divider"><span></span></div>
                                <div class="custom-control custom-checkbox mb-1 fs-15">
                                    <input type="checkbox" class="custom-control-input" id="levelCheckbox" required>
                                    <label class="custom-control-label custom--control-label text-black" for="levelCheckbox">
                                        All Levels
                                    </label>
                                </div><!-- end custom-control -->
                                <div class="custom-control custom-checkbox mb-1 fs-15">
                                    <input type="checkbox" class="custom-control-input" id="levelCheckbox2" required>
                                    <label class="custom-control-label custom--control-label text-black" for="levelCheckbox2">
                                        Beginner
                                    </label>
                                </div><!-- end custom-control -->
                                <div class="custom-control custom-checkbox mb-1 fs-15">
                                    <input type="checkbox" class="custom-control-input" id="levelCheckbox3" required>
                                    <label class="custom-control-label custom--control-label text-black" for="levelCheckbox3">
                                        Middle
                                    </label>
                                </div><!-- end custom-control -->
                                <div class="custom-control custom-checkbox mb-1 fs-15">
                                    <input type="checkbox" class="custom-control-input" id="levelCheckbox4" required>
                                    <label class="custom-control-label custom--control-label text-black" for="levelCheckbox4">
                                        Advance
                                    </label>
                                </div><!-- end custom-control -->
                            </div>
                        </div><!-- end card -->
                    </div><!-- end sidebar -->
                </div><!-- end col-lg-4 -->
                <div class="col-lg-8">
                    <div class="row">

                        <div id="course_list"> <!-- Tempat daftar course awal -->
                            <div class="row">



                                @foreach ($courses as $course)
                                <div class="col-lg-4 responsive-column-half">
                                    <div class= "card card-item card-preview" data-tooltip-content="#tooltip_content_1{{ $course->id }}">
                                        <div class="card-image">
                                            <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="d-block">
                                                <img class="card-img-top lazy" src="{{ asset($course->course_image) }}" data-src="images/img8.jpg" alt="Card image cap">
                                            </a>
                                            @php
                                            $amount = $course->selling_price - $course->discount_price;
                                            $discount = ($amount/$course->selling_price) * 100;
                                            @endphp

                                            <div class="course-badge-labels">

                                                @if ($course->bestseller == 1)
                                                <div class="course-badge">Bestseller</div>
                                                @else
                                                @endif

                                                @if ($course->highestrated == 1)
                                                <div class="course-badge sky-blue">Highestrated</div>
                                                @else
                                                @endif

                                                @if ($course->discount_price == NULL)
                                                <div class="course-badge blue">New</div>
                                                @else
                                                <div class="course-badge blue">{{ round( $discount ) }}%</div>
                                                @endif

                                                {{-- @if ($course->featured == 1)
                                            <div class="course-badge">Featured</div>
                                            @else
                                            @endif --}}
                                            </div>
                                        </div><!-- end card-image -->

                                        @php
                                            $reviewcount = App\Models\Review::where('course_id',$course->id)->where('status',1)->latest()->get();
                                            $average = App\Models\Review::where('course_id',$course->id)->where('status',1)->avg('rating');
                                        @endphp

                                        <div class="card-body">
                                            <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $course->label }}</h6>
                                            <h5 class="card-title"><a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">{{ $course->course_name }}</a></h5>
                                            <p class="card-text"><a href="{{ route('instructor.details',$course->instructor_id) }}">{{ $course['user']['name'] }}</a></p>
                                            <div class="rating-wrap d-flex align-items-center py-2">
                                                <div class="review-stars">
                                                    <span class="rating-number">{{ round($average,1) }}</span>
                                                    @if($average == 0)
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                    @elseif($average == 1 || $average < 2)
                                                        <span class="la la-star"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                    @elseif($average == 2 || $average < 3)
                                                        <span class="la la-star"></span>
                                                        <span class="la la-star"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                    @elseif($average == 3 || $average < 4)
                                                        <span class="la la-star"></span>
                                                        <span class="la la-star"></span>
                                                        <span class="la la-star"></span>
                                                        <span class="la la-star-o"></span>
                                                        <span class="la la-star-o"></span>
                                                    @elseif($average == 4 || $average < 5)
                                                        <span class="la la-star"></span>
                                                        <span class="la la-star"></span>
                                                        <span class="la la-star"></span>
                                                        <span class="la la-star"></span>
                                                        <span class="la la-star-o"></span>
                                                    @elseif($average == 5 || $average < 5)
                                                        <span class="la la-star"></span>
                                                        <span class="la la-star"></span>
                                                        <span class="la la-star"></span>
                                                        <span class="la la-star"></span>
                                                        <span class="la la-star"></span>
                                                    @endif
                                                </div>
                                                <span class="rating-total pl-1">({{ count($reviewcount) }})</span>
                                            </div><!-- end rating-wrap -->

                                            <div class="d-flex justify-content-between align-items-center">

                                                @if ($course->discount_price == NULL)
                                                <p class="card-price text-black font-weight-bold">${{ $course->selling_price }} </p>
                                                @else
                                                <p class="card-price text-black font-weight-bold">${{ $course->discount_price }} <span class="before-price font-weight-medium">${{ $course->selling_price }}</span></p>
                                                @endif
                                                <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist"><i class="la la-heart-o" id="{{ $course->id }}" onclick="AddToWishList(this.id)"></i></div>
                                            </div>
                                        </div><!-- end card-body -->
                                    </div><!-- end card -->
                                </div>
                                @endforeach




                            </div>
                        </div>

                    </div><!-- end row -->
                    <div class="text-center pt-3">
                        <nav aria-label="Page navigation example" class="pagination-box">
                            {{ $courses->links('vendor.pagination.custom') }}
                        </nav>
                    </div>
                </div><!-- end col-lg-8 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end courses-area -->

    @php
        $courseData = App\Models\Course::get();
    @endphp

    <!-- tooltip_templates -->
    @foreach ($courseData as $item)
    <div class="tooltip_templates">
        <div id="tooltip_content_1{{ $item->id }}">
            <div class="card card-item">
                <div class="card-body">
                    <p class="card-text pb-2">By <a href="teacher-detail.html">{{ $item['user']['name'] }}</a></p>
                    <h5 class="card-title pb-1"><a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">{{ $item->course_name }}</a></h5>
                    <div class="d-flex align-items-center pb-1">

                    @if($item->bestseller == 1)
                        <h6 class="ribbon fs-14 mr-2">Bestseller</h6>
                    @else
                        <h6 class="ribbon fs-14 mr-2">New</h6>
                    @endif

                        <p class="text-success fs-14 font-weight-medium">Updated<span class="font-weight-bold pl-1">{{ $item->created_at->format('M d Y') }}</span></p>
                    </div>
                    <ul class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center fs-14">
                        <li>{{ $item->duration }} total hours</li>
                        <li>{{ $item->label }}</li>
                    </ul>
                    <p class="card-text pt-1 fs-14 lh-22">{{ $item->prerequisite }}</p>

                    @php
                    $goals = App\Models\Course_goal::where('course_id',$item->id)->orderBy('id','DESC')->get();
                    @endphp

                    <ul class="generic-list-item fs-14 py-3">
                    @foreach($goals as $goal)
                        <li><i class="la la-check mr-1 text-black"></i> {{ $goal->goal_name }}</li>
                    @endforeach
                    </ul>


                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn theme-btn flex-grow-1 mr-3" onclick="addToCart({{ $item->id }},'{{ $item->course_name }}','{{ $item->instructor_id }}','{{ $item->course_name_slug }}' )"><i class="la la-shopping-cart mr-1 fs-18"></i> Add to Cart</button>
                        <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist"><i class="la la-heart-o" id="{{ $item->id }}" onclick="AddToWishList(this.id)"></i></div>
                    </div>
                </div>
            </div><!-- end card -->
        </div>
    </div><!-- end tooltip_templates -->
    @endforeach

    <!--======================================
            END COURSE AREA
    ======================================-->

    @endsection
