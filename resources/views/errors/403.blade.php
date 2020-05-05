@extends('errors::minimal')

@section('title', __('Beers and Footy API - Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
