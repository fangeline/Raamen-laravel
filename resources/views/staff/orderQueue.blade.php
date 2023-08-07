@extends('layout.staffNav')

@section('content')
    {{ Auth::user()->username }}
@endsection