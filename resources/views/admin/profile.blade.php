@extends('layouts.adminNav')

@section('content')
<link href="{{ asset('template/css/profile.css') }}" rel="stylesheet">

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="border-right">
            <div class="p-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <form action="{{ route('updateProfile.admin', $user->id) }}" method="POST">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-md-12"><label for="username" class="labels">Username</label><input type="text" name="username" class="form-control" placeholder="Enter username..." value="{{ $user->username }}"></div>
                        <div class="col-md-12"><label for="email" class="labels">E-mail</label><input type="text" name="email" class="form-control" placeholder="Enter e-mail address..." value="{{ $user->email }}"></div>
                        <div class="col-md-12"><label for="password" class="labels">Password</label><input type="text" name="password" class="form-control" placeholder="Enter new password..." value=""></div>
                        <div class="col-md-12">
                            <label for="gender" class="labels">Gender</label>
                            <select name="gender" class="form-control">
                                <option selected value="{{ $user->gender }}">{{ $user->gender }}</option>
                                <option value="female">female</option>
                                <option value="male">male</option>
                            </select>
                        </div>
                        <div class="col-md-12"><label for="role" class="labels">Role</label><input type="" name="role" class="form-control" value="{{ $user->role }}"></div>
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection