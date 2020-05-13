<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePapelFormRequest;
use App\Repositories\Contracts\PapelRepositoryInterface;
use Illuminate\Http\Request;

class PapelController extends Controller
{
    protected $repository, $model;
    
    public function __construct(PapelRepositoryInterface $repository, Request $request) 
    {
        $this->repository = $repository;
        $this->model = $request->segment(2);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recupera todos os papeis com paginação a cada 5 itens
        $data = $this->repository->paginate(5);
        
        //chama a view admin/papeis/index.blade.php e passa os dados no array
        return view('admin.'.$this->model.'.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.'.$this->model.'.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdatePapelFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePapelFormRequest $request)
    {
        if($this->repository->store($request->all())):
            return redirect()->route($this->model.'.index')->withSuccess('Cadastro realizado com sucesso!');
        else:
            return redirect()->back()->withErrors('Falha ao cadastrar!');
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
        //
        $data = $this->repository->findById($id);
        
        return view('admin.'.$this->model.'.show', compact('data'));
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
        if(!$data = $this->repository->findById($id)):
            return redirect()->back();
        else:
            return view('admin.'.$this->model.'.edit', compact('data')); 
        endif;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePapelFormRequest $request, $id)
    {
        //atualia os dados de um registro específico
        $this->repository->update($id, $request->all());
        
        //redireciona para a view admin/papeis/index.blade.php
        return redirect()->route($this->model.'.index')->withSuccess('Atualização realizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //verifica se o item foi deletado com sucesso e redireciona para a view admin/papeis/index.blade.php,
        //caso contrário mostra uma mensagem de erro
        if($this->repository->delete($id)):
            return redirect()->route($this->model.'.index')->withSuccess('Cadastro deletado co sucesso!');
        else:
            return redirect()->back()->withErrors("Falha ao deletar");
        endif;
    }
    
    /**
     * Mostra o resultado da pesquisa
     * 
     * @param Request $request
     * @return type
     */
    public function search(Request $request) 
    {
        //filtro com os parametros da pesquisa
        $filters = $request->except('_token');
        
        
        
        //realiza a pesquisa com os filtros passados e armazena em $data
        $data = $this->repository->search($filters);
        
        //chama a view admin/materiais/index.blade.php retornado os filtros e os dados encontrados
        return view('admin.'.$this->model.'.index', compact('data','filters'));
    }
}
