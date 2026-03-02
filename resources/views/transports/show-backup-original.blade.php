@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Mensaje de Éxito -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h1>{{ __('Transporte Registrado') }}</h1>
            <p>{{ __('Tu servicio de transporte ha sido registrado exitosamente.') }}</p>
            <a href="{{ app()->getLocale() === 'es' ? '/es/' : '/en/' }}" class="btn btn-primary">
                {{ __('Volver al Inicio') }}
            </a>
        </div>
    </div>
</div>
@endsection
