<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

use App\Http\Requests\DiscountRequests\StoreDiscountRequest;
use App\Http\Requests\DiscountRequests\UpdateDiscountRequest;

class DiscountController extends Controller
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
            $discount = new Discount;

            if ($request->has('trashed') && !(is_null($request->trashed))) {
                if ($request->trashed == 0) {
                    $discount = $discount->withTrashed();
                } elseif ($request->trashed == 1) {
                    $discount = $discount->onlyTrashed();
                }
            }

            $discount = $discount->find($id);

            return response()->json($discount, 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro ao buscar o desconto!'], 500);
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
            $discount = new Discount;

            if ($request->has('trashed') && !(is_null($request->trashed))) {
                if ($request->trashed == 0) {
                    $discount = $discount->withTrashed();
                } elseif ($request->trashed == 1) {
                    $discount = $discount->onlyTrashed();
                }
            }

            if ($request->has('name') && !(is_null($request->name))) {
                $discount = $discount->where('name', 'LIKE', "%{$request->name}%");
            }

            if ($request->has('description') && !(is_null($request->description))) {
                $discount = $discount->where('description', 'LIKE', "%{$request->description}%");
            }

            $discount = $discount->paginate();

            return response()->json($discount, 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na pesquisa dos descontos!'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreDiscountRequest $request
     * @return \App\Models\Discount $discount
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiscountRequest $request)
    {
        try {
            $discount = Discount::create($request->all());

            return response()->json($discount, 201);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na criação do desconto!'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param  \Illuminate\Http\UpdateDiscountRequest $request
     * @return \App\Models\Discount $Discount
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateDiscountRequest $request)
    {
        try {
            $discount = Discount::findOrFail($id);
            $discount->update($request->all());

            return response()->json($discount, 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na edição do desconto!'], 500);
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
            $discount = Discount::findOrFail($id);
            $discount->delete();

            return response()->json(['msg' => 'Desconto excluído com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na exclusão do desconto!'], 500);
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
            $discount = Discount::withTrashed()->findOrFail($id);
            $discount->forceDelete();

            return response()->json(['msg' => 'Desconto excluído (force) com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na exclusão (force) do desconto!'], 500);
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
            $discount = Discount::onlyTrashed()->findOrFail($id);
            $discount->restore();

            return response()->json(['msg' => 'Desconto restaurado com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na restauração do desconto!'], 500);
        }
    }
}
