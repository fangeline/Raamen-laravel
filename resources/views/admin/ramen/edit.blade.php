@extends('layouts.adminNav')

@section('content')
<link href="{{ asset('template/css/profile.css') }}" rel="stylesheet">

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="border-right">
            <div class="p-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Edit Ramen</h4>
                </div>
                <form action="{{ route('updateRamen.admin', $ramen['id']) }}" method="POST">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="meat_id" class="labels">Meat</label>
                            <select name="meat_id" class="form-control">
                                <option value="{{ $ramen->meat_id }}">{{ $meatName['name'] }}</option>
                                @foreach ($meat as $daging)
                                    <option value="{{ $daging['id'] }}">{{ $daging['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12"><label for="name" class="labels">Name</label><input type="text" name="name" class="form-control" placeholder="{{ $ramen['name']}}" value="{{ $ramen['name']}}"></div>
                        <div class="col-md-12">
                            <label for="broth" class="labels">Broth</label>
                            <select name="broth" class="form-control">
                                <option selected="{{ $ramen['broth'] }}">{{ $ramen['broth'] }}</option>
                                <option value="chicken">chicken</option>
                                <option value="miso">miso</option>
                                <option value="pork">pork</option>
                            </select>
                        </div>
                        <div class="col-md-12"><label for="price" class="labels">Price</label><input type="text" name="price" class="form-control" placeholder="{{ $ramen['price'] }}" value="{{ $ramen['price'] }}"></div>
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Edit Ramen</button></div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection