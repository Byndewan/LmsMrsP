@extends('frontend.master')
@section('home')
@section('title')
All Category | Linguana
@endsection
<!-- ================================
    START BREADCRUMB AREA
================================= -->
@php
    $category = App\Models\Category::latest()->paginate(6);
@endphp

<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="section__title text-white">All Category</h2>
            </div>
            <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                <li><a href="index.html">Home</a></li>
                <li>All Category</li>
            </ul>
        </div><!-- end breadcrumb-content -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!--======================================
        START CATEGORY AREA
======================================-->
<section class="category-area section--padding">
    <div class="container">
        <div class="category-wrapper mt-30px">
            <div class="row">

               @foreach ($category as $cat)
               @php
               $course = App\Models\Course::where('category_id',$cat->id)->get();
               @endphp
                <div class="col-lg-4 responsive-column-half">
                    <div class="category-item">
                        <img class="cat__img lazy" src="{{ asset($cat->image) }}" data-src="{{ asset($cat->image) }}" alt="Category image">
                        <div class="category-content">
                            <div class="category-inner">
                                <h3 class="cat__title"><a href="{{ url('category/'.$cat->id.'/'.$cat->category_slug) }}">{{ $cat->category_name }}</a></h3>
                                <p class="cat__meta">{{ count($course) }} courses</p>
                                <a href="{{ url('category/'.$cat->id.'/'.$cat->category_slug) }}" class="btn theme-btn theme-btn-sm theme-btn-white">Explore<i class="la la-arrow-right icon ml-1"></i></a>
                            </div>
                        </div><!-- end category-content -->
                    </div><!-- end category-item -->
                </div><!-- end col-lg-4 -->
                @endforeach
            </div><!-- end row -->
        </div><!-- end category-wrapper -->
    </div><!-- end container -->

    <div class="text-center pt-3">
        <nav aria-label="Page navigation example" class="pagination-box">
            {{ $category->links('vendor.pagination.custom') }}
        </nav>
    </div>

</section><!-- end category-area -->
<!--======================================
        END CATEGORY AREA
======================================-->
@endsection
