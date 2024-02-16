@extends('SuperAdmin.layouts.template')

@section('title', 'Les arrondissemnts')
@section('content-title', 'Liste de tous les Arrondissemnts')

@section('content')

<div class="row">
    <div class="search-box pull-left mt-5 ml-3">
        <form action="#">
            <input type="text" name="search" placeholder="Search..." required>
            <i class="ti-search"></i>
        </form>
    </div>
    <div class="col-12 mt-5">
        <a href="{{ route('super-admin.arrondissements.create') }}" class="btn btn-primary mb-3">Ajouter un Arrondissement</a>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Arrondissements</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover progress-table text-center">
                            <thead class="text-uppercase">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nom de l'arrondissement</th>
                                    <th scope="col">Longitude</th>
                                    <th scope="col">Lattitude</th>
                                    <th scope="col">Commune</th>
                                    <th scope="col">Date de Création</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($arrondissements as $arrondissement)
                                    <tr>
                                        <th scope="row">{{ $arrondissement->id }}</th>
                                        <td>{{ $arrondissement->nom }}</td>
                                        <td>{{ $arrondissement->longitude }}°</td>
                                        <td>{{ $arrondissement->lattitude }}°</td>
                                        <td>{{ $arrondissement?->commune?->nom }}</td>
                                        <td>{{ $arrondissement->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3"><a href="{{ route('super-admin.arrondissements.edit', ['arrondissement' => $arrondissement->id]) }}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                <li><a href="" class="text-danger" data-target="#modal{{ $arrondissement->id }}" data-toggle="modal"><i class="ti-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <div class="modal fade" tabindex="-1" id="modal{{ $arrondissement->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title">Confirmation de Suppression</h5>
                                              {{-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button> --}}
                                            </div>
                                            <div class="modal-body">
                                              <p>Souhaitez vous vraiment supprimer cet arrondissement ?</p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                              <form action="{{ route('super-admin.arrondissements.destroy', ['arrondissement' => $arrondissement->id]) }}" method="POST">
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
        {{ $arrondissements->links() }}
    </div>
</div>

@endsection
