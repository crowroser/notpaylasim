@extends('layouts.app')

@section('title', 'Admin Paneli')

@section('content')
<div class="container">
    <h1 class="mb-4">Admin Paneli</h1>
    
    <!-- İstatistikler -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Bekleyen Notlar</h5>
                    <h2>{{ $pendingNotes->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Onaylı Notlar</h5>
                    <h2>{{ $approvedNotes->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Fakülteler</h5>
                    <h2>{{ $facultyCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Bölümler</h5>
                    <h2>{{ $departmentCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Bekleyen Notlar -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Bekleyen Notlar</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Başlık</th>
                            <th>Kullanıcı</th>
                            <th>Fakülte</th>
                            <th>Bölüm</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingNotes as $note)
                        <tr>
                            <td>{{ $note->title }}</td>
                            <td>{{ $note->user->name }}</td>
                            <td>{{ $note->faculty->name }}</td>
                            <td>{{ $note->department->name }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('notes.view', $note->id) }}" 
                                       class="btn btn-info btn-sm me-2" 
                                       target="_blank">
                                        Görüntüle
                                    </a>
                                    <form action="{{ route('admin.notes.approve', $note->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Onayla</button>
                                    </form>
                                    <form action="{{ route('admin.notes.reject', $note->id) }}" method="POST" class="d-inline ms-2">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Reddet</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Onaylı Notlar -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Onaylı Notlar</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Başlık</th>
                            <th>Kullanıcı</th>
                            <th>Fakülte</th>
                            <th>Bölüm</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($approvedNotes as $note)
                        <tr>
                            <td>{{ $note->title }}</td>
                            <td>{{ $note->user->name }}</td>
                            <td>{{ $note->faculty->name }}</td>
                            <td>{{ $note->department->name }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('notes.view', $note->id) }}" 
                                       class="btn btn-info btn-sm me-2" 
                                       target="_blank">
                                        Görüntüle
                                    </a>
                                    <form action="{{ route('admin.notes.delete', $note->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bu notu silmek istediğinizden emin misiniz?')">
                                            Sil
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection