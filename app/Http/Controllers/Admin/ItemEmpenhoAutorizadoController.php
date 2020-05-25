<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItemEmpenhoAutorizado;
use Illuminate\Http\Request;
use Validator;

class ItemEmpenhoAutorizadoController extends Controller
{
    protected $repository;
    
    public function __construct(ItemEmpenhoAutorizado $itemEmpenhoAutorizado) 
    {
        return $this->repository = $itemEmpenhoAutorizado;
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
        
        $rules = [
            'autorizado'    => 'required',
        ];
        
        $error = Validator::make($request->all(), $rules);
        
        if($error->fails()):
            return response()->json(['errors' => $error->errors()->all()]);
        endif;
        
        $data = [
            'item_empenho_id'   => $request->item_empenho_id,
            'autorizado'        => $request->autorizado,
        ];
        
        $this->repository->create($data);
        
        return response()->json(['success' => 'Cadastroefetuado com sucesso!']);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
