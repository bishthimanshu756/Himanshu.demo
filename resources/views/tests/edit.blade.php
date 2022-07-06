<x-app-layout>
    <div class="mx-24 my-6 py-12">
        <!-- BreadCrum Bar -->
        <div class="flex items-center justify-between mb-8">
            <h3 class="font-extrabold text-blue-900 text-xl">
                <a href="{{ route('courses.index') }}">{{ __('Courses') }}</a>
                <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <line x1="13" y1="18" x2="19" y2="12"></line>
                    <line x1="13" y1="6" x2="19" y2="12"></line>
                </svg>
                <a href="{{ route('courses.show', $course) }}">{{ $unit->title }}</a>
                <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <line x1="13" y1="18" x2="19" y2="12"></line>
                    <line x1="13" y1="6" x2="19" y2="12"></line>
                </svg>
                <span class="text-black">
                    <span>{{ __('Edit Test') }}</span>
                </span>
            </h3>
        </div>

        <!-- Edit Form Div -->
        <div class="flex bg-white">
            <!-- Left Div Edit Form -->
            <div class="p-6">
                <form method="POST" action="{{ route('courses.units.update', [$course,$unit]) }}" class="px-5 pt-6" enctype="multipart/form-data">
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
                            <label for="pass_score" class="block font-black required whitespace-nowrap">{{ __('Pass Score') }}</label>
                            <input type="number" name="pass_score">

                            <x-validation-error name="pass_score" />
                        </div>
                        <div class="w-2/5">
                            <label for="duration" class="block font-black required">{{ __('Duration') }}</label>
                            <input type="number" name="duration">

                            <x-validation-error name="duration" />
                        </div>
                    </div>
                    <!-- Buttons -->
                    <div class="mt-10">
                        <button type="submit" class="bg-gray-500 text-white border-0.5 border-2 border-gray-500 font-bold hover: hover:bg-gray-600 hover:border-gray-900 hover:text-white mx-auto px-8 py-1.5 rounded-md">
                            {{ __('Update') }}
                        </button>
                        <div class="bg-blue-100 border-2 font-bold hover:bg-blue-600 hover:border-blue-700 hover:text-white inline ml-4 px-4 py-1.5 rounded-md text-gray-700">
                            <a href="{{ route('courses.index') }}"> {{ __('Cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Right Div Files -->
            <div class="mt-8 pl-24 w-1/2">
                <h3><span class="font-semibold whitespace-nowrapp">{{ __('Add Question Type') }}</span></h3>
                <div class="border mt-2 rounded-md text-center w-2/5">
                    <a href="{{ route('courses.units.tests.questions', [$course, $unit]) }}">
                    <svg class="w-20 h-20 inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                        <path d="M11.5,20h-6a1,1,0,0,1-1-1V5a1,1,0,0,1,1-1h5V7a3,3,0,0,0,3,3h3v5a1,1,0,0,0,2,0V9s0,0,0-.06a1.31,1.31,0,0,0-.06-.27l0-.09a1.07,1.07,0,0,0-.19-.28h0l-6-6h0a1.07,1.07,0,0,0-.28-.19.29.29,0,0,0-.1,0A1.1,1.1,0,0,0,11.56,2H5.5a3,3,0,0,0-3,3V19a3,3,0,0,0,3,3h6a1,1,0,0,0,0-2Zm1-14.59L15.09,8H13.5a1,1,0,0,1-1-1ZM7.5,14h6a1,1,0,0,0,0-2h-6a1,1,0,0,0,0,2Zm4,2h-4a1,1,0,0,0,0,2h4a1,1,0,0,0,0-2Zm-4-6h1a1,1,0,0,0,0-2h-1a1,1,0,0,0,0,2Zm13.71,6.29a1,1,0,0,0-1.42,0l-3.29,3.3-1.29-1.3a1,1,0,0,0-1.42,1.42l2,2a1,1,0,0,0,1.42,0l4-4A1,1,0,0,0,21.21,16.29Z"></path>
                    </svg>
                    <span class="block py-1 text-sm">
                        {{ __('+ Add Questions') }}
                    </span>
                </div>
            </div>
        </div>
        <h3 class="font-bold text-lg mt-10">
            <span>
                {{ __('Questions') }}
            </span>
        </h3>

        <!-- Lessons Listing -->
        <div class="bg-white p-4">
            <span class="italic text-gray-300"> {{ __('No Questions found...') }} </span>
        </div>
    </div>
</x-app-layout>