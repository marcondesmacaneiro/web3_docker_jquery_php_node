<?php
namespace App\Model;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{

    protected $table = 'pessoa';
    protected $hidden = ['password'];
    protected $fillable = array('primeiro_nome', 'segundo_nome', 'email', 'cidade', 'estado', 'password');
    protected $guarded = array('id', 'password');

    public function todasPessoas()
    {
        return self::all();
    }

    public function salvarPessoa()
    {
        // $input = Input::all();
        //dd(Input::all());
        $pessoa = new Pessoa(Input::all());
        $pessoa->password = Hash::make($pessoa->password);
        // $pessoa->fill($pessoa); //mass assigment
        // $pessoa->primeiro_nome = $input['primeiro_nome'];
        // $pessoa->segundo_nome = $input['segundo_nome'];
        $pessoa->save();
        return $pessoa;
    }

    public function getPessoa($id)
    {
        $pessoa = self::find($id);
        if (is_null($pessoa)) {
            return false;
        }
        return $pessoa;
    }

    public function deletePessoa($id)
    {
        $pessoa = self::find($id);
        if (is_null($pessoa)) {
            return false;
        }
        return $pessoa->delete(); //pode dar pau na hora de deletar e irá retornar false também
    }

    public function atualizaPessoa($id)
    {
        $pessoa = self::find($id);
        if (is_null($pessoa)) {
            return false;
        }
        $input = Input::all();
        if (isset($input['password'])) {
            $pessoa->password = Hash::make($input['password']);
        }
        $pessoa->fill($input);
        $pessoa->save();
        return $pessoa;
    }
}
