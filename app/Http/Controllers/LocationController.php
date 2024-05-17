<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LocationController extends Controller
{
    public function update(Request $request)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Actualizar la ubicación del usuario
        $user->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return response()->json(['message' => 'Ubicación actualizada correctamente'], 200);
    }
}
