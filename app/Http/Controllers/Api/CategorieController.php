<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Categorie;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorie = Categorie::orderBy('id', 'DESC')->get();
        return response()->json($categorie);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->input(), [
            'name' => 'required|string|max:40',
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ), 422);
        }

        $categorie = Categorie::create([
            'name' => request('name')
        ]);

        return response()->json(compact('categorie'), 201);
    }

    public function show(int $id)
    {
        $categorie = Categorie::find($id);
        if (!$categorie) {
            return response()->json(["message" => "Categoria no encontrada"], 404);
        }
        return response()->json($categorie);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categorie = Categorie::find($id);
        if (!$categorie) {
            return response()->json(["message" => "Categoria no encontrada"], 404);
        }
        $validator = Validator::make(request()->input(), [
            'name' => 'required|string|max:40,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ), 422);
        }

        $categorie->fill([
            'name' => request('name'),
        ])->save();

        return response()->json(compact('categorie'), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorie = Categorie::find($id);
        if (!$categorie) {
            return response()->json(["message" => "Categoria no encontrada"], 404);
        }
        $categorie->delete();
        return response()->json(["message" => "Categoria eliminado"]);
    }

    public function available($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->is_active = '1';
        $categorie->save();
        return response()->json(["message" => "La categoria ha sido activada"]);
    }
    public function locked($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->is_active = '0';
        $categorie->save();
        return response()->json(["message" => "La categoria ha sido Bloqueada"]);
    }
}
