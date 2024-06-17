@section('title', __('Equipos'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card shadow p-3 mb-5 bg-body rounded">
				<div class="">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fa-solid fa-shield-halved text-info"></i>
							Lista de equipos  </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Equipo">
						</div>
						<div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
						<i class="fa fa-plus"></i>  Agregar Equipo
						</div>
					</div>
				</div>
				<br>
				<div class="card-body shadow p-3 mb-5 bg-body rounded">
						@include('livewire.equipos.modals')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Nombre Equipo</th>
								<td>Acciones</td>
							</tr>
						</thead>
						<tbody>
							@forelse($equipos as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->nombre_equipo }}</td>
								<td width="90">
									<div class="dropdown">
										<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											Opciones
										</a>
										<ul class="dropdown-menu">
											<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a></li>
											<li><a type="button" class="dropdown-item" wire:click="$emit('eliminar' , {{ $row->id }})"><i class="fa fa-trash"></i> Eliminar </a></li></a>
										</ul>
									</div>								
								</td>
							</tr>
							@empty
							<tr>
								<td class="text-center" colspan="100%">No hay información </td>
							</tr>
							@endforelse
						</tbody>
					</table>						
					<div class="float-end">{{ $equipos->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@push('custom-scripts')
<script>

    Livewire.on('eliminar', rId => {
    
            Swal.fire({
                title: '',
                text: "Seguro que desea eliminar el equipo?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('destroy', rId);
                    Swal.fire(
                        'Eliminado!',
                        'Ha sido eliminado con éxito.',
                        'success'
                    )
                }
    
            })
    
        });
    </script>
@endpush