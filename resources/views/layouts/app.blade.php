@include('layouts.partials.header')

<body>

@include('layouts.partials.nav')

<div class="container">
    <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-12">
            @yield('content')
        </div>
    </div>

    <hr>

    <footer>
        <p>	&copy; Andy Tan <?php echo date('Y'); ?></p>
    </footer>
</div>

@include('layouts.partials.footer')



