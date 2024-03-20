<x-mail::message>
# Confirmation de Check-out

Le check-out de votre réservation pour la chambre
<a href="{{ route('clients.chambres.show', ['slug' => $reservation->chambre->getSlug(), 'chambre' => $reservation->chambre->id]) }}">{{ $reservation->chambre->libelle }}</a>
du {{ $reservation->debut_sejour->translatedFormat('d F Y') }} au {{ $reservation->fin_sejour>translatedFormat('d F Y') }} dans l'hôtel
<a href="{{ route('clients.hotels.show', ['slug' => $reservation->chambre->hotel->getSlug(), 'hotel' => $reservation->chambre->hotel->id]) }}">{{ $reservation->chambre->hotel->nom }}</a>
s'est bien passé.

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
