@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">{{ $note->title }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <p class="text-muted mb-2">Not Detayları:</p>
                        <p>{{ $note->description ?? 'Açıklama yok' }}</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-muted mb-2">Not Bilgileri:</p>
                        <ul class="list-unstyled">
                            <li><strong>Fakülte:</strong> {{ $note->faculty->name ?? 'Belirtilmemiş' }}</li>
                            <li><strong>Bölüm:</strong> {{ $note->department->name ?? 'Belirtilmemiş' }}</li>
                            <li><strong>Sınıf:</strong> {{ $note->class_id }}. Sınıf</li>
                            <li><strong>Ders:</strong> {{ $note->course_name ?? 'Belirtilmemiş' }}</li>
                            <li><strong>Yükleyen:</strong> {{ $note->user->name }}</li>
                            <li><strong>Yüklenme Tarihi:</strong> {{ $note->created_at->format('d.m.Y H:i') }}</li>
                        </ul>
                    </div>

                    @if($note->file_path)
                        @php
                            $extension = pathinfo($note->file_path, PATHINFO_EXTENSION);
                        @endphp
                        
                        @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ Storage::url($note->file_path) }}" alt="{{ $note->title }}">
                        @elseif(in_array($extension, ['pdf']))
                            <embed src="{{ Storage::url($note->file_path) }}" type="application/pdf" width="100%" height="600px">
                        @else
                            <a href="{{ Storage::url($note->file_path) }}" class="btn btn-primary" download>
                                Dosyayı İndir
                            </a>
                        @endif
                    @endif

                    @if($note->file_path)
                        <div class="mt-3">
                            <a href="{{ Storage::url($note->file_path) }}" 
                               class="btn btn-primary" 
                               target="_blank">
                                Dosyayı Görüntüle
                            </a>
                        </div>
                    @endif

                    @if(auth()->user()->isAdmin() || auth()->id() === $note->user_id)
                        <div class="mt-4">
                            <form action="{{ route('notes.destroy', $note) }}" 
                                  method="POST" 
                                  class="d-inline" 
                                  onsubmit="return confirm('Bu notu silmek istediğinizden emin misiniz?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Notu Sil</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection