<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Prompts AI') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50 text-gray-900 antialiased">

    <header class="sticky top-0 z-10 border-b border-gray-200 bg-white/90 shadow-sm backdrop-blur">
        <div class="mx-auto flex max-w-7xl flex-col gap-3 px-4 py-3 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-indigo-600 text-white text-sm font-bold">P</span>
                <div>
                    <span class="text-base font-semibold text-gray-900">Prompts AI</span>
                    <span class="ml-2 hidden text-xs text-gray-400 sm:inline">Gestion des prompts IA</span>
                </div>
            </a>

            <nav class="flex flex-wrap items-center gap-1 text-sm font-medium text-gray-700">
                <a href="{{ url('/') }}"
                   class="rounded-lg px-3 py-2 transition-colors hover:bg-gray-100 {{ request()->is('/') ? 'bg-gray-100 text-gray-900' : '' }}">
                    Accueil
                </a>
                <a href="{{ route('prompts.index') }}"
                   class="rounded-lg px-3 py-2 transition-colors hover:bg-gray-100 {{ request()->routeIs('prompts.index') ? 'bg-gray-100 text-gray-900' : '' }}">
                    Prompts
                </a>
                <a href="{{ route('prompts.create') }}"
                   class="rounded-lg bg-indigo-600 px-3 py-2 text-white transition-colors hover:bg-indigo-700">
                    + Ajouter
                </a>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    <footer class="mt-8 border-t border-gray-200 bg-white py-5 text-center text-xs text-gray-400">
        Prompts AI &bull; Laravel &bull; PHP 8.3 &bull; Tailwind CSS
    </footer>

</body>
</html>
