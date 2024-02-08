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
                            <h6 class="m-0 font-weight-bold text-primary">{{ $playlist->title }}</h6>
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
                                        <td><audio src="{{ asset('storage/' . $music->file) }}" controls></audio>
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

@endsection
