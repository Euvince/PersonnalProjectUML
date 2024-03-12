<x-mail::message>
# Annulation de demande de service

Votre demande de {{ $service->TypeService->type }} pour la chambre
<a href="{{ route('clients.chambres.show', ['slug' => $service->chambre->getSlug(), 'chambre' => $service->chambre->id]) }}">{{ $service->chambre->libelle }}</a>
dans l'hôtel <a href="{{ route('clients.hotels.show', ['slug' => $service->chambre->hotel->getSlug(), 'hotel' => $service->chambre->hotel->id]) }}">{{ $service->chambre->hotel->nom }}</a>
a été annulée.

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
