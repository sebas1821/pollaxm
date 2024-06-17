<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Jugadore;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class Jugadores extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombres, $apellidos, $celular, $email, $password, $idPerfil,$newpassword;
    protected $listeners = ['updatePassword'];

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.jugadores.view', [
            'jugadores' => User::latest()
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('email', 'LIKE', $keyWord)
						->orWhere('username', 'LIKE', $keyWord)
						->orWhere('password', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->nombres = null;
		$this->apellidos = null;
		$this->celular = null;
		$this->email = null;
		$this->password = null;
		$this->idPerfil = null;
    }

    public function store()
    {
        $this->validate([
		'nombres' => 'required',
		'apellidos' => 'required',
		'celular' => 'required',
		'email' => 'required',
		'password' => 'required',
        ]);

        Jugadore::create([ 
			'nombres' => ucwords(mb_strtolower($this->nombres)),
			'apellidos' => ucwords(mb_strtolower($this->apellidos)),
			'celular' => $this->celular,
			'email' => mb_strtolower($this->email),
			'password' => $this->password,
			'idPerfil' => 2,
			'puntos'=>0

        ]);
		User::create([
			'name' =>ucwords(mb_strtolower($this->nombres)).' '. ucwords(mb_strtolower($this->apellidos)),
			'email' => mb_strtolower($this->email),
			'username' => $this->celular,
			'password' => Hash::make($this->password)
		])->assignRole('Jugador');
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Jugador creado con éxito.');
    }

    public function edit($id)
    {
        $record = Jugadore::findOrFail($id);
        $this->selected_id = $id; 
		$this->nombres = $record-> nombres;
		$this->apellidos = $record-> apellidos;
		$this->celular = $record-> celular;
		$this->email = $record-> email;
		$this->password = $record-> password;
		$this->idPerfil = $record-> idPerfil;
    }
	
    public function edit2($id)
    {
        $record = User::findOrFail($id);
        $this->selected_id = $id; 
		$this->nombres = $record-> name;
		$this->apellidos = $record-> apellidos;
		$this->celular = $record-> username;
		$this->email = $record-> email;
		$this->password = $record-> password;
		
    }

    public function update()
    {
        $this->validate([
		'nombres' => 'required',
		'celular' => 'required',
		'email' => 'required',
		'password' => 'required',
        ]);

    
			$record = User::find($this->selected_id);
            $record->update([ 
			'name' =>ucwords(mb_strtolower($this->nombres)).' '. ucwords(mb_strtolower($this->apellidos)),
			'email' => mb_strtolower($this->email),
			'username' => $this->celular,
		
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Jugador actualizado con éxito.');
        
    }
	
    public function destroy($id)
    {
        if ($id) {
            User::where('id', $id)->delete();
        }
    }
}