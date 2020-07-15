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
        $input = $request->all();
        $cpf = $input['cpf'];
       $clienteN = DB::table('clientes')->where('cpf',$cpf)->first();
        if($clienteN)
        {
            $data = array(
                'msg'=>'Cadastro Existente',
                'error'=>'01',
                'data'=> $clienteN->nome
                );
            return response()->json($data, 201);
        }
      
        try {
        
            $id =  $cliente->
            create(
                [
                    'nome'=> $input['nome'],
                    'password'=>$input['password'],
                    'cpf'=>$input['cpf'],
                ]
                )->id;
      } 
      catch (\Throwable $th) {
        $data = array(
            'msg'=>'Error de Cadastro Cliente',
            'error'=>'01',
            'data'=> $th->getMessage()
        );
        return response()->json($data, 201);
      }
  
        try {
            
            $conta              = new Contas;
            $id =  $conta->
            create(
                [
                    'cliente_id'=> $id,
                    'saldo'=>0.0
                     
                ]
                )->id;
        
        } catch (\Throwable $th) {
            $data = array(
                'msg'=>'Error de Cadastro Conta',
                'error'=>'2',
                'data'=> $th->getMessage()
            );
            return response()->json($data, 201);
        }
        $data = array(
            'msg'=>'Cadastro Realizadao',
            'error'=>'0',
            'data'=> array(
                'cliente'  => $input['nome'],
                'conta'    => $id
            ));
        
        return response()->json($data, 201);
       

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function saldo(Request $request)
    {
        $input = $request->all();
        $saldo_cliente = DB::table('clientes')
            ->join('contas', 'cliente_id', '=', 'clientes.id')
            ->select('clientes.*', 'contas.saldo')
            ->where('clientes.cpf','=',$input['cpf'])
            ->get();
        $data = array(
            'msg' =>'Consulta de Saldo ',
            'data'=> date('d/m/Y H:m'), 
            'saldo' => number_format($saldo_cliente[0]->saldo,2)
        );
        return response()->json($data, 200); 
    }
    public function saque(Request $request)
    {
        $input = $request->all();
        if($input['cpf'] && $input['valor'])
        {
            $conta_cliente = DB::table('clientes')
            ->join('contas', 'cliente_id', '=', 'clientes.id')
            ->select('clientes.*', 'contas.saldo','contas.id as num_conta')
            ->where('clientes.cpf','=',$input['cpf'])
            ->get();
            $dd_cliente = $conta_cliente[0];
            //dd($conta_cliente[0]);
            if($dd_cliente->saldo < $input['valor'])
            {
                $data = array(
                    'msg'   => 'Seu saldo é insuficiente pra realizar este saque',
                    'saldo' =>  number_format($dd_cliente->saldo ,2)
                );
                return response()->json($data, 200);
            }
            else{
               
                $saldo = $dd_cliente->saldo -$input['valor'];
                $conta = DB::table('contas')
                ->where('cliente_id','=',$dd_cliente->id)
                ->update(['saldo' => $saldo]);
                $data = array(
                    'msg'=>'Saque Realizado com Sucesso',
                    'saldo'=>  number_format($saldo,2)
                );
                return response()->json($data, 200);
            }
        }
    }   
        public function deposito(Request $request)
        {
            $input = $request->all();
            if($input['cpf'] && $input['valor'])
            {
                $conta_cliente = DB::table('clientes')
                ->join('contas', 'cliente_id', '=', 'clientes.id')
                ->select('clientes.*', 'contas.saldo','contas.id as num_conta')
                ->where('clientes.cpf','=',$input['cpf'])
                ->get();
                $dd_cliente = $conta_cliente[0];
                
                if($input['valor'] != 0 && $input['valor'] != ""){
                    $saldo = $dd_cliente->saldo + $input['valor'];
                    
                    $conta = DB::table('contas')
                    ->where('cliente_id','=',$dd_cliente->id)
                    ->update(['saldo' => $saldo]);
                    $data = array(
                        'msg'=>'Deposito Realizado com Sucesso',
                        'saldo'=> number_format($saldo,2)
                    );
                    return response()->json($data, 200);
    
                }
            }
       // $conta = Contas::find($conta_cliente->);
         
       $data = array(
        'msg'=>'Deposito Não Realizado parametros invalidos',
        
        );
        return response()->json($data, 200);
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
