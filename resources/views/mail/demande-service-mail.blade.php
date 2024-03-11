<x-mail::message>
# Demande de service

Une demande de {{ $service->TypeService->type }} vient d'être soumise pour la chambre
<a href="{{ route('clients.chambres.show', ['slug' => $service->chambre->getSlug(), 'chambre' => $service->chambre->id]) }}">{{ $service->chambre->libelle }}</a>
dans l'hôtel <a href="{{ route('clients.hotels.show', ['slug' => $service->chambre->hotel->getSlug(), 'hotel' => $service->chambre->hotel->id]) }}">{{ $service->chambre->hotel->nom }}</a>
par le client {{ $service->nom_client }} {{ $service->prenoms_client }}.

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
