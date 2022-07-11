<x-app-layout>
    <div class="mx-24 my-6 py-12">
        <!-- BreadCrum Bar -->
        <div class="flex items-center justify-between mb-8">
            <h3 class="font-extrabold text-blue-900 text-xl">
                <a href="{{ route('courses.show', $course) }}">
                    {{ __('Courses') }}
                </a>
                <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <line x1="13" y1="18" x2="19" y2="12"></line>
                    <line x1="13" y1="6" x2="19" y2="12"></line>
                </svg>
                <a href="{{ route('courses.units.tests.edit', [$course, $lesson->unit, $test]) }}">
                    {{ $test->name }}
                </a>
                <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <line x1="13" y1="18" x2="19" y2="12"></line>
                    <line x1="13" y1="6" x2="19" y2="12"></line>
                </svg>
                <span class="text-black">
                    <span>{{ __('Add Question') }}</span>
                </span>
            </h3>
        </div>

        <!-- Form Div -->
        <div class="bg-white p-6 w-full">
            <form method="POST" action="{{ route('courses.tests.questions.store', [$course, $test]) }}" class="px-5 pt-6" enctype="multipart/form-data">
                @csrf
                <!-- Question -->
                <div class="h-24 w-full">
                    <label for="name" class="block font-black required">{{ __('Type Your Question') }}</label>
                    <textarea name="name" placeholder="Enter your question" value="{{ old('name') }}" class="w-full h-full"></textarea>

                    <x-validation-error name="name" />
                </div>

                <!-- Attachment -->
                <div class="mb-8 mt-10">
                    <label for="attachment" class="block font-black required">
                        {{ __('Attachment') }}
                        <span class="font-medium italic text-gray-300"> {{ __('(Optional)') }}</span>
                    </label>
                    <input type="file" name="attachment" class="bg-blue-100 border border-dashed border-gray-400 h-20 w-full">
                    <x-validation-error name="attachment" />
                </div>
                <hr>
                <div>
                    <h4>
                        <span>{{ __('Answer') }}</span>
                        <span class="font-light italic text-gray-400">{{ __('(Tick the right answer)') }}</span>
                    </h4>
                    <div>
                        <div class="h-11 mt-4">
                            <input type="radio" id="radio1" name="answer" value="1" class="mb-11">
                            <label for="radio1">
                                <textarea type="text" id="option1" name="options[]" class="h-full w-11/12" placeholder="Enter the answer here..." class="block">{{ old('option1') }}</textarea>
                            </label>
                        </div>
                        <div class="h-11 mt-4">
                            <input type="radio" id="radio2" name="answer" value="2" class="mb-11">
                            <label for="radio2">
                                <textarea type="text" id="option2" name="options[]" class="h-full w-11/12" placeholder="Enter the answer here..." class="block">{{ old('option2') }}</textarea>
                            </label>
                        </div>
                        <div class="h-11 mt-4">
                            <input type="radio" id="radio3" name="answer" value="3" class="mb-11">
                            <label for="radio3">
                                <textarea type="text" id="option3" name="options[]" class="h-full w-11/12" placeholder="Enter the answer here..." class="block">{{ old('option3') }}</textarea>
                            </label>
                        </div>
                        <div class="h-11 mt-4">
                            <input type="radio" id="radio4" name="answer" value="4" class="mb-11">
                            <label for="radio4">
                                <textarea type="text" id="option4" name="options[]" class="h-full w-11/12" placeholder="Enter the answer here..." class="block">{{ old('option4') }}</textarea>
                            </label>
                        </div>
                        <x-validation-error name=answer />
                        <x-validation-error name=options* />
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
                        <a href="{{ route('courses.units.tests.edit', [$course, $lesson->unit, $test]) }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>