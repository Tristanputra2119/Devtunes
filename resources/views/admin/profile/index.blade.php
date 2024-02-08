@extends('admin.layouts.app')
@section('title', 'Profile')

@section('content')
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid" style="margin-top: -20px;">

            <!-- Page Heading -->
            <form class="user" method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow">
                            <div class="card-header py-3 bg-white">
                                <h5 class="m-0 font-weight-bold text-lg text-primary my-2">{{ Auth::user()->name }} Profile
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="p-3">
                                    @if (Auth::user()->profil_image != null)
                                        <img id="images" class="mx-auto d-block"
                                            style="width:175px; height:175px; border-radius:50%"
                                            src="{{ asset('storage/' . Auth::user()->profil_image) }}">
                                    @else
                                        <img id="images" class="mx-auto d-block"
                                            style="width:175px; height:175px; border-radius:50%"
                                            src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=6f5e81&color=ffff&bold=true">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card shadow">
                            <div class="card-header bg-white py-3">
                                <h5 class="m-0 font-weight-bold text-lg text-primary my-2">Profile Setting</h5>
                            </div>
                            <div class="card-body text-gray-800 font-weight-bold">

                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label">Name</label>
                                    <div class="col-md-8">
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name', Auth::user()->name) }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="sfile" class="col-md-4 col-form-label">Image</label>
                                    <div class="col-md-8">
                                        <input id="sfile" name="profil_image" accept=".jpg,.png,.jpeg,.webp"
                                            class="form-control-file mb-2 @error('profil_image') is-invalid @enderror"
                                            value="{{ old('profil_image') }}" type="file">
                                        <div class="text-end font-italic mt-2">
                                            <h6 class="small font-weight-bold text-gray-700">*File max size : 5
                                                Mb</h6>
                                            <h6 class="small font-weight-bold text-gray-700">*Format file :
                                                .jpg,.png,.jpeg,.webp</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-auto me-auto">
                                        <a class="btn btn-user btn-secondary font-weight-bold" type="button"
                                            href="{{ route('playlist.index') }}">
                                            Cancel
                                        </a>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-user btn-primary font-weight-bold">
                                            Save Profile
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.container-fluid -->
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sfile').on('change', function() {
                var sfile = (this).files[0];
                viewImages(sfile);
            })
        });

        function viewImages(file) {
            var reader = new FileReader();
            reader.onload = function() {
                $('#images').attr('src', reader.result);
            }
            reader.readAsDataURL(file);
        }
    </script>

@endsection
