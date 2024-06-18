@extends('layouts.app')
@section('title', __('Welcome'))
@section('content')
<div class="container-fluid">
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow p-3 mb-5 bg-body rounded">
            <div class=""><h5><span class="text-center fa fa-home"></span> Bienvenido</h5></div>
            <br>
            <div class="card-body shadow p-3 mb-5 bg-body rounded">
              <h5>  
            @guest
				
				Bienvenido a Pollaxm !!! 
            </br>
            <br>

                La forma más habitual de hacer una polla es reunir un grupo relativamente pequeño de participantes que se alojarán en un grupo de mensajería instantánea en el cual  todos los participantes dejan mensajes de sus pronósticos, normalmente torneos de fútbol. Al pasar el tiempo, se generan miles de mensajes en el grupo, los cuales se vuelven un trabajo tedioso para el administrador del grupo leer cada uno de los mensajes y capturar los pronósticos de cada participante. Además, es difícil para los participantes pronosticar resultados y que se pierdan entre los mensajes del grupo. Son miles los problemas que se pueden ver cuando hablamos de una polla hecha en un grupo de mensajería instantánea. por todas esas falencias nace la plataforma pollaxm, la cual permite hacer todos los procesos que hay en una polla de una manera más cómoda tanto para los jugadores como para los administradores .
            </br>
              <h4 style="text-align: center"> Te invitamos a unirte a pollaxm para que disfrutes una buena experiencia compitiendo con tus amigos.</h4>
               
			@else
					Hola {{Auth::user()->name}}, Bienvenido a Pollaxm.Haz tus pronósticos y demuestra que eres el mejor.
            @endif	
				</h5>
            </div>
        </div>
    </div>
</div>
</div>
@endsection