<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category; // Import the Category model
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return Category::all();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|unique:categories',
            'description' => 'nullable|string',
        ]);
        return Category::create($data);
    }

    public function show($id) {
        return Category::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $category = Category::findOrFail($id);
        $data = $request->validate([
            'name' => 'sometimes|required|string|unique:categories,name,' . $id,
            'description' => 'nullable|string',
        ]);
        $category->update($data);
        return $category;
    }

    public function destroy($id) {
        Category::destroy($id);
        return response()->json(['message' => 'Category deleted']);
    }
}

