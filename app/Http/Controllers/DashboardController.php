<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DashboardController extends Controller implements HasMiddleware
{
    private $apiKey = 'b0d809481c13d1889decb18b8e45aec9';
    
    /**
     * Mendefinisikan middleware untuk controller
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['getWeather']),
        ];
    }

    // Metode untuk menampilkan halaman dashboard
    public function index()
    {
        // Koordinat default Kupang untuk tampilan awal
        $lat = -10.1783; 
        $lon = 123.5937;
        
        // Panggil metode getWeatherData untuk data cuaca awal
        $weatherData = $this->getWeatherData($lat, $lon);

        return view('dashboard', array_merge($weatherData));
    }

    // Metode baru untuk mengambil data cuaca dari API
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