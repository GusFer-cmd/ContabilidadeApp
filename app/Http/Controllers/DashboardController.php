<?php

namespace App\Http\Controllers;

use App\Services\CardService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(CardService $service)
    {
        $archives = $service->getAll();

        return Inertia::render('Dashboard/Dashboard', ['archives' => $archives]);
    }
}
