<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CardNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("Cartão não encontrado");
    }

    public function report():void
    {
        Log::error($this->getMessage());
    }

    public function render(Request $request): Response|RedirectResponse
    {
        if ($request->is('api/*')) {
            return response()->json([
                'message' => $this->getMessage()
            ], 404);
        }

        return back()
            ->withErrors(['email' => $this->getMessage()])
            ->onlyInput('email');
    }
}