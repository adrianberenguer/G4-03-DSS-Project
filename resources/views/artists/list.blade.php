@extends('layouts')

@section('content')
<h1>Artists</h1>

<form method="GET" action="{{url('/artists/sortByName')}}">
    @method('GET')
    @csrf
    <div class="input-group mb-3">
        <select name="sortByName" class="custom-select" id="inputGroupSelect04">
            <option value="-1">Sort by name...</option>
            <option value="0">Descendent</option>
            <option value="1">Ascendent</option>
        </select>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Sort</button>
        </div>
    </div>
</form>

<form method="GET" action="{{url('/artists/sortByBalance')}}">
    @method('GET')
    @csrf
    <div class="input-group mb-3">
        <select name="sortByBalance" class="custom-select" id="inputGroupSelect04">
            <option value="-1">Sort by balance...</option>
            <option value="0">Descendent</option>
            <option value="1">Ascendent</option>
        </select>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Sort</button>
        </div>
    </div>
</form>

<form method="GET" action="{{url('/artists/sortByVolume')}}">
    @method('GET')
    @csrf
    <div class="input-group mb-3">
        <select name="sortByVolume" class="custom-select" id="inputGroupSelect04">
            <option value="-1">Sort by volume sold...</option>
            <option value="0">Descendent</option>
            <option value="1">Ascendent</option>
        </select>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Sort</button>
        </div>
    </div>
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Balance</th>
            <th scope="col">Volume Sold</th>
            <th scope="col">Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($artists as $artist)
        <tr>
            <td><a href="/api/artists/{{$artist->id}}">{{ $artist->name }}</a></td>
            <td>{{ $artist->balance }}</td>
            <td>{{ $artist->volume_sold }}</td>
            <td>{{ $artist->description }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $artists->appends($_GET)->links() }} <!-- This is done to prevent pagination swap page to 'forget' about the data filtered or ordered -->

@endsection