{{-- resources/views/create.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajouter un nouveau prompt</h2>

    <form action="{{ route('prompts.store') }}" method="POST">
        @csrf

        {{-- Titre --}}
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" name="titre" id="titre"
                   class="form-control" required>
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description"
                      class="form-control" rows="3" required></textarea>
        </div>

        {{-- Prompt Text --}}
        <div class="mb-3">
            <label for="prompt_text" class="form-label">Prompt Text</label>
            <textarea name="prompt_text" id="prompt_text"
                      class="form-control" rows="4" required></textarea>
        </div>

        {{-- Famille (liste déroulante depuis $familles) --}}
        <div class="mb-3">
            <label for="famille_id" class="form-label">Famille</label>
            <select name="famille_id" id="famille_id"
                    class="form-control" required>
                @foreach($familles as $famille)
                    <option value="{{ $famille->id }}">
                        {{ $famille->titre }} ({{ $famille->type }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Boutons --}}
        <button type="submit" class="btn btn-success">Ajouter</button>
        <a href="{{ route('prompts.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection