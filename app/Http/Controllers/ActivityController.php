<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ActivityController extends Controller
{
    //
    public function loadAudio(Request $request)
    {
        $apiKey = '5lDOi3anN42aHBBUyMZTrR3T5gMTrjn5Q5uACsd9'; // Reemplaza 'tu-clave-api' con tu clave API real
        $textToConvert = $request->text;
        $apiUrl = 'https://api.narakeet.com/text-to-speech/m4a';
        $voice = 'armando';
        $voiceSpeed = '0.8';

//        $apiKey = 'tu-clave-api'; // Reemplaza 'tu-clave-api' con tu clave API real
//        $textToConvert = "Hi there, this is your API speaking";

        $response = Http::withHeaders([
            'Content-Type' => 'text/plain',
            'x-api-key' => $apiKey,
            'accept' => 'application/octet-stream',
        ])->post('https://api.narakeet.com/text-to-speech/mp3?voice=' . $voice . '&voice-speed=' . $voiceSpeed, $textToConvert);

        if ($response->successful()) {
            // Guarda la respuesta en un archivo
            $outputFilePath = public_path('/audios/'. $request->path .'/'. $request->name .'.mp3'); // Guarda el archivo en la carpeta pública
            file_put_contents($outputFilePath, $response->body());

            return 'Archivo descargado con éxito: ' . $outputFilePath;
        } else {
            return 'Error al realizar la solicitud: ' . $response->body();
        }
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
