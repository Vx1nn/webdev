@if ($errors->any())
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong>Terjadi Kesalahan!</strong>
		<ul class="mb-0 mt-2">
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
	</div>
@endif