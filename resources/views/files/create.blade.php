<x-app-layout>
    <div class="mx-24 my-6 py-12">
        <!-- BreadCrum Bar -->
        <div class="flex items-center justify-between mb-8">
            <h3 class="font-extrabold text-blue-900 text-xl">
                <a href="{{ route('courses.show', $course) }}">
                    {{ $course->title }}
                </a>
                <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <line x1="13" y1="18" x2="19" y2="12"></line>
                    <line x1="13" y1="6" x2="19" y2="12"></line>
                </svg>
                <a href="{{ route('courses.units.edit', [$course, $unit]) }}">
                    {{ $unit->title }}
                </a>
                <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <line x1="13" y1="18" x2="19" y2="12"></line>
                    <line x1="13" y1="6" x2="19" y2="12"></line>
                </svg>
                <span class="text-black">
                    {{ __('Create File') }}
                </span>
            </h3>
        </div>

        <!-- Create Form Div -->
        <div class="flex bg-white">
            <div class="p-6">
                <form method="POST" action="{{ route('courses.units.files.store', [$course, $unit]) }}" class="px-5 pt-6" enctype="multipart/form-data">
                    @csrf
                    <!-- File Name -->
                    <div>
                        <label for="display_name" class="block font-black required">
                            {{ __('File Name') }}
                        </label>
                        <input type="text" name="display_name"  required class="border-gray-200 rounded-md w-full" placeholder="Enter File Name">

                        <x-validation-error name="display_name" />
                    </div>

                    <!-- Score and Duration wrapper -->
                    <div class="flex justify-between mb-4 mt-4">
                        <div class="w-2/5">
                            <input type="file" name="file">

                            <x-validation-error name="file" />
                        </div>
                        <div class="w-2/5">
                            <label for="duration" class="block font-black required">
                                {{ __('Duration') }}
                            </label>
                            <input type="number" name="duration" placeholder="Duration" class="border-gray-200 rounded-md w-full">

                            <x-validation-error name="duration" />
                        </div>
                    </div>
                    <!-- Buttons -->
                    <div class="mt-10">
                        <button type="submit" name="action" value="save" class="bg-gray-500 text-white border-0.5 border-2 border-gray-500 font-bold hover: hover:bg-gray-600 hover:border-gray-900 hover:text-white mx-auto px-8 py-1.5 rounded-md">
                            {{ __('Save') }}
                        </button>
                        <button type="submit" name="action" value="saveNxt" class="bg-gray-500 text-white border-0.5 border-2 border-gray-500 font-bold hover: hover:bg-gray-600 hover:border-gray-900 hover:text-white mx-auto px-8 py-1.5 rounded-md">
                            {{ __('Save & Add Another') }}
                        </button>
                        <div class="bg-blue-100 border-2 font-bold hover:bg-blue-600 hover:border-blue-700 hover:text-white inline ml-4 px-4 py-1.5 rounded-md text-gray-700">
                            <a href="{{ route('courses.units.edit', [$course, $unit]) }}">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>