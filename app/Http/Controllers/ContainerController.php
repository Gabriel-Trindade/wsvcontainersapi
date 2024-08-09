<?php

namespace App\Http\Controllers;

use App\Models\Container;
use Illuminate\Http\Request;

class ContainerController extends Controller
{
    public function index()
    {
        $containers = Container::all();
        return response()->json($containers);
    }

    public function store(Request $request)
    {
        $container = Container::create($request->all());
        return response()->json($container, 201);
    }

    public function show(Container $container)
    {
        return response()->json($container);
    }

    public function update(Request $request, Container $container)
    {
        $container->update($request->all());
        return response()->json($container);
    }

    public function destroy(Container $container)
    {
        $container->delete();
        return response()->json(null, 204);
    }
}
