<?php

namespace App\Helpers;

class Util 
{
    public static function p2s($string) 
    {
        $regexes = [
            'locais'        => 'local',
            'empresas'      => 'empresaa',
            'telefoness'    => 'telefone',
            'colaboradores' => 'colaborador',
            'empenhos'      => 'empenho',            
        ];
        
        foreach($regexes as $key => $replace):
            $regex = '/'.$key.'$/ui';
            
            if(preg_match($regex, $string)):
                return preg_replace($regex, $replace, $string);
            endif;
        endforeach;
        
        return $string;
    }
    
    public static function limpaCNPJ($cnpj)
    {
        $cnpj = trim($cnpj);
        $cnpj = str_replace(".", "", $cnpj);
        $cnpj = str_replace("/", "", $cnpj);
        $cnpj = str_replace("-", "", $cnpj);
        
        return $cnpj;
    }
    
    public static function formatCNPJ($data)
    {
        $cnpj = preg_replace("/\D/", '', $data);
        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj);
    }
}
