<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'id_produto';

    protected $fillable = ['id_categoria', 'nome_produto', 'desc_produto', 'foto_produto', 'preco_produto'];
}
