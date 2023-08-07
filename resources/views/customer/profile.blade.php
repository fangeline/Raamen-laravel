<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="icon" href="{{ url('template/imgs/ramen.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('template/css/steller.css') }}" rel="stylesheet">

    <script src="{{ asset('template/assets/js/config.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/libs/jquery/jquery.js') }}"></script>
</head>
<body>
    <!-- Page navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" data-spy="affix" data-offset-top="0">
        <div class="container">
            <a class="navbar-brand" href="#"><img src= "{{ asset('template/imgs/ramen.jpg') }}" style="padding: 5px" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.member') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('showCart.member') }}">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('history.member', $userId) }}">History</a>
                    </li>           
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('custProfile') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="- btn btn-primary rounded ml-4" href="{{ route('logout') }}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>          
    </nav>
    <!-- End of page navibation -->
    <main class="py-5">
        <link href="{{ asset('template/css/profile.css') }}" rel="stylesheet">

        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="border-right">
                    <div class="p-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <form action="{{ route('custUpdateProfile', $user->id) }}" method="POST">
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
    </main>

    <script src="template/js/steller.js"></script>
    <script src="template/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="template/vendors/bootstrap/bootstrap.bundle.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>