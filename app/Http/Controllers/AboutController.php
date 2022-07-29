<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Note;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except'=>['publicMethod']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $abouts = About::where('user_id', Auth::id())->latest('updated_at')->paginate(5);
        // $abouts = Auth::user()->abouts()->latest('updated_at')->paginate(5);
      
     //   $abouts = About::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(5);
     //   return view('abouts.index')->with('abouts', $abouts);

        $abouts = About::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(5);
        return view('abouts.index')->with('abouts', $abouts);

    //    $notes = Note::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(5);
    //    return view('notes.index')->with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('abouts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);

        Auth::user()->abouts()->create([
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'text' => $request->text
        ]);
        return to_route('abouts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        if(!$about->user->is(Auth::user())) {
            return abort(403);
        }

        return view('abouts.show')->with('about', $about);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        if(!$about->user->is(Auth::user())) {
            return abort(403);
        }

        return view('abouts.edit')->with('about', $about);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        if(!$about->user->is(Auth::user())) {
            return abort(403);
        }

        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);

        $about->update([
            'title' => $request->title,
            'text' => $request->text
        ]);
        
        return to_route('abouts.show', $about)->with('success','About updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        if(!$about->user->is(Auth::user())) {
            return abort(403);
        }

        $about->delete();

        return to_route('abouts.index')->with('success', 'About deleted successfully');
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicMethod()
    {
        echo("<script>console.log('PHP - Maicon Fang: public function indexPublic ');</script>");
        // $notes = Note::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(5);
       //  $notes = Note::latest()->limit(5)->get();
       //$notes = Note::latest('updated_at')->paginate(1);
       // $notes = Note::selectRaw('id', 'uuid', 'user_id', 'title', 'text', 'created_at', 'updated_at')->paginate(2);

       $abouts = About::paginate(20); //1 page with 10 products

       //echo("<script>console.log('PHP: " . $notes . "');</script>");
   //   echo '<pre>'; print_r($notes); echo '</pre>';
    //   foreach($notes['data'] as $result) {
        //echo $result['id'], '<br>';
    //    echo '<pre>'; print_r($result); echo '</pre>';
    //}

//        foreach($notes as $value){
//            echo $value."<br />"."<br />"."<br />";
//        }
        //$this->middleware('auth')->except("publicMethod");
 //       $this->middleware('auth', ['except' => ['publicMethod']]);

        return view('abouts.public')->with('abouts', $abouts);
    }
}
