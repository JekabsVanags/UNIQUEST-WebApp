<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Level;
use App\Models\User;
use App\Models\Location;
use App\Models\History;
use App\Models\Comment;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        if(auth()->user())
        {
            $top3levels = Level::orderBy('id', 'desc')->where('id','!=',auth()->user()->level_id)->where('isPublic','==',0)->take(3)->get();
            $curlevel = NULL;
            $curlevel = Level::find(auth()->user()->level_id);
        }
        else
        {
            $curlevel = NULL;
            $top3levels = Level::orderBy('id', 'desc')->where('isPublic',0)->take(3)->get();
        }
        return view('levelindex',compact('top3levels'),compact('curlevel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user())
        {
            $json = asset('/countries.json');
            $countries = json_decode(file_get_contents($json));
            $userLoc = Location::all()->where('user_id', auth()->user()->id);
            return view('newlevel',compact('userLoc'),compact('countries'));
        }
       else
       {
            return  view('dashboard');
       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->image;
        $filename = time().'.jpg';
        $file->move('images',$filename);

        $newlevel = new Level();
        $newlevel->title = $request->title;
        $newlevel->coverImage = $filename;
        $newlevel->description = $request->description;
        $newlevel->rating = $request->rating;
        if($request->isPublic == 'on')
        {
            $newlevel->isPublic = 1;
        }
        else
        {
            $newlevel->isPublic = 0;
        }
        $newlevel->dificulty = $request->diff;
        $newlevel->user_id = auth()->user()->id;
        $newlevel->location_id = $request->loc;
        $newlevel->level_id = $request->nextlvl;
        $newlevel->save();
        echo("<script>window.location = 'http://localhost/uniquest/public/';</script>");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comments = Comment::select('*',\DB::raw("comments.id as comid"))->where('comments.level_id',$id)->where('finishedcomment',0)->join('users','comments.user_id', '=', 'users.id')->get();
        $level = Level::findorfail($id);
        //Check if the user is authenticated
        if(auth()->user())
        {
            //Check if the user is attempting the current level and retrieve location data
            if($id == auth()->user()->level_id)
            {
                $location = Location::findorfail($level->location_id);
                echo("LevelActive");
                return view('levelactive',compact('level'),compact('location'))->with(compact('comments'));
            }

            //Otherwise we check if the level has been beaten
            $completed = History::all()->where('user_id', auth()->user()->id);
            foreach($completed as $leveltocheck)
            {
                    if($leveltocheck->level_id == $level->id)
                    {
                        $comments = Comment::all()->where('level_id',$id);
                        return view('levelcompleted',compact('level'),compact('comments'));
                    }
            }
        }
        return view('level',compact('level'),compact('comments'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $level = Level::findorfail($id);
        if(auth()->user())
        {
            if(auth()->user()->id == $level->user_id or auth()->user()->role == 'admin')
            {
                $level->delete();
                $top3levels = Level::orderBy('id', 'desc')->where('id','!=',auth()->user()->level_id)->take(3)->get();
                $curlevel = NULL;
                $curlevel = Level::find(auth()->user()->level_id);
                return redirect('/');
            }
        }
         return abort(401);
        
    }

    public function getPlayerLevels()
    {
        if(auth()->user())
        {
        $levels = Level::all()->where('user_id',auth()->user()->id);
        return view('dashboard',compact('levels'));
        }
        else
        {
         return view('dashboard');
        }
}
    public function searchLevels(Request $request)
    {
        
        $query = Level::select('*',\DB::raw("levels.id as id"))->where('isPublic',0)->join('locations','levels.location_id', '=', 'locations.id');
        if($request->searchcountry != NULL)
        {
            $query = $query->where('locations.country',$request->searchcountry);
        }
        if($request->searchdiff != NULL)
        {
            $query = $query->where('levels.dificulty', $request->searchdiff);
        }
        if($request->searchname != NULL)
        {
            $query = $query->where('levels.title', 'LIKE', $request->searchname.'%');
        }
    
        $top3levels = $query->get();

        if(auth()->user())
        {
            $curlevel = NULL;
            $curlevel = Level::find(auth()->user()->level_id);
        }
        else
        {
            $curlevel = NULL;
        }
       

        return view('levelindex',compact('top3levels'),compact('curlevel'));
    }
}
