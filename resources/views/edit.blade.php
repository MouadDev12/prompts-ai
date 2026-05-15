@extends('layouts.app')

@section('content')
<div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
    <h1 class="text-2xl font-semibold text-gray-900">Modifier le prompt</h1>
    <p class="mt-2 text-sm text-gray-600">Mettez à jour le prompt existant et sa famille.</p>

    @if ($errors->any())
        <div class="mt-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <strong>Veuillez corriger les erreurs suivantes :</strong>
            <ul class="mt-2 list-disc space-y-1 pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('prompts.update', $prompt) }}" method="POST" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="titre" class="mb-2 block text-sm font-medium text-gray-700">Titre</label>
            <input type="text" name="titre" id="titre" value="{{ old('titre', $prompt->titre) }}" required class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100" />
        </div>

        <div>
            <label for="description" class="mb-2 block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" required class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">{{ old('description', $prompt->description) }}</textarea>
        </div>

        <div>
            <label for="prompt_text" class="mb-2 block text-sm font-medium text-gray-700">Prompt Text</label>
            <textarea name="prompt_text" id="prompt_text" rows="5" required class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">{{ old('prompt_text', $prompt->prompt_text) }}</textarea>
        </div>

        <div>
            <label for="famille_id" class="mb-2 block text-sm font-medium text-gray-700">Famille</label>
            <select name="famille_id" id="famille_id" required class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                @foreach ($familles as $famille)
                    <option value="{{ $famille->id }}" @selected(old('famille_id', $prompt->famille_id) == $famille->id)>{{ $famille->titre }} ({{ $famille->type }})</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">Enregistrer</button>
            <a href="{{ route('prompts.index') }}" class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-6 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50">Annuler</a>
        </div>
    </form>
</div>
@endsection
