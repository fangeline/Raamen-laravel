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
        <div class="container" style="margin-top: 100px;">
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
            <h2 style="max-width: 30%; float: left">Menu</h2>
            <input style="max-width: 31%; float: right" type="text" class="form-control form-control-sm" name="keyword" id="keyword" placeholder="Search..." value="{{ $keyword }}">
        </div>
        <br><br>
        <div class="container text-center" style="margin-top: 10px">
            <div class="row text-left">
            @foreach ($ramen as $item)
                <div class="col-md-4">
                    <div class="card border mb-4">
                        <div class="card-body text-center">
                            <h4 class="card-title">{{ $item->name }}</h4>
                            <hr>
                            <h6>Meat: {{ $item->meat->name}} | Broth: {{ $item->broth }}</h6>
                            <p>Price: {{ $item->price }}</p>
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addCart-{{$item->id}}">Add to cart</button>
                            
                            <!-- Modal -->
                            <form action="{{ route('storeCart.member', $item->id) }}" method="post">
                            @csrf
                                <div class="modal fade" id="addCart-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="addQuantity" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 400px; display: flex; justify-content: center">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">{{ $item->name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body text-center" style="max-width: 200px; margin: 0 auto">
                                            <label for="quantity">Select Quantity</label>
                                            <div class="input-group text-center mb-3">
                                                <button class="input-group-text decrement-btn">-</button>
                                                <input type="text" name="quantity" class="form-control text-center qtyInput" value="1">
                                                <button class="input-group-text increment-btn">+</button>
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="margin: 0 auto">
                                            <button type="submit" class="btn btn-primary">Add to cart</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
    
        <script>
            var input = document.getElementById("keyword");
    
            input.addEventListener("keypress", function(event) {
    
                if (event.keyCode == 13) {
                    window.location.href = "{{ url('/memberHome/?keyword=') }}" + $("#keyword").val();
                }
            });
    
            $(document).ready(function () {
                $('.increment-btn').click(function (e) {
                    e.preventDefault();
    
                    var increment = $('.qtyInput').val();
                    var value = parseInt(increment, 10);
                    value = isNaN(value) ? 0 : value;
                    if(value < 10)
                    {
                        value++;
                        $('.qtyInput').val(value);
                    }
                });
    
                $('.decrement-btn').click(function (e) {
                    e.preventDefault();
    
                    var decrement = $('.qtyInput').val();
                    var value = parseInt(decrement, 10);
                    value = isNaN(value) ? 0 : value;
                    if(value > 0)
                    {
                        value--;
                        $('.qtyInput').val(value);
                    }
                });
            });
        </script>
    </main>

    <script src="template/js/steller.js"></script>
    <script src="template/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="template/vendors/bootstrap/bootstrap.bundle.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>