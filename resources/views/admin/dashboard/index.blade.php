@extends('admin.layouts.app')
@section('title', 'dashboard')

@section('content')
    <h1 class="text-center text-dark">Welcome to Dashboard</h1>
    <h3 class="text-center text-dark text-uppercase">{{ Auth::user()->name }}</h3>
@endsection
