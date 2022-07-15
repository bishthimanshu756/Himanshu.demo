<x-app-layout>
    <div class="mx-24 my-6 py-12">

        <!-- BreadCrum Bar -->
        <div class="flex justify-between">
            <div class="flex inline items-center justify-between mb-8">
                <h3 class="font-extrabold text-blue-900 text-xl">
                    <a href="{{ route('courses.index') }}">Courses</a>
                    <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <line x1="13" y1="18" x2="19" y2="12"></line>
                        <line x1="13" y1="6" x2="19" y2="12"></line>
                    </svg>
                    <a href="{{ route('courses.edit', $course) }}"> {{ $course->title }}</a>
                </h3>
            </div>
            <div class="inline">
                <a href="{{ route('courses.units.create', $course) }}" class="bg-blue-500 border font-bold hover:bg-blue-600 px-4 py-2 rounded-md text-sm text-white">
                    {{ __('Add Unit') }}
                </a>
            </div>
        </div>
        <!-- Course Details Div -->
        <div class="bg-white px-6 py-4 rounded-md">
            <div class="w-full bg-white flex mb-4">
                <div class="object-fill w-1/4">
                    <img src="{{ asset('/storage/'.$course->image->image_path) }}" alt="image" class="h-full object-fill w-full">
                </div>
                <div class="w-3/4 relative ml-6">
                    <a class="absolute bg-gray-100 border font-bold px-4 py-1 right-0 rounded-md text-blue-700 text-xs" href="{{ route('courses.edit',$course) }}">
                        <svg class="w-4 h-4 inline" xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                        {{ __('Edit Basic Info') }}
                    </a>
                    <div class="mt-8">
                        <h2 class="font-bold text-2xl text-gray-700">
                            {{ $course->title }}
                        </h2>
                    </div>
                    <span class="font-semibold text-gray-500">
                        {{ $course->description }}
                    </span>
                </div>
            </div>
            <hr>
            <div class="flex justify-between bg-white mt-4 mb-4">
                <div class="inline">
                    <svg class="w-6 h-6 " xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"></path>
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"></path>
                    </svg>
                    <div class="mt-2">{{ __('Course Duration') }}</div>
                    <div class="font-semibold mt-2">{{ date('i:s', $course->units->sum('duration')) }}</div>
                </div>
                <div class="inline">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 13v-1m4 1v-3m4 3V8M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                    </svg>
                    <div class="mt-2">{{ __('Total Unit') }}</div>
                    <div class="font-semibold mt-2">{{ $course->units->count() }}</div>
                </div>
                <div class="inline">
                    <svg class="w-6 h-6 " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M3.302 12.238c.464 1.879 1.054 2.701 3.022 3.562 1.969.86 2.904 1.8 3.676 1.8.771 0 1.648-.822 3.616-1.684 1.969-.861 1.443-1.123 1.907-3.002L10 15.6l-6.698-3.362zm16.209-4.902l-8.325-4.662c-.652-.365-1.72-.365-2.372 0L.488 7.336c-.652.365-.652.963 0 1.328l8.325 4.662c.652.365 1.72.365 2.372 0l5.382-3.014-5.836-1.367a3.09 3.09 0 0 1-.731.086c-1.052 0-1.904-.506-1.904-1.131 0-.627.853-1.133 1.904-1.133.816 0 1.51.307 1.78.734l6.182 2.029 1.549-.867c.651-.364.651-.962 0-1.327zm-2.544 8.834c-.065.385 1.283 1.018 1.411-.107.579-5.072-.416-6.531-.416-6.531l-1.395.781c0-.001 1.183 1.125.4 5.857z"></path>
                    </svg>
                    <div class="mt-2">{{ __('Course Level') }}</div>
                    <div class="font-semibold mt-2">{{$course->level->name }}</div>
                </div>
                <div class="inline">
                    <svg class="w-6 h-6 " xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="currentColor">
                        <g><rect fill="none" height="24" width="24" x="0"></rect></g><g><g><g><path d="M21,10.12h-6.78l2.74-2.82c-2.73-2.7-7.15-2.8-9.88-0.1c-2.73,2.71-2.73,7.08,0,9.79s7.15,2.71,9.88,0 C18.32,15.65,19,14.08,19,12.1h2c0,1.98-0.88,4.55-2.64,6.29c-3.51,3.48-9.21,3.48-12.72,0c-3.5-3.47-3.53-9.11-0.02-12.58 s9.14-3.47,12.65,0L21,3V10.12z M12.5,8v4.25l3.5,2.08l-0.72,1.21L11,13V8H12.5z"></path></g></g></g>
                    </svg>
                    <div class="mt-2">{{ __('Last Updated') }}</div>
                    <div class="font-semibold mt-2">{{ $course->updated_at->format('M d, Y') }}</div>
                </div>
                <div class="inline">
                    <svg class="w-6 h-6 " xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="15" cy="15" r="3"></circle>
                        <path d="M13 17.5v4.5l2 -1.5l2 1.5v-4.5"></path>
                        <path d="M10 19h-5a2 2 0 0 1 -2 -2v-10c0 -1.1 .9 -2 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -1 1.73"></path>
                        <line x1="6" y1="9" x2="18" y2="9"></line>
                        <line x1="6" y1="12" x2="9" y2="12"></line>
                        <line x1="6" y1="15" x2="8" y2="15"></line>
                    </svg>
                    <div class="mt-2">{{ __('Certificate of Completion') }}</div>
                    <div class="font-semibold mt-2">{{ ($course->certificate == 1) ? __('Yes') : __('No') }}</div>
                </div>
            </div>
        </div>

        <h3 class="font-bold mt-8 text-2xl">{{ __('Course content') }}</h3>

        <!-- Unit Listing -->
        <div class="">
            @foreach($units as $unit)
                <div class="bg-white mt-8 px-4 py-2 mb-4 ">
                    <div class="mt-2 px-1.5">
                        <div class="flex">
                            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                                <path d="M108,60A16,16,0,1,1,92,44,16,16,0,0,1,108,60Zm56,16a16,16,0,1,0-16-16A16,16,0,0,0,164,76ZM92,112a16,16,0,1,0,16,16A16,16,0,0,0,92,112Zm72,0a16,16,0,1,0,16,16A16,16,0,0,0,164,112ZM92,180a16,16,0,1,0,16,16A16,16,0,0,0,92,180Zm72,0a16,16,0,1,0,16,16A16,16,0,0,0,164,180Z"></path>
                            </svg>
                            <div class="flex flex-grow justify-between ml-2">
                                <span class="text-3xl text-gray-600">{{ $unit->title }}</span>
                                <div class="flex">
                                    <a href="{{ route('courses.units.edit',[$course, $unit]) }}" class="bg-blue-100 border mr-4 px-3 py-1.5 rounded-md text-blue-600 text-xs font-semibold">
                                        <svg class="align-text-bottom h-4 inline w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="blue" stroke="skyblue" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                        <span>
                                            {{ __('Edit Section') }}
                                        </span>
                                    </a>
                                    <a href="{{ route('courses.units.delete', [$course, $unit]) }}" class="border-red-100 border mr-4 px-3 py-1.5 rounded-md text-red-600 text-xs font-semibold">
                                        <svg class="w-4 h-4 inline align-text-bottom" xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke="white">
                                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"></path>
                                        </svg>
                                        <span>
                                            {{ __('Delete') }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 ml-10">
                            {{ $unit->description }}
                        </div>
                        <!-- Lessons -->
                        <div class="ml-10">
                            <div class="bg-gray-100 flex justify-between p-1 pl-4 mt-4 rounded-md">
                                <span>{{ __('Lessons') }}</span>
                                <span>{{ __('Duration: ') .$unit->lessons->sum('duration') . __('s')}}</span>
                            </div>
                            <div class="bg-white">
                                @if($unit->lessons->count())
                                    @foreach($unit->lessons as $lesson)
                                        <div class="flex">
                                            <svg class="inline h-6 border bg-gray-200 m-2 rounded-full" width="24" height="24" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 11H14.5H17" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M12 7H14.5H17" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M8 15V3.6C8 3.26863 8.26863 3 8.6 3H20.4C20.7314 3 21 3.26863 21 3.6V17C21 19.2091 19.2091 21 17 21V21" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M5 15H8H12.4C12.7314 15 13.0031 15.2668 13.0298 15.5971C13.1526 17.1147 13.7812 21 17 21H8H6C4.34315 21 3 19.6569 3 18V17C3 15.8954 3.89543 15 5 15Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                            <div class="flex flex-grow py-2">
                                                <span class="flex-grow">
                                                    {{ $lesson->name }}
                                                </span>
                                                <span class="bg-blue-100 border pt-0.5 rounded-full text-blue-600 text-center text-sm px-2">
                                                    {{ $lesson->test->total_questions . __(' Questions') }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="p-2">
                                        <span class="font-semibold italic ml-10 py-4 text-gray-400 text-xl">
                                            {{ __('No Lessons Available') }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>