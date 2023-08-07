@extends('layouts.adminNav')

@section('content')
<link href="{{ asset('template/css/steller.css') }}" rel="stylesheet">

<div class="container" style="margin-top: 50px">
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

    <h2 style="margin: 20px 0px">Ramen</h2>

    <div>
        <div style="width: 25%; float: left; margin-bottom: 10px">
            <form action="{{ route('createRamen.admin') }}">
                <button class="btn btn-outline-secondary rounded small" style="min-width: 70px">+ Add Ramen</button>
            </form>
        </div>
        <div style="width: 30%; float: right; margin-top: 5px; margin-right: 10px">
            <input type="text" class="form-control form-control-sm" name="keyword" id="keyword" placeholder="Search..." value="{{ $keyword }}">
        </div>
    </div>
    <form method="post">
        <table class="table table-striped">
            <thead>
               <tr>
                  <th scope="col" style="text-align: center">Name</th>
                  <th scope="col" style="text-align: center">Broth</th>
                  <th scope="col" style="text-align: center">Price</th>
                  <th scope="col" style="text-align: center">Action</th>
               </tr>
            </thead>
            <tbody>
                @foreach ($ramen as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['broth'] }}</td>
                        <td>{{ $item['price'] }}</td>
                        <td style="text-align: center">
                            <form method="post">
                                <a class="- btn btn-outline-secondary rounded small" style="min-width: 70px" href="{{ route('deleteRamen.admin', $item['id']) }}">Delete</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
         </table>
        <div class="d-flex justify-content-center">
            {{ $ramen->withQueryString()->links() }}
        </div>
    </form>
    <script src="{{ asset('template/assets/js/config.js') }}"></script>

    <script src="{{ asset('template/assets/vendor/libs/jquery/jquery.js') }}"></script>
</div>

<script>
    var input = document.getElementById("keyword");

    input.addEventListener("keypress", function(event) {

        if (event.keyCode == 13) {
            window.location.href = "{{ url('/raamen/?keyword=') }}" + $("#keyword").val();
        }
    });
</script>

@endsection