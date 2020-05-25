<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empenho;
use App\Models\ItemEmpenho;
use App\Models\ItemEmpenhoAutorizado;
use Illuminate\Http\Request;
use Validator;

class ItemEmpenhoController extends Controller
{
    protected $repository;
    protected $empenhoRepository;
    protected $itemEmpenhoAutorizadoRepository;

    public function __construct(
            ItemEmpenho $itemEmpenho, 
            Empenho $empenho,
            ItemEmpenhoAutorizado $itemEmpenhoAutorrizado) 
    {
        $this->repository = $itemEmpenho;
        $this->empenhoRepository = $empenho;
        $this->itemEmpenhoAutorizadoRepository = $itemEmpenhoAutorrizado;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($empenho_id)
    {
        $empenho    = $this->empenhoRepository->find($empenho_id);
        $data       = $this->repository->with('itensEmpenhoAutorizados')->where('empenho_id',$empenho_id)->get();
        
        return view('admin.empenhos.itens.index', compact('data','empenho'));
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
        
       
        $this->repository->whereId($request->edit_item_empenho_id)->update($data);
        
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
            //verificar se existe alguma autorizacao para o item do empenho
            $verificaItemEmpenhoAutorizado = $this->itemEmpenhoAutorizadoRepository->where('item_empenho_id',$id)->count();
            if($verificaItemEmpenhoAutorizado > 0):
                $error = 'Existe(em) ' .$verificaItemEmpenhoAutorizado. ' autorização(ões) vinculadas a este item!';
                return response()->json(['error' => $error]);
                //return redirect()->route('itens_empenhos.index',$data->empenho_id)->with('verificaVinculo','Existe(em) ' .$verificaItemEmpenhoAutorizado. 'autorização(ões) vinculadas a este item!');
            else:
                $data->delete();
            endif;    
        endif;
    }
}
