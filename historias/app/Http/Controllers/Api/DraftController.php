<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Draft;

class DraftController extends Controller
{
    public function deleteDraft($history_id)
    {
        try {
            $draft = Draft::where('history_id', $history_id)->first();

            if ($draft) {
                $draft->delete();
                return response()->json(['mensaje' => 'Registro de borrador eliminado exitosamente'], 200);
            } else {
                return response()->json(['mensaje' => 'No se encontró ningún registro de borrador con el history_id proporcionado'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error al eliminar el registro de borrador: ' . $e->getMessage()], 500);
        }
    }
}
