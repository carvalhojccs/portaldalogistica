<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    
    
    public function index() 
    {
       $totalPapeis = DB::table('papeis')->count();
       $totalLinhasCreditos = DB::table('linhas_creditos')->count();
       $totalEmpenhos = DB::table('empenhos')->count();
       $valorEmpenhos = DB::table('empenhos')->sum('valor_solicitacao');
       return view('admin.dashboard', compact('totalPapeis', 'totalLinhasCreditos','totalEmpenhos','valorEmpenhos'));
    }
}
