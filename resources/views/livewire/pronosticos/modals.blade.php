<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create New Pronostico</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    <div class="form-group">
                        <label for="jugador"></label>
                        <input wire:model="jugador" type="text" class="form-control" id="jugador" placeholder="Jugador">@error('jugador') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="partido"></label>
                        <input wire:model="partido" type="text" class="form-control" id="partido" placeholder="Partido">@error('partido') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="golesLocal"></label>
                        <input wire:model="golesLocal" type="text" class="form-control" id="golesLocal" placeholder="Goleslocal">@error('golesLocal') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="golesVisitante"></label>
                        <input wire:model="golesVisitante" type="text" class="form-control" id="golesVisitante" placeholder="Golesvisitante">@error('golesVisitante') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="ganador"></label>
                        <input wire:model="ganador" type="text" class="form-control" id="ganador" placeholder="Ganador">@error('ganador') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div wire:ignore.self class="modal fade" id="updateDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Actualizar Pronostico</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @php
                                           
                                                $local = DB::table('partidos')->join('equipos', 'equipos.id', '=', 'partidos.idEquipoLocal')->where('partidos.id',$this->partido)
                                                ->pluck('nombre_equipo')
                                                ->first();
                                                $visitante = DB::table('partidos')->join('equipos', 'equipos.id', '=', 'partidos.idEquipoVisitante')->where('partidos.id',$this->partido)
                                                ->pluck('nombre_equipo')
                                                ->first();
                                        @endphp
            <div class="modal-body">
                <h4 class="titulop">{{$local}} vs {{$visitante}}</h4>
                <form>

					<input type="hidden" wire:model="selected_id">
    

                    {{-- <div class="form-group">
                       
                        <label for="golesLocal"></label>
                        <input wire:model="golesLocal" type="text" class="form-control" id="golesLocal" placeholder="Goleslocal">@error('golesLocal') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="golesVisitante"></label>
                        <input wire:model="golesVisitante" type="text" class="form-control" id="golesVisitante" placeholder="Golesvisitante">@error('golesVisitante') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div> --}}
                    <div class="input-group">
                        
                        <input wire:model="golesLocal" type="number" class="form-control" id="golesLocal" placeholder="Goleslocal">@error('golesLocal') <span class="error text-danger">{{ $message }}</span> @enderror
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">-</span>
                          </div>
                        <input wire:model="golesVisitante" type="number" class="form-control" id="golesVisitante" placeholder="Golesvisitante">@error('golesVisitante') <span class="error text-danger">{{ $message }}</span> @enderror

                      </div>
                       
                   

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="pronosticar({{$selected_id}})" class="btn btn-primary">Guardar</button>
            </div>
       </div>
    </div>
</div>
