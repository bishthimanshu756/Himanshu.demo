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
                <a href="{{ route('courses.units.tests.edit', [$course, $unit, $test]) }}">
                    {{ $test->name }}
                </a>
                <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <line x1="13" y1="18" x2="19" y2="12"></line>
                    <line x1="13" y1="6" x2="19" y2="12"></line>
                </svg>
                <span class="text-black">
                    <span>{{$question->name }}</span>
                </span>
            </h3>
        </div>

        <!-- Form Div -->
        <div class="bg-white p-6 w-full">
            <form method="POST" action="{{ route('courses.tests.questions.update', [$course, $test, $question]) }}" class="px-5 pt-6" enctype="multipart/form-data">
                @csrf
                <!-- Question -->
                <div class="h-24 w-full">
                    <label for="name" class="block font-black required">{{ __('Type Your Question') }}</label>
                    <textarea name="name" placeholder="Enter your question" class="w-full h-full">{{ $question->name }}</textarea>

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
                        @foreach($options as $option)
                            <div class="h-11 mt-4">
                                <input type="radio" id="{{ $option->id }}" name="answer" value="{{ $option->id }}" class="mb-11" {{$option->is_answer == 1? 'checked':''}}>
                                <label for="{{ $option->id }}">
                                    <textarea type="text" name="options[]" class="h-full w-11/12" placeholder="Enter the answer here..." class="block">{{$option->name}}</textarea>
                                </label>
                            </div>
                        @endforeach
                        <x-validation-error name="radio" />
                        <x-validation-error name="options*" />
                    </div>
                </div>
                <!-- Buttons -->
                <div class="mt-10">
                    <button type="submit" class="bg-gray-500 text-white border-0.5 border-2 border-gray-500 font-bold hover: hover:bg-gray-600 hover:border-gray-900 hover:text-white mx-auto px-8 py-1.5 rounded-md">
                        {{ __('Update') }}
                    </button>
                    <div class="bg-blue-100 border-2 font-bold hover:bg-blue-600 hover:border-blue-700 hover:text-white inline ml-4 px-4 py-1.5 rounded-md text-gray-700">
                        <a href="{{ route('courses.units.tests.edit', [$course, $unit, $test]) }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>