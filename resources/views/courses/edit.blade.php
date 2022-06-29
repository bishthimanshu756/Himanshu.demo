<x-app-layout>
    <div class="mx-24 my-6 py-12">

        <!-- BreadCrum Bar -->
        <div class="flex justify-between">
            <div class="flex inline items-center justify-between mb-8">
                <h3 class="font-extrabold text-blue-900 text-xl">
                    <a href="{{ route('courses.index') }}">Courses</a>
                    <span class="text-black"> > {{ $course->title }}</span>
                </h3>
            </div>
            <div class="inline">
                <a href="{{ route('courses.show', $course) }}" class="bg-blue-500 border font-bold hover:bg-blue-600 px-4 py-2 rounded-md text-sm text-white">{{ __('Go to Course Content') }}</a>
            </div>
        </div>

        <!-- Tabs -->
        <div class="w-full bg-blue-100 px-2 py-4 font-semibold">
            <a href="{{ route('courses.edit', $course) }}" class="ml-14">{{ __('Course Information') }}</a>
            <a href="#" class="ml-14">{{ __('Trainers') }}</a>
            <a href="{{ route('courses.users.index', $course) }}" class="ml-14">{{ __('Users') }}</a>
        </div>

        <!-- Edit Form -->
        <div class="p-6 bg-white">
            <form method="POST" action="{{ route('courses.update', $course) }}" class="px-5 pt-6" enctype="multipart/form-data">
                @csrf
                <div class="flex">
                    <!-- Form Left Div-->
                    <div class="w-7/12">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block font-black required">{{ __('What Will Be The Course Name?') }}</label>
                            <input type="text" name="title" value="{{ $course->title }}" required class="border-gray-200 rounded-md w-full" placeholder="Enter Course Name">

                            <x-validation-error name="title" />
                        </div>

                        <!-- Description -->
                        <div class="mt-4 mb-4 h-40">
                            <label for="description" class="block font-black required">{{ __('Provide A Brief Description For What The Course Is About.') }}</label>
                            <textarea name="description" class="h-full border-gray-200 rounded-md w-full" placeholder="Description"> {{ $course->description }} </textarea>

                            <x-validation-error name="description" />
                        </div>

                        <!-- Category Dropdown-->
                        <div class="mt-10">
                            <label for="category_id" class="block font-black">{{ __('What Category Should The Course Be In?') }}</label>
                            <select name="category_id" id="category_id" class="font-semibold border-gray-200 rounded-md w-full">
                                @foreach($categories as $category)
                                <option name="category_id" value="{{ $category->id }}" class=" w-full" {{$category->id == $course->category_id ? 'selected' : ''}}>{{ $category->name }}</option>
                                @endforeach
                            </select>

                            <x-validation-error name="category_id" />
                        </div>

                        <!-- Level Dropdown-->
                        <div class="mt-4">
                            <label for="level_id" class="block font-black">{{ __('What Is The Level Of The Course?') }}</label>
                            <select name="level_id" id="level_id" class="font-semibold border-gray-200 rounded-md w-full">
                                @foreach($levels as $level)
                                <option name="level_id" value="{{ $level->id }}" class=" w-full" {{ $level->id == $course->level_id ? 'selected': '' }}>{{ $level->name }}</option>
                                @endforeach
                            </select>

                            <x-validation-error name="level_id" />
                        </div>

                        <!-- Certificate checkbox -->
                        <div class="mt-4">
                            <input type="checkbox" name="certificate" value="1" {{ $course->certificate == 1 ? 'checked' : '' }}>
                            <label for="certificate" class="align-middle" >Certificate?</label>
                        </div>
                    </div>
                    <!-- Form Right Div-->
                    <div class="5/12">
                        <input type="file" name="image" placeholder="Choose Image">
                    </div>
                </div>
                <!-- Buttons -->
                <div class="mt-4">
                    <button type="submit" class="bg-gray-500 text-white border-0.5 border-2 border-gray-500 font-bold hover: hover:bg-gray-600 hover:border-gray-900 hover:text-white mx-auto px-8 py-1.5 rounded-md">
                        {{ __('Update Course') }}
                    </button>
                    <div class="bg-blue-100 border-2 font-bold hover:bg-blue-600 hover:border-blue-700 hover:text-white inline ml-4 px-4 py-1.5 rounded-md text-gray-700">
                        <a href="{{ route('courses.index') }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>