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
                'video'  => 'videos/ansiedade.mp4',
            ],
            'depressao' => [
                'titulo' => 'Depressão',
                'video'  => 'videos/depressao.mp4',
            ],
            'vicios' => [
                'titulo' => 'Vícios',
                'video'  => 'videos/vicios.mp4',
            ],
            'autocuidado' => [
                'titulo' => 'Autocuidado',
                'video'  => 'videos/autocuidado.mp4',
            ],
        ];

        // Se não for passado tema, usa "ansiedade" como padrão
        if ($tema === null) {
            $tema = 'ansiedade';
        }

        if (!array_key_exists($tema, $temas)) {
            abort(404, 'Tema não encontrado');
        }

        return view('chat', [
            'tema'       => $tema,
            'tituloTema' => $temas[$tema]['titulo'],
            'videoSrc'   => asset($temas[$tema]['video']),
        ]);
    }
}
