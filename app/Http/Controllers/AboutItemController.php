<?php

namespace App\Http\Controllers;

use App\Models\AboutItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aboutItens = AboutItem::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(5);
        return view('aboutItens.index')->with('aboutItens', $aboutItens);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aboutItens.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo("<script>console.log('PHP - Maicon Fang: " . $request . "');</script>");
        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);

        Auth::user()->aboutItens()->create([
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'text' => $request->text
        ]);
        return to_route('aboutItens.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AboutItem $aboutIten)
    {
        if(!$aboutIten->user->is(Auth::user())) {
            return abort(403);
        }

        return view('aboutItens.show')->with('aboutIten', $aboutIten);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AboutItem $aboutIten)
    {
        if(!$aboutIten->user->is(Auth::user())) {
            return abort(403);
        }

        return view('aboutItens.edit')->with('aboutIten', $aboutIten);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AboutItem $aboutIten)
    {
        if(!$aboutIten->user->is(Auth::user())) {
            return abort(403);
        }

        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);

        $aboutIten->update([
            'title' => $request->title,
            'text' => $request->text
        ]);
        
        return to_route('aboutItens.show', $aboutIten)->with('success','About Itens updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AboutItem $aboutIten)
    {
        if(!$aboutIten->user->is(Auth::user())) {
            return abort(403);
        }

        $aboutIten->delete();

        return to_route('aboutItens.index')->with('success', 'About Itens deleted successfully');
    }
}
