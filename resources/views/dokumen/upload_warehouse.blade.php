{{csrf_field()}}
<input type="hidden" value="{{Auth::user()->personil->unit->id}}">
<div class="box-body">
	<div class="form-group">
		<label class="col-sm-3 control-label">Actifity</label>
		<div class="col-sm-7">
			<select class="form-control select2" name="actifity" id="actifity" style="width: 90%;">
				@foreach($actifity as $val)
					<option value="{{$val['id']}}" @if($val['id']==1) {{'selected'}} @endif>{{$val['nama_actifity']}}</option>
				@endforeach
			</select> <a href="{{url('data/tambah-actifity')}}"><i class="fa fa-fw fa-plus"></i></a>
		</div>
	</div>						
	<div class="form-group">
		<label class="col-sm-3 control-label">Sub Jenis Dokumen</label>
		<div class="col-sm-7">
			<select class="form-control select2" name="sub_jenis_dokumen" id="sub_jenis_dokumen" style="width: 90%;">
				@foreach($sub_jenis as $val)
					<option value="{{$val['id']}}" @if($val['id']) {{'selected'}} @endif>{{$val['nama_sub']}}</option>
				@endforeach
			</select> <a href="{{url('data/insert-sub-jenis')}}"><i class="fa fa-fw fa-plus"></i></a>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Good Receipt</label>
		<div class="col-sm-3">
			<select class="form-control select2" name="gr" style="width: 90%;">
			@foreach($gr as $gr)
				<option value="{{$gr['gr']}}">{{$gr['gr']}}</option>
			@endforeach
			</select>
		</div>
	</div>

	<div class="form-group">
  		<label for="exampleInputFile" class="col-sm-3 control-label">File input</label>
  		<div class="col-sm-9">
  			<input type="file" id="file_pdf" name="file_pdf">
  			<p class="help-block">*Dokumen hanya dokumen final Format File PDF</p>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label">Visibility Dokumen</label>
		<div class="radio">
		@foreach($visibility as $visibility)
			<label>
				<input name="visibility" class="minimal" value="{{$visibility['id']}}" checked="" type="radio">
				{{$visibility['jenis_visibility']}}
			</label>
		@endforeach
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label">Tembusan</label>
		<div class="col-sm-9">
			<select class="form-control select2" name="tembusan" multiple="multiple" data-placeholder="Tembusan Surat" style="width: 100%;">
				@foreach($unit as $tembusan)
					<option value="{{$tembusan['id']}}">{{$tembusan['nama_unit'].' ('.$tembusan['singkatan'].')'}}</option>
				@endforeach
			</select>
		</div>
	</div>
	
	<div class="box-footer">
		<div class="">
			<button type="reset" class="btn btn-default col-md-2">Reset</button>
			<button type="submit" class="btn btn-success col-md-2 pull-right">Upload</button>
		</div>
	</div><!-- /.box-footer -->
</div>