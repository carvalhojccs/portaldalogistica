<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateLinhaCreditoFormRequest;
use App\Models\LinhaCredito;
use Illuminate\Http\Request;

class LinhaCreditoController extends Controller
{
    protected $repository, $model;
    
    public function __construct(LinhaCredito $linhaCredito, Request $request) 
    {
        $this->repository   = $linhaCredito;
        $this->model        = $request->segment(2);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ecupera todas as linhas de crédito
        $data = $this->repository->orderBy('id','desc')->paginate();
        
        /*
         * retorna a view index.blade.php localizada em
         * resources\views\admin\linhas_creditos e passa os dados no array $data
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
        /*
         * retorna a view create.blade.php localizada na pasta
         * resourses\views\admin\linhas_creditos
         */
        return view('admin.'.$this->model.'.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateLinhaCreditoFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateLinhaCreditoFormRequest $request)
    {
        //verifica se a linha de crédito já foi cadastrada
        $verificaLinhaCredito = $this->repository
                ->where('pi',$request->pi)
                ->where('ptres',$request->ptres)
                ->where('fonte',$request->fonte)->count();
        
        if($verificaLinhaCredito > 0):
            return redirect()->route($this->model.'.create')->with('info', 'Esta linha de crédito já está cadastrada!');
        endif;
        
        //atribui o usuário que cadastrou a linha de crédito
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        
        if($this->repository->create($data)):
            return redirect()->route($this->model.'.index')->withSuccess('m');
        else:
            return redirect()->back()->with('error', 'Falha ao cadastrar');
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
         * localiza da pasta resources\views\admin\linhas_creditos
         * e passa os dados no array $data
         * caso contrário,retorna à página anterior
         */
        if($data = $this->repository->find($id)):
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
         /*
         * Busca o item pelo seu id.
         * Caso encontre, retorna a view edit.blade.phhp
         * localizada em resources\views\admin\linhas_creditos
         * e passa os dados no array $data.
         * Caso não enontre, retorna para a página anterior
         */
        if($data = $this->repository->find($id)):
            return view('admin.'.$this->model.'.edit', compact('data'));
        else:
            return redirect()->back();
        endif;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateLinhaCreditoFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateLinhaCreditoFormRequest $request, $id)
    {
        //verifica se a linha de crédito já foi cadastrada
        $verificaLinhaCredito = $this->repository
                ->where('pi',$request->pi)
                ->where('ptres',$request->ptres)
                ->where('fonte',$request->fonte)->count();
        
        if($verificaLinhaCredito > 0):
            return redirect()->route($this->model.'.create')->with('info', 'Esta linha de crédito já está cadastrada!');
        endif;
        
        //atribui o usuário que cadastrou a linha de crédito
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        
        /*
         * Busca o item pelo seu id.
         * Caso encontre, atualiza os dados que foram passados pelo formulário
         * através do request.
         * Caso não encontre, retorna a view index.blade.php
         * localizada em resourses\views\admin\locais com uma mensagem de sucesso
         * Caso contrario,retorna para a página anterior
         */
        if($data = $this->repository->find($id)):
            $data->update($request->all());
            return redirect()->route($this->model.'.index')->withSuccess('m');
        else:
            return redirect()->back();
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*
         * Busca o item pelo seu id.
         * Caso encontre, deleta o item da tabela e retorna a view index.blade.php
         * localizada em resources\views\admin\linhas_creditos com umma mensagem de sucesso.
         * Caso contrário, retorna para a página anterior         * 
         */
        if($data = $this->repository->find($id)):
            $data->delete();
            return redirect()->route($this->model.'.index')->withSuccess('m');
        else:
            return redirect()->back();
        endif;
    }
}
