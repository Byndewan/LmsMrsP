@php
    $testimonials = App\Models\Testimonial::where('status',1)->latest()->get();
    $student = App\Models\User::where('role','user')->where('status','1')->get();
@endphp

<section class="testimonial-area bg-gray section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="testimonial-content-wrap pb-4">
                    <div class="section-heading">
                        <h2 class="section__title mb-3" style="font-size: 32px;">Voices from the Linguana community</h2>
                        <p class="section__desc" style="font-size: 16px;">
                            Join the Linguana community and explore a world of language learning. Improve your skills with engaging content and expert insights.
                        </p>
                    </div><!-- end section-heading -->
                </div>
            </div><!-- end col-lg-4 -->
            <div class="col-lg-8">
                <h3 class="fs-22 font-weight-medium pb-3">{{ count($student) }} people are already learning on Aduca</h3>
                <div class="testimonial-carousel-2 owl-action-styled owl-action-styled-2">
                    @foreach ($testimonials as $item)
                        <div class="card card-item">
                        <div class="card-body">
                            <p class="card-text">
                                {{ $item->comment }}
                            </p>
                            <div class="media media-card align-items-center pt-4">
                                <div class="media-img avatar-md">
                                    <img src="{{ (!empty($item->user->photo)) ? url('upload/user_images/'.$item->user->photo) : url('upload/no_image.jpg') }}" alt="Testimonial avatar" class="rounded-full">
                                </div>
                                <div class="media-body">
                                    <h5>{{ $item->user->name }}</h5>
                                    <div class="d-flex align-items-center pt-1">
                                        <span class="lh-18 pr-2">{{ $item->user->role }}</span>
                                        <div class="review-stars">
                                        @if ($item->rating == NULL)
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                        @elseif($item->rating == 1)
                                            <span class="la la-star"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                        @elseif($item->rating == 2)
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                        @elseif($item->rating == 3)
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                        @elseif($item->rating == 4)
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star-o"></span>
                                        @elseif($item->rating == 5)
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                        @endif

                                        </div>
                                    </div>
                                </div>
                            </div><!-- end media -->
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                    @endforeach
                </div><!-- end testimonial-carousel-2 -->
            </div><!-- end col-lg-8 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end testimonial-area -->
