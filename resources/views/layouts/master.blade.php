<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @php $setting = \App\Models\Setting::first(); @endphp

    <link rel="shortcut icon" href="{{ asset("$setting->favicon") }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body class="{{strtolower(App\Models\Themesetting::find(1)->color)}}">
    @include('includes.header')
    <div id="app">
        <main>
            @include('includes.side')

            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    @yield('js')

    <script>        
        $(document).on("click",".dropdown-btn",function() {
            var dropdownContent = this.nextElementSibling;
            
            if (dropdownContent.style.display === "block") {
                //dropdownContent.style.display = "none";
                $(dropdownContent).fadeOut();
                $(this).find('a').find('i.angle-icon').removeClass('fa-angle-down')
                $(this).find('a').find('i.angle-icon').addClass('fa-angle-left')
            } else {
                $(".dropdown-container").css("display", "none");
                //dropdownContent.style.display = "block";
                $(dropdownContent).fadeIn();
                $(this).find('a').find('i.angle-icon').removeClass('fa-angle-left')
                $(this).find('a').find('i.angle-icon').addClass('fa-angle-down')
            }
        });

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $('.container').toggleClass('update-container');
            $('body').toggleClass('scroll');
            $("#sidebar").attr('style','');
        });
    </script>
</body>
</html>
