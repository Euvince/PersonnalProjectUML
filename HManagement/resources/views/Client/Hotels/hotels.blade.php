@extends('Client.layouts.template')

@section('title', 'Hôtels')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">Tous les Hôtels</h1>
    </div>

    <div class="container">
        <div class="row">
            @foreach ($hotels as $hotel)
                <div class="col-3">
                    <div class="card bg-secondary mb-3" style="max-width: 20rem;">
                        <div class="card-header">
                            <strong>{{ $hotel->nom }}</strong>
                        </div>
                        {{-- <div class="card-body">
                            <h4 class="card-title">{{ $university->adress }}</h4>
                            <p class="card-text"><strong>{{ $university->email }}</strong></p>
                            <p class="card-text"><strong>{{ $university->city }}</strong></p>
                            <p class="card-text"><strong>{{ $university->phone }}</strong></p>
                            <a href="{{ route('user.university.show', ['slug' => Str::slug($university->name), 'university' => $university->id]) }}" class="btn btn-primary">Détails</a>
                        </div> --}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{ $hotels->links() }}

@endsection
