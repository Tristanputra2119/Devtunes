@extends('pages.template')

@section('title')
    Playlist
@endsection

@section('custom-css')
    <style>
        @media (min-width: 1200px) {
            .col-lg-3 {
                flex: 0 0 auto;
                width: 20%;
            }
        }

        @media (min-width: 1600px) {
            .playlist-item {
                height: 220px;
                width: 300px;
                margin: 10px 10px 10px 0;
            }

            .playlist-item .playlist-item-thumbnail {
                height: 228px;
            }
        }

        @media (max-width: 1600px) {
            .playlist-item {
                height: 220px;
                width: 240px;
                margin: 10px 10px 10px 0;
            }

            .playlist-item .playlist-item-thumbnail {
                height: 228px;
            }
        }

        @media (max-width: 1400px) {
            .playlist-item {
                height: 185px;
                width: 205px;
                margin: 10px 10px 10px 0;
            }

            .playlist-item .playlist-item-thumbnail {
                height: 190px;
            }
        }

        @media (max-width: 1000px) {
            .playlist-item {
                height: auto;
                width: auto;
                margin: 10px 10px 10px 0;
            }

            .playlist-item .playlist-item-thumbnail {
                height: auto;
            }
        }

        .title {
            color: white;
            font-size: 22px;
        }
    </style>

    <style>
        .input-group {
            justify-content: flex-end;
        }

        #searchButton {
            background: white;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')

    <div class="container mt-4">
        <form id="searchForm" method="GET" class="form-inline" style="width: 300px;">
            <div class="input-group">
                <input type="text" class="form-control" name="search" id="searchInput" placeholder="Search..."
                    aria-label="Search" value="{{ $search }}">
                <button class="btn" type="button" id="searchButton">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

    @if ($search > 0)
        {
        <div class="container mt-3">
            <h1 class="title">Search Playlist</h1>
            <div class="row">
            @forelse ($news as $item)
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ url('/playlist/' . $item->id) }}">
                        <div class="playlist-item">
                            <img class="playlist-item-thumbnail" src="{{ asset('storage/' . $item->image) }}"
                                alt="Playlist item" class="img-fluid">
                            <div class="playlist-item-info">
                                <p class="playlist-item-title">{{ $item->title }}</p>
                                <a class="playlist-item-button" href="{{ url('/playlist/' . $item->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="#C45EFF" class="bi bi-play-fill" viewBox="0 0 16 16">
                                        <path
                                            d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12">
                    <h3 class="text-center text-white ">No playlists found.</h3>
                </div>
            @endforelse
            </div>
        </div>
        }
    @else
        {
        <div class="container mt-3">
            <h1 class="title">Popular Playlist</h1>
            <div class="row">
                @foreach ($news as $item)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <a href="{{ url('/playlist/' . $item->id) }}">
                            <div class="playlist-item">
                                <img class="playlist-item-thumbnail" src="{{ asset('storage/' . $item->image) }}"
                                    alt="Playlist item" class="img-fluid">
                                <div class="playlist-item-info">
                                    <p class="playlist-item-title">{{ $item->title }}</p>
                                    <a class="playlist-item-button" href="{{ url('/playlist/' . $item->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#C45EFF"
                                            class="bi bi-play-fill" viewBox="0 0 16 16">
                                            <path
                                                d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container mt-3">
            <h1 class="title">All Playlist</h1>
            <div class="row">
                @foreach ($all as $data)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <a href="{{ url('/playlist/' . $data->id) }}">
                            <div class="playlist-item">
                                <img class="playlist-item-thumbnail" src="{{ asset('storage/' . $data->image) }}"
                                    alt="Playlist item" class="img-fluid">
                                <div class="playlist-item-info">
                                    <p class="playlist-item-title">{{ $data->title }}</p>
                                    <a class="playlist-item-button" href="{{ url('/playlist/' . $data->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#C45EFF"
                                            class="bi bi-play-fill" viewBox="0 0 16 16">
                                            <path
                                                d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        }
    @endif
@endsection

@section('custom-js')
    <script>
        $(document).ready(function() {
            // Check if there is a stored search value in local storage
            var savedSearchValue = localStorage.getItem('searchValue');

            // If there is a stored search value, set it as the input value
            if (savedSearchValue) {
                $('#searchInput').val(savedSearchValue);
                setCursorToEnd($('#searchInput'));
            }

            // Set focus on the search input
            $('#searchInput').focus();

            // Event listener for input changes
            $('#searchInput').on('input', function() {
                // Save the search value to local storage
                localStorage.setItem('searchValue', $(this).val());
            });

            // Event listener for button click
            $('#searchButton').on('click', function() {
                // Submit the form when the button is clicked
                $('#searchForm').submit();
            });

            // Event listener for form submission
            $('#searchForm').on('submit', function() {
                // Save the search value to local storage
                localStorage.setItem('searchValue', $('#searchInput').val());
                // Your form submission logic here if needed
            });

            // Function to set cursor position at the end of the input
            function setCursorToEnd(input) {
                var len = input.val().length;
                input[0].setSelectionRange(len, len);
            }
        });
    </script>
@endsection
