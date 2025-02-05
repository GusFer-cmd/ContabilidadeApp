<?php

namespace App\Http\Controllers;

use App\Services\CardService;
use App\Services\InfoService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PdfController extends Controller
{
    public function generate(int $id, CardService $cardService, InfoService $infoService)
    {
        $card = $cardService->getById($id);
        $infos = $infoService->getByCardId($card->id);
        $totalPayment = $infos->sum('payment_value');
        
        $pdf = Pdf::loadView('pdf.card_report', compact('card', 'infos', 'totalPayment'));

        return $pdf->download('relatorio_locacao_' . $card->id . '.pdf');
    }
}
