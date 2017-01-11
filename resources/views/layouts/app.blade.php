@include('layouts.partials.header')

<body id="app-layout">

@include('layouts.partials.nav')

<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        @yield('content')
    </div>
</div>

@include('layouts.partials.footer')


