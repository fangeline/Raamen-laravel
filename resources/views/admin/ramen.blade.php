@extends('layout.adminNav')

@section('content')
    {{ Auth::user()->username }}
@endsection