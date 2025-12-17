@component('mail::message')
CONFIRMACIÓN DE REGISTRO DE MASCOTA
Adjunto encontrarás el QR de tu mascota.
{!! $QR !!}
Gracias, <br>
{{config('app.name')}}
@endcomponent