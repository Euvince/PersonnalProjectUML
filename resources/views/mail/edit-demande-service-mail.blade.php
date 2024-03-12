<x-mail::message>
# Modification de demande de service

Votre demande de {{ $service->TypeService->type }} dans la chambre
<a href="{{ route('clients.chambres.show', ['slug' => $service->chambre->getSlug(), 'chambre' => $service->chambre->id]) }}">{{ $service->chambre->libelle }}</a>
a bien été modifiée dans l'hôtel
<a href="{{ route('clients.hotels.show', ['slug' => $service->chambre->hotel->getSlug(), 'hotel' => $service->chambre->hotel->id]) }}">{{ $service->chambre->hotel->nom }}</a>

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
