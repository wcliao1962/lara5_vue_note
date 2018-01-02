<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dog;

class DogsController extends Controller
{

    public function index()
    {
        return Dog::paginate(5);
    }

    public function store(Request $request)
    {
        Dog::create($request->all());
    }

    public function show($id)
    {
        return Dog::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $dog=Dog::findOrFail($id);
        $dog->update($request->all());
    }

    public function destroy($id)
    {
        $dog=Dog::findOrFail($id);
        $dog->delete();
    }
}
