@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Not Yükle</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Başlık</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Açıklama</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">Dosya</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" 
                               id="file" name="file" accept=".jpg,.jpeg,.png,.pdf">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="faculty_id" class="form-label">Fakülte</label>
                        <select class="form-control" id="faculty_id" name="faculty_id" required>
                            <option value="">Fakülte Seçiniz</option>
                            @foreach($faculties as $faculty)
                                <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="department_id" class="form-label">Bölüm</label>
                        <select class="form-control" id="department_id" name="department_id" required>
                            <option value="">Önce Fakülte Seçiniz</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="class_id" class="form-label">Sınıf</label>
                        <select class="form-select" id="class_id" name="class_id"></select>
                    </div>

                    <!-- Eski select elementini kaldırıp yerine input ekleyelim -->
                    <div class="mb-3">
                        <label for="course_name" class="form-label">Ders Adı</label>
                        <input type="text" 
                               class="form-control @error('course_name') is-invalid @enderror" 
                               id="course_name" 
                               name="course_name" 
                               placeholder="Örnek: Veri Yapıları"
                               value="{{ old('course_name') }}"
                               required>
                        @error('course_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Yükle</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const facultySelect = document.getElementById('faculty_id');
    const departmentSelect = document.getElementById('department_id');
    const classSelect = document.getElementById('class_id');

    facultySelect.addEventListener('change', function() {
        fetchDepartments(this.value);
        // Alt seçimi sıfırla
        classSelect.innerHTML = '<option value="">Önce Bölüm Seçiniz</option>';
    });

    departmentSelect.addEventListener('change', function() {
        fetchClasses(this.value);
    });

    // AJAX fonksiyonları
    function fetchDepartments(facultyId) {
        departmentSelect.innerHTML = '<option value="">Bölüm Seçiniz</option>';
        
        if(facultyId) {
            fetch(`/api/departments/${facultyId}`)
                .then(response => response.json())
                .then(departments => {
                    departments.forEach(department => {
                        const option = document.createElement('option');
                        option.value = department.id;
                        option.textContent = department.name;
                        departmentSelect.appendChild(option);
                    });
                });
        }
    }

    function fetchClasses(departmentId) {
        classSelect.innerHTML = '<option value="">Sınıf Seçiniz</option>';
        
        if(departmentId) {
            fetch(`/api/classes/${departmentId}`)
                .then(response => response.json())
                .then(data => {
                    for(let i = 1; i <= data.class_count; i++) {
                        const option = document.createElement('option');
                        option.value = i;
                        option.textContent = i + '. Sınıf';
                        classSelect.appendChild(option);
                    }
                })
                .catch(error => console.error('Sınıf bilgileri alınırken hata oluştu:', error));
        }
    }

    function fetchCourses(classId) {
        // AJAX isteği ile dersleri getir
    }
</script>
@endpush
@endsection