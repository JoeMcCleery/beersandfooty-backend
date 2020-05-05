@extends('errors::minimal')

@section('title', __('Beers and Footy - Server Error'))
@section('code', '500')
@section('message', __('Server Error'))

@section('Header')
    <h1>
        Beers and Footy - API
    </h1>
    <img src="/images/beersandfooty_logo_01.png" height="150px">
@endsection
