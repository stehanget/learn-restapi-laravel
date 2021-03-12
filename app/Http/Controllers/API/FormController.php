<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Item;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function index()
    {
      $item = Item::all();
      return response()->json([
        'message' => 'success display a listing of the resource',
        'data' => $item
      ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required'
      ]);

      if ($validator->fails()) {
        return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
      }

      try {
        $item = Item::create($request->all());

        return response()->json([
          'message' => 'success store a newly created resource in storage',
          'data' => $item
        ], Response::HTTP_CREATED);
      } catch (QueryException $e) {
        return response()->json([
          'message' => 'failed ' . $e->errorInfo
        ]);
      }
    }

    public function show(Item $item)
    {
      return response()->json([
        'message' => 'success display the specified resource',
        'data' => $item
      ], 200);
    }

    public function update(Item $item, Request $request)
    {
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required'
      ]);

      if ($validator->fails()) {
        return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
      }

      try {
        $item->update($request->all());

        return response()->json([
          'message' => 'success update the specified resource in storage',
          'data' => $item
        ], Response::HTTP_OK);
      } catch (QueryException $e) {
        return response()->json([
          'message' => 'failed ' . $e->errorInfo
        ]);
      }
    }

    public function destroy(Item $item)
    {
      try {
        $item->delete();

        return response()->json([
          'message' => 'success remove the specified resource from storage'
        ], Response::HTTP_OK);
      } catch (QueryException $e) {
        return response()->json([
          'message' => 'failed ' . $e->errorInfo
        ]);
      }
    }
}
