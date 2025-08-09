<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\Kebun;

class DashboardController extends Controller implements HasMiddleware
{
    private $apiKey = 'b0d809481c13d1889decb18b8e45aec9';

    /**
     * Mendefinisikan middleware untuk controller
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['getWeather', 'getWeatherByKebunId']),
        ];
    }

    // Metode untuk menampilkan halaman dashboard
    public function index()
    {
        $user = Auth::user();

        if ($user->pengguna_peran === 'petani') {
            // Petani hanya lihat kebunnya sendiri
            $kebunList = Kebun::where('pengguna_id', $user->pengguna_id)->get();
        } else {
            // Admin/penyuluh lihat semua kebun
            $kebunList = Kebun::all();
        }

        // Jika ada kebun, gunakan koordinat kebun pertama sebagai default
        // Jika tidak, gunakan koordinat default Kupang
        if ($kebunList->count() > 0) {
            $defaultKebun = $kebunList->first();
            $koordinat = $this->parseKoordinat($defaultKebun->kebun_lokasi);
            $lat = $koordinat['lat'];
            $lon = $koordinat['lon'];
            $selectedKebunId = $defaultKebun->kebun_id;
        } else {
            // Koordinat default Kupang untuk tampilan awal jika tidak ada kebun
            $lat = -10.1783;
            $lon = 123.5937;
            $selectedKebunId = null;
        }

        // Panggil metode getWeatherData untuk data cuaca awal
        $weatherData = $this->getWeatherData($lat, $lon);

        // Gabungkan semua data yang diperlukan untuk view
        $viewData = array_merge($weatherData, [
            'kebunList' => $kebunList,
            'selectedKebunId' => $selectedKebunId,
            'lat' => $lat,
            'lon' => $lon
        ]);

        return view('dashboard', $viewData);
    }

    // Metode untuk mengambil data cuaca berdasarkan koordinat
    public function getWeather(Request $request)
    {
        // Validasi parameter lat dan lon
        $request->validate([
            'lat' => 'required|numeric|between:-90,90',
            'lon' => 'required|numeric|between:-180,180'
        ]);

        $lat = $request->lat;
        $lon = $request->lon;

        $weatherData = $this->getWeatherData($lat, $lon);

        return response()->json($weatherData);
    }

    // Metode untuk mengambil data cuaca berdasarkan ID kebun
    public function getWeatherByKebunId(Request $request)
    {
        // Validasi parameter kebun_id
        $request->validate([
            'kebun_id' => 'required|exists:kebun,kebun_id'
        ]);

        $kebunId = $request->kebun_id;
        $kebun = Kebun::findOrFail($kebunId);

        // Parse koordinat dari kebun_lokasi
        $koordinat = $this->parseKoordinat($kebun->kebun_lokasi);
        $lat = $koordinat['lat'];
        $lon = $koordinat['lon'];

        $weatherData = $this->getWeatherData($lat, $lon);
        $weatherData['lat'] = $lat;
        $weatherData['lon'] = $lon;
        $weatherData['kebun'] = $kebun;
        $weatherData['selectedKebunId'] = $kebunId;

        return response()->json($weatherData);
    }

    // Metode helper untuk mengurai string koordinat menjadi lat dan lon
    private function parseKoordinat($lokasiString)
    {
        // Format yang diharapkan: 'latitude,longitude'
        $parts = explode(',', $lokasiString);

        if (count($parts) === 2) {
            return [
                'lat' => (float) trim($parts[0]),
                'lon' => (float) trim($parts[1])
            ];
        }

        // Jika format tidak sesuai, kembalikan koordinat default Kupang
        return [
            'lat' => -10.1783,
            'lon' => 123.5937
        ];
    }

    // Metode helper untuk mengambil data dari OpenWeatherMap
    private function getWeatherData($lat, $lon)
    {
        $dataCuacaSaatIni = null;
        $dataForecast = null;

        try {
            $client = new Client([
                'timeout' => 10, // Timeout setelah 10 detik
                'connect_timeout' => 5 // Timeout koneksi setelah 5 detik
            ]);

            // Ambil data cuaca saat ini
            $responseCurrent = $client->request('GET', "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$this->apiKey}&units=metric&lang=id");
            $dataCuacaSaatIni = json_decode($responseCurrent->getBody()->getContents());

            // Ambil data prakiraan cuaca
            $responseForecast = $client->request('GET', "https://api.openweathermap.org/data/2.5/forecast?lat={$lat}&lon={$lon}&appid={$this->apiKey}&units=metric&lang=id");
            $dataForecast = json_decode($responseForecast->getBody()->getContents());
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            // Error koneksi ke API
            \Illuminate\Support\Facades\Log::error('Koneksi ke OpenWeatherMap gagal: ' . $e->getMessage());
            return $this->getDefaultWeatherData('Koneksi ke server cuaca gagal');
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Error permintaan API
            \Illuminate\Support\Facades\Log::error('Request ke OpenWeatherMap gagal: ' . $e->getMessage());
            return $this->getDefaultWeatherData('Permintaan data cuaca gagal');
        } catch (\Exception $e) {
            // Error umum lainnya
            \Illuminate\Support\Facades\Log::error('Error saat mengambil data cuaca: ' . $e->getMessage());
            return $this->getDefaultWeatherData('Data tidak tersedia');
        }

        return compact('dataCuacaSaatIni', 'dataForecast');
    }

    /**
     * Metode untuk menghasilkan data cuaca default ketika terjadi error
     * 
     * @param string $errorMessage Pesan error yang akan ditampilkan
     * @return array Data cuaca default
     */
    private function getDefaultWeatherData($errorMessage = 'Data tidak tersedia')
    {
        $dataCuacaSaatIni = (object)[
            'main' => (object)['temp' => 'N/A', 'humidity' => 'N/A'],
            'weather' => [(object)['description' => $errorMessage]],
            'wind' => (object)['speed' => 'N/A'],
            'name' => 'Tidak tersedia'
        ];

        $dataForecast = (object)['list' => []];

        return compact('dataCuacaSaatIni', 'dataForecast');
    }
}
