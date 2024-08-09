<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RentalController extends Controller
{
    // Listar todos os contratos de aluguel
    public function index()
    {
        $rentals = Rental::all();
        return response()->json($rentals);
    }

    // Armazenar um novo contrato de aluguel
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'container_id' => 'required|exists:containers,id',
            'customer_id' => 'required|exists:customers,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $rental = Rental::create($request->all());
        return response()->json($rental, 201);
    }

    // Mostrar um contrato de aluguel específico
    public function show(Rental $rental)
    {
        return response()->json($rental);
    }

    // Atualizar um contrato de aluguel específico
    public function update(Request $request, Rental $rental)
    {
        $validator = Validator::make($request->all(), [
            'container_id' => 'sometimes|required|exists:containers,id',
            'customer_id' => 'sometimes|required|exists:customers,id',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'sometimes|required|date',
            'status' => 'sometimes|required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $rental->update($request->all());
        return response()->json($rental);
    }

    // Remover um contrato de aluguel específico
    public function destroy(Rental $rental)
    {
        $rental->delete();
        return response()->json(null, 204);
    }
}
