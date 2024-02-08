@extends('pages.template')

@section('title')
Home
@endsection

@section('custom-css')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 col-6-custom">
            <h1 class="main-text">
                Welcome to the Sound of Harmony
            </h1>
            <p class="sub-text"> Experience the magic of music like never before. Dive into a world where
                melodies paint
                emotions,
                and rhythm guides your journey.</p>
            <div class="row">
                @foreach ($playlist as $item)
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <a href="{{ url('/playlist/' . $item->id) }}">
                        <div class="playlist-item">
                            <img class="playlist-item-thumbnail" src="{{ asset('storage/' . $item->image) }}"
                                alt="Playlist item 1" class="img-fluid">
                            <div class="playlist-item-info">
                                <p class="playlist-item-title">{{ $item->title }}</p>
                                <a href="{{ url('/playlist/' . $item->id) }}" class="playlist-item-button">
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
        <div class="col-6">
            <div class="mod-container container">
                <div class="img-header">
                    <img src="#" class="img-full">
                    <!-- <div class="ambient-light"></div> -->
                </div>

                <div class="swiper music-slider">
                    <div class="swiper-wrapper">
                        @foreach ($music as $item)
                        <!-- Slide-start -->
                        <div class="playlist-newest swiper-slide">
                            <div class="playlist-item-info">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="" class="img-album">
                                <div class="border-info">
                                    <p class="playlist-item-title">{{ $item->title }}</p>
                                    <p class="playlist-item-composer">{{ $item->composer }}</p>
                                    <audio src="{{ asset('storage/' . $item->file) }}" hidden class="audio-player">
                                    </audio>
                                    <a class="playlist-item-button playPauseButton">
                                        <svg class="play-button" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="#C45EFF">
                                            <path d="M8 5v14l11-7z" />
                                        </svg>
                                        <svg class="pause-button" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" style="display: none;" fill="#C45EFF">
                                            <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                        </div>
                        <!-- Slide-end -->
                        @endforeach
                    </div>

                    <div class=" button-music">
                        <div class="swiper-button-prev up">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#C45EFF"
                                class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path
                                    d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z" />
                            </svg>
                        </div>
                        <div class="swiper-button-next down">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#C45EFF"
                                class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path
                                    d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z" />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
<script>
    var musicSlider = new Swiper('.music-slider', {
            effect: 'coverflow',
            grabCursor: true,
            slidesPerView: 3,
            centeredSlides: true,
            direction: 'vertical',
            loop: false,
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 100,
                modifier: 1.5,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            initialSlide: 1,
            on: {
                slideChange: function() {
                    var activeSlide = this.slides[this.activeIndex];
                    var activeImage = activeSlide.querySelector('.img-album');
                    var imgFull = document.querySelector(".img-full");
                    var imgAlbumSrc = activeImage.getAttribute('src');
                    imgFull.setAttribute('src', imgAlbumSrc);

                    var slides = this.slides;
                    for (var i = 0; i < slides.length; i++) {
                        if (i === this.activeIndex) {
                            slides[i].classList.add('active-slide');
                        } else {
                            slides[i].classList.remove('active-slide');
                        }
                    }
                },
            },
        });

</script>

<script>
    $(document).ready(function () {
    var currentAudio = null; // Variable to store the currently playing audio

    $(".playPauseButton").on('click', function () {
        var container = $(this).closest('.playlist-item-info');
        var audio = container.find('.audio-player')[0];

        if (!isAudioSrcEmpty(audio)) {
            if (audio.paused) {
                // Pause any currently playing audio
                if (currentAudio) {
                    currentAudio.pause();
                    var currentContainer = $(currentAudio).closest('.playlist-item-info');
                    currentContainer.find('.pause-button').hide();
                    currentContainer.find('.play-button').show();
                }

                // Start playing the clicked audio
                audio.play();
                container.find('.play-button').hide();
                container.find('.pause-button').show();
                currentAudio = audio;
            } else {
                // Pause the clicked audio
                audio.pause();
                container.find('.pause-button').hide();
                container.find('.play-button').show();
                currentAudio = null;
            }
        }
    });

    $(".audio-player").on('play', function () {
        var container = $(this).closest('.playlist-item-info');
        container.find('.play-button').hide();
        container.find('.pause-button').show();
        currentAudio = this;
    });

    $(".audio-player").on('pause', function () {
        var container = $(this).closest('.playlist-item-info');
        container.find('.pause-button').hide();
        container.find('.play-button').show();
        if (currentAudio === this) {
            currentAudio = null;
        }
    });

    function isAudioSrcEmpty(audio) {
        return audio.src === "";
    }
});

</script>
@endsection