{{-- Start Script --}}
<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src={{ asset('/template/vendor/jquery/jquery.min.js') }}></script>
<script src={{ asset('/template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>

<!-- Core plugin JavaScript-->
<script src={{ asset('/template/vendor/jquery-easing/jquery.easing.min.js') }}></script>

<!-- Custom scripts for all pages-->
<script src={{ asset('/template/js/sb-admin-2.min.js') }}></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

{{-- Datatable bootsrap --}}
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
{{-- End Datatable bootsrap --}}

<script>
    $(document).ready(function() {
        const success = $(".success").data("success");
        if (success) {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Succesfully!",
                text: success,
                showConfirmButton: true,
                confirmButtonText: "Close"
            });
        }
    });
    $(document).ready(function() {
        const success = $(".success_login").data("success_login");
        if (success) {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "You are logged in!",
                showConfirmButton: true,
                confirmButtonText: "Close"
            });
        }
    });
    $(document).ready(function() {
        const error = $(".error").data("error");
        if (error) {
            Swal.fire({
                position: "center",
                icon: "error",
                title: "Opss...",
                text: error,
                showConfirmButton: true,
                confirmButtonText: "Close"
            });
        }
    });
    $(".delete-button").on("click", function(e) {
        e.preventDefault();
        var self = $(this);
        var name = $(this).attr("data-name");
        var formId = $(this).attr("data-formid");

        Swal.fire({
                title: 'Apakah Anda Yakin Ingin Menghapus Data ' + name + ' ?',
                text: 'Semua file yang berkaitan dengan data ini akan terhapus secara permanen',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    $("#delete-" + formId).submit();
                }
            });
    });
    $(".confirm-cancel").on("click", function(e) {
        var href = $(this).attr("data-redirect");
        Swal.fire({
                title: 'Apakah Anda Yakin Ingin Membatalkan?',
                text: 'Data di menu kasir ini akan hilang sepenuhnya',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
    });
</script>

{{-- Script TextEditor --}}
<script>
    tinymce.init({
        selector: '#textArea'
    });
</script>
{{-- End Script TextEditor --}}

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Logout</a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>
{{-- End Logout Modal --}}

<script>
    $(document).ready(function() {
        var currentPath = window.location.pathname;

        $('.navbar-nav .nav-link').each(function() {
            var linkPath = $(this).attr('href');
            linkPath = linkPath.replace(/^.*\/\/[^\/]+/, '');

            if (currentPath.startsWith(linkPath)) {
                $(this).addClass('active');
            }
        });
    });
</script>
{{-- End Script --}}