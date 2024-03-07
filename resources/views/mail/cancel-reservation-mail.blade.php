<x-mail::message>
# Annulation de réservation

Votre réservation pour la chambre {{ $reservation->chambre->libelle }} du
{{ $reservation->debut_sejour }} au {{ $reservation->fin_sejour }} a été annulée.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
