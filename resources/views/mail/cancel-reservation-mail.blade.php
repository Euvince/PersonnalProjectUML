<x-mail::message>
# Annulation de réservation

Votre réservation pour la chambre
<a href="{{ route('clients.chambres.show', ['slug' => $reservation->chambre->getSlug(), 'chambre' => $reservation->chambre->id]) }}">{{ $reservation->chambre->libelle }}</a>
du{{ $reservation->debut_sejour }} au {{ $reservation->fin_sejour }} a été annulée.

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
