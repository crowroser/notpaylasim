# Not Paylaşım Sitesi


## Proje Hakkında

Not Paylaşım Sitesi, kullanıcıların notlarını paylaşabildiği, düzenleyebildiği ve görüntüleyebildiği bir web platformudur. Proje, Laravel framework'ü kullanılarak geliştirilmiştir ve kullanıcı dostu, hızlı ve güvenli bir deneyim sunmayı amaçlamaktadır.

### Özellikler

- **Kullanıcı Yönetimi:**
  - Kullanıcı kaydı, giriş ve profil yönetimi.
  - Şifre sıfırlama ve güvenlik doğrulamaları.

- **Not Yönetimi:**
  - Not oluşturma, düzenleme ve silme.
  - Notları kategoriye ayırma ve etiketleme.

- **Paylaşım ve Görünürlük:**
  - Notları herkese açık veya özel olarak paylaşabilme.
  - Başkalarının paylaştığı notları görüntüleme.

- **Gelişmiş Arama:**
  - Etiketler ve anahtar kelimelerle hızlı not arama.

## Kurulum

### Gereksinimler
- PHP >= 8.1
- Composer
- Laravel 10
- MySQL veya diğer bir desteklenen veritabanı
- Node.js ve NPM (varsa ön uç işlemleri için)

### Kurulum Adımları

1. **Depoyu Klonlayın:**
   ```bash
   git clone https://github.com/crowroser/notpaylasim.git
   cd notpaylasim
   ```

2. **Bağımlılıkları Kurun:**
   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Çevre Değişkenlerini Ayarlayın:**
   `.env` dosyasını oluşturun ve aşağıdaki örneğe göre doldurun:
   ```env
   APP_NAME=NotPaylasim
   APP_ENV=local
   APP_KEY=base64:keyburayaeklenecek
   APP_DEBUG=true
   APP_URL=http://localhost

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=notpaylasim
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Veritabanını Migrasyon ile Hazırlayın:**
   ```bash
   php artisan migrate
   ```

5. **Uygulamayı Çalıştırın:**
   ```bash
   php artisan serve
   ```
   Tarayıcınızda [http://localhost:8000](http://localhost:8000) adresine gidin.

## Katkıda Bulunma

Katkıda bulunmak isterseniz, lütfen aşağıdaki adımları izleyin:

1. Bu projeyi fork'layın.
2. Yeni bir branch oluşturun:
   ```bash
   git checkout -b yeni-ozellik
   ```
3. Değişikliklerinizi yapın ve commit edin:
   ```bash
   git commit -m "Yeni bir özellik eklendi."
   ```
4. Branch'inizi fork'ladığınız depoya push edin:
   ```bash
   git push origin yeni-ozellik
   ```
5. Bir pull request açın.

## Lisans

Bu proje [MIT Lisansı](https://opensource.org/licenses/MIT) ile lisanslanmıştır.

## İletişim

Bu proje hakkında sorularınız veya önerileriniz için benimle iletişime geçebilirsiniz:
- **E-posta:** fatihgulcu@fatihgulcu.com.tr
- **GitHub:** [crowroser](https://github.com/crowroser)
- **Website:** fatihgulcu.com.tr
