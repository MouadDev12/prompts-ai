<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Prompts AI') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 text-gray-900">
    <div class="min-h-screen bg-gray-50 text-gray-900">
        <header class="border-b border-gray-200 bg-white shadow-sm">
            <div class="mx-auto flex flex-col gap-4 px-4 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
                <div>
                    <a href="{{ url('/') }}" class="text-xl font-semibold text-gray-900">Prompts AI</a>
                    <p class="mt-1 text-sm text-gray-500">Gestion professionnelle des prompts IA</p>
                </div>

                <nav class="flex flex-wrap gap-3 text-sm font-medium text-gray-700">
                    <a href="{{ url('/') }}" class="rounded-md px-3 py-2 hover:bg-gray-100">Accueil</a>
                    <a href="{{ route('prompts.index') }}" class="rounded-md px-3 py-2 hover:bg-gray-100">Prompts</a>
                    <a href="{{ route('prompts.create') }}" class="rounded-md bg-indigo-600 px-3 py-2 text-white hover:bg-indigo-700">Ajouter</a>
                </nav>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            @yield('content')
        </main>

        <footer class="border-t border-gray-200 bg-white py-4 text-center text-sm text-gray-500">
            <span>Prompts AI • Laravel 13 • PHP 8.3</span>
        </footer>
    </div>
</body>
</html>
