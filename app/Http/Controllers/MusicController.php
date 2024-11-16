<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function showUploadForm()
    {
        return view('upload-musics');
    }

    /**
     * Process the uploaded JSON file.
     */
    public function processUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:json|max:2048',
        ]);

        // Obter o conteúdo do arquivo
        $file = $request->file('file');
        $jsonContent = file_get_contents($file->getRealPath());
        $tracks = json_decode($jsonContent, true);

        if (!$tracks) {
            return redirect()->back()->withErrors(['file' => 'O arquivo JSON é inválido.']);
        }

        // Inserir os dados no banco
        foreach ($tracks as $track) {
            Music::create([
                'track' => $track['Track'] ?? null,
                'artist' => $track['Artist'] ?? null,
                'album' => $track['Album'] ?? null,
                'year' => $track['Year'] ?? null,
                'duration' => $track['Duration'] ?? null,
                'time_signature' => $track['Time_Signature'] ?? null,
                'danceability' => $track['Danceability'] ?? null,
                'energy' => $track['Energy'] ?? null,
                'key' => $track['Key'] ?? null,
                'loudness' => $track['Loudness'] ?? null,
                'mode' => $track['Mode'] ?? null,
                'speechiness' => $track['Speechiness'] ?? null,
                'acousticness' => $track['Acousticness'] ?? null,
                'instrumentalness' => $track['Instrumentalness'] ?? null,
                'liveness' => $track['Liveness'] ?? null,
                'valence' => $track['Valence'] ?? null,
                'tempo' => $track['Tempo'] ?? null,
                'popularity' => $track['Popularity'] ?? null,
            ]);
        }

        return redirect()->back()->with('success', 'Dados importados com sucesso!');
    }
}
