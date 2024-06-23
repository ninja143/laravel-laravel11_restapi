<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Interfaces\PlayerRepositoryInterface;
use App\Classes\ApiResponseClass AS ResponseClass;
use App\Http\Resources\PlayerResource;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{
    private PlayerRepositoryInterface $playerRepositoryInterface;
    
    public function __construct(PlayerRepositoryInterface $playerRepositoryInterface)
    {
        $this->playerRepositoryInterface = $playerRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->playerRepositoryInterface->index();

        return ResponseClass::sendResponse(PlayerResource::collection($data),'',200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlayerRequest $request)
    {
        $details =[
            'name' => $request->name,
            'age' => $request->age,
            'points' => $request->points,
            'address' => $request->address
        ];
        DB::beginTransaction();
        try{
             $player = $this->playerRepositoryInterface->store($details);

             DB::commit();
             return ResponseClass::sendResponse(new PlayerResource($player),'Player Create Successful',201);

        }catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $player = $this->playerRepositoryInterface->getById($id);

        return ResponseClass::sendResponse(new PlayerResource($player),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlayerRequest $request, $id)
    {
        $updateDetails =[
            'name' => $request->name,
            'age' => $request->age,
            'points' => $request->points,
            'address' => $request->address
        ];
        DB::beginTransaction();
        try{
             $player = $this->playerRepositoryInterface->update($updateDetails,$id);

             DB::commit();
             return ResponseClass::sendResponse('Player Update Successful','',201);

        }catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if($this->playerRepositoryInterface->delete($id)){
            return ResponseClass::sendResponse('Player Delete Successful','',204);
        } else {
            return ResponseClass::sendResponse('Player Not Found','',204);
        }
    }
}
