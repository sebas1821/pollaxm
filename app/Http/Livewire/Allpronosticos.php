<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Jugadore;
use Illuminate\Support\Facades\DB;



class Allpronosticos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre_equipo;

    public function render()
    {
       
		$keyWord = '%'.$this->keyWord .'%';
        $sql = 'select users.name ,pronosticos.id,idEquipoLocal, idEquipoVisitante,golesLocal,golesVisitante,pronosticos.ganador,partidos.estado, partidos.id as partido
        from pronosticos
           join users on users.id = pronosticos.jugador 
         join partidos on partidos.id = pronosticos.partido
         where partidos.estado = 1 ';
         $pronosticos = DB::select($sql);
         return view('livewire.Allpronosticos.view', [
            'pronosticos' => $pronosticos,
        ]);
    }
	
 
	
   
}