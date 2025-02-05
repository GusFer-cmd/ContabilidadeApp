<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInfoRequest;
use App\Http\Requests\EditInfoRequest;
use App\Services\CardService;
use App\Services\InfoService;
use App\Services\RenterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class InfoController extends Controller
{
    public function create(int $id, InfoService $infoService, CardService $cardService, RenterService $renterService)
    {

        $card = $cardService->getById($id);
        $renters = $renterService->getAll();

        return Inertia::render('Info/Cadastrar', ['card' => $card, 'renters' => $renters]);
    }

    public function store(CreateInfoRequest $request, InfoService $infoService)
    {
        $data = [
            'renter_id' => $request->renter_id,
            'card_id' => $request->card_id,
            'payment_date' => $request->payment_date,
            'payment_value' => $request->payment_value
        ];

        $infoService->create($data);
        Log::info('Informação adicionada');

        return redirect()->back();
    }

    public function edit(int $id, InfoService $infoService, RenterService $renterService, CardService $cardService)
    {
        $info = $infoService->getById($id);
        $renters = $renterService->getAll();
        $cards = $cardService->getAll();

        return Inertia::render('Info/Editar', ['info' => $info, 'renters' => $renters, 'cards' => $cards]);
    }

    public function update(int $id, EditInfoRequest $request, InfoService $infoService)
    {

        $data = [
            'id' => $id,
            'renter_id' => $request->renter_id,
            'card_id' => $request->card_id,
            'payment_date' => $request->payment_date,
            'payment_value' => $request->payment_value
        ];

        $infoService->update($data);
        Log::info('Informação atualizada');

        return redirect()->route('manager.index', ['id' => $id])->with('success', 'Informação editada com sucesso!');
    }

    public function delete(int $id, InfoService $infoService)
    {
        $infoService->delete($id);
        Log::info('Informação deletada');

        return redirect()->back()->with('success', 'Informação deletada com sucesso!');
    }
}
