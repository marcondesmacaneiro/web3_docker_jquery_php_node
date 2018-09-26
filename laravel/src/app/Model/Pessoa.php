<?php
namespace App\Model;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

    public function salvarPessoa(Request $request)
    {
        $pessoa = new Pessoa($request->all());
        $pessoa->password = Hash::make($pessoa->password);
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

    public function atualizaPessoa(Request $request, $id)
    {
        $pessoa = self::find($id);
        if (is_null($pessoa)) {
            return false;
        }
        $input = $request->all();
        if (isset($input['password'])) {
            $pessoa->password = Hash::make($input['password']);
        }
        $pessoa->fill($input);
        $pessoa->save();
        return $pessoa;
    }
}
