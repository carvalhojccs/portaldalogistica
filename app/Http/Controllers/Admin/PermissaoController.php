<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePermissaoFormRequest;
use App\Repositories\Contracts\PermissaoRepositoryInterface;
use Illuminate\Http\Request;

class PermissaoController extends Controller
{
    protected $repository, $model;
    
    public function __construct(PermissaoRepositoryInterface $repository, Request $request) 
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
        
        //chama a view admin/papeis/index.blade.php e passa os dados no array data
        return view('admin.'.$this->model.'.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //chama a view admin/permissoes/create.blade.php para inserir os dados
        return view('admin.'.$this->model.'.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdatePermissaoFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePermissaoFormRequest $request)
    {
        //verifica se os dados foram persistidos com sucesso
        //caso afirmativo, redireciona para a view admin/permissoes/index.blade.php
        //com uma mensagem de sucesso. Caso contrário, volta para o furmulário com uma
        //mensagem de erro
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
        //recupera o item pelo seu id
        $data = $this->repository->findById($id);
        
        //chama a view admin/permissoes/show.blade.php com os dados do item
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
        /**
         * verifica se o item existe na tabela
         * caso afirmativo chama a view admin/permissoes/edit.blade.php
         * com os dados do item a ser editado. Caso contrário, volta a tela anterior
         */
        if(!$data = $this->repository->findById($id)):
            return redirect()->back();
        else:
            return view('admin.'.$this->model.'.edit', compact('data')); 
        endif;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdatePermissaoFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePermissaoFormRequest $request, $id)
    {
        //atualia os dados de um registro específico
        $this->repository->update($id, $request->all());
        
        //redireciona para a view admin/permissoes/index.blade.php
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
        //verifica se o item foi deletado com sucesso e redireciona para a view 
        //admin/papeis/index.blade.php com uma mensagem de sucesso. Caso
        //contrário mostra uma mensagem de erro
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
