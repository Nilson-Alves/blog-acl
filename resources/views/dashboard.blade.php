@extends('layouts.template')

@section('content')

{{-- @dd(auth()->user()->hasRole('User'))
@can('user_update') --}}

<h1> Logado </h1>
{{-- @endcan --}}

<a href="{{route('logout')}}" onclick="event.preventDefault();
document.getElementById('form-logout').submit()">Logout</a>
<form id="form-logout" action="{{route('logout')}}" method="POST" style="display: none;">
    @csrf

</form>

@endsection
