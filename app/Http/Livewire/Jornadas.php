<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Jornada;

class Jornadas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $descripcion, $valor_puntaje_me, $valor_puntaje_g;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.jornadas.view', [
            'jornadas' => Jornada::latest()
						->orWhere('descripcion', 'LIKE', $keyWord)
						->orWhere('valor_puntaje_me', 'LIKE', $keyWord)
						->orWhere('valor_puntaje_g', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->descripcion = null;
		$this->valor_puntaje_me = null;
		$this->valor_puntaje_g = null;
    }

    public function store()
    {
        $this->validate([
		'descripcion' => 'required',
		'valor_puntaje_me' =>  ['required', 'integer'],
		'valor_puntaje_g' =>  ['required', 'integer'],
        ]);

        Jornada::create([ 
			'descripcion' => ucwords(mb_strtolower($this->descripcion)),
			'valor_puntaje_me' => $this-> valor_puntaje_me,
			'valor_puntaje_g' => $this-> valor_puntaje_g
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Jornada creada con éxito.');
    }

    public function edit($id)
    {
        $record = Jornada::findOrFail($id);
        $this->selected_id = $id; 
		$this->descripcion = $record-> descripcion;
		$this->valor_puntaje_me = $record-> valor_puntaje_me;
		$this->valor_puntaje_g = $record-> valor_puntaje_g;
    }

    public function update()
    {
        $this->validate([
		'descripcion' => 'required',
		'valor_puntaje_me' => 'required',
		'valor_puntaje_g' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Jornada::find($this->selected_id);
            $record->update([ 
			'descripcion' => $this-> descripcion,
			'valor_puntaje_me' => $this-> valor_puntaje_me,
			'valor_puntaje_g' => $this-> valor_puntaje_g
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Jornada actualizada con éxito.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Jornada::where('id', $id)->delete();
        }
    }
}