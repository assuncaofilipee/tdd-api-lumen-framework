<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribuidor extends Model
{
    use HasFactory;

    protected $table = 'distribuidor';

    protected $primaryKey = 'id_distribuidor';

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
        'nu_telefone', 'nu_celular', 'nm_distribuidor',
        'ds_razao_social','ds_nome_fantasia','nu_documento'
    ];

    public function pos()
    {
        return $this->hasMany(Pos::class,'id_distribuidor');
    }

    public function user()
    {
        return $this->hasMany(User::class,'id_distribuidor');
    }
}
