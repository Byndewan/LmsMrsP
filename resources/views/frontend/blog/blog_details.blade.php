@extends('frontend.master')
@section('home')
@section('title')
{{ $blog->post_title }} | Linguana
@endsection

<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area pt-80px pb-80px pattern-bg">
    <div class="container">
        <div class="breadcrumb-content">
            <div class="section-heading pb-3">
                <h2 class="section__title">{{ $blog->post_title }}</h2>
            </div>
            <ul class="generic-list-item generic-list-item-arrow d-flex flex-wrap align-items-center">
                <li><a href="index.html">Home</a></li>
                <li><a href="blog-no-sidebar.html">Blog</a></li>
                <li>{{ $blog->post_title }}</li>
            </ul>
            <ul class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center flex-wrap fs-14 pt-2">
                <li class="d-flex align-items-center">By<a href="#">Admin</a></li>
                <li class="d-flex align-items-center">{{ $blog->created_at->format('d M Y') }}</li>
                <li class="d-flex align-items-center"><a href="#comments" class="page-scroll">4 Comments</a></li>
                <li class="d-flex align-items-center">130 Shares</li>
            </ul>
        </div><!-- end breadcrumb-content -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!-- ================================
       START BLOG AREA
================================= -->
<section class="blog-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5">
                <div class="card card-item">
                    <div class="card-body">
                        <p class="card-text pb-3">{!! nl2br($blog->long_descp) !!}</p>

                        <div class="section-block"></div>
                        <h3 class="fs-18 font-weight-semi-bold pt-3">Tags</h3>
                        <div class="d-flex flex-wrap justify-content-between align-items-center pt-3">
                            <ul class="generic-list-item generic-list-item-boxed d-flex flex-wrap fs-15">
                                @foreach($tags_all as $tag)
                                    <li class="mr-2"><a href="#">{{ ucwords($tag) }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
                <div class="section-block"></div>
                <div class="comments-wrap pt-5" id="comments">
                    <div class="d-flex align-items-center justify-content-between pb-4">
                        <h3 class="fs-22 font-weight-semi-bold">Comments</h3>
                        <span class="ribbon ribbon-lg">{{ count($comments) }}</span>
                    </div>
                    <div class="comment-list">
                        {{-- <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
                            <div class="media-img mr-4 rounded-full">
                                <img class="rounded-full lazy" src="images/img-loading.png" data-src="images/small-avatar-1.jpg" alt="User image">
                            </div>
                            <div class="media-body">
                                <h5 class="pb-2">Kavi arasan</h5>
                                <span class="d-block lh-18 pb-2">a month ago</span>
                                <p class="pb-3">This is one of the best courses I have taken in Udemy. It is very complete, and it has made continue learning about Java and SQL databases as well.</p>
                                <div class="helpful-action d-flex align-items-center justify-content-between">
                                    <a class="btn theme-btn theme-btn-sm theme-btn-transparent lh-30" href="#" data-toggle="modal" data-target="#replyModal"><i class="la la-reply mr-1"></i> Reply</a>

                                </div>
                            </div>
                        </div><!-- end media -->
                        <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4 review-reply">
                            <div class="media-img mr-4 rounded-full">
                                <img class="rounded-full lazy" src="images/img-loading.png" data-src="images/small-avatar-2.jpg" alt="User image">
                            </div>
                            <div class="media-body">
                                <h5 class="pb-2">Jitesh Shaw</h5>
                                <span class="d-block lh-18 pb-2">1 months ago</span>
                                <p class="pb-3">This is one of the best courses I have taken in Udemy. It is very complete, and it has made continue learning about Java and SQL databases as well.</p>
                                <div class="helpful-action d-flex align-items-center justify-content-between">
                                    <a class="btn theme-btn theme-btn-sm theme-btn-transparent lh-30" href="#" data-toggle="modal" data-target="#replyModal"><i class="la la-reply mr-1"></i> Reply</a>

                                </div>
                            </div>
                        </div><!-- end media --> --}}

                        @foreach ($comments as $comment)
    <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
        <div class="media-img mr-4 rounded-full">
            <img class="rounded-full lazy" src="{{ (!empty($comment['user']['photo'])) ? url('upload/user_images/'.$comment['user']['photo']) : url('upload/no_image.jpg') }}" data-src="images/small-avatar-1.jpg" alt="User  image">
        </div>
        <div class="media-body">
            <h5 class="pb-2">{{ $comment['user']['name'] }}</h5>
            <div class="d-flex blog-tags">
                <span class="d-block lh-18 pb-2">{{ $comment['user']['role'] }}</span>
                <p class="d-block lh-18 pb-2 pl-1">{{ $comment->created_at->diffForHumans() }}</p>
            </div>
            <p class="pb-3">{!! nl2br($comment->comment) !!}</p>
            <div class="helpful-action d-flex align-items-center justify-content-between">

            <a class="btn theme-btn theme-btn-sm theme-btn-transparent lh-30" href="#" data-toggle="modal" data-target="#replyModal" data-comment-id="{{ $comment->id }}" data-commenter-name="{{ $comment['user']['name'] }}">
                <i class="la la-reply mr-1"></i> Reply
            </a>


            @if ($comment->replies->count() > 0)
                <a class="btn theme-btn theme-btn-sm theme-btn-transparent lh-30 toggle-reply" href="#">
                    <i class="la la-arrow-down"></i> <span class="reply-count">{{ $comment->replies->count() }}</span> Show Replies
                </a>
            @endif        

            </div>
            <div class="replies mt-3" style="display: none; overflow: hidden; max-height: 0; transition: max-height 0.3s ease-in-out;">
                @foreach ($comment->replies as $reply)
                <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4 review-reply">
                    <div class="media-img mr-4 rounded-full">
                        <img class="rounded-full lazy" src="{{ (!empty($reply['user']['photo'])) ? url('upload/user_images/'.$reply['user']['photo']) : url('upload/no_image.jpg') }}" data-src="images/small-avatar-2.jpg" alt="User  image">
                    </div>
                    <div class="media-body">
                        <h5 class="pb-2">{{ $reply['user']['name'] }}</h5>
                        <div class="d-flex blog-tags">
                            <span class="d-block lh-18 pb-2">{{ $reply['user']['role'] }}</span>
                            <p class="d-block lh-18 pb-2 pl-1">{{ $reply->created_at->diffForHumans() }}</p>
                        </div>
                        <p class="pb-3">{!! nl2br($reply->reply) !!}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endforeach

                    </div>
                    <div class="load-more-btn-box text-center pt-3 pb-5">
                        <button class="btn theme-btn theme-btn-sm theme-btn-transparent lh-30"><i class="la la-refresh mr-1"></i> Load More Comment</button>
                    </div>
                </div>
                <div class="section-block"></div>


                <div class="add-comment-wrap pt-5">
                    @guest
                    <p><b>For Add Comment, You need to login first <br> <a href="{{ route('login') }}">Login Here</a></b></p>
                    @else


                    <h3 class="fs-22 font-weight-semi-bold pb-4">Add a Comment</h3>
                    <form action="{{ route('store.comment') }}" method="post" class="row">
                        @csrf
                        <input type="hidden" name="blogpost_id" value="{{ $blog->id }}">
                        <div class="input-box col-lg-12">
                            {{-- <label class="label-text">Message</label> --}}
                            <div class="form-group">
                                <textarea class="form-control form--control pl-3" name="comment" placeholder="Write Message" rows="5"></textarea>
                            </div>
                        </div><!-- end input-box -->
                        <div class="btn-box col-lg-12">
                            <button class="btn theme-btn" type="submit">Submit Comment</button>
                        </div><!-- end btn-box -->
                    </form>
                    @endguest

                </div><!-- end add-comment-wrap -->
            </div><!-- end col-lg-8 -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Blog Category</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item">
                            @foreach($bcategory as $cat)
                                <li><a href="{{ url('blog/cat/list/'.$cat->id) }}">{{ $cat->category_name }}</a></li>
                            @endforeach
                            </ul>
                        </div>
                    </div><!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Recent Posts</h3>
                            <div class="divider"><span></span></div>
                            @foreach ($post as $item)
                                <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
                                    <a href="{{ url('blog/details/'.$item->post_slug) }}" class="media-img">
                                        <img class="mr-3" src="{{ asset($item->post_image) }}" alt="Related course image">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="fs-15"><a href="{{ url('blog/details/'.$item->post_slug) }}">{{ $item->post_title }}</a></h5>
                                        <span class="d-block lh-18 py-1 fs-14">Admin</span>
                                    </div>
                                </div><!-- end media -->
                            @endforeach
                            <div class="view-all-course-btn-box">
                                <a href="blog-no-sidebar.html" class="btn theme-btn w-100">View All Posts <i class="la la-arrow-right icon ml-1"></i></a>
                            </div>
                        </div>
                    </div><!-- end card -->
                    <div class="card card-item">
                    </div><!-- end card -->
                    {{-- <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Post Tags</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item generic-list-item-boxed d-flex flex-wrap fs-15">
                                <li class="mr-2"><a href="#">Business</a></li>
                                <li class="mr-2"><a href="#">Event</a></li>
                                <li class="mr-2"><a href="#">Video</a></li>
                                <li class="mr-2"><a href="#">Audio</a></li>
                                <li class="mr-2"><a href="#">Software</a></li>
                                <li class="mr-2"><a href="#">Conference</a></li>
                                <li class="mr-2"><a href="#">Marketing</a></li>
                                <li class="mr-2"><a href="#">Freelance</a></li>
                                <li class="mr-2"><a href="#">Tips</a></li>
                                <li class="mr-2"><a href="#">Technology</a></li>
                                <li class="mr-2"><a href="#">Entrepreneur</a></li>
                            </ul>
                        </div>
                    </div><!-- end card --> --}}
                </div><!-- end sidebar -->
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end blog-area -->
<!-- ================================
       START BLOG AREA
================================= -->

<!-- Modal -->
<div class="modal fade modal-container" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <div class="pr-2">
                <h5 class="modal-title" id="exampleModalLabel">Reply comment on</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div><!-- end modal-header -->
            <div class="modal-body">


            <form action="{{ route('store.reply') }}" method="post">
                @csrf
                <input type="hidden" name="comment_id" value="">
                <input type="hidden" name="blogpost_id" value="{{ $blog->id }}">
                <div class="form-group">
                    <label class="label-text">Message</label>
                    <textarea class="form-control form--control pl-3" name="reply" placeholder="Write Message" rows="5"></textarea>
                </div>
                <div class="btn-box text-right">
                    <button type="button" class="btn font-weight-medium mr-3" data-dismiss="modal">Cancel</button>
                    <button class="btn theme-btn theme-btn-sm" type="submit">Reply <i class="la la-arrow-right icon ml-1"></i></button>
                </div><!-- end btn-box -->
            </form>



            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".toggle-reply").forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault();
                let replies = this.closest(".media-body").querySelector(".replies");
                let icon = this.querySelector("i");

                if (replies.style.maxHeight === "0px" || replies.style.maxHeight === "") {
                    replies.style.display = "block";
                    replies.style.maxHeight = replies.scrollHeight + "px";
                    icon.classList.replace("la-arrow-down", "la-arrow-up");
                } else {
                    replies.style.maxHeight = "0px";
                    setTimeout(() => { replies.style.display = "none"; }, 300);
                    icon.classList.replace("la-arrow-up", "la-arrow-down");
                }
            });
        });
    });

    const replyButtons = document.querySelectorAll('[data-toggle="modal"]');

    replyButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Ambil ID komentar dan nama pengguna yang mengomentari dari tombol
            const commentId = this.getAttribute('data-comment-id');
            const commenterName = this.getAttribute('data-commenter-name');

            // Setel nilai comment_id di input form reply
            document.querySelector('input[name="comment_id"]').value = commentId;

            // Ganti teks modal menjadi "Reply comment on {username}"
            const replyText = document.querySelector('.modal-title');
            if (replyText) {
                replyText.textContent = `Reply comment on ${commenterName}`;
            }
        });
    });

</script>

@endsection
