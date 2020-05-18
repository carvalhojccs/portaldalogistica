<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateEmpenhoFormRequest;
use App\Models\Empenho;
use App\Models\Empresa;
use App\Models\LinhaCredito;
use App\Models\Natureza;
use App\Models\StatusEmpenho;
use App\Models\TipoItem;
use Illuminate\Http\Request;

class EmpenhoController extends Controller
{
    protected   $tipoItemRepository;
    protected   $empresaRepository;
    protected   $linhaCreditoRepository;
    protected   $naturezaRepository;
    protected   $statusEmpenhoRepository;
    protected   $empenhoRepository;
    protected   $model;


    public function __construct(
            TipoItem $tipoItem,
            Empresa $empresa,
            LinhaCredito $linhaCredito,
            Natureza $natureza,
            StatusEmpenho $statusEmprenho,
            Empenho $empenho,
            Request $request
            )
    {
        $this->tipoItemRepository       = $tipoItem;
        $this->empresaRepository        = $empresa;
        $this->linhaCreditoRepository   = $linhaCredito;
        $this->naturezaRepository       = $natureza;
        $this->statusEmpenhoRepository  = $statusEmprenho;
        $this->empenhoRepository        = $empenho;
        $this->model                    = $request->segment(2);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recupera todos os empenhos e seus relacionamentos
        $data = $this->empenhoRepository->with([
            'tipoItem',
            'empresa',
            'linhaCredito',
            'natureza',
            'statusEmpenho',
            'itensEmpenhos',
        ])->paginate();
        

        
        /*
         * retorna a view index.blade.php localizada na pasta
         * resources\views\admin\locais
         * e passa os locais no array $data
         */
        return view('admin.'.$this->model.'.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //retorna todos os tipos de itens
        $tiposItens = $this->tipoItemRepository->pluck('nome', 'id');
        
        //retorna todas asempresas
        $empresas = $this->empresaRepository->pluck('nome', 'id');
        
        //retorna todas as llinhas de crédito
        $linhasCreditos = $this->linhaCreditoRepository->get();
        
        //retorna todas as naturezas de despesas
        $naturezas = $this->naturezaRepository->pluck('natureza','id');
        
        //retorna todos os status do empenho
        $statusEmpenhos = $this->statusEmpenhoRepository->pluck('status','id');
        /*
         * retorna a view create.blade.php localizada na pasta
         * resourses\views\admin\locais
         */
        return view('admin.'.$this->model.'.create', compact('tiposItens','empresas','linhasCreditos','naturezas','statusEmpenhos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateEmpenhoFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateEmpenhoFormRequest $request)
    {
        $data = $request->all();
        $data['status_empenho_id'] = 1;
        
        //dd($data);
        
      /*
         * recupera os dados do formulário via $request e na tabela
         * se os dados foram persistidos,retorna a view index.blade.php
         * localizada em resources\views\admin\locais
         * caso haja algum erro,retorna para a página anterior         * 
         */
        if($this->empenhoRepository->create($data)):
            return redirect()->route($this->model.'.index')->withSuccess('m');
        else:
            return redirect()->back;
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($data = $this->empenhoRepository->find($id)):
            return view('admin.'.$this->model.'.show', compact('data'));
        else:
            return redirect()->back()->withErrors('Erro ao buscar dados!');
        endif;
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
     * @param  \App\Http\Requests\StoreUpdateEmpenhoFormRequest  $request
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
