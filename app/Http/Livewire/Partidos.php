<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Partido;
use App\Models\Equipo;
use App\Models\Resultado;
use App\Models\Pronostico;
use App\Models\User;
use App\Models\Jornada;





class Partidos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $idEquipoLocal, $idEquipoVisitante,$jornada;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        $equipos = Equipo::all();
        $jornadas = Jornada::all();

       
        return view('livewire.partidos.view', [
            'partidos' => Partido::latest()
						->orWhere('idEquipoLocal', 'LIKE', $keyWord)
						->orWhere('idEquipoVisitante', 'LIKE', $keyWord)
                        ->paginate(8),
        ], compact('equipos','jornadas'));
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->idEquipoLocal = null;
		$this->idEquipoVisitante = null;
		$this->jornada = null;

    }

    public function store()
    {
        $this->validate([
		'idEquipoLocal' => 'required',
		'idEquipoVisitante' => 'required',
		'jornada' => 'required',

        ]);

        Partido::create([ 
			'idEquipoLocal' => $this-> idEquipoLocal,
			'idEquipoVisitante' => $this-> idEquipoVisitante,
            'estado' => 0,
            'jornada'=> $this->jornada,
        ]);
        $partido = Partido::latest('created_at')->pluck('id')->first();
        Resultado::create([ 
			'partido' => $partido,
			'golesLocal' => null,
			'golesVisitante' => null,
			'ganador' => null
        ]);
        $jugadores= User::all()->pluck('id');
    
        foreach ($jugadores as $i) {
       
        
        Pronostico::create([ 
			'jugador' => $i,
			'partido' => $partido,
			'golesLocal' => null,
			'golesVisitante' => null,
			'ganador' => null
			
            
        ]);
        }
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Partido creado con éxito.');
    }

    public function edit($id)
    {
        $record = Partido::findOrFail($id);
        $this->selected_id = $id; 
		$this->idEquipoLocal = $record-> idEquipoLocal;
		$this->idEquipoVisitante = $record-> idEquipoVisitante;
		$this->jornada = $record-> jornada;

    }

    public function update()
    {
        $this->validate([
		'idEquipoLocal' => 'required',
		'idEquipoVisitante' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Partido::find($this->selected_id);
            $record->update([ 
			'idEquipoLocal' => $this-> idEquipoLocal,
			'idEquipoVisitante' => $this-> idEquipoVisitante,
			'jornada' => $this-> jornada


            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Partido actualizado con éxito.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Partido::where('id', $id)->delete();
        }
    }
}