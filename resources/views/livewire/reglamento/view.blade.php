@section('title', __('Reglamento'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow p-3 mb-5 bg-body rounded">
                <div class=" ">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h4><i class="fa-solid fa-handshake-angle text-info"></i>
                               Reglamento </h4>
                        </div>
                        @if (session()->has('message'))
                            <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;">
                                {{ session('message') }} </div>
                        @endif
                       
                    </div>
                </div>
<br>
<div class="card-body shadow p-3 mb-5 bg-body rounded" >
    

        <ul class="list-group">
            <li class="list-group-item"> Para el cálculo de puntos se utiliza el resultado real del partido al finalizar los 90 o 120 minutos. No incluye definición por penaltis.
               </li>
            <li class="list-group-item"> El usuario puede realizar y cambiar sus pronósticos todas las veces que desee hasta 15 minutos antes de iniciar el partido, momento en el cual el sistema no permitirá modificar el pronóstico para ese partido. Realiza los pronósticos con tiempo!.
      </li>
            <li class="list-group-item"> Si el jugador no realiza el pronóstico para un partido, no se sumarán puntos.</li>
            <li class="list-group-item"> Los pronósticos serán secretos hasta que comience el partido, una vez comience el partido se podrán ver los pronósticos. Esto se realiza para evitar que una persona utilice los pronósticos de otras.
            </li>

          </ul>
      
       
    
  </div>
  <div class="float-left">
    <h4><i class="fa-solid fa-medal text-info"></i>
        Puntuación </h4>
</div>
<br>
                <div class="card-body shadow p-3 mb-5 bg-body rounded" >
                    <div class="table-responsive">
                        <table  class="table table-hover">
                            <thead class="thead">
                                <tr>
                                    <th  >Regla</th>
                                    
                                    
									<th>Puntos</th>
        
                                </tr>
                            </thead>
                            <tbody>
                              
                                    <tr>
                                        <td>Marcador exacto  </td>
                                        <td>5    </td>
                                    </tr>
                                    <tr>
                                        <td>Ganador del partido </td>
                                        <td>2    </td>
                                    </tr>
                                    <tr>
                                        <td>Marcador exacto en octavos de final  </td>
                                        <td>8    </td>
                                    </tr>
                                    <tr>
                                        <td>Ganador del partido en octavos de final  </td>
                                        <td>4    </td>
                                    </tr>
                                    <tr>
                                        <td>Marcador exacto en cuartos de final  </td>
                                        <td>11    </td>
                                    </tr>
                                    <tr>
                                        <td>Ganador del partido en cuartos de final  </td>
                                        <td>6   </td>
                                    </tr>
                                    <tr>
                                        <td>Marcador exacto en semifinal  </td>
                                        <td>14   </td>
                                    </tr>
                                    <tr>
                                        <td>Ganador del partido en semifinal  </td>
                                        <td>8   </td>
                                    </tr>
                                    <tr>
                                        <td>Marcador exacto en final  </td>
                                        <td>17    </td>
                                    </tr>
                                    <tr>
                                        <td>Ganador del partido en la final  </td>
                                        <td>10    </td>
                                    </tr>
                                    <tr>
                                        <td>Campeón (Solo si hay empate de puntuaciones, se toma del grupo de whatsapp) </td>
                                        <td>15    </td>
                                    </tr>
                                    <tr>
                                        <td>Subcampeón (Solo si persiste el empate de puntuaciones, se toma del grupo de whatsapp)  </td>
                                        <td>10    </td>
                                    </tr>
                                   
                                 
    
                            </tbody>
                        </table>
                        {{-- <div class="float-end">{{ $pronosticos->links() }}</div> --}}
                    </div>
                </div>
            </div>
        </div>
       
    </div>
    
</div>


