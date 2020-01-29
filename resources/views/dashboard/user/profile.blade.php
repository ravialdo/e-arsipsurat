@extends('layouts.dashboard')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="#">Pengguna</a></li>
	<li class="breadcrumb-item active" aria-current="page">Profile</li>
@endsection

@section('content')
	
	  <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="../../assets/images/users/5.jpg" class="rounded-circle" width="150" />
                                    <h4 class="card-title m-t-10">{{ $user->name }}</h4>
                                    <h6 class="card-subtitle">{{ $user->level->level_name }}</h6>
                                    <div class="row text-center justify-content-md-center">
                                    </div>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> <small class="text-muted">Email </small>
                                <h6>{{ $user->email }}</h6> <small class="text-muted p-t-30 db">Nomor Telepon</small>
                                <h6>{{ $user->profile->number_phone != NULL ? $user->profile->number_phone : '-' }}</h6> <small class="text-muted p-t-30 db">Alamat</small>
                                <h6>{{ $user->profile->address != NULL ?  $user->profile->address : '-' }}</h6>
                                <div class="map-box">
							<div class="mapouter">
								<div class="gmap_canvas">
									<iframe width="100%" height="150" id="gmap_canvas" src="https://maps.google.com/maps?q={{ $user->profile->address != '' ? $user->profile->address : 'indonesia' }}&t=&z=19&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
									</div>
									<style>
									.mapouter{
										position:relative;
										text-align:right;
										height:150px;
										width:100%;
									}
									.gmap_canvas {
										overflow:hidden;
										background:none!important;
										height:150px;
										width:100%;
									}
									</style>
								</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" method="post" action="{{ url('dashboard/user', $user->id) }}">
								
								@method('put')
								@csrf
								
                                    <div class="form-group">
                                        <label class="col-md-12">Nama</label>
                                        <div class="col-md-12">
                                            <input type="text" name="nama" value="{{ $user->name }}" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" name="email" value="{{ $user->email }}" class="form-control form-control-line" name="example-email" id="example-email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name="password" placeholder="Password Baru" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Nomor Telepon</label>
                                        <div class="col-md-12">
                                            <input type="text" name="nomor_telepon" value="{{ $user->profile->number_phone }}" class="form-control form-control-line">
                                        </div>
                                    </div>
							 <div class="form-group">
                                        <label class="col-md-12">Alamat</label>
                                        <div class="col-md-12">
                                            <textarea name="alamat" rows="5" class="form-control form-control-line">{{ $user->profile->address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->

@endsection