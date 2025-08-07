# FarmEase: Solusi Pertanian Cerdas untuk Petani Lahan Kering Kupang 🌾

FarmEase adalah sebuah platform web inovatif yang didesain untuk memberdayakan petani lahan kering di Kabupaten Kupang, Nusa Tenggara Timur. Platform ini menyediakan informasi penting secara dinamis dan real-time yang dapat membantu petani membuat keputusan yang lebih baik dan strategis.



## 🎯 Fitur Utama

FarmEase dirancang dengan fokus pada kegunaan dan relevansi lokal, menawarkan fitur-fitur berikut:

-   **Peta Interaktif 🗺️**: Menampilkan peta Kabupaten Kupang yang dapat diklik untuk melihat data cuaca spesifik di lokasi tersebut. Ini memungkinkan petani untuk mendapatkan informasi yang sangat lokal dan relevan dengan lahan mereka.
-   **Data Cuaca Real-time ☀️**: Menyajikan data cuaca terkini (suhu, kelembaban, kecepatan angin) dari OpenWeatherMap yang diperbarui secara dinamis berdasarkan lokasi yang dipilih pada peta.
-   **Prediksi Cuaca 5 Hari 🌦️**: Memberikan prakiraan cuaca untuk 5 hari ke depan, membantu petani merencanakan aktivitas tanam, panen, atau pengolahan lahan dengan lebih efektif.
-   **Tren Harga Pasar 📈**: Menampilkan grafik tren harga jagung pipilan kering, komoditas utama di Kupang, yang bersumber dari data pasar lokal. Fitur ini membantu petani dalam menentukan waktu terbaik untuk menjual hasil panen.

---

## 🚀 Teknologi yang Digunakan

FarmEase dibangun di atas tumpukan teknologi modern untuk memastikan kinerja yang cepat, keamanan, dan skalabilitas.

-   **Backend**: **Laravel** (PHP Framework)
-   **Frontend**: **HTML**, **CSS** (**Bootstrap 5**), **JavaScript**
-   **Peta**: **Leaflet.js** dan layer **OpenStreetMap** & **Esri World Imagery**
-   **Grafik**: **Chart.js** untuk visualisasi data
-   **Permintaan API**: **Guzzle** dan **Axios**

---

## 🛠️ Instalasi dan Pengembangan

Untuk menjalankan proyek ini secara lokal, ikuti langkah-langkah berikut:

1.  **Clone repositori:**
    ```bash
    git clone https://github.com/Hendrasetiawanolybunga/api-cuaca.git
    cd farmease
    ```

2.  **Instal dependensi Composer:**
    ```bash
    composer install
    ```

3.  **Salin file `.env` dan konfigurasikan:**
    ```bash
    cp .env.example .env
    ```
    Buka file `.env` dan atur kunci API untuk OpenWeatherMap.
    ```env
    # .env
    OPENWEATHERMAP_API_KEY=your_api_key_here
    ```

4.  **Jalankan server pengembangan Laravel:**
    ```bash
    php artisan serve
    ```

Aplikasi sekarang dapat diakses di `http://127.0.0.1:8000`.

---

## 🤝 Kontribusi

Kami sangat menghargai kontribusi dari komunitas! Jika Anda tertarik untuk membantu mengembangkan FarmEase, silakan ikuti langkah-langkah berikut:

1.  Fork repositori ini.
2.  Buat branch baru: `git checkout -b fitur-baru-anda`
3.  Lakukan perubahan dan commit: `git commit -m 'Menambahkan fitur baru'`
4.  Push ke branch Anda: `git push origin fitur-baru-anda`
5.  Buka Pull Request.

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah **Lisensi MIT**. Lihat file [LICENSE](LICENSE) untuk detail lebih lanjut.

---

Copyright © 2025 FarmEase Team.