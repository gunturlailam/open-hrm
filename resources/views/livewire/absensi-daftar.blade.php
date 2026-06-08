<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">Sistem Absensi Karyawan</h2>

    @if (session()->has('success'))
        <div class="mb-4 p-4 text-sm text-green-800 bg-green-100 rounded-lg dark:bg-gray-700 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mb-4 p-4 text-sm text-red-800 bg-red-100 rounded-lg dark:bg-gray-700 dark:text-red-400">
            {{ session('error') }}
        </div>
    @endif

    <div x-data="{ 
        loading: false,
        ambilLokasi() {
            this.loading = true;
            if (!navigator.geolocation) {
                alert('Browser kamu tidak mendukung pencatatan lokasi GPS.');
                this.loading = false;
                return;
            }
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    // Kirim koordinat langsung ke fungsi Livewire backend
                    $wire.absenMasuk(position.coords.latitude, position.coords.longitude);
                    this.loading = false;
                },
                (error) => {
                    alert('Gagal mengambil lokasi. Pastikan izin GPS aktif.');
                    this.loading = false;
                }
            );
        }
    }">
        @if($sudahHadir)
            <div class="p-4 bg-gray-100 dark:bg-gray-700 text-center rounded-lg text-gray-600 dark:text-gray-300 font-semibold">
                🎉 Anda telah menyelesaikan absensi masuk untuk hari ini. Terima kasih!
            </div>
        @else
            <button 
                type="button"
                x-on:click="ambilLokasi()"
                x-bind:disabled="loading"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200 shadow-md flex justify-center items-center disabled:opacity-50"
            >
                <span x-show="!loading">📍 Klik untuk Absen Masuk</span>
                <span x-show="loading" x-cloak>⏳ Memverifikasi GPS Anda...</span>
            </button>
        @endif
    </div>
</div>