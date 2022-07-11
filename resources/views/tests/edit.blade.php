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
                    <span>{{ __('Edit Test') }}</span>
                </span>
            </h3>
        </div>

        <!-- Edit Form Div -->
        <div class="flex bg-white">
            <!-- Left Div Edit Form -->
            <div class="p-6">
                <form method="POST" action="{{ route('courses.units.tests.update', [$course, $unit,  $test]) }}" class="px-5 pt-6" enctype="multipart/form-data">
                    @csrf
                    <!-- Test Name -->
                    <div>
                        <label for="name" class="block font-black required">{{ __('Test Name') }}</label>
                        <input type="text" name="name"  required class="border-gray-200 rounded-md w-full" value="{{ $test->name }}" placeholder="Enter Test Name">

                        <x-validation-error name="name" />
                    </div>

                    <!-- Score and Duration wrapper -->
                    <div class="flex justify-between mb-4 mt-4">
                        <div class="w-2/5">
                            <label for="pass_percentage" class="block font-black required whitespace-nowrap">{{ __('Pass Score') }}</label>
                            <div class="border border-gray-200 rounded-md w-full">
                                <input type="number" name="pass_percentage" value="{{ $test->pass_percentage }}" class="border-0 rounded-md w-4/5" placeholder="Passing Score">
                                <svg class="w-4 h-4 inline" width="24" height="24" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17 19C15.8954 19 15 18.1046 15 17C15 15.8954 15.8954 15 17 15C18.1046 15 19 15.8954 19 17C19 18.1046 18.1046 19 17 19Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M7 9C5.89543 9 5 8.10457 5 7C5 5.89543 5.89543 5 7 5C8.10457 5 9 5.89543 9 7C9 8.10457 8.10457 9 7 9Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M19 5L5 19" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>

                            <x-validation-error name="pass_percentage" />
                        </div>
                        <div class="w-2/5">
                            <label for="duration"  class="block font-black required">{{ __('Duration') }}</label>
                            <input type="number" name="duration" value="{{ $test->duration }}">

                            <x-validation-error name="duration" />
                        </div>
                    </div>
                    <!-- Buttons -->
                    <div class="mt-10">
                        <button type="submit" class="bg-gray-500 text-white border-0.5 border-2 border-gray-500 font-bold hover: hover:bg-gray-600 hover:border-gray-900 hover:text-white mx-auto px-8 py-1.5 rounded-md">
                            {{ __('Update') }}
                        </button>
                        <div class="bg-blue-100 border-2 font-bold hover:bg-blue-600 hover:border-blue-700 hover:text-white inline ml-4 px-4 py-1.5 rounded-md text-gray-700">
                            <a href="{{ route('courses.units.edit', [$course, $unit]) }}"> {{ __('Cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Right Div Files -->
            <div class="mt-8 pl-24 w-1/2">
                <h3><span class="font-semibold whitespace-nowrapp">{{ __('Add Question Type') }}</span></h3>
                <div class="border mt-2 rounded-md text-center w-2/5">
                    <a href="{{ route('courses.tests.questions.create', [$course, $test]) }}">
                        <svg class="w-20 h-20 inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                            <path d="M11.5,20h-6a1,1,0,0,1-1-1V5a1,1,0,0,1,1-1h5V7a3,3,0,0,0,3,3h3v5a1,1,0,0,0,2,0V9s0,0,0-.06a1.31,1.31,0,0,0-.06-.27l0-.09a1.07,1.07,0,0,0-.19-.28h0l-6-6h0a1.07,1.07,0,0,0-.28-.19.29.29,0,0,0-.1,0A1.1,1.1,0,0,0,11.56,2H5.5a3,3,0,0,0-3,3V19a3,3,0,0,0,3,3h6a1,1,0,0,0,0-2Zm1-14.59L15.09,8H13.5a1,1,0,0,1-1-1ZM7.5,14h6a1,1,0,0,0,0-2h-6a1,1,0,0,0,0,2Zm4,2h-4a1,1,0,0,0,0,2h4a1,1,0,0,0,0-2Zm-4-6h1a1,1,0,0,0,0-2h-1a1,1,0,0,0,0,2Zm13.71,6.29a1,1,0,0,0-1.42,0l-3.29,3.3-1.29-1.3a1,1,0,0,0-1.42,1.42l2,2a1,1,0,0,0,1.42,0l4-4A1,1,0,0,0,21.21,16.29Z"></path>
                        </svg>
                        <span class="block py-1 text-sm">
                            {{ __('+ Add Questions') }}
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <h3 class="font-bold text-lg mt-10">
            <span>
                {{ __('Questions') }}
            </span>
        </h3>

        <!-- Questions Listing -->
        <div class="bg-white p-4">
            @if($questions->count())
                @foreach($questions as $question)
                    <div class="flex justify-between my-6">
                        <span>{{$question->name}}</span>
                        <div class="inline">
                            <a href="{{ route('courses.tests.questions.edit', [$course, $test, $question]) }}">
                                <svg class="w-6 h-6 inline mr-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path d="M402.3 344.9l32-32c5-5 13.7-1.5 13.7 5.7V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h273.5c7.1 0 10.7 8.6 5.7 13.7l-32 32c-1.5 1.5-3.5 2.3-5.7 2.3H48v352h352V350.5c0-2.1.8-4.1 2.3-5.6zm156.6-201.8L296.3 405.7l-90.4 10c-26.2 2.9-48.5-19.2-45.6-45.6l10-90.4L432.9 17.1c22.9-22.9 59.9-22.9 82.7 0l43.2 43.2c22.9 22.9 22.9 60 .1 82.8zM460.1 174L402 115.9 216.2 301.8l-7.3 65.3 65.3-7.3L460.1 174zm64.8-79.7l-43.2-43.2c-4.1-4.1-10.8-4.1-14.8 0L436 82l58.1 58.1 30.9-30.9c4-4.2 4-10.8-.1-14.9z"></path>
                                </svg>
                            </a>
                            <a href="{{ route('courses.tests.questions.delete', [$course, $test, $question]) }}">
                                <svg class="w-8 h-8 inline mr-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4V4zm2 2h6V4H9v2zM6.074 8l.857 12H17.07l.857-12H6.074zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1z" fill="currentColor"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <span class="italic text-gray-300"> {{ __('No Questions found...') }} </span>
            @endif
        </div>
    </div>
</x-app-layout>