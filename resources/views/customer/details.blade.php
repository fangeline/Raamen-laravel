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
        <link href="{{ asset('template/css/steller.css') }}" rel="stylesheet">

        <div class="container" style="margin-top: 100px">
            @if (session('success_message'))
                <div class="alert alert-success" style="margin-top: 50px">
                    {{ session('success_message') }}
                </div>
            @endif

            @if (session('error_message'))
                <div class="alert alert-danger" style="margin-top: 50px">
                    {{ session('error_message') }}
                </div>
            @endif

            <div>
                <div style="max-width: 40%; max-height: 40px; float: left; margin: 20px 0px">
                    <h2>Order Details</h2>
                </div>
            </div>
            <form method="post">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col" style="text-align: center">Order ID</th>
                        <th scope="col" style="text-align: center">Ramen Name</th>
                        <th scope="col" style="text-align: center">Quantity</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($details as $item)
                            <tr>
                                <td>{{ $item['id'] }}</td>
                                <td>{{ $item->ramen->name }}</td>
                                <td>{{ $item['quantity'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $details->withQueryString()->links() }}
                </div>
            </form>
            <script src="{{ asset('template/assets/js/config.js') }}"></script>

            <script src="{{ asset('template/assets/vendor/libs/jquery/jquery.js') }}"></script>
        </div>
    </main>

    <script src="template/js/steller.js"></script>
    <script src="template/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="template/vendors/bootstrap/bootstrap.bundle.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>