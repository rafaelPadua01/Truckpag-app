<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Endereco;
use App\Models\Cidades;
use Inertia\Inertia;

class EnderecoController extends Controller
{
    //
    private $endereco;

    public function _construct(Endereco $endereco){
        $this->endereco = $endereco;
    }

    public function index(){
        $cidades = Cidades::all();
        $enderecos = Endereco::all();
        return Inertia::render('endereco', [
            'cidades' => $cidades,
            'enderecos' => $enderecos,
        ]);
    }
    public function store(Request $request){
        try{
            $store = Endereco::create([
                'cidade_id' => $request->cidade_id,
                'logradouro' => $request->logradouro,
                'numero' => $request->numero,
                'bairro' => $request->bairro,
            ]);
            $response = true;
            return \Response::json($response);
        }catch(Exception $e){
            $erro = $e;
            return \Response::json($error);
        }
        
    }
    public function update(Request $request, $id){
        
        try{
            $endereco = Endereco::findOrFail($id)->where('id', '=', $id)->update([
                'cidade_id' => $request->cidade_id,
                'logradouro' => $request->logradouro,
                'numero' => $request->numero,
                'bairro' => $request->bairro,
               
            ]);
            $response = true;
            return \Response::json($response);
        }catch(Exception $e){
            $error  = $e;
            return \Response::json($error);
        }
    }
    public function destroy($id){
        $endereco = Endereco::findOrFail($id);
        try{
            $delete = Endereco::where('id', '=', $id)->delete();
            $response = true;
            return \Response::json($response);
        }catch(Exception $e){
            $error = $e;
            return \Response::json($error);
        }
    }
}
