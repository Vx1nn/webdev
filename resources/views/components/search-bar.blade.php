@props(['placeholder' => 'Cari...'])

<form method="GET" class="mb-3">
	<div class="input-group">
		<input type="text" name="search" class="form-control" placeholder="{{ $placeholder }}"
			value="{{ request('search') }}" autocomplete="off">
		<button class="btn btn-primary" type="submit">
			<i class="bi bi-search"></i> Cari
		</button>
		@if(request('search'))
			<a href="{{ url()->current() }}" class="btn btn-secondary">
				<i class="bi bi-x-circle"></i> Reset
			</a>
		@endif
	</div>
</form>