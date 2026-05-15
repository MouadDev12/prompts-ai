<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prompts = Prompt::with('famille')->paginate(9);
        return view('index', compact('prompts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $famille = Famille::all();
        return view ('create', compact('familles'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre'       => 'required',
            'description' => 'required',
            'prompt_text' => 'required',
            'famille_id'  => 'required',
        ]);

        Prompt::create($request->all());

        return redirect()->route('prompts.index')
                         ->with('success', 'Prompt ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prompt $prompt)
    {
        $prompt->delete();
        return redirect()->route('prompts.index')
                         ->with('success', 'Prompt supprimé avec succès !');
    }
    
