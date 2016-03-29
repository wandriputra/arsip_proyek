<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Sap;

use File;
use Storage;
use Excel;
use Artisan;
use Schema;
use DB;
use Datatables;

class sapController extends Controller
{
	public $data = 0;
    public $create_table = true;


    public function getUploadExcel($value='')
    {
        return view('sap.upload_excel');
    }

    public function postUploadExcel(Request $request)
    {
    	$file = $request->file('format1');
        $format = $file->getClientOriginalExtension();
    	$filename = $request['format1'];
        
        $file1 = $file->getPathName();

        if (Schema::hasTable('sap_')) {
            Schema::drop('sap_');
        }

        Excel::filter('chunk')->load($file1)->chunk(100, function($results) use ($format)
        {
            $this->data = $results;
            // if ($format === 'csv') {
                $this->makeMigrationCsv();
            // }else{
                // $this->makeMigrationXls();
            // }
        });
        // var_dump($this->data);

        return redirect('/sap/view-upload-data');
    }

    public function getViewUploadData($value='')
    {

        return view('sap.view_data');
    }

    public function getAjaxFileUpload($value='')
    {   
        $dataSql = DB::table('sap_')
            ->select(['id', 'wbs_element', 'purchase_requisition', 'purchase_order', 'material_num', 'short_text', 'net_price', 'po_quantity', 'po_unit', 'net_value',  'currency_key', 'movement_type','good_receipt', 'posting_date_good_receipt', 'invoice', 'invoice_item', 'clearing_doc'])
            ->whereNotNull('purchase_requisition');
        return Datatables::of($dataSql)->make(true);
    }

    private function makeMigrationCsv(){
        //create table csv

        if (!Schema::hasTable('sap_')) {
            Schema::create('sap_', function (Blueprint $table) {
                $table->increments('id');
                foreach ($this->data[0] as $key => $value) {
                    $table->string($key)->nullable();
                }
            });
        }

        for ($i=0; $i < count($this->data); $i++) { 
            foreach ($this->data[$i] as $key => $value) {
                $array[$i][$key] = $value;
            }
            DB::table('sap_')->insert($array[$i]);
        }
        return true;
    }

    private function makeMigrationXls(){
        //create table excel pakai 
        if(!Schema::hasTable('sap_')){
            Schema::create('sap_', function (Blueprint $table) {
                $table->increments('id');
                foreach (array_keys($this->data[0]) as $key => $value) {
                    $table->string($value)->nullable();
                }
            });
        }

        foreach ($this->data as $value) {
            DB::table('sap_')->insert($value);
        }
        return true;
    }

    public function getDetailSap($type='', $no_sap='')
    {
        $var = $this->type_sap($type);
        $detail = Sap::select('id', 'purchase_order as po', 'purchase_requisition as pr', 'short_text', 'description', 'wbs_element as wbs')
            ->where($var, $no_sap)
            ->get();

        return view('sap.detail', compact('detail'));
    }

    public function getAjaxSelectSap(Request $request)
    {
        $q = $request->get('q');
        $var = $this->type_sap($request->get('type'));
        if($q!='' && $var !=''){
            $sap = Sap::where($var, "like", "%$q%")->groupBy($var)->select("$var as id", "$var as text")->limit('10')->get();
            return response()->json($sap);
        }
        return [];
        
    }

    private function type_sap($type='')
    {
        switch ($type) {
            case 'po':
                $var = 'purchase_order';
                break;
            case 'pr':
                $var = 'purchase_requisition';
                break;
            case 'gr':
                $var = 'good_receipt';
                break;
            case 'cd':
                $var = 'clearing_doc';
                break;
            default:
                # code...
                break;
        }
        return $var;
    }


    
}
