<x-app-layout>
    @php
        $categories = App\Models\Category::visibleTo()->get();
        $levels = App\Models\Level::get();
    @endphp
    <div class="mx-24 my-6 py-12">
        <div class="flex items-center justify-between mb-8">
            <h3 class="font-extrabold text-blue-900 text-xl">
                <a href="{{ route('courses.index') }}">Courses</a>
                <span class="text-black"> > Create Course</span>
            </h3>
        </div>
        <div class="p-6 bg-white">
            <form method="POST" action="{{ route('courses.store') }}" class="px-5 pt-6" enctype="multipart/form-data">
                @csrf
                <div class="flex">
                    <!-- Form Left Div-->
                    <div class="w-7/12">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block font-black required">{{ __('What Will Be The Course Name?') }}</label>
                            <input type="text" name="title" value="{{ old('title') }}" required class="border-gray-200 rounded-md w-full" placeholder="Enter Course Name">

                            <x-validation-error name="title" />
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <label for="description" class="block font-black required">{{ __('Provide A Brief Description For What The Course Is About.') }}</label>
                            <textarea name="description" value="{{ old('description') }}" class="border-gray-200 rounded-md w-full" placeholder="Description" required></textarea>

                            <x-validation-error name="description" />
                        </div>

                        <!-- Category Dropdown-->
                        <div class="mt-4">
                            <label for="category_id" class="block font-black">{{ __('What Category Should The Course Be In?') }}</label>
                            <select name="category_id" id="category_id" class="font-semibold border-gray-200 rounded-md w-full">
                                @foreach($categories as $category)
                                <option name="category_id" value="{{ $category->id }}" class=" w-full">{{ $category->name }}</option>
                                @endforeach
                            </select>

                            <x-validation-error name="category_id" />
                        </div>

                        <!-- Level Dropdown-->
                        <div class="mt-4">
                            <label for="level_id" class="block font-black">{{ __('What Is The Level Of The Course?') }}</label>
                            <select name="level_id" id="level_id" class="font-semibold border-gray-200 rounded-md w-full">
                                @foreach($levels as $level)
                                <option name="level_id" value="{{ $level->id }}" class=" w-full">{{ $level->name }}</option>
                                @endforeach
                            </select>

                            <x-validation-error name="level_id" />
                        </div>

                        <!-- Certificate checkbox -->
                        <div class="mt-4">
                            <input type="checkbox" name="certificate" value="1" >
                            <label for="certificate" class="align-middle">{{ __('Certificate?') }}</label>
                        </div>
                    </div>
                    <!-- Form Right Div-->
                    <div class="ml-40 mt-32 w-1/4">
                        <svg class="h-36 w-36" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="skyblue" viewBox="0 0 16 16">
                            <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"></path>
                        </svg>
                        <input type="file" name="image" placeholder="Upload" class="w-52">
                        <div>
                            <span class="font-bold text-xs">
                                {{ __('Upload Course Cover Image') }}
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Buttons -->
                <div class="mt-4">
                    <button type="submit" class="bg-gray-500 text-white border-0.5 border-2 border-gray-500 font-bold hover: hover:bg-gray-600 hover:border-gray-900 hover:text-white mx-auto px-8 py-1.5 rounded-md">
                        Create Course
                    </button>
                    <div class="bg-blue-100 border-2 font-bold hover:bg-blue-600 hover:border-blue-700 hover:text-white inline ml-4 px-4 py-1.5 rounded-md text-gray-700">
                        <a href="{{ route('courses.index') }}"> {{ __('Cancel') }} </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>