@extends('admin.admin_dashboard')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Site Setting</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Site Setting</h5>
            <form id="myForm" action="{{ route('update.site') }}" method="POST" class="row g-3" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" value="{{ $site->id }}">

                <div class="form-group col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ $site->phone }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" value="{{ $site->email }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ $site->address }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label">Facebook</label>
                    <input type="text" name="facebook" class="form-control" value="{{ $site->facebook }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label">Twitter</label>
                    <input type="text" name="twitter" class="form-control" value="{{ $site->twitter }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label">Copyright</label>
                    <input type="text" name="copyright" class="form-control" value="{{ $site->copyright }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label">Site Logo </label>
                    <input type="file" class="form-control" name="logo" id="image">
                </div>
                <div class="col-md-6">
                    <img id="showImage" src="{{ asset($site->logo) }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="80">
                </div>
                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>

@endsection
