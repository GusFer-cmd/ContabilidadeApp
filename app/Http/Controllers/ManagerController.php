<?php

namespace App\Http\Controllers;

use App\Services\CardService;
use App\Services\InfoService;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ManagerController extends Controller
{
    public function index(int $id, CardService $service, InfoService $infoService)
    {
        $archive = $service->getById($id);
        $infos = $infoService->getAll();

        return Inertia::render('Manager/Gerenciar', ['archive' => $archive, 'infos' => $infos]);
    }
}