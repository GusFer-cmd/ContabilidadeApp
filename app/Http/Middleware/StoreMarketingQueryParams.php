<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use App\Services\UtmTagService;

class StoreMarketingQueryParams
{
    protected $utmTagService;

    public function __construct(UtmTagService $utmTagService)
    {
        $this->utmTagService = $utmTagService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $utmParams = ['utm_source', 'utm_medium', 'utm_campaign'];
        $utmData = [];

        foreach ($utmParams as $utmParam) {
            if ($request->has($utmParam)) {
                $utmData[$utmParam] = $request->input($utmParam);
            }
        }

        //Verifico se está o array está vazio ou não
        if (!empty($utmData)) {
            Cookie::queue('utm_params', json_encode($utmData), 60); //60 minutos, ficar pra sempre
            Log::info('UTM Armazenada no Cookie:', $utmData);
        }

        //É a primeira sessão?
        if (!$request->cookie('first_session') && empty($request->header('referer'))) { // olha no document.referer, se vazio página atual é a primeira (nova sessão)
            Cookie::queue('first_session', json_encode($utmData), 60); 
            Log::info('Primeira Sessão Setada no Cookie:', $utmData);
        } else {
            Log::info('Essa não é a Primeira Sessão!');
        }

       
        if ($this->isConversionRequest($request)) {
            Log::info('Passou por aqui');
            $utmParams = json_decode($request->cookie('utm_params', '[]'), true);
            $firstSession = json_decode($request->cookie('first_session', '[]'), true);

            if (!empty($utmParams) && !empty($firstSession)) {
                $dataUtm = [
                    'utm_params' => $utmParams,
                    'first_session' => $firstSession
                ];

                $this->utmTagService->create($dataUtm);
                Log::info('UTM Params Armazenadas no Banco de Dados:', $dataUtm);
            }
        }

        return $next($request);
    }

    /**
     * Verifica se a solicitação é uma conversão.
     *
     * @param Request $request
     * @return bool
     */
    protected function isConversionRequest(Request $request)
    {
       // como verificar se é uma conversão?
       return $request->routeIs('usuario.store'); //rota do subcribe
    }
}