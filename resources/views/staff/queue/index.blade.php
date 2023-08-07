@extends('layouts.staffNav')

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
            <h2>Order Queue</h2>
        </div>
        <div style="width: 30%; float: right; margin-top: 25px; margin-right: 5px">
            <input type="text" class="form-control form-control-sm" name="keyword" id="keyword" placeholder="Search by username..." value="{{ $keyword }}">
        </div>
    </div>
    <form method="post">
        <table class="table table-striped">
            <thead>
               <tr>
                  <th scope="col" style="text-align: center">Id</th>
                  <th scope="col" style="text-align: center">Customer ID</th>
                  <th scope="col" style="text-align: center">Staff ID</th>
                  <th scope="col" style="text-align: center">Date</th>
                  <th scope="col" style="text-align: center">Status</th>
                  <th scope="col" style="text-align: center">Action</th>
               </tr>
            </thead>
            <tbody>
                @foreach ($queue as $item)
                    <tr>
                        <td>{{ $item['id'] }}</td>
                        <td>{{ $item->customer->username }}</td>
                        <td>{{ $item['staff_id'] }}</td>
                        <td>{{ $item['created_at'] }}</td>
                        @if ($item['staff_id'] == 0)
                            <td>Unhandled</td>
                            <td style="text-align: center">
                                <form method="post">
                                    <a class="- btn btn-outline-secondary rounded small" style="min-width: 70px" href="{{ route('showDetail.staff', $item['id']) }}">Details</a>
                                    <a class="- btn btn-outline-primary rounded small" style="min-width: 70px" href="{{ route('handleOrder.staff', $item['id']) }}">Handle</a>
                                    <a class="- btn btn-outline-secondary rounded small" style="min-width: 70px" href="{{ route('removeOrder.staff', $item['id']) }}">Remove</a>
                                </form>
                            </td>
                        @else
                            <td>Handled</td>
                            <td style="text-align: center">
                                <form method="post">
                                    <a class="- btn btn-outline-secondary rounded small" style="min-width: 70px" href="{{ route('showDetail.staff', $item['id']) }}">Details</a>
                                    <a class="- btn btn-outline-primary rounded small disabled" style="min-width: 70px" href="{{ route('handleOrder.staff', $item['id']) }}">Handle</a>
                                    <a class="- btn btn-outline-secondary rounded small disabled" style="min-width: 70px" href="{{ route('removeOrder.staff', $item['id']) }}">Remove</a>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
         </table>
        <div class="d-flex justify-content-center">
            {{ $queue->withQueryString()->links() }}
        </div>
    </form>
    <script src="{{ asset('template/assets/js/config.js') }}"></script>

    <script src="{{ asset('template/assets/vendor/libs/jquery/jquery.js') }}"></script>
</div>

<script>
    var input = document.getElementById("keyword");

    input.addEventListener("keypress", function(event) {

        if (event.keyCode == 13) {
            window.location.href = "{{ url('/staffQueue/?keyword=') }}" + $("#keyword").val();
        }
    });
</script>

@endsection