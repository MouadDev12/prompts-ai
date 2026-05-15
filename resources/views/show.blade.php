@extends('layouts.app')

@section('content')
<div class="space-y-6">

    {{-- En-tête --}}
    <div class="flex flex-col gap-4 rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <div class="flex items-center gap-2">
                <a href="{{ route('prompts.index') }}" class="text-sm text-gray-400 hover:text-gray-600 transition-colors">Prompts</a>
                <span class="text-gray-300">/</span>
                <span class="text-sm text-gray-600">{{ Str::limit($prompt->titre, 40) }}</span>
            </div>
            <h1 class="mt-2 text-2xl font-semibold text-gray-900">{{ $prompt->titre }}</h1>
            <span class="mt-2 inline-flex items-center rounded-full bg-indigo-50 px-3 py-1 text-xs font-medium text-indigo-700">
                {{ $prompt->famille?->titre ?? 'Sans famille' }} — {{ $prompt->famille?->type ?? '-' }}
            </span>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('prompts.edit', $prompt) }}"
               class="inline-flex items-center gap-1.5 rounded-xl bg-amber-500 px-4 py-2 text-sm font-medium text-white hover:bg-amber-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2v-5m-1.414-9.414a2 2 0 1 1 2.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Modifier
            </a>
            <form action="{{ route('prompts.destroy', $prompt) }}" method="POST" class="inline"
                  onsubmit="return confirm('Supprimer ce prompt définitivement ?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center gap-1.5 rounded-xl bg-red-100 px-4 py-2 text-sm font-medium text-red-700 hover:bg-red-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0 1 16.138 21H7.862a2 2 0 0 1-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v3M4 7h16"/>
                    </svg>
                    Supprimer
                </button>
            </form>
            <a href="{{ route('prompts.index') }}"
               class="inline-flex items-center rounded-xl border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                ← Retour
            </a>
        </div>
    </div>

    {{-- Notification succès --}}
    @if(session('success'))
        <div class="flex items-center gap-3 rounded-2xl border border-green-200 bg-green-50 px-6 py-4 text-sm text-green-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Infos --}}
    <div class="grid gap-6 sm:grid-cols-2">
        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200">
            <h3 class="text-xs font-semibold uppercase tracking-wide text-gray-400">Description</h3>
            <p class="mt-3 whitespace-pre-line text-gray-700 leading-relaxed">{{ $prompt->description }}</p>
        </div>
        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200">
            <h3 class="text-xs font-semibold uppercase tracking-wide text-gray-400">Métadonnées</h3>
            <dl class="mt-3 space-y-2 text-sm">
                <div class="flex justify-between">
                    <dt class="text-gray-500">Famille</dt>
                    <dd class="font-medium text-gray-900">{{ $prompt->famille?->titre ?? '-' }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-gray-500">Type</dt>
                    <dd class="font-medium text-gray-900">{{ $prompt->famille?->type ?? '-' }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-gray-500">Créé le</dt>
                    <dd class="font-medium text-gray-900">{{ $prompt->created_at->format('d/m/Y à H:i') }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-gray-500">Modifié le</dt>
                    <dd class="font-medium text-gray-900">{{ $prompt->updated_at->format('d/m/Y à H:i') }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-gray-500">Longueur du prompt</dt>
                    <dd class="font-medium text-gray-900">{{ strlen($prompt->prompt_text) }} caractères</dd>
                </div>
            </dl>
        </div>
    </div>

    {{-- Prompt Text avec bouton copier --}}
    <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">
        <div class="flex items-center justify-between border-b border-gray-100 px-5 py-3">
            <h3 class="text-sm font-semibold text-gray-700">Prompt Text</h3>
            <button id="copyBtn" onclick="copyPrompt()"
                    class="inline-flex items-center gap-1.5 rounded-lg bg-gray-100 px-3 py-1.5 text-xs font-medium text-gray-600 hover:bg-gray-200 transition-colors">
                <svg id="copyIcon" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2m-6 12h8a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-8a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2z"/>
                </svg>
                <span id="copyLabel">Copier</span>
            </button>
        </div>
        <pre id="promptText" class="overflow-x-auto whitespace-pre-wrap break-words p-5 text-sm text-gray-700 font-mono leading-relaxed">{{ $prompt->prompt_text }}</pre>
    </div>

</div>

<script>
function copyPrompt() {
    const text = document.getElementById('promptText').innerText;
    navigator.clipboard.writeText(text).then(() => {
        const label = document.getElementById('copyLabel');
        const icon  = document.getElementById('copyIcon');
        label.textContent = 'Copié !';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>';
        setTimeout(() => {
            label.textContent = 'Copier';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2m-6 12h8a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-8a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2z"/>';
        }, 2000);
    });
}
</script>
@endsection
