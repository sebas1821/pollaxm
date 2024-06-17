<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Jugadore;
use Illuminate\Support\Facades\DB;



class Posiciones extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre_equipo;

    public function render()
    {
        $this->calcularPuntos();
        $this->calcularPuntos2();

		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.posiciones.view', [
            'posiciones' => DB::table('users')->orderBy('puntos', 'desc')->get(),
        ]);
    }
	
    public function calcularPuntos(){
        $sql1 = 'SELECT id FROM pollamundialista.users';
        $users = DB::select($sql1);
        foreach ($users as $key  ) {
         $sql2 = 'SELECT pronosticos.jugador ,jornadas.descripcion, jornadas.valor_puntaje_me,COUNT(pronosticos.jugador) AS aciertos
         from pronosticos 
         join partidos on partidos.id = pronosticos.partido
         join jornadas on jornadas.id = partidos.jornada
         join resultados on resultados.partido = pronosticos.partido  
         where pronosticos.golesLocal = resultados.golesLocal 
         and pronosticos.golesVisitante = resultados.golesVisitante 
         and pronosticos.partido = resultados.partido
         and pronosticos.jugador='.$key->id.'
         GROUP BY pronosticos.jugador,jornadas.descripcion,jornadas.valor_puntaje_me;';
         $suma_marcador_exactos=0;
         $aciertos = DB::select($sql2);  
            foreach ($aciertos as $key  ) {
             $suma_marcador_exactos+=($key->valor_puntaje_me*$key->aciertos);
             $record = User::find($key->jugador);
             $record->update([ 
             'puntos'=>$suma_marcador_exactos
             ]);
            } ;
        }
       
          

        }

          
          
        
        public function calcularPuntos2(){
        
            $sql1 = 'SELECT id FROM pollamundialista.users';
        $users = DB::select($sql1);
        foreach ($users as $key  ) {
           $sql2 = '  SELECT pronosticos.jugador ,jornadas.valor_puntaje_g,COUNT(pronosticos.jugador) AS aciertos
              from pronosticos join partidos on partidos.id = pronosticos.partido
         join jornadas on jornadas.id = partidos.jornada
         join resultados on resultados.partido = pronosticos.partido  
              where pronosticos.ganador = resultados.ganador 
             and pronosticos.jugador='.$key->id.'
              GROUP BY pronosticos.jugador,jornadas.valor_puntaje_g;';
       
           $aciertosGanador = DB::select($sql2);
              $suma_ganador=0;
              foreach ($aciertosGanador as $key  ) {
               $record = User::find($key->jugador);
               $record->update([ 
               'puntos_aux'=>  $suma_ganador+=$key->aciertos*$key->valor_puntaje_g
               ]);
              } ;
            }      
           }
        
	
   
}