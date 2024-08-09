<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InspectionController extends Controller
{
    // Listar todas as inspeções
    public function index()
    {
        $inspections = Inspection::all();
        return response()->json($inspections);
    }

    // Armazenar uma nova inspeção
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'container_id' => 'required|exists:containers,id',
            'inspection_date' => 'required|date',
            'notes' => 'nullable|string',
            'status' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $inspection = Inspection::create($request->all());
        return response()->json($inspection, 201);
    }

    // Mostrar uma inspeção específica
    public function show(Inspection $inspection)
    {
        return response()->json($inspection);
    }

    // Atualizar uma inspeção específica
    public function update(Request $request, Inspection $inspection)
    {
        $validator = Validator::make($request->all(), [
            'container_id' => 'sometimes|required|exists:containers,id',
            'inspection_date' => 'sometimes|required|date',
            'notes' => 'nullable|string',
            'status' => 'sometimes|required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $inspection->update($request->all());
        return response()->json($inspection);
    }

    // Remover uma inspeção específica
    public function destroy(Inspection $inspection)
    {
        $inspection->delete();
        return response()->json(null, 204);
    }
}
