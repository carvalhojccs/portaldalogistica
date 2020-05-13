<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateLocalFormRequest;
use App\Models\Local;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    protected $repository, $model;
    
    public function __construct(Local $local, Request $request) 
    {
        $this->repository = $local;
        $this->model = $request->segment(2);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recupera todos os locais
        $data = $this->repository->paginate();
        
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
        /*
         * retorna a view create.blade.php localizada na pasta
         * resourses\views\admin\locais
         */
        return view('admin.'.$this->model.'.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateLocalFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateLocalFormRequest $request)
    {
        /*
         * recupera os dados do formulário via $request e na tabela
         * se os dados foram persistidos,retorna a view index.blade.php
         * localizada em resources\views\admin\locais
         * caso haja algum erro,retorna para a página anterior         * 
         */
        if($this->repository->create($request->all())):
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
        /*
         * pesquisa o item pelo seu id e verifica se existe.
         * Caso exista, retorna a view show.blade.php
         * localiza da pasta resources\views\admin\locais
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
         * localizada em resources\views\admin\locais
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
     * @param  \App\Http\Requests\StoreUpdateLocalFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateLocalFormRequest $request, $id)
    {
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
         * localizada em resources\views\admin\locais com umma mensagem de sucesso.
         * Caso contrário, retorna para a página anterior         * 
         */
        if($data = $this->repository->find($id)):
            $data->delete();
            return redirect()->route($this->model.'.index')->withSuccess('m');
        else:
            return redirect()->back();
        endif;
    }
    
    /*
     * Show search results
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function search(Request $request)
    {
        //filtro com os parametros da pesquisa
        $filters = $request->except('_token');
        
        //realiza a pesquisa com os filtros passados e armazena no array $data
        $data = $this->repository->search($filters);
        
        /*
         * retorna a view index.blade.php localizada em resourses\views\admin\locais
         * passando o os filtros e os dados no arry $data
         */
        return view('admin.'.$this->model.'.index', compact('filters','data'));
    }
}
