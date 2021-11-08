<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Cidades;

class CidadesController extends Controller
{
    // função construtora da classe
    private $cidades;
    public function __construct(Cidades $cidades){
        $this->cidades = $cidades;
    }

    public function import(Request $request){
       // var_dump($request);
        //$data = $request->all();
        $import = Cidades::create([
            'nome' => $request->nome,
        ]);
        return response()->json(['location'=>$import, 200]);
        /*
        $import = Cidades::create([
            'nome' => $request->nome,
        ]);

        //bloco try catch, caso não seja importado retorna uma exceção
        try{
          //  dd($request);
            $import = Cidades::create([
                'nome' => $request->nome,
            ]);

            $response = true;
            return Inertia::render('cidades');
        }
        catch(Exception $e){
            $error = $e;
            return \Response::json($error);
        }*/
    }
}
