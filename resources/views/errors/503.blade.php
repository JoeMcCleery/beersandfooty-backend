@extends('errors::minimal')

@section('title', __('Beers and Footy API - Site in Maintenance'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'Site in Maintenance'))
