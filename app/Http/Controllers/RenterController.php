<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRenterRequest;
use App\Http\Requests\EditRenterRequest;
use App\Models\Renter;
use App\Services\InfoService;
use App\Services\RenterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class RenterController extends Controller
{
    public function index(RenterService $renterService, InfoService $infoService)
    {
        $renters = $renterService->getAll();
        $infos = $infoService->getAll();
        
        return Inertia::render('Renter/Exibir', ['renters' => $renters, 'infos' => $infos]);
    }

    public function create()
    {
        return Inertia::render('Renter/Cadastrar');
    }

    public function store(CreateRenterRequest $request, RenterService $renterService)
    {
        $data = [
            'name' => $request->name,
            'assigned_sex' => $request->assigned_sex,
            'telephone' => $request->telephone,
            'email' => $request->email
        ];
        
        $renterService->create($data);
        Log::info('Locatário Criado!');

        return redirect()->back();
    }

    public function edit(int $id, RenterService $renterService)
    {
        $renter = $renterService->getById($id);

        return Inertia::render('Renter/Editar', ['renter' => $renter]);
    }

    public function update(int $id, EditRenterRequest $request, RenterService $renterService)
    {
        $data = [
            'id' => $id,
            'name' => $request->name,
            'assigned_sex' => $request->assigned_sex,
            'telephone' => $request->telephone,
            'email' => $request->email
        ];

        $renterService->update($data);
        Log::info('Locatário Editado!');
        
        return redirect()->back();
    }

    public function delete(int $id, RenterService $renterService)
    {
        $renterService->delete($id);
        Log::info('Locatário Deletado!');

        return back()->with('success', 'Locatário deletado com sucesso!');
    }
}
