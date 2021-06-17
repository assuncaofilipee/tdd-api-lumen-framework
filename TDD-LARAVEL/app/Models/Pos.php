<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    use HasFactory;

    protected $table = 'pos';

    protected $primaryKey = 'id_pos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $casts = [ 'nm_pos' => 'string', 'nm_modelo' => 'string',
        'nm_terminal' => 'string', 'nr_serie' => 'string', 'nu_pos' => 'string',
        'id_pos_situacao' => 'integer', 'id_distribuidor' => 'integer',
        'id_cliente' => 'integer', 'id_pos_aplicativo' => 'integer'];

    protected $fillable = ['nm_pos', 'nm_modelo', 'nm_terminal',
        'nr_serie','id_pos_situacao','id_distribuidor','id_cliente',
        'id_pos_aplicativo','nu_pos'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'id_cliente');
    }

    public function distribuidor()
    {
        return $this->belongsTo(Distribuidor::class,'id_distribuidor');
    }

    public function posSituacao()
    {
        return $this->belongsTo(PosSituacao::class,'id_pos_situacao');
    }

    public function posAplicativo()
    {
        return $this->belongsTo(PosAplicativo::class,'id_pos_aplicativo');
    }

}
