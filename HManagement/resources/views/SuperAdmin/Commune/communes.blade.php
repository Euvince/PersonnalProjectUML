@extends('SuperAdmin.layouts.template')

@section('title', 'Les communes')
@section('content-title', 'Liste de toutes les Communes')

@section('content')

<div class="row">
    <div class="search-box pull-left mt-5 ml-3">
        <form action="#">
            <input type="text" name="search" placeholder="Search..." required>
            <i class="ti-search"></i>
        </form>
    </div>
    <div class="col-12 mt-5">
        <a href="{{ route('super-admin.communes.create') }}" class="btn btn-primary mb-3">Ajouter une Commune</a>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Communes</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover progress-table text-center">
                            <thead class="text-uppercase">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nom de la Commune</th>
                                    <th scope="col">Longitude</th>
                                    <th scope="col">Lattitude</th>
                                    <th scope="col">Département</th>
                                    <th scope="col">Date de Création</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($communes as $commune)
                                    <tr>
                                        <th scope="row">{{ $commune->id }}</th>
                                        <td>{{ $commune->nom }}</td>
                                        <td>{{ $commune->longitude }}°</td>
                                        <td>{{ $commune->lattitude }}°</td>
                                        <td>{{ $commune?->departement?->nom }}</td>
                                        <td>{{ $commune->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3"><a href="{{ route('super-admin.communes.edit', ['commune' => $commune->id]) }}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                <li><a href="" class="text-danger" data-target="#modal{{ $commune->id }}" data-toggle="modal"><i class="ti-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <div class="modal fade" tabindex="-1" id="modal{{ $commune->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title">Confirmation de Suppression</h5>
                                              {{-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button> --}}
                                            </div>
                                            <div class="modal-body">
                                              <p>Souhaitez vous vraiment supprimer cette commune ?</p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                              <form action="{{ route('super-admin.communes.destroy', ['commune' => $commune->id]) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger">Supprimer</button>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ml-4 mt-4">
        {{ $communes->links() }}
    </div>
</div>

@endsection
