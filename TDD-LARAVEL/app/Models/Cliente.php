<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';

    protected $primaryKey = 'id_cliente';

    protected $casts = [ 'ds_razao_social' => 'string', 'nu_telefone' => 'string',
        'nu_celular' => 'string','nu_documento' => 'string'];

    const CREATED_AT = 'dt_cadastro';
    const UPDATED_AT = 'updated_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dt_situacao', 'nu_telefone', 'nu_celular', 'nm_cliente',
        'ds_razao_social','ds_nome_fantasia','nu_documento','dt_cadastro_cerc', 'email'
    ];

    public function pos()
    {
        return $this->hasMany(Pos::class,'id_cliente');
    }
}
