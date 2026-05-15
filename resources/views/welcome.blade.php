@extends('layouts.app')

@section('content')
<div class="space-y-10">

    {{-- Hero --}}
    <div class="rounded-3xl bg-gradient-to-br from-indigo-600 to-indigo-800 p-10 text-white shadow-lg">
        <div class="max-w-2xl">
            <div class="mb-4 inline-flex items-center rounded-full bg-white/20 px-3 py-1 text-xs font-medium text-white">
                ✦ Gestion professionnelle des prompts IA
            </div>
            <h1 class="text-4xl font-bold leading-tight">
                Organisez vos prompts IA<br>en toute simplicité
            </h1>
            <p class="mt-4 text-indigo-200 leading-relaxed">
                Créez, classez et retrouvez facilement vos prompts par famille et type.
                Copiez-les en un clic pour les utiliser dans vos outils IA préférés.
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('prompts.index') }}"
                   class="inline-flex items-center gap-2 rounded-2xl bg-white px-6 py-3 text-sm font-semibold text-indigo-700 shadow hover:bg-indigo-50 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h10"/>
                    </svg>
                    Voir tous les prompts
                </a>
                <a href="{{ route('prompts.create') }}"
                   class="inline-flex items-center gap-2 rounded-2xl border border-white/30 bg-white/10 px-6 py-3 text-sm font-semibold text-white hover:bg-white/20 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Créer un prompt
                </a>
            </div>
        </div>
    </div>

    {{-- Fonctionnalités --}}
    <div>
        <h2 class="mb-6 text-lg font-semibold text-gray-900">Ce que vous pouvez faire</h2>
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <a href="{{ route('prompts.create') }}"
               class="group rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200 hover:ring-indigo-300 hover:shadow-md transition-all">
                <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 group-hover:bg-indigo-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 group-hover:text-indigo-700 transition-colors">Créer des prompts</h3>
                <p class="mt-1 text-sm text-gray-500">Rédigez et structurez vos prompts avec titre, description et texte complet.</p>
                <span class="mt-3 inline-flex items-center gap-1 text-xs font-medium text-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity">
                    Créer maintenant →
                </span>
            </a>
            <a href="{{ route('prompts.index') }}"
               class="group rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200 hover:ring-amber-300 hover:shadow-md transition-all">
                <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600 group-hover:bg-amber-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h10M7 11h6M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 group-hover:text-amber-700 transition-colors">Rechercher & filtrer</h3>
                <p class="mt-1 text-sm text-gray-500">Retrouvez rapidement un prompt par mot-clé ou par famille de catégorie.</p>
                <span class="mt-3 inline-flex items-center gap-1 text-xs font-medium text-amber-600 opacity-0 group-hover:opacity-100 transition-opacity">
                    Parcourir les prompts →
                </span>
            </a>
            <a href="{{ route('prompts.index') }}"
               class="group rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200 hover:ring-green-300 hover:shadow-md transition-all">
                <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-xl bg-green-50 text-green-600 group-hover:bg-green-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2m-6 12h8a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-8a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 group-hover:text-green-700 transition-colors">Copier en un clic</h3>
                <p class="mt-1 text-sm text-gray-500">Copiez le texte d'un prompt dans le presse-papier pour l'utiliser immédiatement.</p>
                <span class="mt-3 inline-flex items-center gap-1 text-xs font-medium text-green-600 opacity-0 group-hover:opacity-100 transition-opacity">
                    Voir les prompts →
                </span>
            </a>
        </div>
    </div>

</div>
@endsection
