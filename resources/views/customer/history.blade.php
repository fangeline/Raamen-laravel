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
            @if (isset($success_message))
                <div class="alert alert-success" style="margin-top: 50px">
                    {{ session('success_message') }}
                </div>
            @endif

            @if (isset($error_message))
                <div class="alert alert-danger" style="margin-top: 50px">
                    {{ session('error_message') }}
                </div>
            @endif

            <div>
                <div style="max-width: 40%; max-height: 40px; float: left; margin: 20px 0px">
                    <h2>History</h2>
                </div>
                {{-- <div style="width: 30%; float: right; margin-top: 25px; margin-right: 5px">
                    <input type="text" class="form-control form-control-sm" name="keyword" id="keyword" placeholder="Search by username..." value="{{ $keyword }}">
                </div> --}}
            </div>
            <form method="post">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col" style="text-align: center">Id</th>
                        <th scope="col" style="text-align: center">Customer ID</th>
                        <th scope="col" style="text-align: center">Customer Name</th>
                        <th scope="col" style="text-align: center">Staff ID</th>
                        <th scope="col" style="text-align: center">Date</th>
                        <th scope="col" style="text-align: center">Status</th>
                        <th scope="col" style="text-align: center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($history as $item)
                        @if ($item['staff_id'] == '0')
                            <tr>
                                <td>{{ $item['id'] }}</td>
                                <td>{{ $item['customer_id'] }}</td>
                                <td>{{ $item->customer->username }}</td>
                                <td>{{ $item['staff_id'] }}</td>
                                <td>{{ $item['created_at'] }}</td>
                                <td>Unhandled</td>
                                <td style="text-align: center">
                                    <form method="post">
                                        <a class="- btn btn-outline-secondary rounded small" style="min-width: 70px" href="{{ route('detail.member', $item['id']) }}">Details</a>
                                    </form>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td>{{ $item['id'] }}</td>
                                <td>{{ $item['customer_id'] }}</td>
                                <td>{{ $item->customer->username }}</td>
                                <td>{{ $item['staff_id'] }}</td>
                                <td>{{ $item['created_at'] }}</td>
                                <td>Handled</td>
                                <td style="text-align: center">
                                    <form method="post">
                                        <a class="- btn btn-outline-secondary rounded small" style="min-width: 70px" href="{{ route('detail.member', $item['id']) }}">Details</a>
                                    </form>
                                </td>
                            </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $history->withQueryString()->links() }}
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