<div>
    <x-input-label for="title" :value="__('Title')"/>
    <x-text-input id="title" name="title" type="title" required autofocus class="mt-1 block w-full" value="{{$news->title ?? ''}}"/>
    <x-input-error :messages="$errors->get('title')" class="mt-2"/>
</div>
<div>
    <x-input-label for="summary" :value="__('Summary')"/>
    <x-text-input id="summary" name="summary" type="summary" required autofocus class="mt-1 block w-full"
                  value="{{$news->summary ?? ''}}"/>
    <x-input-error :messages="$errors->get('summary')" class="mt-2"/>
</div>
<div>
    <x-input-label for="category_id" :value="__('Category')"/>
    <select id="category_id" name="category_id" required autofocus class="block w-full rounded-md border border-gray-300 py-2 px-3">
        <option value="">{{ __('Select Category') }}</option>
        @foreach ($categories as $category)
            <option
                value="{{ $category->id }}" {{ (old('category_id') ?? @$news->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('category_id')" class="mt-2"/>
</div>

@if (session('success') === true)
    <p
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 2000)"
        class="text-sm text-gray-600"
    >{{ __('Saved.') }}</p>
@endif


