@extends('layouts.dashboard')

@section('breadcrumb')
	<li class="breadcrumb-item active" aria-current="page">Surat</li>
@endsection

@section('content')

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="card-title">Form Surat</div>
					
						<form class="form-horizontal form-material"  enctype="multipart/form-data"  method="post" action="{{ url('dashboard/mail') }}">
						
							@csrf
						
						     <div class="form-group">
                                        <label class="col-sm-12">Tipe Surat</label>
                                        <div class="col-sm-6">
                                            <select  name="tipe_surat" class="custom-select">
                                                <option value="">Silahkan Pilih</option>
											@foreach($mail_types as $mail_type)                                 
                                                			<option value="{{ $mail_type->id }}">{{ $mail_type->type_name }}</option>
											@endforeach
                                            </select>
                                        </div>
                                    </div>							
                                    <div class="form-group">
                                        <label class="col-md-12">Kode Surat</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-line" name="kode_surat">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Surat Dari</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-line" name="surat_dari">
                                        </div>
                                    </div>
							<div class="form-group">
                                        <label class="col-md-12">Surat Untuk</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-line" name="surat_untuk">
                                        </div>
                                    </div>
							<div class="form-group">
                                        <label class="col-md-12">Subjek Surat</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-line" name="subjek_surat">
                                        </div>
                                    </div>
							<div class="form-group">
                                        <label class="col-md-12">Deskripsi</label>
                                        <div class="col-md-12">
                                            <textarea name="deskripsi" class="form-control form-control-line" rows="5"></textarea>
                                        </div>
                                    </div>
							<div class="form-group">
                                        <label class="col-md-12">File</label>
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
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="card-title">Data Surat</div>
						<div class="table-responsive mb-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Kode</th>
								    <th scope="col">Tipe</th>
                                            <th scope="col">Ditujukan</th>
                                            <th scope="col">Subjek</th>
								    <th scope="col">Deskripsi</th>
								    <th scope="col">File</th>
								    <th scope="col"></th>                                        
                                        </tr>
                                    </thead>
                                    <tbody>
								@php 
								$i=1;
								@endphp
								@foreach($mails as $mail)
                                        <tr>					    
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $mail->mail_code }}</td>
								    <td>{{ $mail->mail_type->type_name }}</td>
                                            <td>{{ $mail->mail_to }}</td>
                                            <td>{{ $mail->mail_subject }}</td>
								    <td>{{ $mail->description }}</td>
								    <td>{{ $mail->file }}</td>
                                            <td>										                           
                               	 		  <div class="hide-menu">
                                    			<a href="javascript:void(0)" class="text-dark" id="actiondd" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       				<i class="mdi mdi-dots-vertical"></i>
                                    			</a>
                                    				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="actiondd">
                                        			<a class="dropdown-item" href="{{ url('dashboard/mail', $mail->id) }}"><i class="ti-pencil"></i> Edit </a>
			
											<button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete">
												<i class="ti-trash"></i> Hapus
											</button>																																							
                                        			                    							                                                                            
                                				</div>
                            				</div>
									<!-- Modal -->
									<div class="modal fade in" id="delete">
										<div class="modal-dialog">
											<div class="modal-content">				
												<div class="modal-header">
													<div class="modal-title">
														<i class="mdi mdi-alert text-danger"></i> PERINGATAN
													</div>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													Yakin ingin menghapus data surat?
			 								    </div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
													<form method="post" action="{{ url('dashboard/mail', $mail->id) }}">
														@csrf
														@method('delete')
												
														<button class="btn btn-success" type="submit">Yakin</button>
													</form>
												</div>
											</div>
										</div>
									</div>
									<!-- End modal -->
								    </td>					
                                        </tr>
								@php
								$i++;
								@endphp
								@endforeach                                  
                                    </tbody>
                                </table>
                            </div>
				</div>
			</div>
		</div>
	</div>

@endsection