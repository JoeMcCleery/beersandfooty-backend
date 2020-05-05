@extends('errors::minimal')

@section('title', __('Beers and Footy - Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))

@section('Header')
    <h1>
        Beers and Footy - API
    </h1>
    <img src="/images/beersandfooty_logo_01.png" height="150px">
@endsection
