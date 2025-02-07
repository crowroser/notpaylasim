document.addEventListener('DOMContentLoaded', function() {
    const facultySelect = document.getElementById('faculty_id');
    const departmentSelect = document.getElementById('department_id');
    const classSelect = document.getElementById('class_id');
    const courseSelect = document.getElementById('course_id');

    async function fetchData(url, targetSelect) {
        targetSelect.innerHTML = '<option value="">Yükleniyor...</option>';
        try {
            const response = await fetch(url);
            const data = await response.json();
            
            targetSelect.innerHTML = '<option value="">Seçiniz</option>';
            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id;
                option.textContent = item.name;
                targetSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Veri yüklenirken hata oluştu:', error);
            targetSelect.innerHTML = '<option value="">Hata oluştu</option>';
        }
    }

    facultySelect?.addEventListener('change', function() {
        if (this.value) {
            fetchData(`/api/departments/${this.value}`, departmentSelect);
            classSelect.innerHTML = '<option value="">Önce bölüm seçin</option>';
            courseSelect.innerHTML = '<option value="">Önce sınıf seçin</option>';
        } else {
            departmentSelect.innerHTML = '<option value="">Önce fakülte seçin</option>';
            classSelect.innerHTML = '<option value="">Önce bölüm seçin</option>';
            courseSelect.innerHTML = '<option value="">Önce sınıf seçin</option>';
        }
    });

    departmentSelect?.addEventListener('change', function() {
        if (this.value) {
            fetchData(`/api/classes/${this.value}`, classSelect);
            courseSelect.innerHTML = '<option value="">Önce sınıf seçin</option>';
        } else {
            classSelect.innerHTML = '<option value="">Önce bölüm seçin</option>';
            courseSelect.innerHTML = '<option value="">Önce sınıf seçin</option>';
        }
    });

    classSelect?.addEventListener('change', function() {
        if (this.value) {
            fetchData(`/api/courses/${this.value}`, courseSelect);
        } else {
            courseSelect.innerHTML = '<option value="">Önce sınıf seçin</option>';
        }
    });
}); 