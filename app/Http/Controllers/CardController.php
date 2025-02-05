<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCardRequest;
use App\Services\CardService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class CardController extends Controller
{
    public function index(CardService $service) 
    {
        $archives = $service->getAll();

        return Inertia::render('ArchivesData/Exibir', ['archives' => $archives]);
    }

    public function create()
    {
        $currentData = Carbon::now();

        return Inertia::render('ArchivesData/Cadastrar', ['currentData' => $currentData]);
    }

    public function store(CreateCardRequest $request, CardService $service) 
    {
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'create_date' => $request->create_date
        ];

        $archive = $service->create($data);
        Log::info('Arquivo Criado!');

        return redirect()->route('page.dashboard')->with('success', 'Arquivo criado com sucesso!');
    }

    public function edit(int $id, CardService $service) 
    {

        $archive = $service->getById($id);

        return Inertia::render('ArchivesData/Editar', ['archive' => $archive]);
    }

    public function update(int $id, CreateCardRequest $request, CardService $service) 
    {
        $data = [
            'id' => $id,
            'title' => $request->title,
            'description' => $request->description,
            'create_date' => $request->create_date
        ];
        
        $archive = $service->update($data);
        Log::info('Arquivo Editado!');

        return redirect()->route('archive.index')->with('success', 'Arquivo editado com sucesso!');
    }

    public function delete(int $id, CardService $service) 
    {
        $service->delete($id);

        return redirect()->back()->with('success', 'Arquivo deletado com sucesso!');
    }
}
