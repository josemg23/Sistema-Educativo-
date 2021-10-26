<div>
	@foreach ($niveles as $nivel)
	<span class="badge badge-primary">{{ $nivel->nivel_nombre }}</span>
	@endforeach
</div>