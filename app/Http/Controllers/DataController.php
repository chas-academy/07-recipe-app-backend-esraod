<?php

namespace App\Http\Controllers;


use App\Save;
use Illuminate\Http\Request;
use JWTAuth;

class DataController extends Controller
{
    private $currentUser;
    public function __construct()
    {
        $this->currentUser = JWTAuth::parseToken()->authenticate();
    }

    public function show()
    {
        $saves = $this->currentUser->saves()->get();
        return compact('saves');
    }

    public function store($id)
    {
        $save = new Save();
        $save->recipeID = $id;
    
        if ($this->currentUser->saves()->save($save)) {
            return Response::json(['success' => true]);
        }

        else {
            return Response::json(['error' => 'could_not_create_save'], 500);
        }
    }

    public function check($id)
    {
        $save = $this->currentUser->saves()->where('recipeID', $id);
    
        if (!$save->count()) {
            return Response::json(['saved' => false]);
        } else if ($save->count()) {
            return Response::json(['saved' => true]);
        } else {
            return Response::json(['message' => 'could_not_check_save'], 500);
        }
    }

    public function delete($id)
    {
        $save = $this->currentUser->saves()->where('recipeID', $id);
    
        if ($save->delete()) {
            return Response::json(['success' => true]);
        } else {
            return Response::json(['message' => 'could_not_delete_save'], 500);
        }
    }

}