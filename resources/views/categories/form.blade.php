<div>
    <x-input-label for="name" :value="__('Name')"/>
    <x-text-input id="name" name="name" type="name" required autofocus class="mt-1 block w-full" value="{{$category->name ?? ''}}"/>
    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
</div>
<div>
    <x-input-label for="description" :value="__('Description')"/>
    <x-text-input id="description" name="description" type="description" required autofocus class="mt-1 block w-full" value="{{$category->description ?? ''}}"/>
    <x-input-error :messages="$errors->get('description')" class="mt-2"/>
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


