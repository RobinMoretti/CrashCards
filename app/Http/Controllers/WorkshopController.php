<?php

namespace App\Http\Controllers;

use App\Deck;
use App\User;
use App\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class WorkshopController extends Controller
{

    public function destroy(Request $request, Workshop $workshop)
    {
        if ($request->ajax() && Auth::check()) {
            $user = Auth::user();

            if($workshop->author->id == $user->id){
                $workshop->delete();
                return $workshop->id;
            }else{
                return 'false';
            }
        }else{
                return 'false';
        }
    }


    public function get(Request $request, Workshop $workshop)
    {
        if ($request->ajax()) {
            $user = Auth::user();

            $workshop->load('author');
            $workshop->load('deck');

            // $data->workshop = $workshop;

            $availableDecks = Deck::where('user_id', Auth::user()->id)->get();
            // $data->availableDecks = $availableDecks;

            $connectedUser = $user;
            $userIsAuthor = false;

            if(Auth::check()){
                if(Auth::user()->id == $workshop->author->id){
                    $userIsAuthor = true;
                }
            }

            $teams = $workshop->teams;

            $particpants = $workshop->participants;

            $data = collect(["workshop" => $workshop, "availableDecks" => $availableDecks, "connectedUser" => $connectedUser, "userIsAuthor" => $userIsAuthor, "teams" => $teams, "particpants" => $particpants ]);
            // dd($data);
            return $data;
        }
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        $workshop = new Workshop();
        $workshop->save();
        $workshop->author()->associate($user);
        $workshop->sharable_link = str_random(10);
        $workshop->save();

        return redirect()->route('workshop-entry', compact('workshop')); 
    }


    public function index()
    {
        $workshops = Workshop::all();

        $currentWorkshop = $this->getWorkshopState(Workshop::first());

        return view('home', compact('workshops', 'currentWorkshop'));
    }

    public function indexWorkshops()
    {
        $workshops = Workshop::all();
        $workshops->load('author');

        return view('workshops-manager', compact('workshops'));
    }



    public function indexWorkshop(Workshop $workshop, Request $request)
    {

        if(Auth::check()){
            //if user connected

            $user = Auth::user();
            $decks = Deck::all();

            if($workshop->author->id == $user->id){ 
                // is author of workshop
                return view('workshop-entry', compact('workshop', 'decks'));
            }else{ 
                $userIsParticipant = $workshop->participants->contains($user->id);

                if($userIsParticipant){
                    return view('workshop-entry', compact('workshop', 'decks'));
                }else{
                    // return view('workshop-join', compact('workshop'));
                    // return redirect()->route('workshop-join');
                    if($workshop->public){
                        return view('workshop-entry', compact('workshop', 'decks'));
                    }else{
                        abort(404);
                    }
                }

            }
        }
    }

    public function updateWorkshop(Workshop $workshop, Request $request){

        if ($request->ajax()) {

            $request->validate([
                '_data' => 'required',
            ]);

            $newWorkshop = $request->_data;

            $user = Auth::user();

            // dump($newWorkshop);

            if($workshop->author->id == $user->id){
                $workshop->name = $newWorkshop["name"];
                $workshop->description = $newWorkshop["description"];
                $workshop->start_date = $newWorkshop["start_date"];
                $workshop->end_date = $newWorkshop["end_date"];
                $workshop->private = $newWorkshop["private"];
                $workshop->public = $newWorkshop["public"];
                $workshop->locked = $newWorkshop["locked"];
                $workshop->deck_id = $newWorkshop["deck_id"];
                $workshop->save();

                return 'true';
            }else{
                return 'false';
            }
        }
    }


    function getWorkshopState(){
        if(count(Workshop::all())){
            $workshops = Workshop::all()
                        ->first()
                        ->load('deck.categories', 'deck.cards');
        }
        else
            $workshops = null;

    	return $workshops;
    }

    public function updateWorkshopImage(Request $request, Workshop $workshop)
    {        
            // logger(dump($request->file));

            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:100000',
            ]);


            $path = URL::to('/') . '/' . $request->file('file')->store('public/workshops/'.$workshop->id);

            $workshop->image_header = $path;
            $workshop->save();

            return $path;
    }

    public function setDeck(Request $request, Workshop $workshop)
    {
        if ($request->ajax()) {

            $request->validate([
                '_data' => 'required|numeric',
            ]);

            $deck = Deck::find($request->_data);

            $workshop->deck()->associate($deck);
            $workshop->save();

            return $deck;
        }
    }

    
    public function tryJoinWorkshop(Request $request, String $joinCode = "")
    {   
        $workshop = Workshop::where('sharable_link', $joinCode)->first();
        if(isset($workshop)){
            //join woirkshop
            return view('workshop-join', compact('workshop', 'joinCode') );
        }
        else{
            abort(404);
        }
    }

    public function joinWorkshop(Request $request, String $joinCode = "")
    {
        $workshop = Workshop::where('sharable_link', $joinCode)->first();
        if(isset($workshop)){
            if(Auth::check()){
                $workshop->participants()->attach(Auth::user());
                $workshop->save();

                return redirect()->route('workshop-entry', compact('workshop'));
            }else{
                abort(404);
            }
        }
        else{
            abort(404);
        }
    }
}
