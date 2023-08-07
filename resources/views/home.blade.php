@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if(auth()->user()->role == 'staff')
                        <a href="{{ route('staff.home') }}">Staff</a>
                    @endif

                    @if(auth()->user()->role == 'member')
                        <a href="{{ route('member.home') }}">Member</a>
                    @endif
                    
                    @if(auth()->user()->role == 'admin')
                        <a href="{{ route('admin.home') }}">Admin</a>
                    @endif

                    {{ Auth::user()->username }}
                    <br>
                    {{ $msg }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
