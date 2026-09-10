# 📄 Modern Teklif & Proforma Sihirbazı (Proforma Proposal Generator)

![PHP](https://img.shields.io/badge/PHP-8.x%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6%2B-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![CSS3](https://img.shields.io/badge/CSS3-Modern%20UI-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![Responsive](https://img.shields.io/badge/Design-A4%20Print%20Ready-22c55e?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)

İşletmeler, ajanslar ve serbest çalışanlar (freelancer) için geliştirilmiş; sol tarafta kolayca doldurulabilen form, sağ tarafta ise anlık canlı A4 önizlemesi sunan modern ve profesyonel teklif/proforma fatura hazırlama aracı.

---

## ✨ Temel Özellikler

- ⚡ **Canlı A4 Önizleme (Live Preview):** Form alanlarına girilen veriler anında sağ taraftaki A4 kağıt şablonuna yansır.
- 🖨️ **Baskı ve PDF Çıktısı Uyumluluğu:** `@media print` optimizasyonu sayesinde tarayıcının "Yazdır" (Ctrl+P / Cmd+P) veya "PDF Olarak Kaydet" özelliğiyle kusursuz A4 çıktısı alınır.
- 🖼️ **Dinamik Logo Desteği:** Şirket logonuzu yükleyin; Base64 entegrasyonu sayesinde harici sunucuya ihtiyaç duymadan anında belgenize yerleştirin.
- ➕ **Dinamik Kalem/Ürün Yönetimi:** İhtiyacınız kadar ürün/hizmet kalemi ekleyin veya silin; başlık, açıklama, miktar ve birim fiyat tanımlayın.
- 🧮 **Gelişmiş Vergi & Tutar Hesaplama:**
  - KDV Dahil veya KDV Hariç hesaplama seçeneği.
  - Özel KDV oranı belirleme.
  - Ara toplam, vergi tutarı ve genel toplamın anlık otomatik hesaplanması.
- 💱 **Çoklu Para Birimi Desteği:** TL (₺), USD ($), EUR (€) ve GBP (£) seçenekleri.
- 💾 **Geçici Durum Saklama (Session Storage):** Sayfa yenilendiğinde girdiğiniz bilgilerin kaybolmaması için tarayıcı belleğine otomatik kayıt.
- 🎨 **Modern ve Temiz Tasarım:** Inter tipografisi ve Lucide ikonlarıyla zenginleştirilmiş, kullanıcı dostu şık arayüz.

---

## 🚀 Hızlı Başlangıç & Kurulum

Bu proje sıfır bağımlılıkla veya standart bir PHP sunucusu (WampServer, XAMPP, Laragon, PHP Built-in Server) üzerinde anında çalışır.

### Gereksinimler

- PHP 7.4 veya üzeri (tercihen PHP 8.x)
- Modern bir web tarayıcısı (Chrome, Edge, Firefox, Safari)

### Çalıştırma Adımları

1. **Repoyu klonlayın:**
   ```bash
   git clone https://github.com/ozcansayid/proforma-teklif.git
   cd proforma-teklif
   ```

2. **Yerel PHP sunucusunu başlatın:**
   ```bash
   php -S localhost:8000
   ```
   *Veya projeyi WampServer / XAMPP altındaki `www` ya da `htdocs` klasörüne taşıyın.*

3. **Tarayıcınızda açın:**
   [http://localhost:8000](http://localhost:8000)

---

## 🛠️ Kullanım Rehberi

1. **Gönderen Bilgileri:** Firma adı, iletişim bilgileri, adres ve logonuzu yükleyin.
2. **Teklif & Müşteri Detayları:** Teklif numarası, teklif tarihi, son geçerlilik tarihi ve müşteri unvanı/yetkili bilgilerini girin.
3. **Ürün/Hizmet Kalemleri:** Teklife dahil edilecek kalemleri "Yeni Kalem Ekle" butonuyla ekleyin. Miktar ve birim fiyatları belirleyin.
4. **Vergi & Para Birimi:** Para birimini ve KDV oranını seçin; KDV'nin fiyata dahil olup olmadığını işaretleyin.
5. **Notlar ve Koşullar:** Teklife eklemek istediğiniz banka hesap bilgileri, teslimat şartları veya garanti notlarını yazın.
6. **Yazdır / PDF İndir:** Sol üstteki **"Yazdır / PDF Olarak Kaydet"** butonuna basarak doğrudan PDF olarak kaydedin veya yazdırın.

---

## 📂 Proje Yapısı

```text
proforma-teklif/
├── index.php          # Tüm form, önizleme, stil ve JS mantığını içeren ana dosya
├── .gitignore         # Gereksiz dosyaların repoya girmesini engelleyen yapılandırma
└── README.md          # Proje dökümantasyonu
```

---

## 📄 Lisans

Bu proje [MIT Lisansı](LICENSE) altında lisanslanmıştır. Dilediğiniz gibi kullanabilir, değiştirebilir ve geliştirebilirsiniz.
