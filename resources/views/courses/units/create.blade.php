<x-app-layout>
    <div class="mx-24 my-6 py-12">
        <div class="flex items-center justify-between mb-8">
            <h3 class="font-extrabold text-blue-900 text-xl">
                <a href="{{ route('courses.index') }}">
                    {{ __('Courses') }}
                </a>
                <svg class="w-4 h-4 inline" viewBox="0 0 358 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                    <title>right</title><path d="M98 460L64 426 227 262 64 98 98 64 294 262 98 460Z"></path>
                </svg>
                <a href="{{ route('courses.show', $course) }}">
                    {{ $course->title }}
                </a>
                <span class="text-black">
                    <svg class="w-4 h-4 inline" viewBox="0 0 358 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                        <title>right</title><path d="M98 460L64 426 227 262 64 98 98 64 294 262 98 460Z"></path>
                    </svg>
                    {{ __('Add New Unit') }}
                </span>
            </h3>
        </div>
        <div class="p-6 bg-white border-b border-gray-200">
            <form method="POST" action="{{ route('courses.units.store', $course) }}" class="px-5 w-7/12 pt-6">

                @csrf
                <!-- Title -->
                <div>
                    <label for="title" class="block font-black required">{{ __('Title') }}</label>
                    <input type="text" name="title" value="{{ old('title') }}" required class="border-gray-200 rounded-md w-full" placeholder="Enter Unit Name">

                    <x-validation-error name="title" />
                </div>

                <!-- Description -->
                <div class="mt-4">
                    <label for="description" class="block font-black required">{{ __('Description') }}</label>
                    <textarea name="description" value="{{ old('description') }}" class="border-gray-200 rounded-md w-full" placeholder="Description"></textarea>

                    <x-validation-error name="description" />
                </div>

                <!-- Buttons -->
                <div class="mt-4">
                    <button type="submit" class="bg-gray-500 text-white border-0.5 border-2 border-gray-500 font-bold hover: hover:bg-gray-600 hover:border-gray-900 hover:text-white mx-auto px-8 py-1.5 rounded-md">
                        {{ __('Save') }}
                    </button>
                    <button type="submit" name="create_another" class="bg-gray-500 text-white border-0.5 border-2 border-gray-500 font-bold hover: hover:bg-gray-600 hover:border-gray-900 hover:text-white mx-auto px-8 py-1.5 rounded-md">
                        {{ __('Save & Add Another') }}
                    </button>
                    <div class="bg-blue-100 border-2 font-bold hover:bg-blue-600 hover:border-blue-700 hover:text-white inline ml-4 px-4 py-1.5 rounded-md text-gray-700">
                        <a href="{{ route('courses.show', $course) }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>