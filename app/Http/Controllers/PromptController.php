<?php

namespace App\Http\Controllers;

use App\Models\Famille;
use App\Models\Prompt;
use Illuminate\Http\Request;

class PromptController extends Controller
{
    public function index(Request $request)
    {
        $query = Prompt::with('famille')->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('prompt_text', 'like', "%{$search}%");
            });
        }

        if ($request->filled('famille_id')) {
            $query->where('famille_id', $request->famille_id);
        }

        $prompts  = $query->paginate(9)->withQueryString();
        $familles = Famille::orderBy('titre')->get();

        return view('index', compact('prompts', 'familles'));
    }

    public function create()
    {
        $familles = Famille::orderBy('titre')->get();

        return view('create', compact('familles'));
    }

    public function store(Request $request)
    {
        $data = $this->validatePrompt($request);

        Prompt::create($data);

        return redirect()->route('prompts.index')
                         ->with('success', 'Prompt ajouté avec succès !');
    }

    public function show(Prompt $prompt)
    {
        $prompt->load('famille');

        return view('show', compact('prompt'));
    }

    public function edit(Prompt $prompt)
    {
        $familles = Famille::orderBy('titre')->get();

        return view('edit', compact('prompt', 'familles'));
    }

    public function update(Request $request, Prompt $prompt)
    {
        $data = $this->validatePrompt($request);

        $prompt->update($data);

        return redirect()->route('prompts.index')
                         ->with('success', 'Prompt mis à jour avec succès !');
    }

    public function destroy(Prompt $prompt)
    {
        $prompt->delete();

        return redirect()->route('prompts.index')
                         ->with('success', 'Prompt supprimé avec succès !');
    }

    protected function validatePrompt(Request $request): array
    {
        return $request->validate([
            'titre'       => 'required|string|max:255',
            'description' => 'required|string',
            'prompt_text' => 'required|string',
            'famille_id'  => 'required|exists:familles,id',
        ]);
    }
}
