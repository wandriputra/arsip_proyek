<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Dokumen;
use App\Models\Dokumen_pr;
use App\Models\Dokumen_po;

class pencarianController extends Controller
{
    public function getIndex(Request $request){
    	
        $input = $request->input('q');
        $type = $request->input('type');

        if($type=='file_pdf'){
            $dokumen = ($input !== '') ? $this->cariFiles($input) : '' ;
            $folder = [];
        }elseif ($type=='no_sap') {
            $folder = ($input !== '') ? $this->cariFolders($input) : '' ;
            $dokumen = [];
            # code...
        }else{
            $folder =[];
            $dokumen =[];
        }
    	
        // var_dump($dokumen);

    	if ($dokumen != [] || $dokumen != '' && $folder != [] || $folder != '' && $input!= '') {
    		$include = 'pencarian.hasil-pencarian';
    	}else{
    		$include = 'pencarian.fail-pencarian';
    	}

        // if (\Request::ajax()) {
        //     return \Response::json(\View::make('pencarian', compact('dokumen', 'include', 'input', 'folder', 'type'))->render());
        // }
    	
        return view('pencarian.index', compact('dokumen', 'include', 'input', 'folder', 'type'));
    }

    private function cariFiles($input)
    {
		$dokumen = Dokumen::findGlobal($input);
    	return $dokumen;
	}

    public function cariFolders($input)
    {
    	$folders = Dokumen::findSap($input);
        // $folders->setPath("?q=$input&");
        return $folders;
    }
}
