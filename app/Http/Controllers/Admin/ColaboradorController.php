<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Colaborador;
use App\Models\Empresa;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    protected $colaboradorRepository, $empresaRepository;
    
    public function __construct(Empresa $empresa, Colaborador $colaborador) 
    {
        $this->colaboradorRepository   = $colaborador;
        $this->empresaRepository    = $empresa;
    }
    
    public function store(Request $request) 
    {
        if($this->colaboradorRepository->create($request->all())):
            return redirect()->back();
        else:
            return redirect()->back();
        endif;
    }
    
    public function destroy($id) 
    {
        if($data = $this->colaboradorRepository->find($id)):
            $data->delete();
        endif;
    }
}