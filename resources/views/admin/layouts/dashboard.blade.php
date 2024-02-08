@extends('admin.layouts.app')
@section('dashboard', 'active')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid" style="margin-top: -25px;">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h5 mb-0 text-primary">Dashboard CMS Panel Reka Media Creative </h1>
                <div class="d-flex">
                    <div class="h5 mb-0 mr-1 text-xs font-weight-bold text-primary" id="tanggal"></div>
                    <div class="h5 mb-0 mr-1 text-xs font-weight-bold text-dark">|</div>
                    <div class="h5 mb-0 mr-1 text-xs font-weight-bold text-primary" id="waktu"></div>
                    <div class="h5 mb-0 mr-1 text-xs font-weight-bold text-primary">WITA</div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Approach -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Hai, {{ Auth::user()->name }}</h6>
                        </div>
                        <div class="card-body">
                            <p>Selamat datang dan selamat menggunakan CMS Panel RMC. Berikut detail
                                login Anda, mohon jaga kerahasiaan informasi Anda :</p>
                            <ul>
                                <li>Email : {{ Auth::user()->email }}</li>
                                <li>Nama : {{ Auth::user()->name }}</li>
                                <li>Bergabung Pada : {{ Auth::user()->created_at }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-4">
                    <!-- Approach -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pintasan Menu</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card shadow mb-4">
                                <!-- Card Body -->
                                <div class="card-body text-center">
                                    <i class="fas fa-cog fa-3x text-primary mb-3"></i>
                                    <div class="text-center">
                                        <h5 class="text-primary">CMS Landing</h5>
                                        <p class="text-dark">Lakukan konfigurasi halaman landing page</p>
                                    </div>
                                    <a href="" class="btn btn-primary btn-sm col-12">Pilih
                                        Menu</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card shadow mb-4">
                                <!-- Card Body -->
                                <div class="card-body text-center">
                                    <i class="fas fa-cogs fa-3x text-primary mb-3"></i>
                                    <div class="text-center">
                                        <h5 class="text-primary">General Setting</h5>
                                        <p class="text-dark">Lakukan konfigurasi General Setting</p>
                                    </div>
                                    <a href="" class="btn btn-primary btn-sm col-12">Pilih
                                        Menu</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card shadow mb-4">
                                <!-- Card Body -->
                                <div class="card-body text-center">
                                    <i class="fas fa-sign-out-alt fa-3x text-primary mb-3"></i>
                                    <div class="text-center">
                                        <h5 class="text-primary">Keluar Aplikasi</h5>
                                        <p class="text-dark">Selesai Menggunakan Aplikasi</p>
                                    </div>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm col-12">
                                            Pilih Menu
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
