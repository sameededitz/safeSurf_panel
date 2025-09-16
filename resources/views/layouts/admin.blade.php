<!doctype html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body class="fixed-left">

    <!--sidebar wrapper -->
    @include('partials.sidebar')
    <!--end sidebar wrapper -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>
    <div id="wrapper">
        <div class="content-page">
            <div class="content">

                <!--start page content -->
                @yield('content')
                <!--end page content -->

            </div>
        </div>
    </div>

    <footer class="footer d-flex justify-content-between">
        <p class="mb-0"> © {{ date('Y') }} Copyright by Safesurf.pro</p>
        <p class="mb-0">Powered by <a href="https://www.tecclubx.com">TecClub</a></p>
    </footer>
    </div>
    <!--end wrapper-->

    @include('partials.scripts')
    
    <!-- Sweet Toast Notifications -->
    <x-sweet-toast />
</body>

</html>
