<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertPermissoesFodaseTable extends Migration {

    public function up() {
        DB::table('permissoes')->insert([
            [
                'permanente' => 1,
                'permissao' => 'FODASE_LISTAR',
                'descricao' => 'Acessar a lista de Fodases',
            ],
            [
                'permanente' => 1,
                'permissao' => 'FODASE_DETALHAR',
                'descricao' => 'Acessar o detalhe do Fodase',
            ],
            [
                'permanente' => 1,
                'permissao' => 'FODASE_CADASTRAR',
                'descricao' => 'Acessar a tela de cadastro do Fodase',
            ],
            [
                'permanente' => 1,
                'permissao' => 'FODASE_EDITAR',
                'descricao' => 'Acessar a tela de edição do Fodase',
            ],
            [
                'permanente' => 1,
                'permissao' => 'FODASE_EXCLUIR',
                'descricao' => 'Você não pode excluir este Fodase',
            ],
        ]);
    }
}