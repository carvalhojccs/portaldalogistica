<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Util;
use App\Http\Controllers\Controller;
use App\Models\Cidade;
use App\Models\Colaborador;
use App\Models\Empenho;
use App\Models\Empresa;
use App\Models\Estado;
use App\Models\Telefone;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    protected   $empresaRepositoory, 
                $estadoRepository, 
                $cidadeRepository,
                $telefoneRepository,
                $colaboradorRepository,
                $empenhoRepository,
                $model;
    
    public function __construct(
            Empresa $empresa, 
            Estado $estado, 
            Cidade $cidade, 
            Telefone $telefone,
            Colaborador $colaborador,
            Empenho $empenho,
            Request $request)
    {
        $this->empresaRepositoory       = $empresa;
        $this->estadoRepository         = $estado;
        $this->cidadeRepository         = $cidade;
        $this->telefoneRepository       = $telefone;
        $this->colaboradorRepository    = $colaborador;
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
        //recupera todas as empresas com seu estado, cidade, telefones, colaboradores
        $data = $this->empresaRepositoory->with(['estado','cidade','telefones','colaboradores'])->paginate();
        
        /*
         * retorna a view index.blade.php localizada em
         * resources\views\admin\empresas e passa os dados no array $data
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
        //recupera todos os estados
        $estados = $this->estadoRepository->pluck('nome','id');
        
        //recupera todas as cidades
        $cidades = $this->cidadeRepository->pluck('nome','id');
        
        return view('admin.'.$this->model.'.create', compact('estados','cidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['cnpj'] = Util::limpaCNPJ($request->cnpj);
        
        if($this->empresaRepositoory->create($data)):
            return redirect()->route($this->model.'.index')->withSuccess('m');
        else:
            return redirect()->back();
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
        /*
         * pesquisa o item pelo seu id e verifica se existe.
         * Caso exista, retorna a view show.blade.php
         * localiza da pasta resources\views\admin\empresas
         * e passa os dados no array $data
         * caso contrário,retorna à página anterior
         */
        if($data = $this->empresaRepositoory->find($id)):
            return view('admin.'.$this->model.'.show', compact('data'));
        else:
            return redirect()->back();
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
        //verifica se existe algum empenho vinculado a empresa
        $verificaEmpenho = $this->empenhoRepository->where('empresa_id',$id)->count();
        if($verificaEmpenho > 0):
            return redirect()->route($this->model.'.show',$id)->with('verificaVinculo','Existe(em) '. $verificaEmpenho . ' empenho(os) vinculado(os) a esta empresa!');
            
        else:
            //deleta os telefones
            $this->telefoneRepository->where('empresa_id',$id)->delete();
        
            //deleta os colaboradores
            $this->colaboradorRepository->where('empresa_id',$id)->delete();
        
            //deleta a empresa
            $this->empresaRepositoory->where('id',$id)->delete();
        
            return redirect()->route($this->model.'.index')->withSuccess('m');
            
        endif;
        
        
        
    }
}
