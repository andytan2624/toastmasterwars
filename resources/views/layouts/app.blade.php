@include('layouts.partials.header')

<body id="app-layout">

@include('layouts.partials.nav')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        @yield('content')
    </div>
</div>

@include('layouts.partials.footer')


