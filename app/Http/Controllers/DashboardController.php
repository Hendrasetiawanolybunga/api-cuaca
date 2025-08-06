<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DashboardController extends Controller
{
    private $apiKey = 'b0d809481c13d1889decb18b8e45aec9';

    // Metode untuk menampilkan halaman dashboard
    public function index()
    {
        // Data Harga Pasar dengan tren (untuk grafik)
        $dataHarga = [
            'labels' => ['28 Jul', '29 Jul', '30 Jul', '31 Jul', '1 Agt', '2 Agt', '3 Agt'],
            'harga' => [5000, 5050, 5100, 5150, 5100, 5120, 5200]
        ];

        // Koordinat default Kupang untuk tampilan awal
        $lat = -10.1783; 
        $lon = 123.5937;
        
        // Panggil metode getWeather untuk data cuaca awal
        $weatherData = $this->getWeatherData($lat, $lon);

        return view('dashboard', array_merge(['dataHarga' => $dataHarga], $weatherData));
    }

    // Metode baru untuk mengambil data cuaca dari API
    public function getWeather(Request $request)
    {
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
            $client = new Client();
            $responseCurrent = $client->request('GET', "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$this->apiKey}&units=metric&lang=id");
            $dataCuacaSaatIni = json_decode($responseCurrent->getBody()->getContents());

            $responseForecast = $client->request('GET', "https://api.openweathermap.org/data/2.5/forecast?lat={$lat}&lon={$lon}&appid={$this->apiKey}&units=metric&lang=id");
            $dataForecast = json_decode($responseForecast->getBody()->getContents());

        } catch (\Exception $e) {
            $dataCuacaSaatIni = (object)[
                'main' => (object)['temp' => 'N/A', 'humidity' => 'N/A'],
                'weather' => [(object)['description' => 'Data tidak tersedia']],
                'wind' => (object)['speed' => 'N/A'],
            ];
            $dataForecast = (object)['list' => []];
        }

        return compact('dataCuacaSaatIni', 'dataForecast');
    }
}