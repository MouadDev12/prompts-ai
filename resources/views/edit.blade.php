@extends('layouts.app')

@section('content')
<div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200">

    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Modifier le prompt</h1>
            <p class="mt-1 text-sm text-gray-500">Mettez à jour le prompt existant et sa famille.</p>
        </div>
        <a href="{{ route('prompts.show', $prompt) }}"
           class="inline-flex items-center rounded-2xl border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
            ← Retour au détail
        </a>
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

    <form action="{{ route('prompts.update', $prompt) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Titre --}}
        <div>
            <label for="titre" class="mb-2 block text-sm font-medium text-gray-700">
                Titre <span class="text-red-500">*</span>
            </label>
            <input type="text" name="titre" id="titre" value="{{ old('titre', $prompt->titre) }}"
                   class="w-full rounded-2xl border @error('titre') border-red-400 bg-red-50 @else border-gray-300 bg-white @enderror px-4 py-3 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition" />
            @error('titre')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div>
            <div class="mb-2 flex items-center justify-between">
                <label for="description" class="text-sm font-medium text-gray-700">
                    Description <span class="text-red-500">*</span>
                </label>
                <span id="desc-count" class="text-xs text-gray-400">0 caractère(s)</span>
            </div>
            <textarea name="description" id="description" rows="4"
                      oninput="updateCount('description','desc-count')"
                      class="w-full rounded-2xl border @error('description') border-red-400 bg-red-50 @else border-gray-300 bg-white @enderror px-4 py-3 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">{{ old('description', $prompt->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Prompt Text --}}
        <div>
            <div class="mb-2 flex items-center justify-between">
                <label for="prompt_text" class="text-sm font-medium text-gray-700">
                    Prompt Text <span class="text-red-500">*</span>
                </label>
                <span id="prompt-count" class="text-xs text-gray-400">0 caractère(s)</span>
            </div>
            <textarea name="prompt_text" id="prompt_text" rows="7"
                      oninput="updateCount('prompt_text','prompt-count')"
                      class="w-full rounded-2xl border @error('prompt_text') border-red-400 bg-red-50 @else border-gray-300 bg-white @enderror px-4 py-3 font-mono text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">{{ old('prompt_text', $prompt->prompt_text) }}</textarea>
            @error('prompt_text')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Famille --}}
        <div>
            <label for="famille_id" class="mb-2 block text-sm font-medium text-gray-700">
                Famille <span class="text-red-500">*</span>
            </label>
            <select name="famille_id" id="famille_id"
                    class="w-full rounded-2xl border @error('famille_id') border-red-400 bg-red-50 @else border-gray-300 bg-white @enderror px-4 py-3 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">
                @foreach ($familles as $famille)
                    <option value="{{ $famille->id }}" @selected(old('famille_id', $prompt->famille_id) == $famille->id)>
                        {{ $famille->titre }} ({{ $famille->type }})
                    </option>
                @endforeach
            </select>
            @error('famille_id')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Actions --}}
        <div class="flex flex-col gap-3 border-t border-gray-100 pt-4 sm:flex-row sm:items-center">
            <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Enregistrer les modifications
            </button>
            <a href="{{ route('prompts.show', $prompt) }}"
               class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-6 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
                Annuler
            </a>
        </div>
    </form>
</div>

<script>
function updateCount(fieldId, countId) {
    const len = document.getElementById(fieldId).value.length;
    document.getElementById(countId).textContent = len + ' caractère' + (len > 1 ? 's' : '');
}
document.addEventListener('DOMContentLoaded', () => {
    updateCount('description', 'desc-count');
    updateCount('prompt_text', 'prompt-count');
});
</script>
@endsection
