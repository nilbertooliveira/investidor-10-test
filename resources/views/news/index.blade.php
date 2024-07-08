<link rel="stylesheet" href="{{ asset('css/news.css') }}">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a class="" href="{{ route('news.create') }}">{{ __('News Create') }}</a>
        </h2>
    </x-slot>

    <div class="grid">
        @if(count($news)  > 0)
            @foreach($news as $model)
                <div class="card">
                    <h5 class="card-title">{{$model->title}}</h5>
                    <div class="category font-bold">
                        <label>{{ __("Category") }}:</label>
                        {{$model->category->name}}
                    </div>
                    <p class="card-content">
                        {{$model->summary}}
                    </p>
                    <button class="custom-button" data-id="{{ $model->id }}">
                        <a href="{{ route('news.show', $model->id)}}">{{ __('Access') }}</a>
                    </button>
                </div>
            @endforeach
        @else
            <p class="text-gray-500 mt-4">{{__('SEARCH_NOT_FOUND')}}.</p>
        @endif
    </div>
</x-app-layout>
