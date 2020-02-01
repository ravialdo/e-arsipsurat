@extends('layouts.dashboard')

@section('breadcrumb')
	<li class="breadcrumb-item active" aria-current="page">Disposisi</li>
@endsection

@section('content')
      <div class="row">
		<!-- Column -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" method="post" action="{{ url('dashboard/disposition') }}">

							@csrf

							  <div class="col-md-6">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text">
										 	Surat *
										</label>
									</div>
									<select id="surat" class="custom-select" onchange="getValue(this)" {{ count($mails) == 0 ? 'disabled' : '' }}>
										@if(count($mails) == 0)
											<option>Pilihan tidak ada</option>
										@else
											<option>Silahkan Pilih</option>
											@foreach($mails as $mail)
                                                			<option id_surat="{{ $mail->id }}"  tipe_surat="{{ $mail->mail_type_id }}" value="{{ $mail->description }}">{{ $mail->mail_subject }}</option>
                                                		@endforeach
										@endif
									</select>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text">
										 	Ditujukan Untuk *
										</label>
									</div>
									<select name="ditujukan_untuk" class="custom-select" {{ count($mails) == 0 ? 'disabled' : '' }}>
										@if(count($users) == 0)
											<option>Pilihan tidak ada</option>
										@else
										<option value="">Silahkan Pilih</option>
											@foreach($users as $user)
                                                			<option value="{{ $user->id }}">{{ $user->name }}</option>
                                                		@endforeach
										@endif
									</select>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text">
											 Status Balasan *
										</label>
									</div>
									<select name="status_balasan" class="custom-select">
										<option>Silahkan Pilih</option>								
                                                	<option value="1">Biasa</option>
										<option value="2">Penting</option>
										<option value="3">Sangat Penting</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
                                        <label class="col-md-12">Deskripsi</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" class="form-control form-control-line" id="description" name="deskripsi" readonly></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
								<label class="col-md-12">Notifikasi</label>
                                        <div class="col-md-12">
                                            <input type="text"class="form-control form-control-line" name="notifikasi" value="Anda Memiliki Pesan Baru!" readonly>
                                        </div>
                                    </div>

							<input type="hidden" name="tipe_surat" id="tipe_surat">
							<input type="hidden" name="id_surat" id="id_surat">
                                                                     
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success float-right">Kirim</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->

			 <div class="row">
				<div class="col-md-12">
					<div class="card">
				<div class="card-body">
					<div class="card-title">Data Disposisi</div>
						<div class="table-responsive mb-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Ditujukan</th>
								    <th scope="col">Tipe</th>
                                            <th scope="col">Balasan</th>
                                            <th scope="col">Status</th>
								    <th scope="col">Deskripsi</th>
								    <th scope="col">File</th>
								    <th scope="col"></th>                                        
                                        </tr>
                                    </thead>
                                    <tbody>
								@php 
								$i=1;
								@endphp
								@foreach($dispositions as $disposition)
                                        <tr>					    
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $disposition->user->name }}</td>
								    <td>{{ $disposition->type_mail_disposition }}</td>
                                            <td>{{ $disposition->status_disposition }}</td>
                                            <td>{{ $disposition->status }}</td>
								    <td>{{ $disposition->description }}</td>
								    <td>
										
											<a href="{{ url('dashboard/mail/view', $mail->id) }}" class="btn btn-success btn-sm btn-rounded">
												<i class="mdi mdi-download"></i> Unduh
											</a>
																			
									</td>
                                            <td>										                           
                               	 		  <div class="hide-menu">
                                    			<a href="javascript:void(0)" class="text-dark" id="actiondd" role="button" data-toggle="dropdown">
                                       				<i class="mdi mdi-dots-vertical"></i>
                                    			</a>
                                    				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="actiondd">
                                        			<a class="dropdown-item" href="{{ url('dashboard/disposition', $disposition->id) }}"><i class="ti-pencil"></i> Edit </a>
											<form method="post" action="{{ url('dashboard/disposition', $disposition->id) }}" id="delete{{ $disposition->id }}">
												@csrf
												@method('delete')
												
												<button type="button" class="dropdown-item" onclick="deleteDisposition({{ $disposition->id }})">
													<i class="ti-trash"></i> Hapus
												</button>	
											
											</form>																																																
                                        			                    							                                                                            
                                				</div>
                            				</div>								
								    </td>					
                                        </tr>
								@php
								$i++;
								@endphp
								@endforeach                                  
                                    </tbody>
                                </table>
                            </div>
					@if(count ($dispositions) == 0)
				  		<div class="text-center">Tidak ada data!</div>
					@endif
				</div>
			</div>
				</div>
			</div>
@endsection

@section('sweet')

	function getValue(){
		var surat = $("#surat").val();
		var id_surat = $("#surat option:selected").attr('id_surat');
		var tipe_surat = $("#surat option:selected").attr('tipe_surat');
		$("#description").text(surat);
		$("#id_surat").val(id_surat);
		$("#tipe_surat").val(tipe_surat)
	}
	
	function deleteDisposition(id){
			
		swal({
			title:"PERINGATAN!",
			text:"Yakin ingin menghapus data surat?",
			icon:"warning",
			buttons: true
		})
		.then((willDelete) => {
			if(willDelete){
			 	   $('#delete'+id).submit();
			   }
		});
	
	}

@endsection