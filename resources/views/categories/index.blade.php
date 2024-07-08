<link rel="stylesheet" href="{{ asset('css/news.css') }}">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xs text-gray-800 leading-tight">
            <a class="" href="{{ route('categories.create') }}">{{ __('Category Create') }}</a>
        </h2>
    </x-slot>

    <div class="w-full max-w-7xl mx-auto">
        <div class="py-4">
            <table class="bg-white w-full table table-bordered table-striped border-gray-700">
                <thead class="bg-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-3">{{__('Name')}}</th>
                    <th scope="col" class="px-6 py-3">{{__('Description')}}</th>
                    <th scope="col" class="px-6 py-3">{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td class="px-6 py-1 border-b border-gray-200">{{ $category->name }}</td>
                        <td class="px-6 py-1 border-b border-gray-200">{{ $category->description }}</td>
                        <td class="px-6 py-1 border-b border-gray-200 text-center">
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-primary mr-2">{{ __('Visualizar') }}</a>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning mr-2">{{ __('Editar') }}</a>
                            <form method="POST" action="{{ route('categories.destroy', $category->id) }}" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{ __('Excluir') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @if (session('success') === true)
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 4000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @else
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 10000)"
                    class="text-sm text-red-600"
                >{{ session('error') }}</div>
            @endif
        </div>
    </div>
</x-app-layout>
