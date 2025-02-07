<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faculty;
use App\Models\Department;

class FacultyDepartmentSeeder extends Seeder
{
    public function run()
    {
        $faculties = [
            'Teknoloji Fakültesi' => [
                'Adli Bilişim Mühendisliği' => 4,
                'Elektrik-Elektronik Mühendisliği' => 4,
                'Enerji Sistemleri Mühendisliği' => 4,
                'İnşaat Mühendisliği' => 4,
                'Makine Mühendisliği' => 4,
                'Mekatronik Mühendisliği' => 4,
                'Metalurji ve Malzeme Mühendisliği' => 4,
                'Otomotiv Mühendisliği' => 4,
                'Yazılım Mühendisliği' => 4,
                'Yazılım Mühendisliği (İngilizce) (UOLP-Sam Houston State)' => 4,
            ],
            'Mühendislik Fakültesi' => [
                'Bilgisayar Mühendisliği' => 4,
                'Çevre Mühendisliği' => 4,
                'Elektrik-Elektronik Mühendisliği' => 4,
                'İnşaat Mühendisliği' => 4,
                'Jeoloji Mühendisliği' => 4,
                'Kimya Mühendisliği' => 4,
                'Makine Mühendisliği' => 4,
                'Mekatronik Mühendisliği' => 4,
                'Metalurji ve Malzeme Mühendisliği' => 4,
                'Yapay Zeka ve Veri Mühendisliği' => 4,
                'Yazılım Mühendisliği' => 4,
            ],
            'İnsan ve Toplum Bilimleri Fakültesi' => [
                'Alman Dili ve Edebiyatı (Almanca)' => 4,
                'Coğrafya' => 4,
                'Çağdaş Türk Lehçeleri ve Edebiyatları' => 4,
                'İngiliz Dili ve Edebiyatı' => 4,
                'Sanat Tarihi' => 4,
                'Sosyoloji' => 4,
                'Tarih' => 4,
                'Türk Dili ve Edebiyatı' => 4,
            ],
            'Sağlık Bilimleri Fakültesi' => [
                'Beslenme ve Diyetetik' => 4,
                'Ebelik' => 4,
                'Fizyoterapi ve Rehabilitasyon' => 4,
                'Hemşirelik' => 4,
            ],
            'Fen Fakültesi' => [
                'Biyoloji' => 4,
                'Fizik' => 4,
                'İstatistik' => 4,
                'Kimya' => 4,
                'Matematik' => 4,
                'Moleküler Biyoloji ve Genetik' => 4,
            ],
            'İktisadi ve İdari Bilimler Fakültesi' => [
                'Çalışma Ekonomisi ve Endüstri İlişkileri' => 4,
                'İktisat' => 4,
                'İşletme' => 4,
                'Maliye' => 4,
                'Siyaset Bilimi ve Kamu Yönetimi' => 4,
                'Sosyal Hizmet' => 4,
                'Yönetim Bilişim Sistemleri' => 4,
            ],
            'Eğitim Fakültesi' => [
                'Fen Bilgisi Öğretmenliği' => 4,
                'İlköğretim Matematik Öğretmenliği' => 4,
                'İngilizce Öğretmenliği (İngilizce)' => 4,
                'Okul Öncesi Öğretmenliği' => 4,
                'Rehberlik ve Psikolojik Danışmanlık' => 4,
                'Sınıf Öğretmenliği' => 4,
                'Sosyal Bilgiler Öğretmenliği' => 4,
                'Türkçe Öğretmenliği' => 4,
            ],
            'İletişim Fakültesi' => [
                'Gazetecilik' => 4,
                'Görsel İletişim Tasarımı' => 4,
                'Halkla İlişkiler ve Tanıtım' => 4,
                'Radyo, Televizyon ve Sinema' => 4,
            ],
            'Diş Hekimliği Fakültesi' => [
                'Diş Hekimliği' => 5,
            ],
            'Eczacılık Fakültesi' => [
                'Eczacılık' => 5,
            ],
            'İlahiyat Fakültesi' => [
                'İlahiyat' => 4,
            ],
            'Mimarlık Fakültesi' => [
                'Mimarlık' => 4,
            ],
            'Spor Bilimleri Fakültesi' => [
                'Spor Yöneticiliği' => 4,
            ],
            'Su Ürünleri Fakültesi' => [
                'Su Ürünleri Mühendisliği' => 4,
            ],
            'Tıp Fakültesi' => [
                'Tıp' => 6,
            ],
            'Veteriner Fakültesi' => [
                'Veterinerlik' => 5,
            ],
            'Sivil Havacılık Yüksekokulu' => [
                'Havacılık Elektrik ve Elektroniği' => 4,
                'Uçak Bakım ve Onarım' => 4,
            ],
        ];

        foreach ($faculties as $facultyName => $departments) {
            $faculty = Faculty::create(['name' => $facultyName]);
            
            foreach ($departments as $departmentName => $classCount) {
                Department::create([
                    'faculty_id' => $faculty->id,
                    'name' => $departmentName,
                    'class_count' => $classCount
                ]);
            }
        }
    }
}