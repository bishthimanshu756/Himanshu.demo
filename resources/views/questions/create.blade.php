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
                    <span>{{ __('Add Question') }}</span>
                </span>
            </h3>
        </div>

        <!-- Edit Form Div -->
        <div class="flex bg-white">
            <!-- Left Div Edit Form -->
            <div class="p-6">
                <form method="POST" action="{{ route('courses.units.update', [$course,$unit]) }}" class="px-5 pt-6" enctype="multipart/form-data">
                    @csrf
                    <!-- Question -->
                    <div>
                        <label for="name" class="block font-black required">{{ __('Type Your Question') }}</label>
                        <textarea name="question" placeholder="Enter your question"></textarea>

                        <x-validation-error name="title" />
                    </div>

                    <!-- Attachment -->
                    <div class="flex justify-between mb-4 mt-4">
                        <label for="attachment" class="block font-black required">
                            {{ __('Attachment') }}
                            <span> {{ __('(Optional)') }}</span>
                        </label>
                        <input type="file" name="attachment">
                        <x-validation-error name="attachment" />
                    </div>
                    <hr>
                    <div>
                        <h4>
                            <span>{{ __('Answer') }}</span>
                            <span>{{ __('(Tick the right answer)') }}</span>
                        </h4>
                        <div>
                            <input type="text" placeholder="Enter the answer here...">
                            <input type="text" placeholder="Enter the answer here...">
                        </div>
                    </div>
                    <!-- Buttons -->
                    <div class="mt-10">
                        <button type="submit" class="bg-gray-500 text-white border-0.5 border-2 border-gray-500 font-bold hover: hover:bg-gray-600 hover:border-gray-900 hover:text-white mx-auto px-8 py-1.5 rounded-md">
                            {{ __('Save') }}
                        </button>
                        <button type="submit" class="bg-gray-500 text-white border-0.5 border-2 border-gray-500 font-bold hover: hover:bg-gray-600 hover:border-gray-900 hover:text-white mx-auto px-8 py-1.5 rounded-md">
                            {{ __('Save & Add Another') }}
                        </button>
                        <div class="bg-blue-100 border-2 font-bold hover:bg-blue-600 hover:border-blue-700 hover:text-white inline ml-4 px-4 py-1.5 rounded-md text-gray-700">
                            <a href="{{ route('courses.index') }}">Cancel</a>
                        </div>
                    </div>
                </form>
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