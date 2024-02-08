@include('admin.layouts.head')

<body id="page-top">
    <div class="success_login" data-success_login="{{ Session::get('success_login') }}"></div>
    <div class="success" data-success="{{ Session::get('success') }}"></div>
    <div class="error" data-error="{{ Session::get('error') }}"></div>
    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('admin.layouts.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('admin.layouts.navbar')


                <!-- Begin Page Content -->
                <main class="py-4">
                    @yield('content')
                </main>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            {{-- Footer --}}
            @include('admin.layouts.footer')
            {{-- End Footer --}}

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- End Top Button-->

    {{-- Script --}}
    @include('admin.layouts.script')
    {{-- End Script --}}

</body>

</html>
