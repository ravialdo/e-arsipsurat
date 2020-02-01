@extends('layouts.dashboard')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="#">Surat</a></li>
	<li class="breadcrumb-item active" aria-current="page">Edit</li>
@endsection

@section('content')

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="card-title">Form Surat</div>
					
						<form class="form-horizontal form-material"  enctype="multipart/form-data"  method="post" action="{{ url('dashboard/mail', $mail->id) }}">
						
							@csrf
							@method('put')
							
						     <div class="form-group">
                                        <label class="col-sm-12">Tipe Surat</label>
                                        <div class="col-sm-6">
                                            <select  name="tipe_surat" class="custom-select">
                                                <option value="">Silahkan Pilih</option>
											@foreach($mail_types as $mail_type)                                 
                                                			<option value="{{ $mail_type->id }}" {{ $mail_type->id == $mail->mail_type_id ? 'selected' : ''}}>{{ $mail_type->type_name }}</option>
											@endforeach
                                            </select>
                                        </div>
                                    </div>							
                                    <div class="form-group">
                                        <label class="col-md-12">Kode Surat *</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-line" name="kode_surat" value="{{ $mail->mail_code }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Surat Dari *</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-line" name="surat_dari" value="{{ $mail->mail_from }}">
                                        </div>
                                    </div>
							<div class="form-group">
                                        <label class="col-md-12">Surat Untuk *</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-line" name="surat_untuk" value="{{ $mail->mail_to }}">
                                        </div>
                                    </div>
							<div class="form-group">
                                        <label class="col-md-12">Subjek Surat *</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-line" name="subjek_surat" value="{{ $mail->mail_subject }}">
                                        </div>
                                    </div>
							<div class="form-group">
                                        <label class="col-md-12">Deskripsi *</label>
                                        <div class="col-md-12">
                                            <textarea name="deskripsi" class="form-control form-control-line" rows="5">{{ $mail->description }}</textarea>
                                        </div>
                                    </div>
							<div class="form-group">
                                        <label class="col-md-12">File (Opsional)</label>
                                        <div class="col-md-12">
                                            <input type="file" class="custom-file" name="file">
                                        	<small class="text-muted">Format PDF/DOC/DOCX</small>
								</div>
                                    </div>                                
                                    
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success float-right">Tambah</button>
                                        </div>
                                    </div>
                                </form>
				</div>
			</div>
			
			<a href="{{ url('dashboard/mail') }}" class="btn btn-primary btn-rounded">
				<i class="mdi mdi-chevron-left"></i> Kembali
			</a>
			
		</div>	
       </div>
@endsection