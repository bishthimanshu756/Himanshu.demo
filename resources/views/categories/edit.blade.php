<x-app-layout>
    <div class="h-screen overflow-x-auto py-12 h-screen mx-24 my-6 w-3/5">
        <div class="flex items-center justify-between mb-8">
            <h3 class="font-extrabold text-blue-900 text-xl">
                <a href="{{ route('categories.index') }}">Categories</a>
                <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <line x1="13" y1="18" x2="19" y2="12"></line>
                    <line x1="13" y1="6" x2="19" y2="12"></line>
                </svg>
                <span class="text-black"> {{ $category->name }}</span>
            </h3>
        </div>
        <div class="p-6 bg-white border-b border-gray-200 w-4/5">
            <form method="POST" action="{{ route('categories.update', $category) }}" class="px-5">
                @csrf
                <!-- Category Name -->
                <div>
                    <label for="name" class="block font-black required">{{ __('Name') }}</label>
                    <input type="text" name="name" value="{{ $category->name }}" required class="rounded-md w-full" placeholder="E.g. Orthodontics" >

                    <x-validation-error name="name" />
                </div>

                <!-- Buttons -->
                <div class="mt-4">
                    <button type="submit" class="bg-gray-600 border-2 border-gray-600 text-white font-bold hover: hover:bg-gray-800 hover:border-gray-900 hover:text-white mx-auto px-4 py-1.5 rounded-md">Update Category</button>
                    <div class="bg-blue-100 border-2 border-blue-100 font-bold hover:bg-blue-400 hover:text-white inline ml-8 px-4 py-1.5 rounded-md">
                        <a href="{{ route('categories.index') }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>