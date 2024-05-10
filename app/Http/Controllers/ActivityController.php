<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ActivityController extends Controller
{
    public function getActivityCount($levelNumber)
    {
        // Aquí debes implementar la lógica para contar las vistas.
        // Este es solo un ejemplo, debes adaptarlo a tu caso.
        $count = count(glob(resource_path('views/level' . $levelNumber . '/*.blade.php')));

        return response()->json($count);
    }

    public function loadAudio(Request $request)
    {

//        return $request->text;
        $apiKey = '5lDOi3anN42aHBBUyMZTrR3T5gMTrjn5Q5uACsd9'; // Reemplaza 'tu-clave-api' con tu clave API real
//        $textToConvert = str_replace('%20', ' ', urlencode($request->text));
        $textToConvert = str_replace('+', ' ', urlencode($request->text));
//        $textToConvert = urlencode($request->text);

        $apiUrl = 'https://api.narakeet.com/text-to-speech/m4a';
        $voice = 'armando';
        $voiceSpeed = $request->speed;

//        $apiKey = 'tu-clave-api'; // Reemplaza 'tu-clave-api' con tu clave API real
//        $textToConvert = "Hi there, this is your API speaking";

        $response = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'x-api-key' => $apiKey,
            'accept' => 'application/octet-stream',
        ])->post('https://api.narakeet.com/text-to-speech/m4a?voice=' . $voice . '&voice-speed=' . $voiceSpeed, $textToConvert);


        try {
            $outputFilePath = public_path('audios/' . $request->path . '/' . $request->name . '.m4a'); // Guarda el archivo en la carpeta pública
            file_put_contents($outputFilePath, $response->body());
            return 'Archivo descargado con éxito: ' . $outputFilePath;
        } catch (\Exception $e) {
            return 'Error al realizar la solicitud: ' . $e->getMessage();
        }

//        if ($response->successful()) {
//            // Guarda la respuesta en un archivo
//            $outputFilePath = public_path('/audios/'. $request->path .'/'. $request->name .'.m4a'); // Guarda el archivo en la carpeta pública
//            file_put_contents($outputFilePath, $response->body());
//
//            return 'Archivo descargado con éxito: ' . $outputFilePath;
//        } else {
//            return 'Error al realizar la solicitud: ' . $response->body();
//        }
    }


    public function showActivity($levelNumber, $activityNumber): View
    {
        $data = [
            'levelNumber' => $levelNumber,
            'activityNumber' => $activityNumber,
        ];

        return view('level' . $levelNumber . '/' . $activityNumber)->with($data);
    }
}
