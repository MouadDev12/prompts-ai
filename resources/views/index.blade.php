@extends('layouts.app')

@section('content')
<div class="space-y-6">

    {{-- En-tête --}}
    <div class="flex flex-col gap-4 rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Prompts IA</h1>
            <p class="mt-1 text-sm text-gray-500">Liste paginée des prompts enregistrés et gestion des catégories.</p>
        </div>
        <a href="{{ route('prompts.create') }}"
           class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Ajouter un prompt
        </a>
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

    {{-- Barre de recherche + filtre --}}
    <form method="GET" action="{{ route('prompts.index') }}"
          class="flex flex-col gap-3 rounded-3xl bg-white p-4 shadow-sm ring-1 ring-gray-200 sm:flex-row sm:items-center">
        <div class="relative flex-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
            </svg>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Rechercher un prompt…"
                   class="w-full rounded-xl border border-gray-300 bg-white py-2.5 pl-9 pr-4 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100"/>
        </div>
        <select name="famille_id"
                class="rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
            <option value="">Toutes les familles</option>
            @foreach($familles as $famille)
                <option value="{{ $famille->id }}" @selected(request('famille_id') == $famille->id)>
                    {{ $famille->titre }} ({{ $famille->type }})
                </option>
            @endforeach
        </select>
        <button type="submit"
                class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700 transition-colors">
            Filtrer
        </button>
        @if(request('search') || request('famille_id'))
            <a href="{{ route('prompts.index') }}"
               class="rounded-xl border border-gray-200 px-4 py-2.5 text-sm text-gray-600 hover:bg-gray-50 transition-colors">
                Réinitialiser
            </a>
        @endif
    </form>

    {{-- Tableau --}}
    <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">#</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Titre</th>
                    <th class="hidden px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 md:table-cell">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Famille</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($prompts as $prompt)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-400">{{ $prompt->id }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $prompt->titre }}</td>
                        <td class="hidden px-6 py-4 text-sm text-gray-500 md:table-cell">{{ Str::limit($prompt->description, 80) }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-full bg-indigo-50 px-2.5 py-0.5 text-xs font-medium text-indigo-700">
                                {{ $prompt->famille->titre ?? '-' }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium space-x-1">
                            <a href="{{ route('prompts.show', $prompt) }}"
                               class="inline-flex items-center rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-200 transition-colors">
                                Voir
                            </a>
                            <a href="{{ route('prompts.edit', $prompt) }}"
                               class="inline-flex items-center rounded-lg bg-amber-100 px-3 py-1.5 text-xs font-medium text-amber-700 hover:bg-amber-200 transition-colors">
                                Modifier
                            </a>
                            <form action="{{ route('prompts.destroy', $prompt) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Supprimer ce prompt définitivement ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center rounded-lg bg-red-100 px-3 py-1.5 text-xs font-medium text-red-700 hover:bg-red-200 transition-colors">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-3-3v6M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/>
                                </svg>
                                <p class="text-sm">Aucun prompt trouvé.</p>
                                <a href="{{ route('prompts.create') }}" class="text-sm font-medium text-indigo-600 hover:underline">Ajouter le premier prompt</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="flex flex-col gap-2 rounded-3xl bg-white p-4 shadow-sm ring-1 ring-gray-200 sm:flex-row sm:items-center sm:justify-between">
        <div class="text-sm text-gray-500">
            Total : <span class="font-semibold text-gray-700">{{ $prompts->total() }}</span> prompt(s)
            @if(request('search') || request('famille_id'))
                <span class="ml-1 text-indigo-600">(filtrés)</span>
            @endif
        </div>
        <div>{{ $prompts->links() }}</div>
    </div>

</div>
@endsection
