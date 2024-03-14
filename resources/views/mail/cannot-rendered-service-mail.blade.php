<x-mail::message>
# Incapacité à satisfaire une demande de service

Votre demande de {{ $service->TypeService->type }} pour la chambre
<a href="{{ route('clients.chambres.show', ['slug' => $service->chambre->getSlug(), 'chambre' => $service->chambre->id]) }}">{{ $service->chambre->libelle }}</a>
dans l'hôtel <a href="{{ route('clients.hotels.show', ['slug' => $service->chambre->hotel->getSlug(), 'hotel' => $service->chambre->hotel->id]) }}">{{ $service->chambre->hotel->nom }}</a>
ne pourra être rendue pour une raison donnée, nous vous prions de nous excuser.

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
