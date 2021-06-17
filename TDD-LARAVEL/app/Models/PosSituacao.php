<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosSituacao extends Model
{
    use HasFactory;

    protected $table = 'pos_situacao';

    protected $primaryKey = 'id_pos_situacao';

    protected $casts = [ 'nm_pos_situacao' => 'string'];

    protected $fillable = ['nm_pos_situacao'];

    public function pos()
    {
        return $this->hasMany(Pos::class,'id_pos_situacao');
    }
}
