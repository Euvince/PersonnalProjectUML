@extends('Client.layouts.template')

@section('title', 'Contactez-nous')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold">Contactez-nous</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    <form method="POST" action="{{ route('contact.us') }}">
        @csrf
        <div class="row">
            <div class="row">
                <div class="col row">
                    <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="nom" label="Nom" type="text" name="nom" placeholder="Nom"  readonly="" value="" />
                    <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="email" label="Email" type="text" name="email" placeholder="Email"  readonly="" value="" />
                    <x-input class1="form-group col" class2="form-label mt-4" class3="form-control" id="telephone" label="Téléphone" type="text" name="telephone" placeholder="Téléphone"  readonly="" value="" />
                </div>
            </div>
            <div>
                <label for="description" class="form-label mt-4">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <span style="color: red; font-size: 0.7rem;">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary my-4">Soumettre</button>
    </form>

@endsection
