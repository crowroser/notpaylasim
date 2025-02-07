@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-8 mx-auto">
        <form action="{{ route('notes.search') }}" method="GET" class="d-flex">
            <input type="text" name="query" class="form-control me-2" placeholder="Not ara..." value="{{ $query ?? '' }}">
            <button type="submit" class="btn btn-primary">Ara</button>
        </form>
    </div>
</div>

<div class="row">
    @forelse($notes as $note)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $note->title }}</h5>
                    <p class="card-text">{{ Str::limit($note->description ?? 'Açıklama yok', 100) }}</p>
                    <div class="small text-muted">
                        <div>Fakülte: {{ $note->faculty->name ?? 'Belirtilmemiş' }}</div>
                        <div>Bölüm: {{ $note->department->name ?? 'Belirtilmemiş' }}</div>
                        <div>Sınıf: {{ $note->class_id }}. Sınıf</div>
                        <div>Ders: {{ $note->course_name ?? 'Belirtilmemiş' }}</div>
                    </div>
                </div>
                <div class="card-footer">
                    @if($note->file_path)
                        <a href="{{ asset('storage/' . $note->file_path) }}" class="btn btn-primary btn-sm" target="_blank">
                            Görüntüle
                        </a>
                    @else
                        <span class="text-muted">Dosya yok</span>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center">
            <p>Henüz not bulunmamaktadır.</p>
        </div>
    @endforelse
</div>

<div class="d-flex justify-content-center">
    {{ $notes->links() }}
</div>
@endsection