<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index($tema = null)
    {
        $temas = [
            'ansiedade' => [
                'titulo' => 'Ansiedade',
                'video'  => 'videos/video_ansiedade.mp4', // <-- Nome correto do arquivo
            ],
            'depressao' => [
                'titulo' => 'Depressão',
                'video'  => 'videos/video_depressao.mp4',
            ],
            'vicios' => [
                'titulo' => 'Vícios',
                'video'  => 'videos/video_vicios.mp4',
            ],
            'autocuidado' => [
                'titulo' => 'Autocuidado',
                'video'  => 'videos/video_autoajuda.mp4',
            ],
        ];

        // se não veio tema, define "ansiedade" como padrão
        $tema = $tema ?? 'ansiedade';

        // se não existir no array, retorna 404
        if (!isset($temas[$tema])) {
            abort(404, 'Tema não encontrado');
        }

        return view('chat', [
            'tema'       => $tema,
            'tituloTema' => $temas[$tema]['titulo'],
            'videoSrc'   => asset($temas[$tema]['video']), // gera URL pública
        ]);
    }
}
