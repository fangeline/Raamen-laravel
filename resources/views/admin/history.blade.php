@extends('layouts.adminNav')

@section('content')
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
                  <th scope="col" style="text-align: center">Customer Name</th>
                  <th scope="col" style="text-align: center">Staff ID</th>
                  <th scope="col" style="text-align: center">Date</th>
                  <th scope="col" style="text-align: center">Status</th>
                  <th scope="col" style="text-align: center">Action</th>
               </tr>
            </thead>
            <tbody>
                @foreach ($history as $item)
                    <tr>
                        <td>{{ $item['id'] }}</td>
                        <td>{{ $item['customer_id'] }}</td>
                        <td>{{ $item->customer->username }}</td>
                        <td>{{ $item['staff_id'] }}</td>
                        <td>{{ $item['created_at'] }}</td>
                        <td>Handled</td>
                        <td style="text-align: center">
                            <form method="post">
                                <a class="- btn btn-outline-secondary rounded small" style="min-width: 70px" href="{{ route('showDetail.admin', $item['id']) }}">Details</a>
                                <a class="- btn btn-outline-secondary rounded small" style="min-width: 70px" href="{{ route('showPDF.admin', $item['id']) }}">Report</a>
                            </form>
                        </td>
                    </tr>
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

<script>
    var input = document.getElementById("keyword");

    input.addEventListener("keypress", function(event) {

        if (event.keyCode == 13) {
            window.location.href = "{{ url('/adminHistory/?keyword=') }}" + $("#keyword").val();
        }
    });
</script>

@endsection