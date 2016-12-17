@include('layouts.partials.header')

<body id="app-layout">

@include('layouts.partials.nav')

<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        @yield('content')
    </div>
</div>

@include('layouts.partials.footer')


