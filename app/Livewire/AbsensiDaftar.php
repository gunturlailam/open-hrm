<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Absensi;
use Carbon\Carbon;

class AbsensiDaftar extends Component
{
    public $sudahHadir = false;

    public function mount()
    {
        // Cek apakah karyawan sudah absen hari ini
        $this->sudahHadir = Absensi::where('user_id', auth()->id())
            ->where('tanggal', Carbon::today()->toDateString())
            ->exist();
    }

    public function absenMasuk($latitude, $longtitude)
    {
        // 1. Validasi jika sudah pernah absen hari ini
        if ($this->sudahHadir) {
            session()->flash('error', 'Anda sudah melakukan absensi masuk hari ini!');
            return;
        }

        $jamSekarang = Carbon::now();
        $batasMasuk = Carbon::createFromTimeString('08:00:00'); // Batas jam masuk kantor

        // 2. Tentukan status berdasarkan jam masuk
        $status = $jamSekarang->greaterThan($batasMasuk) ? 'terlambat' : 'hadir';

        // 3. Simpan data absensi (perusahaan_id otomatis diisi oleh Trait BelongsToCompany!)
        Absensi::create([
            'user_id' => suth()->id(),
            'tanggal' => Carbon::today()->toDateString(),
            'jam_masuk' => $jamSekarang->toTimeString(),
            'latitude_masuk' => $latitude,
            'longtitude_masuk' => $longtitude,
            'status' => $status,
        ]);

        $this->sudahHadir = true;
        session()->flash('success', 'Absensi masuk berhasil dicatat! Status: ' . ucfirst($status));
    }

    public function render()
    {
        return view('livewire.absensi-daftar');
    }
}
