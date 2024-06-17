<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear Nuevo Partido</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    {{-- <div class="form-group">
                        <label for="idEquipoLocal"></label>
                        <input wire:model="idEquipoLocal" type="text" class="form-control" id="idEquipoLocal" placeholder="Idequipolocal">@error('idEquipoLocal') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="idEquipoVisitante"></label>
                        <input wire:model="idEquipoVisitante" type="text" class="form-control" id="idEquipoVisitante" placeholder="Idequipovisitante">@error('idEquipoVisitante') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div> --}}
                    <div class="form-group">
                        <label for="idEquipoLocal">* Equipo Local:</label>
        
                        <select wire:model="idEquipoLocal" class="form-control" id="idEquipoLocal">
                            <option value="">Seleccione el equipo local</option>
                            @foreach ($equipos as $row)
                                <option value="{{$row->id}}">{{$row->nombre_equipo}}</option>
                            @endforeach
                        </select>
                        @error('idEquipoLocal') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="idEquipoVisitante">* Equipo Visitante:</label>
        
                        <select wire:model="idEquipoVisitante" class="form-control" id="idEquipoVisitante">
                            <option value="">Seleccione el equipo visitante</option>
                            @foreach ($equipos as $row)
                                <option value="{{$row->id}}">{{$row->nombre_equipo}}</option>
                            @endforeach
                        </select>
                        @error('idEquipoVisitante') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="idEquipoVisitante">* Jornada:</label>
        
                        <select wire:model="jornada" class="form-control" id="jornada">
                            <option value="">Seleccione la jornada</option>
                            @foreach ($jornadas as $row)
                                <option value="{{$row->id}}">{{$row->descripcion}}</option>
                            @endforeach
                        </select>
                        @error('jornada') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div wire:ignore.self class="modal fade" id="updateDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Partido</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
                    <div class="form-group">
                        <label for="idEquipoLocal">* Equipo Local:</label>
        
                        <select wire:model="idEquipoLocal" class="form-control" id="idEquipoLocal">
                            <option value="">Seleccione el equipo local</option>
                            @foreach ($equipos as $row)
                                <option value="{{$row->id}}">{{$row->nombre_equipo}}</option>
                            @endforeach
                        </select>
                        @error('idEquipoLocal') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="idEquipoVisitante">* Equipo Visitante:</label>
        
                        <select wire:model="idEquipoVisitante" class="form-control" id="idEquipoVisitante">
                            <option value="">Seleccione el equipo visitante</option>
                            @foreach ($equipos as $row)
                                <option value="{{$row->id}}">{{$row->nombre_equipo}}</option>
                            @endforeach
                        </select>
                        @error('idEquipoVisitante') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="idEquipoVisitante">* Jornada:</label>
        
                        <select wire:model="jornada" class="form-control" id="jornada">
                            <option value="">Seleccione la jornada</option>
                            @foreach ($jornadas as $row)
                                <option value="{{$row->id}}">{{$row->descripcion}}</option>
                            @endforeach
                        </select>
                        @error('jornada') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary">Guardar</button>
            </div>
       </div>
    </div>
</div>
