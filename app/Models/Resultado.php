<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'resultados';

    protected $fillable = ['partido','golesLocal','golesVisitante','ganador'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function partido()
    {
        return $this->hasOne('App\Models\Partido', 'id', 'partido');
    }
    
}
