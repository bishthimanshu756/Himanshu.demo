<x-app-layout>
    <div class="mx-24 my-6 py-12 ">
        <div class="flex items-center justify-between mb-8">
            <h3 class="font-extrabold text-blue-900 text-xl">
                <a href="{{ route('categories.index') }}">Categories</a> 
                <span class="text-black"> > Create Category</span>
            </h3>
        </div>
        <div class="p-6 bg-white border-b border-gray-200 w-3/5">
            <form method="POST" action="{{ route('categories.create') }}" class="px-5">

                @csrf
                <!-- Category Name -->
                <div>
                    <label for="name" class="block font-black">{{ __('Name') }}<sup class="text-red-500">*</sup></label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="rounded-md w-full" placeholder="E.g. Orthodontics">
                    
                    @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slug Name -->
                <div class="mt-4">
                    <label for="slug" class="block font-black">{{ __('Slug') }}<sup class="text-red-500">*</sup></label>
                    <input type="text" name="slug" value="{{ old('slug') }}" required class="rounded-md w-full" placeholder="Enter unique slug name">
                    
                    @error('slug')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="mt-4">
                    <button type="submit" class="bg-gray-700 border-0.5 border-2 border-gray-500 font-bold hover: hover:bg-gray-700 hover:border-gray-900 text-white hover:text-white mx-auto px-4 py-1.5 rounded-md">Create Category</button>
                    <div class="bg-blue-100 border-2 font-bold hover:bg-blue-600 hover:border-blue-700 hover:text-white inline ml-8 px-4 py-1.5 rounded-md text-gray-700">
                        <a href="{{ route('categories.index') }}" >Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>