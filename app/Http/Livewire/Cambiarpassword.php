<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Jugadore;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;




class Cambiarpassword extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $newpassword;
    protected $listeners = ['updatePassword'];

    public function render()
    {
       
		$keyWord = '%'.$this->keyWord .'%';
    
         return view('livewire.cambiarpassword.view', [
            
        ]);
    }
    private function resetInput()
    {		
		$this->newpassword = null;
    }

    public function updatePassword($id)
    {
        $this->validate([
		'newpassword' => ['required', 'string', 'min:8'],
        ]);

       
			$record = User::find(auth()->id());
            $record->update([ 
			'password' =>Hash::make($this->newpassword),
		
            ]);

            $this->resetInput();
			session()->flash('message', 'Cambio de contraseña exitoso.');
        
    }
	
   
}