<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pronostico;
use App\Models\Partido;
use App\Models\Jornada;


use Illuminate\Support\Facades\DB;


class Pronosticos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $jugador, $partido, $golesLocal, $golesVisitante, $ganador,$jornada=0;
    
    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        $sql = 'select pronosticos.id,idEquipoLocal, idEquipoVisitante,golesLocal,golesVisitante,pronosticos.ganador,partidos.estado,jornadas.descripcion, partidos.id as partido, jornadas.id as jornada
        from pronosticos
         join partidos on partidos.id = pronosticos.partido 
         join jornadas on jornadas.id = partidos.jornada 
         where pronosticos.jugador =' .auth()->id().' and partidos.jornada ='.$this->jornada ;
        

        $pronosticosJornada = DB::select($sql);

        $jornadas = Jornada::all();

        return view('livewire.pronosticos.view', [
            'pronosticosJornada' => $pronosticosJornada,
            'jornadas' => $jornadas,


        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->jugador = null;
		$this->partido = null;
		$this->golesLocal = null;
		$this->golesVisitante = null;
		$this->ganador = null;
    }

    public function store()
    {
        $this->validate([
		'jugador' => 'required',
		'partido' => 'required',
		'golesLocal' => 'required',
		'golesVisitante' => 'required',
		'ganador' => 'required',
        ]);

        Pronostico::create([ 
			'jugador' => $this-> jugador,
			'partido' => $this-> partido,
			'golesLocal' => $this-> golesLocal,
			'golesVisitante' => $this-> golesVisitante,
			'ganador' => $this-> ganador
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Pronostico Successfully created.');
    }

    public function edit($id)
    {
        $record = Pronostico::findOrFail($id);
        $this->selected_id = $id; 
		$this->jugador = $record-> jugador;
		$this->partido = $record-> partido;
		$this->golesLocal = $record-> golesLocal;
		$this->golesVisitante = $record-> golesVisitante;
		$this->ganador = $record-> ganador;
    }

    public function jornada($id)
    {
        $record = Jornada::findOrFail($id);
        $this->jornada = $id; 
		
    }
    

    public function update()
    {
        $this->validate([
		'jugador' => 'required',
		'partido' => 'required',
		'golesLocal' => 'required',
		'golesVisitante' => 'required',
		'ganador' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Pronostico::find($this->selected_id);
            $record->update([ 
			'jugador' => $this-> jugador,
			'partido' => $this-> partido,
			'golesLocal' => $this-> golesLocal,
			'golesVisitante' => $this-> golesVisitante,
			'ganador' => $this-> ganador
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Pronóstico creado con éxito.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Pronostico::where('id', $id)->delete();
        }
    }

    
    public function pronosticar($pronostico)
    {
    
        $estadoPartido= DB::table('partidos')->select('estado')->join('pronosticos', 'pronosticos.partido', '=', 'partidos.id')->where('pronosticos.id',$pronostico)->pluck('estado')->first();

        if($estadoPartido==1){
        $this->dispatchBrowserEvent('closeModal');
        $this->emit('bloqueado');
        }else{
        $record = Pronostico::findOrFail($pronostico);
        if($this->golesLocal > $this->golesVisitante){
            $ganador= Partido::select("nombre_equipo")->join('equipos', 'equipos.id', '=', 'partidos.idEquipoLocal')->where('partidos.id',$record->partido)->pluck('nombre_equipo')->first();



        }elseif($this->golesLocal == $this->golesVisitante){
            $ganador='Empate';

        }else{
            $ganador= Partido::select("nombre_equipo")->join('equipos', 'equipos.id', '=', 'partidos.idEquipoVisitante')->where('partidos.id',$record->partido)->pluck('nombre_equipo')->first();

        }
       
        $record->update([
            'jugador' => auth()->id(),
            'partido' => $record-> partido,
            'golesLocal' => $this-> golesLocal,
            'golesVisitante' => $this-> golesVisitante,
            'ganador'=> $ganador,
            'estado'=> $record->estado
         
        ]);
       
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Pronóstico con éxito.');
        }
    }
}