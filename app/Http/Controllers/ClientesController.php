<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\Contas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    //private $cliente;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $cliente;
    public function __construct(Clientes $cliente)
	{
		$this->Clientes = $cliente;
	}
    public function index()
    {
        //
        return response()->json($this->Clientes->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = $this->Clientes;
      
        $cliente->where('cpf',$request->cpf);
       
        //return response()->json($cliente, 201);
        if($cliente->count() > 0)
        {
            $data = array(
                'msg'=>'Cadastro Existente',
                'error'=>'01',
                'data'=> $cliente->get()
                );
            return response()->json($data, 201);
        }
      try {
        
        $cliente->create($request->all());

      } catch (\Throwable $th) {
        $data = array(
            'msg'=>'Error de Cadastro',
            'error'=>'01',
            'data'=> $th->getMessage()
        );
        return response()->json($data, 201);
      }
      $cliente_id   = $cliente->get();
      $conta        = new Contas;
      $conta->saldo = 0.00;
      $conta->cliente_id = $cliente_id->id;
      $conta->save();
      $data = array(
        'msg'=>'Cadastro Realizadao',
        'error'=>'01',
        'data'=> array(
            'cliente' => $cliente,
            'conta'   => $conta->get()
        ));

        return response()->json($data, 201);
      /*
        if($cliente == null){
            $cliente->nome          = $request->input('nome');;
            $cliente->password      = $request->input('email');;
            $cliente->cpf       = $request->input('cpf'); 
            if($cliente->save())        
                {

                    $data = array(
                        'msg'=>'Cadastro Criado com Sucesso!',
                        'error'=>'',
                        'data'=> $cliente
                    );
                    return response()->json($data, 201);
                }
                else{
                    $data = array(
                        'msg'=>'Erro ao cadastrar novo cliente',
                        'error'=>'01',
                        'data'=> $cliente
                    );
                    return response()->json($data, 200);
                }
        }
        else{
            $data = array(
                'msg'=>'Este CPF já Foi cadastrado, não pode ser inserido novamente',
                'error'=>'01',
                'data'=> $cliente
            );
            return response()->json($data, 201);
        }
        

        */
        
         

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(Clientes $clientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit(Clientes $clientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clientes $clientes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clientes $clientes)
    {
        //
    }
}
