@extends('layouts.template')

@section('content')
<h1>Logado</h1>
<a href="{{route('logout')}}" onclick="event.preventDefault();
document.getElementById('form-logout').submit()">Logout</a>
<form id="form-logout" action="{{route('logout')}}" method="POST" style="display: none;">
    @csrf
</form>



@endsection
