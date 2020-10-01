<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Codedigger provides you handpicked problems from top 4 coding sites i.e. Codeforces, Codechef, UVa and SPOJ which will increase your versatility in competitive programming.">
    <meta name="keywords" content="codedigger tech competitive programming topiwise ladder problems">
    <meta name="author" content="Shivam Singhal">

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-M4G8GBD');</script>
<!-- End Google Tag Manager -->

<!-- Ad sense Code -->

<script data-ad-client="ca-pub-5867313035253621" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')

    <link rel = "icon" href =  {{asset('logo.png')}} 
        type = "image/x-icon"> 

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Metal+Mania&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    

</head>
<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M4G8GBD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <div id="app">

        @auth
            @include('inc.sidebar')
        @endauth
        <div class="main-container">
            @include('inc.session')
            
            @yield('content')
        </div>

    </div>
    <a class="back-to-top inner-link" href="#" data-scroll-class="100vh:active">
        ~
    </a>

        {{-- Theme Scripts --}}
        <script src="{{ asset('js/app/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('js/app/flickity.min.js') }}"></script>
        <script src="{{ asset('js/app/parallax.js') }}"></script>
        <script src="{{ asset('js/app/typed.min.js') }}"></script>
        <script src="{{ asset('js/app/datepicker.js') }}"></script>
        <script src="{{ asset('js/app/isotope.min.js') }}"></script>
        <script src="{{ asset('js/app/lightbox.min.js') }}"></script>
        <script src="{{ asset('js/app/granim.min.js') }}"></script>
        <script src="{{ asset('js/app/jquery.steps.min.js') }}"></script>
        <script src="{{ asset('js/app/countdown.min.js') }}"></script>
        <script src="{{ asset('js/app/spectragram.min.js') }}"></script>
        <script src="{{ asset('js/app/smooth-scroll.min.js') }}"></script>
        <script src="{{ asset('js/app/scripts.js') }}"></script>
        
        </script>

        <script>
            $(document).ready(function () {
                $('.tab__content section.switchable').mouseenter(function () {
                    $(this).append('<div class="switchable-toggle label">Switch Sides</div>');
                });
                $('.tab__content section.switchable').mouseleave(function () {
                    $(this).find('.switchable-toggle').remove();
                });
                $(document).on('click', '.switchable-toggle', function () {
                    $(this).closest('section').toggleClass('switchable--switch');
                });
            });
        </script>

        {{-- Page Scripts --}}
        @yield('scripts')

</body>
</html>
