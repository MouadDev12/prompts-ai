@extends('layouts.app')

@section('content')
<div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
    <div class="flex flex-col gap-6 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Détails du prompt</h1>
            <p class="mt-2 text-sm text-gray-600">Affiche toutes les informations liées à ce prompt.</p>
        </div>
        <div class="flex flex-col gap-3 sm:flex-row">
            <a href="{{ route('prompts.edit', $prompt) }}" class="rounded-md bg-yellow-500 px-4 py-2 text-sm font-medium text-white hover:bg-yellow-600">Modifier</a>
            <a href="{{ route('prompts.index') }}" class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Retour</a>
        </div>
    </div>

    <div class="mt-6 grid gap-6 sm:grid-cols-2">
        <div class="space-y-3 rounded-2xl bg-gray-50 p-5">
            <h2 class="text-sm font-semibold uppercase tracking-wide text-gray-500">Titre</h2>
            <p class="text-lg font-semibold text-gray-900">{{ $prompt->titre }}</p>
        </div>

        <div class="space-y-3 rounded-2xl bg-gray-50 p-5">
            <h2 class="text-sm font-semibold uppercase tracking-wide text-gray-500">Famille</h2>
            <p class="text-lg text-gray-900">{{ $prompt->famille?->titre ?? 'Aucune famille' }} ({{ $prompt->famille?->type ?? '-' }})</p>
        </div>
    </div>

    <div class="mt-6 grid gap-6 sm:grid-cols-2">
        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200">
            <h3 class="text-sm font-semibold text-gray-500">Description</h3>
            <p class="mt-3 text-gray-700 whitespace-pre-line">{{ $prompt->description }}</p>
        </div>
        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200">
            <h3 class="text-sm font-semibold text-gray-500">Prompt Text</h3>
            <pre class="mt-3 whitespace-pre-wrap break-words text-gray-700">{{ $prompt->prompt_text }}</pre>
        </div>
    </div>
</div>
@endsection
