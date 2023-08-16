@extends('layouts.base')

@section('body')
    <div class="">
        @include('layouts.navigation')
        @yield('content')
    </div>
    @isset($slot)
        {{ $slot }}
    @endisset
    @if (Request::path() != 'register' && Request::path() != 'login')
        @include('layouts.footer')
    @endif
@endsection
