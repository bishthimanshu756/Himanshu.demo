<x-app-layout>
    <div class="mx-24 my-6 py-12">
        <!-- BreadCrum Bar -->
        <div class="flex items-center justify-between mb-8">
            <h3 class="font-extrabold text-blue-900 text-xl">
                <a href="{{ route('courses.show', $course) }}">{{ $course->title }}</a>
                <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <line x1="13" y1="18" x2="19" y2="12"></line>
                    <line x1="13" y1="6" x2="19" y2="12"></line>
                </svg>
                <a href="{{ route('courses.units.edit', [$course, $unit]) }}">{{ $unit->title }}</a>
                <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <line x1="13" y1="18" x2="19" y2="12"></line>
                    <line x1="13" y1="6" x2="19" y2="12"></line>
                </svg>
                <span class="text-black">
                    <span>{{ __('Create Test') }}</span>
                </span>
            </h3>
        </div>

        <!-- Edit Form Div -->
        <div class="flex bg-white">
            <!-- Left Div Edit Form -->
            <div class="p-6">
                <form method="POST" action="{{ route('courses.units.tests.store', [$course,$unit]) }}" class="px-5 pt-6" enctype="multipart/form-data">
                    @csrf
                    <!-- Test Name -->
                    <div>
                        <label for="name" class="block font-black required">{{ __('Test Name') }}</label>
                        <input type="text" name="name"  required class="border-gray-200 rounded-md w-full" placeholder="Enter Test Name">

                        <x-validation-error name="name" />
                    </div>

                    <!-- Score and Duration wrapper -->
                    <div class="flex justify-between mb-4 mt-4">
                        <div class="w-2/5">
                            <label for="pass_percentage" class="block font-black required whitespace-nowrap">{{ __('Pass Score') }}</label>
                            <div class="border border-gray-200 rounded-md w-full">
                                <input type="number" name="pass_percentage" class="border-0 rounded-md w-4/5" placeholder="Passing Score">
                                <svg class="w-4 h-4 inline" width="24" height="24" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17 19C15.8954 19 15 18.1046 15 17C15 15.8954 15.8954 15 17 15C18.1046 15 19 15.8954 19 17C19 18.1046 18.1046 19 17 19Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M7 9C5.89543 9 5 8.10457 5 7C5 5.89543 5.89543 5 7 5C8.10457 5 9 5.89543 9 7C9 8.10457 8.10457 9 7 9Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M19 5L5 19" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>

                            <x-validation-error name="pass_percentage" />
                        </div>
                        <div class="w-2/5">
                            <label for="duration" class="block font-black required">{{ __('Duration') }}</label>
                            <input type="number" name="duration" placeholder="Duration" class="border-gray-200 rounded-md w-full">

                            <x-validation-error name="duration" />
                        </div>
                    </div>
                    <!-- Buttons -->
                    <div class="mt-10">
                        <button type="submit" class="bg-gray-500 text-white border-0.5 border-2 border-gray-500 font-bold hover: hover:bg-gray-600 hover:border-gray-900 hover:text-white mx-auto px-8 py-1.5 rounded-md">
                            {{ __('Save') }}
                        </button>
                        <div class="bg-blue-100 border-2 font-bold hover:bg-blue-600 hover:border-blue-700 hover:text-white inline ml-4 px-4 py-1.5 rounded-md text-gray-700">
                            <a href="{{ route('courses.index') }}"> {{ __('Cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>