@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        @include('admin.partials.sidebar')
    </div>
    
    <div class="col-md-9">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Dersler</h4>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                    Yeni Ekle
                </button>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kod</th>
                            <th>Ders Adı</th>
                            <th>Sınıf</th>
                            <th>Bölüm</th>
                            <th>Fakülte</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->code }}</td>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->classRoom->name }}</td>
                            <td>{{ $course->classRoom->department->name }}</td>
                            <td>{{ $course->classRoom->department->faculty->name }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-course" 
                                        data-id="{{ $course->id }}"
                                        data-name="{{ $course->name }}"
                                        data-code="{{ $course->code }}"
                                        data-description="{{ $course->description }}"
                                        data-class="{{ $course->class_id }}">
                                    Düzenle
                                </button>
                                <button class="btn btn-sm btn-danger delete-course" 
                                        data-id="{{ $course->id }}"
                                        data-name="{{ $course->name }}">
                                    Sil
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Course Modal -->
<div class="modal fade" id="addCourseModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.courses.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Yeni Ders Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="code" class="form-label">Ders Kodu</label>
                        <input type="text" class="form-control" id="code" name="code" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Ders Adı</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Açıklama</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="class_id" class="form-label">Sınıf</label>
                        <select class="form-select" id="class_id" name="class_id" required>
                            <option value="">Seçiniz</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">
                                    {{ $class->department->faculty->name }} - 
                                    {{ $class->department->name }} - 
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Course Modal -->
<div class="modal fade" id="editCourseModal" tabindex="-1">
    <!-- Benzer yapı, form action'ı farklı -->
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Düzenleme modal işlemleri
    const editButtons = document.querySelectorAll('.edit-course');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const modal = document.getElementById('editCourseModal');
            modal.querySelector('[name="code"]').value = this.dataset.code;
            modal.querySelector('[name="name"]').value = this.dataset.name;
            modal.querySelector('[name="description"]').value = this.dataset.description;
            modal.querySelector('[name="class_id"]').value = this.dataset.class;
            modal.querySelector('form').action = `/admin/courses/${this.dataset.id}`;
            new bootstrap.Modal(modal).show();
        });
    });

    // Silme işlemi için onay dialogu
    const deleteButtons = document.querySelectorAll('.delete-course');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const courseId = this.dataset.id;
            const courseName = this.dataset.name;

            Swal.fire({
                title: 'Emin misiniz?',
                text: `"${courseName}" dersini silmek istediğinize emin misiniz?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Evet, Sil',
                cancelButtonText: 'İptal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/courses/${courseId}`;
                    form.innerHTML = `
                        @csrf
                        @method('DELETE')
                    `;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
});
</script>
@endpush
@endsection 