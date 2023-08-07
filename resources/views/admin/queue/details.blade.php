@extends('layouts.adminNav')

@section('content')
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
        {{-- <div style="width: 30%; float: right; margin-top: 25px; margin-right: 5px">
            <input type="text" class="form-control form-control-sm" name="keyword" id="keyword" placeholder="Search by username..." value="{{ $keyword }}">
        </div> --}}
    </div>
    <form method="post">
        <table class="table table-striped">
            <thead>
               <tr>
                  <th scope="col" style="text-align: center">Order ID</th>
                  <th scope="col" style="text-align: center">Ramen Name</th>
                  <th scope="col" style="text-align: center">Quantity</th>
                  <th scope="col" style="text-align: center">Action</th>
               </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($details as $item)
                    <tr>
                        <td>{{ $item['id'] }}</td>
                        <td>{{ $item->ramen->name }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td style="text-align: center">
                            <form method="post">
                                <a class="- btn btn-outline-secondary rounded small" style="min-width: 70px" href="{{ route('removeDetail.admin', $item['id']) }}">Remove</a>
                            </form>
                        </td>
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

{{-- <script>
    var input = document.getElementById("keyword");

    input.addEventListener("keypress", function(event) {

        if (event.keyCode == 13) {
            window.location.href = "{{ url('/showDetails/?keyword=') }}" + $("#keyword").val();
        }
    });
</script> --}}

@endsection