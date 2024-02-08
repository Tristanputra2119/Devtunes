<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />

    <title>DevTunes | @yield('title')</title>
    {{-- <link rel="icon" href="{{ asset('admin/img/rmc-logo.png') }}" type="image/x-icon"> --}}

    <!-- Custom fonts for this template-->
    <link href={{ asset('template/vendor/fontawesome-free/css/all.min.css') }} rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href={{ asset('template/css/sb-admin-2.min.css') }} rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('tinymce/js/tinymce/skins/ui/oxide/skin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</head>
<style>
    /* Custom CSS for hover effect */
    .overlay {
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .position-relative:hover .overlay {
        opacity: 1;
    }

    /* Positioning for the buttons */
    .play-button {
        bottom: 10px;
        /* Adjust the distance from bottom as needed */
        left: 10px;
        /* Adjust the distance from left as needed */
    }

    .list-option-button {
        bottom: 10px;
        /* Adjust the distance from bottom as needed */
        right: 10px;
        /* Adjust the distance from right as needed */
    }
</style>
