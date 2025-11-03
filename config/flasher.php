<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Default Notification Library
    |--------------------------------------------------------------------------
    | Library notifikasi yang akan digunakan secara default.
    | Kita set 'noty' agar semua notifikasi menggunakan Noty.
    */
    'default' => 'noty',

    /*
    |--------------------------------------------------------------------------
    | Auto Inject Assets
    |--------------------------------------------------------------------------
    | Otomatis memasukkan script CSS & JS Noty ke dalam halaman.
    | Jika true, Anda tidak perlu include manual.
    */
    'inject_assets' => true,

    /*
    |--------------------------------------------------------------------------
    | Translation
    |--------------------------------------------------------------------------
    | Aktifkan jika ingin menggunakan file translasi untuk pesan notifikasi.
    */
    'translate' => true,

    /*
    |--------------------------------------------------------------------------
    | Filter Notifications
    |--------------------------------------------------------------------------
    | Batasi jumlah notifikasi yang bisa muncul dalam satu halaman.
    */
    'filter' => [
        'limit' => 5, // Maksimal 5 notifikasi per halaman
    ],

    /*
    |--------------------------------------------------------------------------
    | CDN Configuration
    |--------------------------------------------------------------------------
    | Konfigurasi CDN untuk load file CSS & JS Noty dari internet.
    */
    'scripts' => [
        'cdn' => [
            'enabled' => true, // Gunakan CDN
            'base_url' => null, // null = gunakan CDN default
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Notification Presets (KONFIGURASI UTAMA NOTY)
    |--------------------------------------------------------------------------
    | Di sinilah Anda mengatur tampilan dan perilaku notifikasi Noty.
    */
    'presets' => [
        
        'noty' => [
            
            // ===== TEMA NOTY =====
            // Pilihan: 'mint', 'sunset', 'relax', 'metroui', 'nest', 'light', 'bootstrap-v4'
            'theme' => 'mint',
            
            // ===== POSISI NOTIFIKASI =====
            // Pilihan posisi:
            // - 'top', 'topLeft', 'topCenter', 'topRight' (atas)
            // - 'center', 'centerLeft', 'centerRight' (tengah)
            // - 'bottom', 'bottomLeft', 'bottomCenter', 'bottomRight' (bawah)
            'layout' => 'topRight',
            
            // ===== DURASI TAMPIL =====
            // Dalam milidetik (1000 = 1 detik)
            // false = tidak otomatis hilang (harus diklik manual)
            'timeout' => 5000, // 5 detik
            
            // ===== PROGRESS BAR =====
            // Tampilkan bar progress countdown
            'progressBar' => true,
            
            // ===== CARA MENUTUP =====
            // User bisa menutup dengan cara: klik notifikasi atau klik tombol close
            'closeWith' => ['click', 'button'],
            
            // ===== ANIMASI =====
            // Animasi saat notifikasi muncul dan hilang
            'animation' => [
                'open' => 'animated fadeInRight',  // Masuk dari kanan
                'close' => 'animated fadeOutRight', // Keluar ke kanan
            ],
            
            // ===== MAKSIMAL NOTIFIKASI TAMPIL =====
            'maxVisible' => 5,
            
            // ===== QUEUE =====
            // Notifikasi akan antri jika lebih dari maxVisible
            'queue' => 'global',
            
            // ===== KILLER =====
            // true = menutup notifikasi dengan tipe yang sama saat muncul notifikasi baru
            'killer' => false,
            
            // ===== MODAL =====
            // true = notifikasi dengan overlay (menutupi seluruh layar)
            'modal' => false,
            
            // ===== SOUNDS =====
            // Suara notifikasi (opsional)
            'sounds' => [
                'enabled' => true,
            ],
        ],
        
    ],

    /*
    |--------------------------------------------------------------------------
    | Type Mapping
    |--------------------------------------------------------------------------
    | Mapping tipe notifikasi ke warna/style Noty.
    */
    'types' => [
        'success' => 'success', // Hijau
        'error' => 'error',     // Merah
        'warning' => 'warning', // Kuning
        'info' => 'info',       // Biru
    ],
];