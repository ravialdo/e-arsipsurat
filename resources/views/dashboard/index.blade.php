@extends('layouts.dashboard')

@section('breadcrumb')
	<li class="breadcrumb-item active" aria-current="page">Home</li>
@endsection

@section('content')

@if($profile->number_phone == NULL || $profile->address == NULL)
		<div class="alert alert-warning">
			{{ __('Data diri anda belum lengkap,') }} <a href="{{ url('dashboard/user', auth()->user()->id) }}">lengkapi disini..</a>
		</div>
@endif

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					Test
				</div>
			</div>
		</div>
	</div>

@endsection