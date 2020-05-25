<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItemEmpenhoAutorizado;
use App\Models\Requisicao;
use Illuminate\Http\Request;
use Validator;

class RequisicaoController extends Controller
{
    protected $repository, $itemEmpenhoAutorizadoRepository;
    
    public function __construct(Requisicao $requisicao, ItemEmpenhoAutorizado $itemEmpenhoAutorizado) 
    {
        $this->repository = $requisicao;
        $this->itemEmpenhoAutorizadoRepository = $itemEmpenhoAutorizado;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($item_empenho_id)
    {
        $autorizacoes = $this->itemEmpenhoAutorizadoRepository->with(['requisicoes', 'itemEmpenho.empenho'])->where('item_empenho_id',$item_empenho_id)->get();
        
        
        return view('admin.empenhos.itens.requisicoes.index', compact('autorizacoes'));
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
        $roles = [
            'requisicao' => 'required',
        ];
        
        $error = Validator::make($request->all(),$roles);
        
        if($error->fails()):
            return response()->json(['errors' => $error->errors()->all()]);
        endif;
        
        $data = [
            'item_empenho_autorizado_id'    => $request->item_empenho_autorizado_id,
            'requisicao'                    => $request->requisicao,
        ];
        
        $this->repository->create($data);
        
        return response()->json(['success' => 'Requisição cadastrada com sucesso!']);
        
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
        if(request()->ajax()):
            $data = $this->repository->find($id);
            return response()->json(['result' => $data]);
        endif;
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
        $roles = [
            'requisicao' => 'required',
        ];
        
        $error = Validator::make($request->all(),$roles);
        
        if($error->fails()):
            return response()->json(['errors' => $error->errors()->all()]);
        endif;
        
        $data = [
            'requisicao' => $request->requisicao,
        ];
        
        $this->repository->whereId($request->requisicao_id)->update($data);
        
        return response()->json(['success' => 'Requisição atualizada com sucesso!']);
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
