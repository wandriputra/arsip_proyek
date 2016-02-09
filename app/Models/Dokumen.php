<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;

class Dokumen extends Model
{
    //
    use SoftDeletes;

	protected $table = 'dokumen';

	protected $fillable = ['no_dokumen', 'nama_dokumen', 'file_name_pdf', 'lokasi_file_pdf', 'tag_keterangan', 'sub_jenis_id', 'unit_asal', 'unit_tujuan', 'visibility_id', 'created_by'];

	public static $rules = [
    	'jenis_dokumen' => 'required',
    	'sub_jenis_dokumen' => 'required',
    	'file_pdf' => 'required'
    ];

    protected $dates = ['deleted_at'];

    public function sub_jenis_dokumen()
    {
        return $this->belongsTo('App\Models\Sub_jenis_dokumen', 'sub_jenis_id');
    }

    public function asal_surat()
    {
        return $this->belongsTo('App\Models\Unit', 'unit_asal');
    }
    
    public function tujuan_surat()
    {
        return $this->belongsTo('App\Models\Unit', 'unit_tujuan');
    }

    public function folder()
    {
        return $this->belongsToMany('App\Models\Folder', 'folder_dokumen', 'dokumen_id', 'folder_id');
    }

    public function dokumen_sap()
    {
        return $this->hasOne('App\Models\Dokumen_sap', 'dokumen_id');
    }

    public function scopeFindGlobal($query, $key)
    {
        $dokumen = DB::table("dokumen")
            ->leftJoin("dokumen_sap", "dokumen.id", "=", "dokumen_sap.dokumen_id")
            ->where("file_name_pdf", "like", "%$key%")
            ->orWhere("no_sap" , "like", "%$key%")
            ->select('*', 'dokumen.id as id_dokumen');
            // ->paginate(2);
        return $dokumen;
    }

    public function scopeDokumenPR($query, $pr)
    {
        $dokumen_id = DB::table('dokumen')
            ->Join("dokumen_sap", "dokumen.id", "=", "dokumen_sap.dokumen_id")
            ->Join("sub_jenis_dokumen", "dokumen.sub_jenis_id", "=", "sub_jenis_dokumen.id")
            ->where("dokumen_sap.type", "=", 'pr')
            ->where("dokumen_sap.no_sap", "=", $pr)
            ->select('*', 'dokumen.id as id_dokumen', 'sub_jenis_dokumen.id as sub_jenis_id');
        return $dokumen_id;
    }

    public function scopeDokumenPO($query, $po)
    {
        $dokumen_id = DB::table('dokumen')
            ->Join("dokumen_sap", "dokumen.id", "=", "dokumen_sap.dokumen_id")
            ->Join("sub_jenis_dokumen", "dokumen.sub_jenis_id", "=", "sub_jenis_dokumen.id")
            ->where("dokumen_sap.type", "=", 'po')
            ->where("dokumen_sap.no_sap", "=", $po)
            ->select('*', 'dokumen.id as id_dokumen', 'sub_jenis_dokumen.id as sub_jenis_id');
        return $dokumen_id;
    }

    public function scopeDokumenGR($query, $gr)
    {
        $dokumen_id = DB::table('dokumen')
            ->Join("dokumen_sap", "dokumen.id", "=", "dokumen_sap.dokumen_id")
            ->Join("sub_jenis_dokumen", "dokumen.sub_jenis_id", "=", "sub_jenis_dokumen.id")
            ->where("dokumen_sap.type", "=", 'gr')
            ->where("dokumen_sap.no_sap", "=", $gr)
            ->select('*', 'dokumen.id as id_dokumen', 'sub_jenis_dokumen.id as sub_jenis_id');
        return $dokumen_id;
    }

    public function scopeDokumenCD($query, $cd)
    {
        $dokumen_id = DB::table('dokumen')
            ->Join("dokumen_sap", "dokumen.id", "=", "dokumen_sap.dokumen_id")
            ->Join("sub_jenis_dokumen", "dokumen.sub_jenis_id", "=", "sub_jenis_dokumen.id")
            ->where("dokumen_sap.type", "=", 'cd')
            ->where("dokumen_sap.no_sap", "=", $cd)
            ->select('*', 'dokumen.id as id_dokumen', 'sub_jenis_dokumen.id as sub_jenis_id');
        return $dokumen_id;
    }

}
