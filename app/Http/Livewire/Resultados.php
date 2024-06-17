<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Resultado;
use App\Models\Partido;
use Illuminate\Support\Facades\DB;
use App\Models\Jugadore;
use App\Models\User;




class Resultados extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $partido, $golesLocal, $golesVisitante, $ganador;

    protected $listeners = ['bloquearPartido'];
    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        $sql = 'select resultados.id,idEquipoLocal, idEquipoVisitante,golesLocal,golesVisitante,resultados.ganador,jornadas.descripcion
        from resultados
         join partidos on partidos.id = resultados.partido
         join jornadas on jornadas.id = partidos.jornada';
         

        $resultados = DB::select($sql);
        return view('livewire.resultados.view', [
            'resultados' =>$resultados,
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->partido = null;
		$this->golesLocal = null;
		$this->golesVisitante = null;
		$this->ganador = null;
    }

    public function store()
    {
        $this->validate([
		'partido' => 'required',
		'golesLocal' => 'required',
		'golesVisitante' => 'required',
		'ganador' => 'required',
        ]);

        Resultado::create([ 
			'partido' => $this-> partido,
			'golesLocal' => $this-> golesLocal,
			'golesVisitante' => $this-> golesVisitante,
			'ganador' => $this-> ganador
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Resultado creado con éxito.');
    }

    public function edit($id)
    {
        $record = Resultado::findOrFail($id);
        $this->selected_id = $id; 
		$this->partido = $record-> partido;
		$this->golesLocal = $record-> golesLocal;
		$this->golesVisitante = $record-> golesVisitante;
		$this->ganador = $record-> ganador;
    }

    public function update()
    {
        $this->validate([
		'partido' => 'required',
		'golesLocal' => 'required',
		'golesVisitante' => 'required',
		'ganador' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Resultado::find($this->selected_id);
            $record->update([ 
			'partido' => $this-> partido,
			'golesLocal' => $this-> golesLocal,
			'golesVisitante' => $this-> golesVisitante,
			'ganador' => $this-> ganador
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Resultado registrado con éxito.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Resultado::where('id', $id)->delete();
        }
    }
    public function agregarResultado($resultado)
    {
        
        $record = Resultado::findOrFail($resultado);
        if($this->golesLocal > $this->golesVisitante){
            $ganador= Partido::select("nombre_equipo")->join('equipos', 'equipos.id', '=', 'partidos.idEquipoLocal')->where('partidos.id',$record->partido)->pluck('nombre_equipo')->first();



        }elseif($this->golesLocal == $this->golesVisitante){
            $ganador='Empate';

        }else{
            $ganador= Partido::select("nombre_equipo")->join('equipos', 'equipos.id', '=', 'partidos.idEquipoVisitante')->where('partidos.id',$record->partido)->pluck('nombre_equipo')->first();

        }
        $record->update([
            'partido' => $record-> partido,
            'golesLocal' => $this-> golesLocal,
            'golesVisitante' => $this-> golesVisitante,
            'ganador' => $ganador,
        ]);
       
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Resultado registrado con éxito.');
      

    }
        public function bloquearPartido($partido)
    {

        $record = Partido::where('id', $partido);
        $record->update([

            'estado' => '1'
        ]);

        $this->resetInput();
        $this->updateMode = false;
        session()->flash('message', 'Partido bloqueado con éxito.');
		
    }
}