<x-app-layout>
    <div class="h-screen overflow-x-auto py-12 h-screen mx-24 my-6 w-3/5">
        <div class="flex items-center justify-between mb-8">
            <h3 class="font-extrabold text-blue-900 text-xl">
                <a href="{{ route('categories.index') }}">Categories</a> 
                <span class="text-black"> > {{ $category->name }}</span>
            </h3>
        </div>
        <div class="p-6 bg-white border-b border-gray-200 w-4/5">
            <form method="POST" action="{{ route('categories.update', $category) }}" class="px-5">
                @csrf
                <!-- Category Name -->
                <div>
                    <label for="name" class="block font-black">{{ __('Name') }}<sup class="text-red-500">*</sup></label>
                    <input type="text" name="name" value="{{ $category->name }}" required class="rounded-md w-full" placeholder="E.g. Orthodontics" >

                    @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="mt-4">
                    <button type="submit" class="bg-gray-600 border-2 border-gray-600 text-white font-bold hover: hover:bg-gray-800 hover:border-gray-900 hover:text-white mx-auto px-4 py-1.5 rounded-md">Update Category</button>
                    <div class="bg-blue-100 border-2 border-blue-100 font-bold hover:bg-blue-400 hover:text-white inline ml-8 px-4 py-1.5 rounded-md">
                        <a href="{{ route('users.index') }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>