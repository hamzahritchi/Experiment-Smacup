# Eksperimen Sistem

# Pemasangan
Buat database bernama eksperimen, import file eksperimen.sql

# Pengaturan
Aplication/Config/cofig.php untuk pengaturan url, dsb
Aplication/Config/database.php untuk pengaturan database yang dipakai

# Modifikasi
Aplikasi menggunakan konsep MVC Codeigniter, modifikasi dilakukan pada folder:

Aplication/Controler
Aplication/Model
Aplication/View

Halaman pertama diatur pada folder controler, file pendahuluan.php
Halaman pencatatan peserta pertama kali dilakukan controler, pada dataresponden.php
Model distribusi kasus dan pencatatan peserta dapat dilihat melalui model M_Partisipan.php.

Pada controler M_Dataresponden, akan memanggil model M_DataResponden.php. Model M_DataResponden.php akan memanggil model M_Partisipan.
