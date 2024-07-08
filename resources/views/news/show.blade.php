<link rel="stylesheet" href="{{ asset('css/news.css') }}">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a class="" href="{{ route('news.index') }}">{{ __('News') }}</a>
        </h2>
    </x-slot>

    <div class="custom-item">
        <h2 class="custom-title">{{ $news->title }}</h2>
        <p class="custom-content">{{ $news->summary }}</p>
        <div class="flex justify-end">
            <a href="{{ route('news.edit', $news->id) }}" class="btn btn-primary mr-2">{{ __('Edit') }}</a>

            <form method="POST" action="{{ route('news.destroy', $news->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
            </form>
        </div>
    </div>
</x-app-layout>
