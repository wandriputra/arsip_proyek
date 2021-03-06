@extends('./layout')

@section('costom_style_pages')
    <link rel="stylesheet" href="{{url('asset/plugins/select2/select2.min.css')}}">
    <style>
        .detail-kode{
            margin-top: 10px;
            font-style: italic;
            font-weight: 400;
        }
        .table-add-activity{
            text-align: center;
            width: 100%;
            padding: 10px;
            border-radius: 3px;
        }
        .table-add-activity:hover{
            background-color: #eee;
        }
    </style>
@stop

@section('content_main_pages')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Checklist Baru</h3>
        </div>
        <div class="box-body">
            <form method="post" class="form-horizontal" action="{{url('checklist/buat')}}">

                {{csrf_field()}}

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Nama Checklist</label>
                    <div class="col-md-8">
                        <input type="text" name="nama_checklist" class="form-control kode" value="{{{old('nama_checklist')}}}">
                    </div>
                    <label class="detail-kode"> </label>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Unit</label>
                    <div class="col-md-8">
                        <select name="unit_id" class="form-control select2" id="asal_surat" style="width: 95%;">
                            @foreach($unit as $asal_surat)
                                @if($asal_surat['id'] != '1')
                                    <option value="{{$asal_surat['id']}}" @if(Auth::user()->personil->unit->id == $asal_surat['id']) {{'selected'}} @endif >({{$asal_surat['singkatan']}}) {{$asal_surat['nama_unit']}}</option>
                                @endif
                            @endforeach
                        </select> <a href="{{url('unit/tambah-unit')}}"><i class="fa fa-fw fa-plus"></i></a>
                    </div>
                </div>

                <hr>

                @include('checklist._add_actifity_jenis')


        </div>
        <div class="box-footer">
            <div class="">
                <button type="reset" class="btn btn-default col-md-2">Reset</button>
                <button type="submit" class="btn btn-info col-md-2 pull-right">Tambah</button>
            </div>
        </div><!-- /.box-footer -->
        </form>
    </div>
@stop

@section('costom_js_pages')
    @include('checklist._Script')
@stop