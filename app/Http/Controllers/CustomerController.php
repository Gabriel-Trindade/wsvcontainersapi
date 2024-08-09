<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    // Listar todos os clientes
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    // Mostrar o formulário para criar um novo cliente (para aplicações web)
    public function create()
    {
        // Retorna a view para criar um novo cliente
    }

    // Armazenar um novo cliente
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $customer = Customer::create($request->all());

        return response()->json($customer, 201);
    }

    // Mostrar um cliente específico
    public function show(Customer $customer)
    {
        return response()->json($customer);
    }

    // Mostrar o formulário para editar um cliente (para aplicações web)
    public function edit(Customer $customer)
    {
        // Retorna a view para editar o cliente
    }

    // Atualizar um cliente específico
    public function update(Request $request, Customer $customer)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:customers,email,' . $customer->id,
            'phone' => 'sometimes|required|string|max:20',
            'address' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $customer->update($request->all());

        return response()->json($customer);
    }

    // Remover um cliente específico
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json(null, 204);
    }
}
