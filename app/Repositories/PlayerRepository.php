<?php

namespace App\Repositories;
use App\Models\Player;
use App\Interfaces\PlayerRepositoryInterface;

class PlayerRepository implements PlayerRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        // 
    }

    public function index(){
        return Player::all();
    }

    public function getById($id){
       return Player::findOrFail($id);
    }

    public function store(array $data){
       return Player::create($data);
    }

    public function update(array $data,$id){
       return Player::whereId($id)->update($data);
    }
    
    public function delete($id){
      if (Player::where('id', '=', $id)->exists()) {
         Player::destroy($id);
         return true;
      } else {
         return false;
      }
         
    }
}
