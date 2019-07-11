<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;


use App\Deck;
use App\User;
use App\Workshop;
use App\Team;



class TeamController extends Controller
{
    public function createInWorkshop(Request $request, Workshop $workshop)
    {
    	if($request->ajax()){ 

    		$newTeam = new Team();
    		$user = Auth::user();

    		$create = false;

    		if($workshop->author->id == $user->id){
    			$create = true;
    		}else if(!$workshop->teams->contains($user)){
    			$create = true;
    			$newTeam->leader()->associate($user);
    		}

    		if($create){
    			$newTeam->workshop()->associate($workshop);
    			$newTeam->save();
    			return $newTeam;
    		}

    		return response()->json(['error' => "Can't create team"], 404);

    	}
    }

    public function readInWorkshop(Request $request, Workshop $workshop, Team $team)
    {
    	if($request->ajax()){

    	}
    }

    public function updateInWorkshop(Request $request, Workshop $workshop, Team $team)
    {
    	if($request->ajax()){
            if($workshop->author->id == Auth::user()->id || $team->players->contains(Auth::user())){
                // Team::destroy($team->id);
                $request->validate([
                    '_data' => 'required',
                    '_data.id' => 'required|numeric',
                ]);

                $team->name = $request->_data["name"];
                $team->save();

                return 'true';
            }
    	}

        return 'false';
    }

    public function deleteInWorkshop(Request $request, Workshop $workshop, Team $team)
    {
        // $team->leader->id == Auth::user()->id
        if($request->ajax()){
            if($workshop->author->id == Auth::user()->id){
                Team::destroy($team->id);
                return "true";
            }
        }

        return response()->json(['error' => "Can't delete team"], 404);
    }

    public function addPlayerToTeam(Request $request, Workshop $workshop, Team $team)
    {
        if($request->ajax()){
            if($workshop->author->id == Auth::user()->id){
                $request->validate([
                    '_data.username' => 'required',
                ]);

                if(isset($request->_data["id"])){
                    if($request->_data["id"] > 0){
                        $user = User::find($request->_data["id"]);
                        $user->teams()->attach($team);
                        $user->save();
                        return $user;
                    }
                }else{
                    $users = User::where('username', $request->_data["username"]);

                    //check if user with same username exist
                    if($users->count()){
                        $users->first();
                        //send an invitation
                        //add to participants
                        //add to team
                        return 'false';

                    }else{
                        $user = $team->players()->create([
                            'username' => $request->_data["username"],
                        ]);

                        return $user;
                    }
                }
                
                return 'false';
            }
        }

        return response()->json(['error' => "Can't delete team"], 404);
    }

    public function removePlayerToTeam(Request $request, Workshop $workshop, Team $team, User $player)
    {
        if($request->ajax()){
            if($workshop->author->id == Auth::user()->id){
                Team::destroy($team->id);
                return "true";
            }
        }

        return response()->json(['error' => "Can't delete team"], 404);
    }
}
