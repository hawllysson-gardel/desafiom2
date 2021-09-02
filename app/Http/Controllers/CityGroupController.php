<?php

namespace App\Http\Controllers;

use App\Models\CityGroup;
use Illuminate\Http\Request;

use App\Http\Requests\CityGroupRequests\StoreCityGroupRequest;
use App\Http\Requests\CityGroupRequests\UpdateCityGroupRequest;

class CityGroupController extends Controller
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
            $cityGroup = new CityGroup;

            if ($request->has('trashed') && !(is_null($request->trashed))) {
                if ($request->trashed == 0) {
                    $cityGroup = $cityGroup->withTrashed();
                } elseif ($request->trashed == 1) {
                    $cityGroup = $cityGroup->onlyTrashed();
                }
            }

            $cityGroup = $cityGroup->find($id);

            return response()->json($cityGroup, 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro ao buscar o grupo de cidades!'], 500);
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
            $cityGroup = new CityGroup;

            if ($request->has('trashed') && !(is_null($request->trashed))) {
                if ($request->trashed == 0) {
                    $cityGroup = $cityGroup->withTrashed();
                } elseif ($request->trashed == 1) {
                    $cityGroup = $cityGroup->onlyTrashed();
                }
            }

            if ($request->has('name') && !(is_null($request->name))) {
                $cityGroup = $cityGroup->where('name', 'LIKE', "%{$request->name}%");
            }

            if ($request->has('description') && !(is_null($request->description))) {
                $cityGroup = $cityGroup->where('description', 'LIKE', "%{$request->description}%");
            }

            $cityGroup = $cityGroup->paginate();

            return response()->json($cityGroup, 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na pesquisa dos grupos das cidades!'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreCityGroupRequest $request
     * @return \App\Models\CityGroup $cityGroup
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCityGroupRequest $request)
    {
        try {
            $cityGroup = CityGroup::create($request->all());

            return response()->json($cityGroup, 201);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na criação do grupo de cidades!'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param  \Illuminate\Http\UpdateCityGroupRequest $request
     * @return \App\Models\CityGroup $cityGroup
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateCityGroupRequest $request)
    {
        try {
            $cityGroup = CityGroup::findOrFail($id);
            $cityGroup->update($request->all());

            return response()->json($cityGroup, 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na edição do grupo de cidades!'], 500);
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
            $cityGroup = CityGroup::findOrFail($id);
            $cityGroup->delete();

            return response()->json(['msg' => 'Grupo de cidades excluído com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na exclusão do grupo de cidades!'], 500);
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
            $cityGroup = CityGroup::withTrashed()->findOrFail($id);
            $cityGroup->forceDelete();

            return response()->json(['msg' => 'Grupo de cidades excluído (force) com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na exclusão (force) do grupo de cidades!'], 500);
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
            $cityGroup = CityGroup::onlyTrashed()->findOrFail($id);
            $cityGroup->restore();

            return response()->json(['msg' => 'Grupo de cidades restaurado com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na restauração do grupo de cidades!'], 500);
        }
    }
}
