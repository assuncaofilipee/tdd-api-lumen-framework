<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosAplicativo extends Model
{
    use HasFactory;

    protected $table = 'pos_aplicativo';

    protected $primaryKey = 'id_pos_aplicativo';

    protected $casts = ['nr_versao' => 'string','nm_pos_aplicativo' => 'string'];

    protected $fillable = ['nm_pos_aplicativo', 'nr_versao', 'tp_principal'];

    public function pos()
    {
        return $this->hasMany(Pos::class,'id_pos_aplicativo');
    }
}
