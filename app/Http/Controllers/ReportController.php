<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Services\CardService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReportController extends Controller
{
    public function index(CardService $cardService)
    {
        $cards = $cardService->getAll();

        return Inertia::render('Report/Exibir', ['cards' => $cards]);
    }
}
