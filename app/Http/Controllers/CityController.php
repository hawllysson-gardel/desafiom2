<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

use App\Http\Requests\CityRequests\StoreCityRequest;
use App\Http\Requests\CityRequests\UpdateCityRequest;

class CityController extends Controller
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
            $city = new City;

            if ($request->has('trashed') && !(is_null($request->trashed))) {
                if ($request->trashed == 0) {
                    $city = $city->withTrashed();
                } elseif ($request->trashed == 1) {
                    $city = $city->onlyTrashed();
                }
            }

            $city = $city->find($id);

            return response()->json($city, 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro ao buscar a cidade!'], 500);
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
            $city = new City;

            if ($request->has('trashed') && !(is_null($request->trashed))) {
                if ($request->trashed == 0) {
                    $city = $city->withTrashed();
                } elseif ($request->trashed == 1) {
                    $city = $city->onlyTrashed();
                }
            }

            if ($request->has('name') && !(is_null($request->name))) {
                $city = $city->where('name', 'LIKE', "%{$request->name}%");
            }

            if ($request->has('city_group_id')) {
                $city = $city->whereIn('city_group_id', $request->city_group_id);
            }

            $city = $city->paginate();

            return response()->json($city, 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na pesquisa das cidades!'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreCityRequest $request
     * @return \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCityRequest $request)
    {
        try {
            $city = City::create($request->all());

            return response()->json($city, 201);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na criação da cidade!'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param  \Illuminate\Http\UpdateCityRequest $request
     * @return \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateCityRequest $request)
    {
        try {
            $city = City::findOrFail($id);
            $city->update($request->all());

            return response()->json($city, 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na edição da cidade!'], 500);
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
            $city = City::findOrFail($id);
            $city->delete();

            return response()->json(['msg' => 'Cidade excluída com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na exclusão da cidade!'], 500);
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
            $city = City::withTrashed()->findOrFail($id);
            $city->forceDelete();

            return response()->json(['msg' => 'Cidade excluída (force) com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na exclusão (force) da cidade!'], 500);
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
            $city = City::onlyTrashed()->findOrFail($id);
            $city->restore();

            return response()->json(['msg' => 'Cidade restaurada com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na restauração da cidade!'], 500);
        }
    }
}
