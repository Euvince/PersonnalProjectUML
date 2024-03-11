<x-mail::message>
# Modification de demande de service

Votre demande de {{ $service->TypeService->type }} dans la chambre
<a href="{{ route('clients.chambres.show', ['slug' => $chambre->getSlug(), 'chambre' => $chambre->id]) }}">{{ $chambre->libelle }}</a>
a bien été modifiée dans l'hôtel
<a href="{{ route('clients.hotels.show', ['slug' => $chambre->hotel->getSlug(), 'hotel' => $chambre->hotel->id]) }}">{{ $chambre->hotel->nom }}</a>

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
