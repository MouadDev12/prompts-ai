@extends('layouts.app')

@section('content')
<div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Ajouter un nouveau prompt</h1>
            <p class="mt-1 text-sm text-gray-500">Créez un prompt IA structuré avec sa famille associée.</p>
        </div>
        <a href="{{ route('prompts.index') }}" class="rounded-2xl border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Retour à la liste</a>
    </div>

    @if ($errors->any())
        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <strong>Veuillez corriger les erreurs suivantes :</strong>
            <ul class="mt-2 list-disc space-y-1 pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('prompts.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="titre" class="mb-2 block text-sm font-medium text-gray-700">Titre</label>
            <input type="text" name="titre" id="titre" value="{{ old('titre') }}" required class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100" />
        </div>

        <div>
            <label for="description" class="mb-2 block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" required class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="prompt_text" class="mb-2 block text-sm font-medium text-gray-700">Prompt Text</label>
            <textarea name="prompt_text" id="prompt_text" rows="5" required class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">{{ old('prompt_text') }}</textarea>
        </div>

        <div>
            <label for="famille_id" class="mb-2 block text-sm font-medium text-gray-700">Famille</label>
            <select name="famille_id" id="famille_id" required class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                <option value="">Sélectionnez une famille</option>
                @foreach($familles as $famille)
                    <option value="{{ $famille->id }}" @selected(old('famille_id') == $famille->id)>{{ $famille->titre }} ({{ $famille->type }})</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">Ajouter le prompt</button>
            <a href="{{ route('prompts.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50">Annuler</a>
        </div>
    </form>
</div>
@endsection