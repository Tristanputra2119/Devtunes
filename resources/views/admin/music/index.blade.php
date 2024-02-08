@extends('admin.layouts.app')
@section('title', 'Music')

@section('content')

    <div id="content">
        <div class="container-fluid" style="margin-top: -20px;">
            <!-- Page Heading -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">All Music</h6>
                            <a type="button" class="btn btn-sm btn-primary addMusic"><i class="fas fa-plus"
                                    data-toggle="modal" data-target="exampleModal"></i> Add Music</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered no-footer" width="100%" cellspacing="0"
                            role="grid" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="w-10">Title</th>
                                    <th class="w-10">Image</th>
                                    <th class="w-10">Artist</th>
                                    <th class="w-10">Preview Audio</th>
                                    <th class="text">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($musics as $key => $music)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $music->title }}</td>
                                        <td><img src="{{ asset('storage/' . $music->image) }}" alt=""
                                                width="80px">
                                        </td>
                                        <td>{{ $music->composer }}</td>
                                        <td><audio src="{{ asset('storage/' . $music->file) }}" controls></audio></td>
                                        <td class="text-center">
                                            <a class="btn btn-warning btn-sm editMusic" title="Edit Data" type="button"
                                                data-toggle="modal"
                                                data-url_update="{{ route('music.update', $music->id) }}"
                                                data-url_edit="{{ route('music.getmusic', $music->id) }}"
                                                data-id="{{ $music->id }}" data-target="exampleModal"><i
                                                    class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" id="delete" class="btn btn-danger btn-sm delete"
                                                data-url_destroy="{{ route('music.destroy', $music->id) }}"
                                                data-name="{{ $music->title }}" data-id="{{ $music->id }}"
                                                title="Delete Data"><i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---Modal --->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">New Music</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('music.store') }}" method="post" id="form_music" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="id">
                        @csrf
                        <label for="Playlist" class="form-label">Playlist</label>
                        <select name="playlist_id" id="selected_playlist" class="custom-select">
                            @foreach ($playlist as $playlist)
                                <option value="{{ $playlist['id'] }}">
                                    {{ $playlist['title'] }}
                                </option>
                            @endforeach
                        </select>
                        <label for="Title" class="form-label">Title</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Input Title.."
                            value="{{ old('title') }}">
                        <label for="Composer" class="form-label">Composer</label>
                        <input type="text" id="composer" name="composer" class="form-control"
                            placeholder="Input Composer.." value="{{ old('composer') }}">
                        <label for="Image" class="form-label">Image</label>
                        <input name="image" accept=".jpg,.png,.jpeg,.webp,.gif"
                            class="form-control-file mb-2 @error('image') is-invalid @enderror" type="file"
                            onchange="document.getElementById('preview-image').src = window.URL.createObjectURL(this.files[0])"
                            id="image">
                        <img id="preview-image" src="" width="150" class="mb-2" alt="Preview Image">
                        <br>
                        <span class="small text-sm font-italic mt-2">*File max size : 5 Mb</span>
                        <br>
                        <span class="small text-sm font-italic mb-2">*Format file : .jpg,.png,.jpeg,.webp</span>
                        <div class="mt-2">
                            <label for="File" class="form-label">Music</label>
                            <input type="file" name="file" id="file" class="form-control" accept=".mp3">
                            <label for="Previewaudio" class="form-label">Preview Audio</label>
                            <audio src="" id="audiopreview" class="form-control" controls></audio>
                        </div>
                        <span class="small text-sm font-italic mt-2">*File max size : 20.48 MB</span>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <script>
            //add modal
            $(document).ready(function() {
                // Function to show the 'Add music' modal
                $('.addMusic').on('click', function() {
                    $('#exampleModal').modal('show');
                });
            });
        </script>

        <script>
            // Stop all other audio elements when a new one starts playing
            $('audio').on('play', function() {
                $('audio').not(this).each(function(index, audio) {
                    audio.pause();
                });
            });
        </script>
        <!-- Autoplay next -->
        <script>
            $(document).ready(function() {
                // Autoplay next
                $('audio').on('ended', function() {
                    var nextAudio = $(this).closest('tr').next().find('audio')[0];
                    if (nextAudio) {
                        nextAudio.play();
                    }
                });
            })
        </script>

        <script>
            //music preview
            $("#file").change(function() {
                const file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $("#audiopreview").attr("src", event.target.result);
                        $("#audiopreview").show();
                    };
                    reader.readAsDataURL(file);
                } else {
                    $("#audiopreview").hide();
                }
            });
        </script>

        <script>
            //update ajax
            $(document).ready(function() {
                $('.editMusic').on('click', function() {
                    // Fetch the music ID
                    var id = $(this).data('id');
                    var url_update = $(this).data('url_update');
                    var url_edit = $(this).data('url_edit');
                    // Set modal title and submit button text
                    $('#formModalLabel').html('Edit Music');
                    $('.modal-footer button[type=submit]').html('Update data');

                    // Ajax call to fetch music details
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

                            // Populate form fields with fetched data
                            $('#selected_playlist').val(response.data.playlist_id);
                            $('#_id').val(response.data.id);
                            $('#title').val(response.data.title);
                            $('#composer').val(response.data.composer);
                            form.find("#preview-image").attr('src', response.data.previewImage);
                            form.find('#audiopreview').attr('src', response.data.previewAudio);
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
            //delete ajax
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
                                        text: "Music Items has been Deleted!",
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
