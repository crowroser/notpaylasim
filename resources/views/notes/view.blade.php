@extends('layouts.app')

@section('title', $note->title)

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">{{ $note->title }}</h1>
            <span class="badge {{ $note->is_approved ? 'bg-success' : 'bg-warning' }}">
                {{ $note->is_approved ? 'Onaylı' : 'Onay Bekliyor' }}
            </span>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Not Detayları</h5>
                    <ul class="list-unstyled">
                        <li><strong>Yükleyen:</strong> {{ $note->user->name }}</li>
                        <li><strong>Fakülte:</strong> {{ $note->faculty->name }}</li>
                        <li><strong>Bölüm:</strong> {{ $note->department->name }}</li>
                        <li><strong>Sınıf:</strong> {{ $note->class_id }}. Sınıf</li>
                        <li><strong>Ders:</strong> {{ $note->course_name }}</li>
                        <li><strong>Yüklenme Tarihi:</strong> {{ $note->created_at->format('d.m.Y H:i') }}</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5>Açıklama</h5>
                    <p>{{ $note->description ?? 'Açıklama bulunmuyor.' }}</p>
                </div>
            </div>

            @if($note->file_path)
            <div class="text-center mb-4">
                <a href="{{ asset('storage/' . $note->file_path) }}" 
                   class="btn btn-primary btn-lg" 
                   target="_blank">
                    <i class="fas fa-external-link-alt me-2"></i>
                    Dosyayı Görüntüle
                </a>
            </div>

                @if(Str::endsWith($note->file_path, ['.jpg', '.jpeg', '.png', '.gif']))
                <div class="text-center mb-3">
                    <img src="{{ asset('storage/' . $note->file_path) }}" 
                         alt="{{ $note->title }}" 
                         class="img-fluid rounded shadow"
                         style="max-height: 500px;">
                </div>
                @endif
            @endif

            <div class="mt-4">
                @if($note->file_path)
                <a href="{{ asset('storage/' . $note->file_path) }}" 
                   class="btn btn-success me-2" 
                   download>
                    <i class="fas fa-download me-1"></i>
                    Dosyayı İndir
                </a>
                @endif
                <a href="{{ url()->previous() }}" 
                   class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>
                    Geri Dön
                </a>
            </div>
        </div>
    </div>
</div>
@endsection