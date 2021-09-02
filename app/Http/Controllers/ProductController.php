<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests\ProductRequests\StoreProductRequest;
use App\Http\Requests\ProductRequests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['msg' => 'Função não implementada!'], 500);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json(['msg' => 'Função não implementada!'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return response()->json(['msg' => 'Função não implementada!'], 500);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return response()->json(['msg' => 'Função não implementada!'], 500);
    }

    /**
     * Get a the resource.
     *
     * @param  $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function get($id, Request $request)
    {
        try {
            $product = new Product;

            if ($request->has('trashed') && !(is_null($request->trashed))) {
                if ($request->trashed == 0) {
                    $product = $product->withTrashed();
                } elseif ($request->trashed == 1) {
                    $product = $product->onlyTrashed();
                }
            }

            $product = $product->find($id);

            return response()->json($product, 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro ao buscar o produto!'], 500);
        }
    }

    /**
     * Search a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        try {
            $product = new Product;

            if ($request->has('trashed') && !(is_null($request->trashed))) {
                if ($request->trashed == 0) {
                    $product = $product->withTrashed();
                } elseif ($request->trashed == 1) {
                    $product = $product->onlyTrashed();
                }
            }

            if ($request->has('name') && !(is_null($request->name))) {
                $product = $product->where('name', 'LIKE', "%{$request->name}%");
            }

            if ($request->has('description') && !(is_null($request->description))) {
                $product = $product->where('description', 'LIKE', "%{$request->description}%");
            }

            $product = $product->paginate();

            return response()->json($product, 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na pesquisa dos produtos!'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreProductRequest $request
     * @return \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $product = Product::create($request->all());

            return response()->json($product, 201);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na criação do produto!'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param  \Illuminate\Http\UpdateProductRequest $request
     * @return \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateProductRequest $request)
    {
        try {
            $product = Product::findOrFail($id);
            $product->update($request->all());

            return response()->json($product, 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na edição do produto!'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return response()->json(['msg' => 'Produto excluído com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na exclusão do produto!'], 500);
        }
    }

    /**
     * Force remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDestroy($id)
    {
        try {
            $product = Product::withTrashed()->findOrFail($id);
            $product->forceDelete();

            return response()->json(['msg' => 'Produto excluído (force) com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na exclusão (force) do produto!'], 500);
        }
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        try {
            $product = Product::onlyTrashed()->findOrFail($id);
            $product->restore();

            return response()->json(['msg' => 'Produto restaurado com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na restauração do produto!'], 500);
        }
    }
}
