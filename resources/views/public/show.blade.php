<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-6">
                    <a href="{{ route('public.index', $user->id) }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        Retour sur les articles
                    </a>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                            {{ $article->title }}
                        </h1>
                        
                        <div class="flex flex-wrap gap-2 mb-2">
                            @foreach ($article->categories as $category)
                                <span class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-3 py-1 rounded-full text-xs font-semibold">#{{ $category->name }}</span>
                            @endforeach
                        </div>

                        <div class="text-gray-500 dark:text-gray-400 text-sm mb-6">
                            Publié le {{ $article->created_at->format('d/m/Y') }} par {{ $article->user->name }}
                        </div>

                        <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300">
                            {{ $article->content }}
                        </div>
                    </div>
                </div>
                <!-- Liste des commentaires -->
                <div class="mt-6 space-y-4">
                    @foreach ($article->comments as $comment)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                            <div class="font-bold text-gray-900 dark:text-gray-100">{{ $comment->user->name }} <span class="text-xs text-gray-500 font-normal">le {{ $comment->created_at->format('d/m/Y') }}</span></div>
                            <p class="text-gray-700 dark:text-gray-300 mt-1">{{ $comment->content }}</p>
                        </div>
                    @endforeach
                </div>
                                <!-- Ajout d'un commentaire -->
                @auth
                <form action="{{ route('comments.store') }}" method="post" class="mt-6">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Votre commentaire</label>
                        <textarea id="content" name="content" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Envoyer
                    </button>
                </form>
                @endauth
                
                @guest
                    <div class="mt-6 p-4 bg-white dark:bg-gray-800 rounded-lg shadow sm:p-6 text-center">
                        <p class="text-gray-700 dark:text-gray-300">Vous devez être connecté pour laisser un commentaire.</p>
                        <a href="{{ route('login') }}" class="mt-2 inline-block text-blue-500 hover:underline">Se connecter</a>
                    </div>
                @endguest
            </div>
        </div>
    </body>
</html>