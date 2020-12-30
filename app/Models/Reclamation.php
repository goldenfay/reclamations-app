<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class Reclamation extends Model
{
    use HasFactory;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titre',
        'objet',
        'corps',
        'date',
        'etat',
        'reclamateur',
    ];

    public function reclamateur(){

        return $this->belongsTo(Client::class,'reclamateur')->first();
    }
}
