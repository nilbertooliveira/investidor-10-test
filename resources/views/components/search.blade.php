<div class="hidden sm:flex sm:items-center sm:ms-6 ">
    <form action="{{ route('search') }}" method="post">
        @csrf
        <div class="flex items-center w-full">
            <input type="text" name="term" id="term" required autofocus class="flex-grow rounded-md border border-gray-300 focus:border-blue-500 px-4 py-2" placeholder="{{ __('Search') }}" />
            <span class="mr-2"></span>
            <button type="submit" class="custom-button">
                {{ __('Search') }}
            </button>
        </div>
    </form>
</div>
