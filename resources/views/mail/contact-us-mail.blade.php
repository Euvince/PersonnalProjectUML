<x-mail::message>
# Nouveau contact reçu

Vous avez reçu un nouveau message de contact de la part de {{ $infos['nom'] }}. <br>
**Email du contact : {{ $infos['email'] }} <br>
**Téléphone du contact : {{ $infos['telephone'] }} <br>
**Contenu : {{ $infos['description'] }} <br>

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
