@extends('admin.layouts.app')
@section('title', 'Security')

@section('content')
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid" style="margin-top: -20px;">

            <!-- Page Heading -->
            <div class="card shadow">
                <div class="card-header py-3 bg-white">
                    <h5 class="m-0 text-lg font-weight-bold text-primary my-2">Security Setting</h5>
                </div>
                <div class="card-body p-5 font-weight-bold text-gray-800">
                    <form class="user" method="POST" action="{{ route('setting.update', $users->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label">Your Email</label>
                            <div class="col-md-8">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email', Auth::user()->email) }}">
                            </div>
                        </div>

                        <div class="mt-2">
                            <h6 class="small font-weight-bold text-gray-700"><i>*Fill in the following sections if you only
                                    want to change your password</i></h6>
                        </div>

                        <div class="row mb-3">
                            <label for="old_password" class="col-md-4 col-form-label">Current Password</label>
                            <div class="col-md-8">
                                <input name="old_password" type="password"
                                    class="form-control @error('old_password') is-invalid @enderror" id="old_password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="newPasswordInput" class="col-md-4 col-form-label">New Password</label>
                            <div class="col-md-8">
                                <input name="new_password" type="password"
                                    class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="confirmNewPasswordInput" class="col-md-4 col-form-label">Confirm Password</label>
                            <div class="col-md-8">
                                <input name="new_password_confirmation" type="password" class="form-control"
                                    id="confirmNewPasswordInput">
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
                                    Save Change
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>

@endsection
