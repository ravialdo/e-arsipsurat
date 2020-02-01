@extends('layouts.dashboard')

@section('breadcrumb')
	<li class="breadcrumb-item active" aria-current="page">Pengguna</li>
@endsection

@section('content')

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="card-title">Data Pengguna</div>
						<button type="button" class="btn btn-success mb-3 float-right" data-toggle="modal" data-target="#add">
							<i class="mdi mdi-account-plus"></i> {{ __('Tambah')}}
					     </button>
					<div class="modal fade in" id="add">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<div class="modal-title">
										{{ __('Tambah Data Pengguna') }}
									</div>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form class="form-horizontal form-material" method="post" action="{{ url('dashboard/user') }}">
										
										@csrf
										
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<label class="input-group-text">
												Level
											</label>
										</div>
										<select name="level" class="custom-select">
											<option>Silahkan Pilih</option>
												@foreach($levels as $level)
													<option value="{{ $level->id }}">{{ $level->level_name }}</option>
												@endforeach
										</select>
									</div>
										
										<div class="form-group">
											<label>Nama</label>
											<input type="text" name="nama" class="form-control" required>
										</div>
										<div class="form-group">
											<label>Email</label>
											<input type="email" name="email" class="form-control" required>
										</div>
										<div class="form-group">
											<label>Kata Sandi</label>
											<input type="password" name="password" class="form-control" required>
										</div>
								</div>
								<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
										<button type="submit" class="btn btn-success">Simpan</button>
									</form>
								</div>
							</div>						
						</div>
					</div>
						
						<div class="table-responsive mb-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Level</th>
								    <th scope="col"></th>                                        
                                        </tr>
                                    </thead>
                                    <tbody>
								@php 
								$i=1;
								@endphp
								@foreach($users as $user)
                                        <tr>					    
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>
										<a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
								    </td>
                                            <td>{{ $user->level->level_name }}</td>
                                            <td>										                           
                               	 		  <div class="hide-menu">
                                    			<a href="javascript:void(0)" class="text-dark" id="actiondd" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       				<i class="mdi mdi-dots-vertical"></i>
                                    			</a>
                                    				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="actiondd">
                                        			<a class="dropdown-item" href="{{ url('dashboard/user', $user->id) }}"><i class="ti-pencil"></i> Edit </a>										
											@if(auth()->user()->id != $user->id)
												<form method="post" action="{{ url('dashboard/user', $user->id) }}" id="delete{{$user->id}}">
													@csrf
													@method('delete')
													
													<button type="button" class="dropdown-item" onclick="deleteUser({{$user->id}})">
													<i class="ti-trash"></i> hapus
													</button>
												</form>																								
                                        			@endif                              							                                                                            
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

					<!-- Pagination -->
					@if($users->lastPage() != 1)
						<div class="btn-group float-right">		
						   <a href="{{ $users->previousPageUrl() }}" class="btn btn-success">
								<i class="mdi mdi-chevron-left"></i>
						    </a>
						    @for($i = 1; $i <= $users->lastPage(); $i++)
								<a class="btn btn-success {{ $i == $users->currentPage() ? 'active' : '' }}" href="{{ $users->url($i) }}">{{ $i }}</a>
						    @endfor
					        <a href="{{ $users->nextPageUrl() }}" class="btn btn-success">
								<i class="mdi mdi-chevron-right"></i>
							</a>
					   </div>
					@endif
					<!-- End Pagination -->
					
					   @if(count($users) == 0)
					   	 	<div class="text-center">Tidak ada data!</div>
					   @endif
				</div>
			</div>
		</div>
	</div>

@endsection

@section('sweet')

	function deleteUser(id){
			
		swal({
			title:"PERINGATAN!",
			text:"Yakin ingin menghapus data pengguna?",
			icon:"warning",
			buttons: true,
		})
		.then((willDelete) => {
			if(willDelete){
			 	   $('#delete'+id).submit();
			   }
		});
	
	}
	
@endsection