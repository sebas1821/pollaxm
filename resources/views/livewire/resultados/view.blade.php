@section('title', __('Resultados'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card shadow p-3 mb-5 bg-body rounded" >
				<div class="">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fa-solid fa-futbol text-info"></i>
							Lista de Resultados  </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						{{-- <div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Resultados">
						</div> --}}
						{{-- <div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
						<i class="fa fa-plus"></i>  Add Resultados
						</div> --}}
					</div>
				</div>
				<br>
				<div class="card-body shadow p-3 mb-5 bg-body rounded">
						@include('livewire.resultados.modals')
				<div class="table-responsive">
					<table class="table table-hover">
						<thead class="thead">
							
							<tr> 
								 
								<th style=" text-align: right;" >Local</th>
								<th></th>
								<th></th>
							  
								<th></th>
								<th>Visitante</th>
								<th>Jornada</th>

								@can('boton-agregarResultado')
								<td></td>
								@endcan
							</tr>
					
						<tbody>
							@forelse($resultados as $row)
					
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
								<td>{{ $row->descripcion }}</td>


							
							 @can('boton-agregarResultado')
								<td width="90">
									<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateDataModal"
									wire:click="edit({{ $row->id }})">+</button>
	  
								</td>
								@endcan

								@can('boton-bloquearPronostico')
								<td width="90">
									<a type="button" class="btn btn-danger" 
									wire:click="$emit('evento' , {{ $row->id }})">Bloquear</a>
	  
								</td>
								@endcan
							</tr>
						@empty
							<tr>
								<td class="text-center" colspan="100%">No hay información </td>
							</tr>
							@endforelse
						</tbody>
					</table>						
					{{-- <div class="float-end">{{ $resultados->links() }}</div> --}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@push('custom-scripts')
<script>

    Livewire.on('evento', rId => {
    
            Swal.fire({
                title: 'Pollaxm',
                text: "Seguro que desea bloquear los pronósticos para este partido.?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Bloquear!'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('bloquearPartido', rId);
                    Swal.fire(
                        'Bloqueado!',
                        'Ha sido bloqueado con éxito.',
                        'success'
                    )
                }
    
            })
    
        });
    </script>
@endpush
