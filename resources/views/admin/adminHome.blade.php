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

    <h2>Admin Home / Staff Data</h2>
    <div>
        <div class="left mb-3 mt-1">
            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter by:
             </button>
             <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('home.admin') }}">Staff</a>
                <a class="dropdown-item" href="{{ route('home.admin.cust') }}">Customer</a>
            </div>
        </div>
        <div class="right mt-3">
            <input type="text" class="form-control form-control-sm" name="keyword" id="keyword" placeholder="Search by username..." value="{{ $keyword }}">
        </div>
    </div>
    <form method="post">
        <table class="table table-striped">
            <thead>
               <tr>
                  <th scope="col" style="text-align: center">Username</th>
                  <th scope="col" style="text-align: center">E-mail</th>
                  <th scope="col" style="text-align: center">Gender</th>
                  <th scope="col" style="text-align: center">Action</th>
               </tr>
            </thead>
            <tbody>
                @foreach ($user as $item)
                    <tr>
                        <td>{{ $item['username'] }}</td>
                        <td>{{ $item['email'] }}</td>
                        <td>{{ $item['gender'] }}</td>
                        <td style="text-align: center">
                            <form method="post">
                                <a class="- btn btn-outline-secondary rounded small" style="min-width: 70px" href="{{ route('deleteStaff.admin', $item['id']) }}">Delete</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
         </table>
        <div class="d-flex justify-content-center">
            {{ $user->withQueryString()->links() }}
        </div>
    </form>
    <script src="{{ asset('template/assets/js/config.js') }}"></script>

    <script src="{{ asset('template/assets/vendor/libs/jquery/jquery.js') }}"></script>
</div>

<script>
    var input = document.getElementById("keyword");

    input.addEventListener("keypress", function(event) {

        if (event.keyCode == 13) {
            window.location.href = "{{ url('/adminHome/?keyword=') }}" + $("#keyword").val();
        }
    });
</script>

@endsection