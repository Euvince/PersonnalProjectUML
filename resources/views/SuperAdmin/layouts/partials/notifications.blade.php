@php
    use App\Models\Service;
    use App\Models\Reservation;
    $services = Service::where('rendu', 0)->get();
    $reservations = Reservation::where('confirme', 0)->get();
@endphp

<div class="dropdown-menu bell-notify-box notify-box">
    @can('Gérer les Demandes de Services')
        <span class="notify-title">
            @if ($services->count() === 1)
                Vous avez une notification
            @elseif ($services->count() === 0)
                Vous n'avez aucune notification
            @else Vous avez {{ $services->count() }} notifications
            @endif
            {{-- <a href="#">view all</a> --}}
        </span>
    @endcan
    @can('Gérer les Réservations')
        <span class="notify-title">
            @if ($reservations->count() === 1)
                Vous avez une notification
            @elseif ($reservations->count() === 0)
                Vous n'avez aucune notification
            @else Vous avez {{ $reservations->count() }} notifications
            @endif
            {{-- <a href="#">view all</a> --}}
        </span>
    @endcan
    <div class="nofity-list">
        @can('Gérer les Demandes de Services')
            @foreach ($services as $service)
                <a href="#" class="notify-item">
                    <div class="notify-thumb"><i class="ti-comments-smiley btn-info"></i></div>
                    <div class="notify-text">
                        <p>Nouvelle demande de service</p>
                        <span>{{ $service->date_demande_service->format('d F Y') }} | {{ $service->prenoms_client }}</span>
                    </div>
                </a>
            @endforeach
        @endcan

        @can('Gérer les Réservations')
            @foreach ($reservations as $reservation)
                <a href="#" class="notify-item">
                    <div class="notify-thumb"><i class="ti-comments-smiley btn-info"></i></div>
                    <div class="notify-text">
                        <p>Nouvelle réservation infirmée</p>
                        <span>{{ $reservation->date_reservation->format('d F Y') }} | {{ $reservation->prenoms_client }}</span>
                    </div>
                </a>
            @endforeach
        @endcan
    </div>
</div>


