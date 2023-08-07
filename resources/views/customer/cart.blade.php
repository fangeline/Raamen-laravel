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
                        @if (session('success_message'))
                            <div class="alert alert-success">
                                {{ session('success_message') }}
                            </div>
                        @endif

                        @if (session('error_message'))
                            <div class="alert alert-danger">
                                {{ session('error_message') }}
                            </div>
                        @endif
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Cart</h4>
                        </div>

                        @foreach ($cart as $item)
                            <div class="card rounded-3 mb-4">
                                <div class="card-body p-4">
                                <div class="row d-flex justify-content-between align-items-center">
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                    <p class="lead fw-normal mb-2">{{ $item->ramen->name }}</p>
                                    <p>
                                        <span class="text-muted">Broth: </span>{{ $item->ramen->broth}} 
                                        <br>
                                        <span class="text-muted">Meat: </span>{{ $item->ramen->meat->name }} 
                                        <br>
                                        <span class="text-muted">Price: </span>{{ $item->ramen->price}}
                                    </p>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex" style="max-width: 90px">
                                    <input id="form1" min="0" name="quantity" value="{{ $item->quantity }}" type="number"
                                        class="form-control form-control-sm" />
                                    </div>
                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                    <h5 class="mb-0">{{ $item->ramen->price * $item->quantity }}</h5>
                                    </div>
                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end" style="min-width: 20%; margin-right: 30px">
                                        <form action="{{ route('removeCart.member', $item->id) }}" method="post">
                                            @csrf
                                            <button class="btn btn-danger" type="submit">Remove</button>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="mt-4 text-right" style="max-width: 60%; float: right; margin: 0px 0px 20px 0px">
                            <form action="{{ route('submitCart.member') }}" method="post" style="float: left; margin-right: 10px">
                                @csrf
                                <button class="btn btn-primary profile-button" type="submit">Submit Order</button>
                            </form>
                            <form action="{{ route('home.member') }}" style="float: right">
                                <button class="btn btn-light" type="submit">Continue Shopping</button>
                            </form>
                        </div>
                        
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