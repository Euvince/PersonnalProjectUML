<x-mail::message>
# Confirmation de réservation

Votre réservation pour la chambre
<a href="{{ route('clients.chambres.show', ['slug' => $chambre->getSlug(), 'chambre' => $chambre->id]) }}">{{ $chambre->libelle }}</a>
a été confirmée dans l'hôtel
<a href="{{ route('clients.hotels.show', ['slug' => $chambre->hotel->getSlug(), 'hotel' => $chambre->hotel->id]) }}">{{ $chambre->hotel->nom }}</a>

-Prénoms : {{ $reservation->user->prenoms }} <br>
-Noms : {{ $reservation->user->nom }} <br>
-Téléphone : {{ $reservation->user->telephone }} <br>
-Email : {{ $reservation->user->email }} <br>

**Durée du séjour** <br>
Du {{ $reservation->debut_sejour }} au {{ $reservation->fin_sejour }}


<x-mail::button :url="$url">Télécharger Facture</x-mail::button>

Merci,<br>
{{ config('app.name') }}
</x-mail::message>


