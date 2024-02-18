@extends('SuperAdmin.layouts.template')

@section('title', 'Les quartiers')
@section('content-title', 'Liste de tous les Quartiers')

@section('content')

<div class="row">
    <div class="search-box pull-left mt-5 ml-3">
        <form action="#">
            <input type="text" name="search" placeholder="Search..." required>
            <i class="ti-search"></i>
        </form>
    </div>
    <div class="col-12 mt-5">
        <a href="{{ route('super-admin.quartiers.create') }}" class="btn btn-primary mb-3">Ajouter un Quartier</a>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Quartiers</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover progress-table text-center">
                            <thead class="text-uppercase">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nom du quartier</th>
                                    <th scope="col">Longitude</th>
                                    <th scope="col">Lattitude</th>
                                    <th scope="col">Arrondissement</th>
                                    <th scope="col">Date de Création</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quartiers as $quartier)
                                    <tr>
                                        <th scope="row">{{ $quartier->id }}</th>
                                        <td>{{ $quartier->nom }}</td>
                                        <td>{{ $quartier->longitude }}°</td>
                                        <td>{{ $quartier->lattitude }}°</td>
                                        <td>{{ $quartier?->arrondissement?->nom }}</td>
                                        <td>{{ $quartier->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3"><a href="{{ route('super-admin.quartiers.edit', ['quartier' => $quartier->id]) }}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                <li><a href="" class="text-danger" data-target="#modal{{ $quartier->id }}" data-toggle="modal"><i class="ti-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <div class="modal fade" tabindex="-1" id="modal{{ $quartier->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title">Confirmation de Suppression</h5>
                                              {{-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button> --}}
                                            </div>
                                            <div class="modal-body">
                                              <p>Souhaitez vous vraiment supprimer ce quartier ?</p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                              <form action="{{ route('super-admin.quartiers.destroy', ['quartier' => $quartier->id]) }}" method="POST">
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
        {{ $quartiers->links() }}
    </div>
</div>

@endsection