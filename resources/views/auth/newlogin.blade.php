<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
    <title>Login</title>

    <link rel="icon" href="{{ asset('template/imgs/ramen.jpg') }}" />
  </head>
  <body>
    <div class="container-fluid">
      <form class="mx-auto" method="POST" action="{{ route('newlogin') }}">
        @csrf
        <h4 class="text-center">Login</h4>
        <div class="mb-3 mt-5">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" name="username" placeholder="Enter username...">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" placeholder="Enter password...">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>