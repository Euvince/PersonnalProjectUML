<x-mail::message>
# Annulation de réservation

Votre réservation pour la chambre
<a href="{{ route('clients.chambres.show', ['slug' => $reservation->chambre->getSlug(), 'chambre' => $reservation->chambre->id]) }}">{{ $reservation->chambre->libelle }}</a>
du {{ $reservation->debut_sejour }} au {{ $reservation->fin_sejour }} dans l'hôtel
<a href="{{ route('clients.hotels.show', ['slug' => $reservation->chambre->hotel->getSlug(), 'hotel' => $reservation->chambre->hotel->id]) }}">{{ $reservation->chambre->hotel->nom }}</a>
a bien été annuléeet vous avez été remboursez, si ce n'est pas le cas, veuillez passer à la réception le notifiez ou contactez le service client via email {{ $reservation->chambre->hotel->email }}
ou par téléphone {{ $reservation->chambre->hotel->telephone }}.

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
