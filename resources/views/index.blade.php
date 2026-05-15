@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Prompts IA</h1>
            <p class="mt-1 text-sm text-gray-500">Liste paginée des prompts enregistrés et gestion des catégories.</p>
        </div>
        <a href="{{ route('prompts.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">Ajouter un prompt</a>
    </div>

    @if(session('success'))
        <div class="rounded-2xl border border-green-200 bg-green-50 px-6 py-4 text-sm text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Titre</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Famille</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($prompts as $prompt)
                    <tr>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">{{ $prompt->id }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $prompt->titre }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($prompt->description, 80) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $prompt->famille->titre ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-700 space-x-2">
                            <a href="{{ route('prompts.show', $prompt) }}" class="rounded-full bg-slate-100 px-3 py-1 hover:bg-slate-200">Voir</a>
                            <a href="{{ route('prompts.edit', $prompt) }}" class="rounded-full bg-amber-100 px-3 py-1 hover:bg-amber-200">Modifier</a>
                            <form action="{{ route('prompts.destroy', $prompt) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-full bg-red-100 px-3 py-1 text-red-700 hover:bg-red-200" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">Aucun prompt trouvé. Ajoutez le premier prompt pour démarrer.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex items-center justify-between rounded-3xl bg-white p-4 shadow-sm ring-1 ring-gray-200">
        <div class="text-sm text-gray-500">Total : {{ $prompts->total() }} prompt(s)</div>
        <div>{{ $prompts->links() }}</div>
    </div>
</div>
@endsection