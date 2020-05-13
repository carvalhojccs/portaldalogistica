<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTelefoneFormRequest;
use App\Models\Empresa;
use App\Models\Telefone;
use Illuminate\Http\Request;

class TelefoneController extends Controller
{
    protected $telefoneRepository, $empresaRepository;
    
    public function __construct(Empresa $empresa, Telefone $telefone) 
    {
        $this->telefoneRepository   = $telefone;
        $this->empresaRepository    = $empresa;
    }
    
    public function store(StoreUpdateTelefoneFormRequest $request) 
    {
        if($this->telefoneRepository->create($request->all())):
            return redirect()->back();
//            $data = $this->empresaRepository->find($request->empresa_id);
//            return redirect()->route('empresas.show', compact('data'))->withSuccess('m');
        else:
            return redirect()->back();
        endif;
    }
}
