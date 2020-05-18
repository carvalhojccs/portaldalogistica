<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItemEmpenho;
use Illuminate\Http\Request;
use Validator;

class ItemEmpenhoController extends Controller
{
    protected $repository;
    
    public function __construct(ItemEmpenho $itemEmpenho) 
    {
        $this->repository = $itemEmpenho;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'descricao'     => 'required',
            'quantidade'    => 'required',
            'valor'         => 'required',
        ];
        
        $error = Validator::make($request->all(), $rules);
        
        if($error->fails()):
            return response()->json(['errors' => $error->errors()->all()]);
        endif;
        
        $data = [
            'empenho_id'                => $request->empenho_id,
            'status_item_empenho_id'    => 1,
            'descricao'                 => $request->descricao,
            'quantidade'                => $request->quantidade,
            'valor'                     => $request->valor,
            
        ];
        
        $this->repository->create($data);
        
        return response()->json(['success' => 'Cadastro efetuado com sucesso!']);
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = $this->repository->find($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'descricao'     => 'required',
            'quantidade'    => 'required',
            'valor'         => 'required',
        ];
        
        $error = Validator::make($request->all(), $rules);
        
        if($error->fails()):
            return response()->json(['errors' => $error->errors()->all()]);
        endif;
        
        $data = [
            'empenho_id'                => $request->empenho_id,
            'status_item_empenho_id'    => 1,
            'descricao'                 => $request->descricao,
            'quantidade'                => $request->quantidade,
            'valor'                     => $request->valor,
            
        ];
        
        $this->repository->whereId($request->hidden_id)->update($data);
        
        return response()->json(['success' => 'Cadastro atualizado com sucesso!']);
        
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($data = $this->repository->find($id)):
            $data->delete();
        endif;
    }
}
