@extends('layouts.master')

@section('title', __('Transporte Registrado'))

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

            <!-- Video de Presentación (si existe) -->
            @if($transport->video_url)
            <div class="mb-4">
                <h3>Video de Presentación</h3>
                <div class="ratio ratio-16x9 mb-3">
                    @php
                        $videoUrl = ltrim($transport->video_url, '/');
                        $videoMp4 = preg_replace('/\.webm$/i', '.mp4', $videoUrl);
                    @endphp
                    <video controls preload="none" style="width:100%;border-radius:12px;" poster="{{ $transport->images->first() ? asset('storage/' . ltrim($transport->images->first()->url,'/')) : asset('images/default-transport.jpg') }}">
                        <source src="/{{ $videoUrl }}" type="video/webm">
                        <source src="/{{ $videoMp4 }}" type="video/mp4">
                        {{ __('Tu navegador no soporta la reproducción de video.') }}
                    </video>
                </div>
            </div>
            @endif

            <a href="{{ app()->getLocale() === 'es' ? '/es/' : '/en/' }}" class="btn btn-primary">
                {{ __('Volver al Inicio') }}
            </a>
        </div>
    </div>
</div>
@endsection
