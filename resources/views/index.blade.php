{{-- resources/views/index.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des Prompts IA</h2>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- a. Tableau des prompts (2pts) --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Prompt Text</th>
                <th>Famille</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prompts as $prompt)
            <tr>
                <td>{{ $prompt->id }}</td>
                <td>{{ $prompt->titre }}</td>
                <td>{{ $prompt->description }}</td>
                <td>{{ $prompt->prompt_text }}</td>
                <td>{{ $prompt->famille->titre ?? '-' }}</td>

                {{-- b. Actions : Voir, Modifier, Supprimer, Ajouter (2pts) --}}
                <td>
                    <a href="{{ route('prompts.show', $prompt->id) }}"
                       class="btn btn-info btn-sm">Voir</a>

                    <a href="{{ route('prompts.edit', $prompt->id) }}"
                       class="btn btn-warning btn-sm">Modifier</a>

                    {{-- c. Suppression (2pts) --}}
                    <form action="{{ route('prompts.destroy', $prompt->id) }}"
                          method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Confirmer la suppression ?')">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    {{ $prompts->links() }}

    {{-- Bouton Ajouter --}}
    <a href="{{ route('prompts.create') }}" class="btn btn-primary">Ajouter</a>
</div>
@endsection