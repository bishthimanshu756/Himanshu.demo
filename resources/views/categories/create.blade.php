<x-app-layout>
    <div class="mx-24 my-6 py-12 w-3/5">
        <div class="flex items-center justify-between mb-8">
            <h3 class="font-extrabold text-blue-900 text-xl">
                <a href="{{ route('categories.index') }}">Categories</a> 
                <span class="text-black"> > Create Category</span>
            </h3>
        </div>
        <div class="p-6 bg-white border-b border-gray-200">
            <form method="POST" action="{{ route('categories.store') }}" class="px-5">

                @csrf
                <!-- Category Name -->
                <div>
                    <label for="name" class="block font-black required">{{ __('Name') }}</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="rounded-md w-full" placeholder="E.g. Orthodontics">
                    
                    <x-validation-error name="name" />
                </div>

                <!-- Buttons -->
                <div class="mt-4">
                    <button type="submit" name="action" value="create" class="bg-gray-700 border-0.5 border-2 border-gray-500 font-bold hover: hover:bg-gray-700 hover:border-gray-900 text-white hover:text-white mx-auto px-4 py-1.5 rounded-md">
                        Create Category
                    </button>
                    <button type="submit" name="action" value="create_another" class="bg-gray-700 border-0.5 border-2 border-gray-500 font-bold hover: hover:bg-gray-700 hover:border-gray-900 text-white hover:text-white ml-4 px-4 py-1.5 rounded-md">
                        Create Category & Create Another
                    </button>
                    <div class="bg-blue-100 border-2 font-bold hover:bg-blue-600 hover:border-blue-700 hover:text-white inline ml-4 px-4 py-1.5 rounded-md text-gray-700">
                        <a href="{{ route('categories.index') }}" >Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>