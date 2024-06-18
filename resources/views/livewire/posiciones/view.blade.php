@section('title', __('Posiciones'))
<div class="container-fluid" >
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card shadow p-3 mb-5 bg-body rounded" >
				<div class="" >
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4 ><i class="fa-solid fa-ranking-star text-info"></i>
							Tabla de posiciones </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						{{-- <div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Jugadores">
						</div>
						 --}}
					</div>
				</div>
				<br>
				<div class="card-body shadow p-3 mb-5 bg-body rounded " >
						@include('livewire.jugadores.modals')
				<div class="table-responsive" >
					<table class="table table-condensed"   >
						<thead class="thead" >
							<tr> 
								<td >#</td>
								<td >Nombre</td> 
								<td>Puntos</td> 


								
							</tr>
						</thead>
						<tbody>
							@forelse($posiciones as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->name }}</td> 
								<td>{{ $row->total}}</td> 
								
								
							</tr>
							@empty
							<tr>
								<td class="text-center" colspan="100%">No hay información </td>
							</tr>
							@endforelse
						</tbody>
					</table>						
					{{-- <div class="float-end">{{ $jugadores->links() }}</div> --}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>