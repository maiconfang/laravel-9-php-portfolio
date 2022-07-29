<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\About;
use App\Models\AboutItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except'=>['index']]);
    }

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
       $aboutItens = AboutItem::paginate(20);

      $aboutMe =  DB::table('aboutitens')
      ->select(['aboutitens.text'])
      ->join('abouts', 'abouts.id', '=', 'aboutitens.about_id')
      ->where('abouts.title', 'like', '%' . 'About Me' . '%')
      ->get();

       echo("<script>console.log('PHP: " . $aboutMe . "');</script>");

       echo("<script>console.log('PHP: " . $aboutItens . "');</script>");

    return view('welcome')->with('aboutMe', $aboutMe);
    }
}
