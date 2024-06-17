@section('title', __('Allpronosticos'))
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css" >
@endsection
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow p-3 mb-5 bg-body rounded">
                <div class=" ">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h4><i class="fa-solid fa-square-poll-horizontal text-info"></i>
                                Todos los pronósticos </h4>
                        </div>
                        @if (session()->has('message'))
                            <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;">
                                {{ session('message') }} </div>
                        @endif
                       
                    </div>
                </div>
<br>
                <div class="card-body shadow p-3 mb-5 bg-body rounded" >
                    <div class="table-responsive">
                        <table id="allpronosticos" class="table table-hover">
                            <thead class="thead">
                                <tr>
                                    <th  >Usuario</th>
                                    
                                    <th style=" text-align: right;" >Local</th>
									<th></th>
									<th></th>
                                  
									<th></th>
									<th>Visitante</th>
        
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pronosticos as $row)
                                    <tr>
                                        
                                        @php
                                            $local = DB::table('equipos')
                                                ->where('id', $row->idEquipoLocal)
                                                ->pluck('nombre_equipo')
                                                ->first();
                                        @endphp
                                        <td>{{$row->name}}   </td>

                                        <td style=" text-align: right;" >{{ $local }}      </td>
										<td style=" text-align: right;" > {{$row->golesLocal}} </td>
										<td style=" text-align: right;">-</td>
										<td>{{$row->golesVisitante}} </td>
                                        @php
                                            $visita = DB::table('equipos')
                                                ->where('id', $row->idEquipoVisitante)
                                                ->pluck('nombre_equipo')
                                                ->first();
                                        @endphp
                                        <td>{{ $visita }}</td>

                                    </tr>
                
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="float-end">{{ $pronosticos->links() }}</div> --}}
                    </div>
                </div>
            </div>
        </div>
       
    </div>
    
</div>
@push('custom-scripts')
<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>


<script>
 $('#allpronosticos').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                   
                },


            });

</script>
@endpush