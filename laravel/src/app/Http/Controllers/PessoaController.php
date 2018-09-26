<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Model\Pessoa;

class PessoaController extends BaseController
{

    protected $pessoa = null;

    public function __construct(Pessoa $pessoa)
    {
        $this->pessoa = $pessoa;
    }

    public function todasPessoas()
    {
        // $pessoas = Pessoa::orderBy('primeiro_nome', 'desc')
        //        ->get();
        //return $pessoas;
        return response()->json($this->pessoa->todasPessoas(), 200)
            ->header('Content-Type', 'application/json');
    }

    public function getPessoa($id)
    {
        $pessoa = $this->pessoa->getPessoa($id);
        if (!$pessoa) {
            return response()->json(['response', 'Pessoa não encontrada'], 400)
                ->header('Content-Type', 'application/json');
        }
        return response()->json($pessoa, 200)
            ->header('Content-Type', 'application/json');
    }

    public function salvarPessoa()
    {
        return response()->json($this->pessoa->salvarPessoa(), 200)
            ->header('Content-Type', 'application/json');;
    }

    public function atualizarPessoa($id)
    {
        $pessoa = $this->pessoa->atualizaPessoa($id);
        if (!$pessoa) {
            return response()->json(['response', 'Pessoa não encontrada'], 400)
                ->header('Content-Type', 'application/json');
        }
        return response()->json($pessoa, 200)
            ->header('Content-Type', 'application/json');
    }

    public function deletarPessoa($id)
    {
        $pessoa = $this->pessoa->deletePessoa($id);
        if (!$pessoa) {
            return response()->json(['response', 'Pessoa não encontrado'], 400)
                ->header('Content-Type', 'application/json');
        }
        return response()->json(['response' => 'Pessoa deletada com sucesso!'], 200)
            ->header('Content-Type', 'application/json');
    }

}
