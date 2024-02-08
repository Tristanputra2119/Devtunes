@extends('pages.template')

@section('title')
    Playlist {{ $playlist->title }}
@endsection

@section('custom-css')
    <style>
        /*----------Header Album---------*/
        .img-header {
            height: 300px;
            display: flex;
            position: relative;
            align-items: center;
            overflow: hidden;
            border-radius: 5px;
        }

        .img-header img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: blur(2px);
        }

        .about {
            position: absolute;
            bottom: 1px;
            left: 30px;
            text-shadow: 0 2px 5px rgb(255 255 255 / 20%);
        }

        #playAll {
            position: absolute;
            bottom: 30px;
            right: 30px;
            transform: scale(2.5);
            border: 2px solid #C45EFF;
            border-radius: 50%;
            padding: 3px 3px 3px 3px;
        }

        #playQueue {
            position: absolute;
            bottom: 20px;
            cursor: pointer;
            right: 30px;
            transform: scale(1.2);
            border: 2px solid #fff;
            border-radius: 50%;
            padding: 3px 3px 3px 3px;
        }

        .img-title {
            font-size: 32px;
            color: white;
            position: relative;
            font-weight: 700;
            mix-blend-mode: difference;
        }

        .img-status {
            margin-bottom: -5px;
            font-size: 20px;
            color: white;
            font-weight: 700;
            position: relative;
            mix-blend-mode: difference;
        }

        /*----------List Music---------*/
        .music {
            height: 100%;
            background-color: black;
            border-radius: 5px;
            margin-top: 30px;
            padding: 10px;
        }

        .music table {
            border-collapse: collapse;
            width: 100%;
            color: white;
        }

        .music thead th {
            border-bottom: 1px solid gray;
        }

        .img-music {
            width: 50px;
            height: 50px;
            margin: 10px 0;
        }

        .img-music img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 5px;
        }

        .flex-container {
            display: flex;
        }

        .music-title {
            padding-left: 10px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: start;
            margin-top: 10px;
            color: white;
        }

        .music-title p:nth-child(1) {
            font-size: 16px;
            font-weight: 400;
            margin-bottom: -5px;
            text-overflow: ellipsis;
            overflow: hidden;
            display: -webkit-box !important;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }

        .music-title p:nth-child(2) {
            font-size: 16px;
            font-weight: 400;
            text-overflow: ellipsis;
            overflow: hidden;
            display: -webkit-box !important;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }

        /*----------Playing Music Right Top---------*/
        .playing {
            height: auto;
            background-color: black;
            border-radius: 5px;
            margin-top: 20px;
            padding: 20px;
        }

        .playing img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 5px;
        }

        .playing .music-title p:nth-child(1) {
            font-size: 24px;
            padding-bottom: 10px;
        }

        .playing .music-title p:nth-child(2) {
            font-size: 18px;
        }

        /*----------Queue Music---------*/
        .queue {
            height: auto;
            background-color: black;
            border-radius: 5px;
            margin-top: 30px;
            padding: 20px;
            color: white;
        }

        .queue h1 {
            font-size: 22px;
        }

        .queue .play-item {
            position: relative;
        }

        .queue .play {
            bottom: 20px;
            right: 30px;
        }

        .queue .time {
            margin-top: 40px;
        }

        .queue .flex-container {
            margin-top: 18px;
        }

        /*----------Music Control---------*/
        .music-control {
            height: auto;
            background-color: black;
            border-radius: 5px;
            margin-top: 30px;
            transition: border 0.3s, bottom 0.3s;
            padding: 20px;
            color: white;
            border: 0px solid white;
        }

        #progress {
            -webkit-appearance: none;
            width: 100%;
            height: 3px;
            background: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        #progress::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 15px;
            height: 15px;
            background: #C45EFF;
            border-radius: 50%;
        }

        .player-container {
            display: flex;
            align-items: center;
        }

        /* Style for the progress bar */
        input[type=range] {
            width: 100%;
            margin: 0 10px;
        }

        #currentTime,
        #duration {
            font-size: 14px;
            color: #fff;
        }

        .playPauseButton {
            border: 3px solid #C45EFF;
            border-radius: 50%;
            padding: 3px 3px 3px 3px;
        }

        .playPauseButton.disabled {
            border: 3px solid #888;
        }

        .nextButton svg {
            transform: rotate(180deg);
        }

        .button-custom {
            justify-content: center;
            align-items: center;
            display: flex;
            scale: 1.3;
            cursor: pointer;
            gap: 30px;
            margin: 15px 0;
        }

        .button-custom a {
            display: inline-block;
        }

        @media screen and (max-width:1000px) {
            .queue {
                display: none;
            }

            .button-custom {
                scale: 1;
            }

            .img-header {
                height: 160px;
            }

            .playing {
                display: none;
            }

            .music-control {
                margin-top: 66px;
            }

            .music-control.sticky {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                width: 100%;
                transition: border 0.3s, bottom 0.3s;
                z-index: 1000;
                background-color: black;
                border-radius: 5px;
                padding: 20px;
                color: white;
                border-top: 1px solid white;
            }
        }

        .number_list {
            position: relative;
            cursor: pointer;
        }

        .list_music_play {
            position: absolute;
            bottom: 25px;
            right: -5px;
            border: 2px solid #fff;
            border-radius: 50%;
            padding: 3px 3px 3px 3px;
        }

        .content-playing {
            display: none;
        }

        .img-playing {
            height: 270px;
        }

        .hidden {
            display: none;
        }

        .input-group {
            position: relative;
        }

        #searchInput {
            opacity: 0;
            display: none;
            width: 0;
            transition: opacity 1s, width 1s ease;
            /* Add transition for smooth effect */
        }

        #searchInput.active {
            opacity: 1;
            display: flex;
            width: 200px;
        }

        #searchButton {
            transition: boder 1s;
            border: 0;
        }

        #searchButton.active {
            border: 1px solid white;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="img-header">
                            <img src="{{ asset('storage/' . $playlist->image) }}" class="img-fluid" alt="">
                            <div class="about">
                                <p class="img-status">{{ $playlist->user->name }}</p>
                                <p class="img-title">{{ $playlist->title }}</p>
                            </div>
                            <a href="">
                                <a id="playAllHeader">
                                    <svg id="playAll" class="play-button" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="#C45EFF">
                                        <path d="M8 5v14l11-7z" />
                                    </svg>
                                    <svg id="pauseAll" class="pause-button" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" style="display: none;"
                                        fill="#C45EFF">
                                        <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
                                    </svg>
                                </a>
                            </a>

                            </a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="music">

                            {{-- <div class="container mt-2 mb-3">
                                <form id="searchForm" method="GET" class="form-inline" style="width: 300px;">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" id="searchInput"
                                            placeholder="Search..." aria-label="Search" value="{{ $search }}">
                                        <button class="btn" type="button" id="searchButton">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="#fff" class="bi bi-search" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div> --}}

                            <table class="no-footer" width="100%" cellspacing="0" role="grid">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th style="padding: 0 0 0 30px;">Title</th>
                                        <th>Views</th>
                                        <th>Duration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($music as $key => $item)
                                        <tr>
                                            <td class="text-center number_list">
                                                <a href="#" id="number">
                                                    <p class="number">{{ $key + 1 }}</p>
                                                </a>
                                                <a class="list_music_play" style="display: none;" data-index="">
                                                    <svg class="play-button" data-music-id="{{ $item->id }}"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="#fff">
                                                        <path d="M8 5v14l11-7z" />
                                                    </svg>
                                                    <svg class="pause-button" data-music-id="{{ $item->id }}"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" style="display: none;" fill="#fff">
                                                        <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
                                                    </svg>
                                                </a>
                                            </td>

                                            <td class=" flex-container" style="padding: 0 0 0 30px;">
                                                <div class="img-music">
                                                    <img src="{{ asset('storage/' . $item->image) }}"
                                                        alt="{{ $item->title }}" id="list_image">
                                                </div>
                                                <div class="music-title">
                                                    <p id="list_title">{{ $item->title }}</p>
                                                    <p id="list_composer">{{ $item->composer }}</p>
                                                </div>
                                            </td>
                                            <audio src="{{ asset('storage/' . $item->file) }}" class="list_music"
                                                data-music-id="{{ $item->id }}"></audio>
                                            <td data-music-id="{{ $item->id }}">{{ $item->views }}</td>
                                            <td class="list_time">00:00</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-white">
                                                <h3 class="mt-5 mb-3 text-white ">No playlists found.</h3>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="playing">
                            <div class="img-playing">
                                <img src="{{ asset('storage/' . $playlist->image) }}" alt=""
                                    class="img-fluid img_show">
                            </div>
                            <div class="music-title">
                                <p class="title_show">{{ $playlist->user->name }}</p>
                                <p class="composer_show">{{ $playlist->title }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="queue">
                            <h1>Next in Queue</h1>
                            <div class="music-queue">
                                @foreach ($queue as $key => $item)
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="flex-container">
                                                <div class="img-music">
                                                    <img src="{{ asset('storage/' . $item->image) }}" alt=""
                                                        id="queue_image">
                                                </div>
                                                <div class="music-title">
                                                    <p id="queue_title">{{ $item->title }}</p>
                                                    <p id="queue_composer">{{ $item->composer }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="text-center time queue_time">30:00</div>
                                        </div>
                                        <audio src="{{ asset('storage/' . $item->file) }}" class="queue_music"
                                            data-music-id="{{ $item->id }}"></audio>
                                        <div class="col-lg-3
                                            play-item">
                                            <a id="playQueue">
                                                <svg class="play-button" data-music-id="{{ $item->id }}"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="#fff">
                                                    <path d="M8 5v14l11-7z" />
                                                </svg>
                                                <svg class="pause-button hidden" data-music-id="{{ $item->id }}"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="#fff">
                                                    <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-12">
                        <div class="music-control">
                            <div class="button-custom">
                                <a class="previousButton">
                                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="#fff"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 7V17" stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M17.0282 5.2672C17.4217 4.95657 18 5.23682 18 5.73813V18.2619C18 18.7632 17.4217 19.0434 17.0282 18.7328L9.09651 12.4709C8.79223 12.2307 8.79223 11.7693 9.09651 11.5291L17.0282 5.2672Z"
                                            stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </a>

                                <a type="button" class="playPauseButton">
                                    <svg id="playButton" class="play-button" data-music-id="{{ $item->id }}"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="#C45EFF">
                                        <path d="M8 5v14l11-7z" />
                                    </svg>
                                    <svg id="pauseButton" class="pause-button" data-music-id="{{ $item->id }}"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" style="display: none;" fill="#C45EFF">
                                        <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
                                    </svg>
                                </a>

                                <a type="button" class="nextButton">
                                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="#fff"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 7V17" stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M17.0282 5.2672C17.4217 4.95657 18 5.23682 18 5.73813V18.2619C18 18.7632 17.4217 19.0434 17.0282 18.7328L9.09651 12.4709C8.79223 12.2307 8.79223 11.7693 9.09651 11.5291L17.0282 5.2672Z"
                                            stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>

                            <div class="player-container">
                                <span id="currentTime">0:00</span>
                                <input type="range" class="custom-range" id="progress" min="0" max="100"
                                    value="0">
                                <span id="duration">0:00</span>
                            </div>

                            <div class="content-playing">
                                <audio controls class="audioPlayer" src=""></audio>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <!-- search music -->
    <script>
        $(document).ready(function() {
            // Check if there is a stored search value in local storage
            var savedSearchValue = localStorage.getItem('searchValue');

            // If there is a stored search value, set the input as active and populate the value
            if (savedSearchValue) {
                $("#searchInput").addClass("active").val(savedSearchValue);
                setCursorToEnd($("#searchInput"));
            }

            // Add click event handler for the search button
            $("#searchButton").on("click", function() {
                // If the search input is not active, make it active
                if (!$("#searchInput").hasClass("active")) {
                    $("#searchInput").addClass("active");
                    setCursorToEnd($("#searchInput"));
                } else {
                    // If the search input is already active, submit the form
                    $('#searchForm').submit();
                }
            });

            // Set focus on the search input
            $('#searchInput').focus();

            // Event listener for input changes
            $('#searchInput').on('input', function() {
                // Save the search value to local storage
                localStorage.setItem('searchValue', $(this).val());
            });

            // Event listener for form submission
            $('#searchForm').on('submit', function() {
                // Save the search value to local storage
                localStorage.setItem('searchValue', $('#searchInput').val());
            });

            // Function to set cursor position at the end of the input
            function setCursorToEnd(input) {
                var len = input.val().length;
                input[0].setSelectionRange(len, len);
            }
        });
    </script>
    <!-- list music -->
    <script>
        $(document).ready(function() {
            //button list Music
            $('.list_music_play').hide();

            //item number
            $('.number_list').hover(
                function() {
                    $(this).find('.number').hide();
                    $(this).find('.list_music_play').show();
                },
                function() {
                    $(this).find('.list_music_play').hide();
                    $(this).find('.number').show();
                }
            );
            //get all list music
            const musicList = document.querySelectorAll('.list_music_play');

            //get audio player + control buttons
            const audioPlayer = document.querySelector('.audioPlayer');
            const playPauseButton = document.querySelector('.playPauseButton');
            const previousButton = document.querySelector('.previousButton');
            const nextButton = document.querySelector('.nextButton');
            const playButton = document.getElementById('playButton');
            const pauseButton = document.getElementById('pauseButton');
            const progress = document.getElementById('progress');
            const currentTime = document.getElementById('currentTime');
            const duration = document.getElementById('duration');

            // Function to update playing music details
            function updatePlayingDetails(imageSrc, title, composer) {
                $('.img_show').attr('src', imageSrc);
                $('.title_show').text(title);
                $('.composer_show').text(composer);
            }

            //variable to track current playing music
            let currentMusic = null;

            //function to play music based on index
            async function playMusic(index) {
                //pause current audio(if on)
                await audioPlayer.pause();
                //get selected audio source from list music
                const listAudio = document.querySelectorAll('.list_music')[index];
                const audioListSrc = listAudio.getAttribute('src');
                const musicRow = $('tbody tr').eq(index);
                const imageSrc = musicRow.find('.img-music img').attr('src');
                const title = musicRow.find('#list_title').text();
                const composer = musicRow.find('#list_composer').text();
                //set the audio and play
                audioPlayer.src = audioListSrc;
                await audioPlayer.play();
                // Update current music
                currentMusic = index;

                audioPlayer.addEventListener('ended', async function() {
                    // Play the next song when the current one ends
                    if (currentMusic < musicList.length - 1) {
                        await playMusic(currentMusic + 1);
                    } else {
                        await audioPlayer.pause();
                    }
                });
                updatePlayingDetails(imageSrc, title, composer);
            }
            //click event listener for list items
            musicList.forEach((item, index) => {
                item.addEventListener('click', function(event) {
                    event.preventDefault();
                    playMusic(index);
                });
            });

            //queue_music function
            const queueMusicList = document.querySelectorAll('.queue_music');
            const queuePlayButtons = document.querySelectorAll('.play-item');

            let currentQueueMusic = null;

            async function playQueueMusic(index) {
                await audioPlayer.pause();
                const queueAudioSrc = queueMusicList[index];
                const audioSrc = queueAudioSrc.getAttribute('src');
                const imageSrc = queueAudioSrc.parentNode.querySelector('#queue_image').getAttribute(
                    'src');
                const title = queueAudioSrc.parentNode.querySelector('#queue_title').textContent;
                const composer = queueAudioSrc.parentNode.querySelector('#queue_composer').textContent;
                audioPlayer.src = audioSrc;
                await audioPlayer.play();
                currentQueueMusic = index;

                audioPlayer.addEventListener('ended', async function() {
                    if (currentQueueMusic < queueMusicList.length - 1) {
                        await playQueueMusic(currentQueueMusic + 1);
                    } else {
                        await audioPlayer.pause();
                    }
                });
                updatePlayingDetails(imageSrc, title, composer);
            }

            queuePlayButtons.forEach((button, index) => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    playQueueMusic(index);
                });
            });

            $('#playAllHeader').on('click', function(event) {
                event.preventDefault();

                playMusic(0);
            });

            //play / pause button click event listener
            playPauseButton.addEventListener('click', function() {
                if (audioPlayer.paused) {
                    audioPlayer.play();
                    playButton.style.display = 'none';
                    pauseButton.style.display = 'inline-block';
                } else {
                    audioPlayer.pause();
                    playButton.style.display = 'inline-block';
                    pauseButton.style.display = 'none';
                }
            });

            //previous button
            previousButton.addEventListener('click', function() {
                if (currentMusic > 0) {
                    playMusic(currentMusic - 1);
                } else {
                    playMusic(musicList.length - 1);
                }
            });

            //next button
            nextButton.addEventListener('click', function() {
                if (currentMusic < musicList.length - 1) {
                    playMusic(currentMusic + 1);
                } else {
                    playMusic(0);
                }
            });

            // Update progress bar and time
            audioPlayer.addEventListener('timeupdate', function() {
                if (!isNaN(audioPlayer.duration)) {
                    currentTime.textContent = formatTime(audioPlayer.currentTime);
                    duration.textContent = formatTime(audioPlayer.duration);
                    progress.value = (audioPlayer.currentTime / audioPlayer.duration) * 100 || 0;
                }
            });

            // Function to format time (in minutes and seconds)
            function formatTime(seconds) {
                const minutes = Math.floor(seconds / 60);
                const secs = Math.floor(seconds % 60);
                return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
            }

        });
    </script>
    <!-- update views -->
    <script>
        $(document).ready(function() {
            // Listen for 'play' event on audio elements with 'list_music' class
            $('.play-button').on('click', function() {
                const musicId = $(this).data('music-id'); // Get the music ID from data attribute

                // Send AJAX request to update views count based on the music ID for 'list_music'
                updateViews(musicId);
            });

            // Function to update views count via AJAX
            function updateViews(musicId) {
                $.ajax({
                    type: 'POST',
                    url: '/music/' + musicId + '/update-views',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        console.log('View count updated successfully');
                        const viewCountElement = $(`td[data-music-id="${musicId}"]`);
                        const currentViews = parseInt(viewCountElement.text());
                        viewCountElement.text(currentViews + 1);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating view count:', error);
                    }
                });
            }
        });
    </script>
    <!-- duration list music -->
    <script>
        $(document).ready(function() {
            const listMusicElements = $(".list_music");

            listMusicElements.each(function(index, audio) {
                const $audio = $(audio);

                if (!isNaN(audio.duration) && audio.duration > 0) {
                    // Metadata is already loaded, update immediately
                    const listTime = $(".list_time").eq(index);
                    listTime.text(formatTime(audio.duration));
                } else {
                    // Attach event listener to handle metadata loaded event
                    audio.onloadedmetadata = function() {
                        const listTime = $(".list_time").eq(index);
                        listTime.text(formatTime(audio.duration));
                    };
                }
            });
            //function to format time (in minutes and seconds)
            function formatTime(seconds) {
                const minutes = Math.floor(seconds / 60);
                const secs = Math.floor(seconds % 60);
                return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
            }
        });
    </script>
    <!-- duration queue music -->
    <script>
        $(document).ready(function() {
            const audioElements = $(".queue_music");

            audioElements.each(function(index, audio) {
                const $audio = $(audio);

                if (!isNaN(audio.duration) && audio.duration > 0) {
                    const queueTime = $(".queue_time").eq(index);
                    queueTime.text(formatTime(audio.duration));
                } else {
                    audio.onloadedmetadata = function() {
                        const queueTime = $(".queue_time").eq(index);
                        queueTime.text(formatTime(audio.duration));
                    };
                }
            });

            //function to format time (in minutes and seconds)
            function formatTime(seconds) {
                const minutes = Math.floor(seconds / 60);
                const secs = Math.floor(seconds % 60);
                return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
            }
        });
    </script>
@endsection
