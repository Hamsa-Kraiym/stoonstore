@include('partials.header')

@yield('content')

<?php $script = $pageScript ?? '';?>
@include( 'partials.layoutBottom')