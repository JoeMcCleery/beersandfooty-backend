@extends('errors::minimal')

@section('title', __('Beers and Footy API - Page Not Found'))
@section('code', '404')
@section('message', __($exception->getMessage() ?: 'Page Not Found'))
