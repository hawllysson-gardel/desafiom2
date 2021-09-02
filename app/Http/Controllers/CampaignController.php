<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

use App\Http\Requests\State\StoreCampaignRequest;
use App\Http\Requests\State\UpdateCampaignRequest;

class CampaignController extends Controller
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
            $campaign = new Campaign;

            if ($request->has('trashed') && !(is_null($request->trashed))) {
                if ($request->trashed == 0) {
                    $campaign = $campaign->withTrashed();
                } elseif ($request->trashed == 1) {
                    $campaign = $campaign->onlyTrashed();
                }
            }

            $campaign = $campaign->find($id);

            return response()->json($campaign, 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro ao buscar a campanha!'], 500);
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
            $campaign = new Campaign;

            if ($request->has('trashed') && !(is_null($request->trashed))) {
                if ($request->trashed == 0) {
                    $campaign = $campaign->withTrashed();
                } elseif ($request->trashed == 1) {
                    $campaign = $campaign->onlyTrashed();
                }
            }

            if ($request->has('name') && !(is_null($request->name))) {
                $campaign = $campaign->where('name', 'LIKE', "%{$request->name}%");
            }

            if ($request->has('description') && !(is_null($request->description))) {
                $campaign = $campaign->where('description', 'LIKE', "%{$request->description}%");
            }

            $campaign = $campaign->paginate();

            return response()->json($campaign, 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na pesquisa das campanhas!'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreCampaignRequest $request
     * @return \App\Models\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCampaignRequest $request)
    {
        try {
            $campaign = Campaign::create($request->all());

            return response()->json($campaign, 201);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na criação da campanha!'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param  \Illuminate\Http\UpdateCampaignRequest $request
     * @return \App\Models\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateCampaignRequest $request)
    {
        try {
            $campaign = Campaign::findOrFail($id);
            $campaign->update($request->all());

            return response()->json($campaign, 200);
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
            $campaign = Campaign::findOrFail($id);
            $campaign->delete();

            return response()->json(['msg' => 'Campanha excluída com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na exclusão da campanha!'], 500);
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
            $campaign = Campaign::withTrashed()->findOrFail($id);
            $campaign->forceDelete();

            return response()->json(['msg' => 'Campanha excluída (force) com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na exclusão (force) da campanha!'], 500);
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
            $campaign = Campaign::onlyTrashed()->findOrFail($id);
            $campaign->restore();

            return response()->json(['msg' => 'Campanha restaurada com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'Erro na restauração da campanha!'], 500);
        }
    }
}
