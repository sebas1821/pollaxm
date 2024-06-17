@section('title', __('Pronosticos'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow p-3 mb-5 bg-body rounded" >
                <div class="">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h4 class="titulop"><i class="fa-solid fa-square-poll-vertical text-info"></i>
                                Mis Pronosticos </h4>
                        </div>
                        @if (session()->has('message'))
                            <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;">
                                {{ session('message') }} </div>
                        @endif
                        {{-- <div>
                            <input wire:model='keyWord' type="text" class="form-control" name="search"
                                id="search" placeholder="Search Pronosticos">
                        </div> --}}
                        {{-- <div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
                            <i class="fa fa-plus"></i> Add Pronosticos
                        </div> --}}
                    </div>
                </div>
<br>
                <div class="card-body shadow p-3 mb-5 bg-body rounded">
                    @include('livewire.pronosticos.modals')

                 

                   
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            @forelse($jornadas as $row)
                          <button wire:click.prevent="jornada({{$row->id}})" class="nav-link" id="nav-{{$row->id}}-tab" data-bs-toggle="tab" data-bs-target="#nav" type="button" role="tab" aria-controls="nav" aria-selected="false">{{$row->descripcion}}</button>
                          
                          {{-- <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Jornada 1</button>
                          <button class="nav-link" id="nav-jornada4-tab" data-bs-toggle="tab" data-bs-target="#nav-jornada2" type="button" role="tab" aria-controls="nav-jornada2" aria-selected="false">Jornada 2</button>
                          <button class="nav-link" id="nav-jornada3-tab" data-bs-toggle="tab" data-bs-target="#nav-jornada3" type="button" role="tab" aria-controls="nav-jornada3" aria-selected="false">Jornada 3</button>
                          <button class="nav-link" id="nav-octavos-tab" data-bs-toggle="tab" data-bs-target="#nav-octavos" type="button" role="tab" aria-controls="nav-octavos" aria-selected="false">Octavos</button>
                          <button class="nav-link" id="nav-cuartos-tab" data-bs-toggle="tab" data-bs-target="#nav-cuartos" type="button" role="tab" aria-controls="nav-cuartos" aria-selected="false">Cuartos</button>
                          <button class="nav-link" id="nav-semis-tab" data-bs-toggle="tab" data-bs-target="#nav-semis" type="button" role="tab" aria-controls="nav-semis" aria-selected="false">Semis</button>
                          <button class="nav-link" id="nav-final-tab" data-bs-toggle="tab" data-bs-target="#nav-final" type="button" role="tab" aria-controls="nav-final" aria-selected="false">Final</button> --}}
                          @empty
                         
                          <tr>
                            <button class="nav-link " id="nav-final-tab" data-bs-toggle="tab" data-bs-target="#nav-final" type="button" role="tab" aria-controls="nav-final" aria-selected="false">No hay jornadas agregadas</button>
                          </tr>
                      @endforelse
                        </div>
                      </nav>
                      
                      <div class="tab-content" id="nav">
                        <div class="tab-pane fade show active" id="nav" role="tabpanel" aria-labelledby="nav-{{$this->jornada}}-tab">
                            <div class="float-left">
                                <br>
                                @php
                                 $nombreJornada= DB::table('jornadas')->select('descripcion')->where('id',$this->jornada)->pluck('descripcion')->first();
                                @endphp
                                <h4 >{{$nombreJornada}}</h4>
                                <br>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead">
                                        <tr>
                                            
                                            <th style=" text-align: right;"  >Local</th>
                                            <th></th>
                                            <th></th>
                                          
                                            <th></th>
                                            <th>Visitante</th>
                
                                            <td></td>
                                            
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pronosticosJornada as $row)
                                            <tr>
                                                
                                                @php
                                                    $local = DB::table('equipos')
                                                        ->where('id', $row->idEquipoLocal)
                                                        ->pluck('nombre_equipo')
                                                        ->first();
                                                @endphp
                                                <td style=" text-align: right;" >{{ $local }}      </td>
                                                <td style=" text-align: right;" > {{$row->golesLocal}} </td>
                                                <td style=" text-align: center;" >-</td>
                                                <td>{{$row->golesVisitante}} </td>
                                                @php
                                                    $visita = DB::table('equipos')
                                                        ->where('id', $row->idEquipoVisitante)
                                                        ->pluck('nombre_equipo')
                                                        ->first();
                                                @endphp
                                                <td>{{ $visita }}</td>
        
                                            
                                             @if($row->estado== 0)
                                             <td width="90">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateDataModal"
                                                wire:click="edit({{ $row->id }})"> Pronosticar</button>
                  
                                            </td>
                                             @endif
                                             
                                            </tr>
                                        @empty
                                            <tr>
                                                @if($this->jornada==null)

                                                <td class="text-center" colspan="100%"> <H5>SELECCIONE UNA JORNADA </H5></td>
                                                @else

                                                <td class="text-center" colspan="100%">No hay información</td>
                                                @endif

                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{-- <div class="float-end">{{ $pronosticos->links() }}</div> --}}
                            </div>
                        </div>
                        
                    


                      </div>
                    
                </div>
            </div>
        </div>
       
    </div>
    
</div>

    