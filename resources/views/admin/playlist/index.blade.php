@extends('admin.layouts.app')
@section('title', 'Playlist')

@section('content')
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid" style="margin-top: -20px;">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-12 mb-5 d-flex justify-content-between">
                    <h3 class="m-0 font-weight-bold text-lg text-primary">Playlist</h3>
                    <a type="button" class="btn btn-sm btn-primary addPlaylist"><i class="fas fa-plus" data-toggle="modal"
                            data-target="exampleModal"></i> New Playlist</a>
                </div>
            </div>
            <div class="row">
                @foreach ($playlist as $item)
                    <div class="col-md-2 mb-4">
                        <div class="card position-relative">
                            <!-- Card image -->
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="Card image"
                                    style="height: 200px">
                                <div class="overlay position-absolute w-100">
                                    <!-- Play Button -->
                                    <a class="btn btn-primary play-button position-absolute bottom-0 start-0"
                                        href="{{ route('music.playlist_music', $item->id) }}" id="musicList">
                                        <i class="fas fa-play"></i>
                                    </a>
                                    <!-- List Option Dropdown -->
                                    <div class="dropdown">
                                        <button
                                            class="btn btn-secondary dropdown-toggle list-option-button position-absolute bottom-0 end-0"
                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-list"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item editPlaylist"
                                                data-url_update="{{ route('playlist.update', $item->id) }}"
                                                data-url_edit="{{ route('playlist.getPlaylist', $item->id) }}"
                                                data-id="{{ $item->id }}" data-target="exampleModal" href="#"><i
                                                    class="fas fa-edit"></i> Edit</a>
                                            <a class="dropdown-item delete"
                                                data-url_destroy="{{ route('playlist.destroy', $item->id) }}"
                                                data-name="{{ $item->title }}" data-id="{{ $item->id }}"
                                                href="#"><i class="fas fa-trash"></i> Delete</a>
                                            <!-- Divider -->
                                            <hr class="sidebar-divider">
                                            <a class="dropdown-item toggleStatus" data-id="{{ $item->id }}"
                                                data-url-toggle="{{ route('playlist.status') }}"
                                                data-current-status="{{ $item->status }}"
                                                href="#">{{ $item->status }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card content -->
                            <div class="card-body mt-1">
                                <!-- Title -->
                                <h4 class="card-title mb-1 text-primary">{{ $item->title }}</h4>
                                <!-- Additional Content -->
                                <p class="card-text">{{ $item->music_count }} items</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">New Playlist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form_playlist" action="{{ route('playlist.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="user_id">
                        <div class="mb-3">
                            <label for="title" class="form-label text-gray-900 font-weight-bold">Name</label>
                            <input id="title" type="text" name="title"
                                class="form-control @error('title') is-invalid @enderror" placeholder="Input name ..."
                                value="{{ old('title') }}">
                        </div>
                        <div class="form-group my-3">
                            <label for="Image" class="form-label">Image</label>
                            <input name="image" accept=".jpg,.png,.jpeg,.webp"
                                class="form-control-file mb-2 @error('image') is-invalid @enderror" type="file"
                                onchange="document.getElementById('preview-image').src = window.URL.createObjectURL(this.files[0])"
                                id="image">
                            <img id="preview-image" src="" width="150" class="mb-2" alt="Preview Image">
                            <br>
                            <span class="small text-sm font-italic mt-2">*File max size : 5 Mb</span>
                            <br>
                            <span class="small text-sm font-italic mt-2">*Format file : .jpg,.png,.jpeg,.webp</span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        //status toogle
        $(document).ready(function() {
            $('.toggleStatus').click(function() {
                var id = $(this).data('id');
                var currentStatus = $(this).data('current-status');
                var newStatus = currentStatus === 'online' ? 'offline' : 'online';

                $.ajax({
                    url: $(this).data('url-toggle'),
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        status: newStatus,
                    },
                    success: function(response) {
                        // Update button text and current status data attribute
                        $('.toggleStatus[data-id="' + id + '"]')
                            .text(newStatus)
                            .data('current-status', newStatus);

                        Swal.fire({
                            icon: 'success',
                            title: "Successfully!",
                            text: "Successfully updated Playlist status!",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then((result) => {
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: "Error",
                            text: "An error occurred while updating data.",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }
                });
            });
        });
    </script>

    <script>
        //add modal
        $(document).ready(function() {
            // Function to show the 'Add Playlist' modal
            $('.addPlaylist').on('click', function() {
                $('#exampleModal').modal('show');
            });
        });
    </script>

    <script>
        //update modal
        $(document).ready(function() {
            $('.editPlaylist').on('click', function() {
                // Fetch the playlist ID
                var id = $(this).data('id');
                var url_update = $(this).data('url_update');
                var url_edit = $(this).data('url_edit');
                // Set modal title and submit button text
                $('#formModalLabel').html('Edit Playlist');
                $('.modal-footer button[type=submit]').html('Update data');

                // Ajax call to fetch playlist details
                $.ajax({
                    url: url_edit,
                    type: 'GET',
                    cache: false,
                    success: function(response) {
                        const modal = $('#exampleModal');
                        const form = modal.find('form');
                        form.attr('method', 'POST');
                        form.append('<input type="hidden" name="_method" value="PUT">');
                        form.attr('action', url_update);
                        $('#_id').val(response.data.id);
                        $('#title').val(response.data.title);
                        form.find("#preview-image").attr('src', response.data.previewImage);
                        $('#image').attr('src', response.data.image);
                        modal.modal('show');
                    },
                    error: function(error) {
                        console.error('Error fetching data', error);
                    }
                });
            });
        });
    </script>

    <script>
        //delete
        $(document).ready(function() {
            $('.delete').on('click', function() {
                var id = $(this).data('id');
                var name = $(this).attr("data-name");
                var token = $("meta[name='csrf-token']").attr("content");
                var url_destroy = $(this).data('url_destroy');

                Swal.fire({
                    title: 'Are yout sure want to delete ' + name + ' ?',
                    text: "Data will be deleted permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#F24C3D',
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url_destroy,
                            type: "DELETE",
                            cache: false,
                            data: {
                                "_token": token
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: (response.message),
                                    text: "Project Items has been Deleted!",
                                    showConfirmButton: false,
                                    timer: 1500,

                                }).then((result) => {
                                    location.reload();
                                })
                            }
                        });
                    }
                })
            });
        });
    </script>

@endsection
