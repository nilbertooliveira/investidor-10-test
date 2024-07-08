<link rel="stylesheet" href="{{ asset('css/news.css') }}">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a class="" href="{{ route('categories.index') }}">{{ __('Category') }}</a>
        </h2>
    </x-slot>

    <div class="custom-item">
        <h2 class="custom-title">{{ $category->name }}</h2>
        <p class="custom-content">{{ $category->description }}</p>
    </div>
</x-app-layout>
