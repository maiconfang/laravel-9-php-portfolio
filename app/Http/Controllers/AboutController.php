<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $abouts = About::where('user_id', Auth::id())->latest('updated_at')->paginate(5);
        // $abouts = Auth::user()->abouts()->latest('updated_at')->paginate(5);
        $abouts = About::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(5);
        return view('abouts.index')->with('abouts', $abouts);
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
            'title' => 'required|max:120'
        ]);

        Auth::user()->abouts()->create([
            'uuid' => Str::uuid(),
            'title' => $request->title
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
            'title' => 'required|max:120'
        ]);

        $about->update([
            'title' => $request->title
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
}
