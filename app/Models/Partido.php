<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'partidos';

    protected $fillable = ['idEquipoLocal','idEquipoVisitante','estado','jornada'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function equipo()
    {
        return $this->hasOne('App\Models\Equipo', 'id', 'idEquipoLocal');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function equipo1()
    {
        return $this->hasOne('App\Models\Equipo', 'id', 'idEquipoVisitante');
    }

    public function jornada()
    {
        return $this->hasOne('App\Models\Jornada', 'id', 'jornada');
    }
    
}
