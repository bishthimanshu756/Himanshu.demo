<x-app-layout>
    <div class="py-12 mb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-4 py-4 ">
                <div class="flex items-center justify-between ">
                    <h3 class="font-extrabold text-blue-900 text-xl">
                        {{ __('My Courses') }}
                    </h3>
                </div>
                <div class="border-b mt-6 pb-4">
                    <a href="{{ route('my-courses.index') }}" class="px-10">
                        {{ __('All Courses') }}
                    </a>
                    <a href="#" class="px-10">
                        {{ __('New') }}
                    </a>
                    <a href="#" class="px-10">
                        {{ __('In-Progress') }}
                    </a>
                    <a href="#" class="px-10">
                        {{ __('Completed') }}
                    </a>
                </div>
                <!-- Filters and Search Div -->
                <div class="flex justify-between w-full mt-4">
                    <!-- Search -->
                    <form method="get" action="{{ route('my-courses.index') }}" class="bg-white border border-gray-200 py-1 rounded-md w-1/3">
                        <input type="text" name="search" value="{{ request()->input('search') }}" class="text-sm border-0 h-8 ml-4 px-4 py-4 w-10/12" placeholder="Search by Name or Description">
                        <button type="submit">
                            <svg class="w-4 h-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </form>
                    <!-- Sort By Filter -->
                    <div x-data="{ show:false}" @click.away="show = false" class="bg-white border-2 font-semibold px-1.5 py-2 relative text-middle text-sm w-52">
                        <button @click="show = !show" class="w-full">
                            @if(request('orderBy') == 'a-z')
                                {{ __('Name A To Z') }}
                            @elseif(request('orderBy') == 'z-a')
                                {{ __('Name Z To A') }}
                            @elseif(request('orderBy') == 'asc')
                                {{ __('Latest Created Date') }}
                            @else
                                {{ __('Oldest Created Date') }}
                            @endif
                            <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.098 8H6.902c-.751 0-1.172.754-.708 1.268L9.292 12.7c.36.399 1.055.399 1.416 0l3.098-3.433C14.27 8.754 13.849 8 13.098 8z"></path>
                            </svg>
                        </button>
                        <div x-show="show" class="absolute bg-white border-2 left-0 mt-1 p-2 w-44 z-50" style="display: none;">
                            <form action="{{ route('my-courses.index') }}" method="get">
                                <button name="orderBy" value="a-z" class="hover:bg-gray-200 py-0.5 w-full text-left">{{ __('Name A To Z') }}</button>
                                <button name="orderBy" value="z-a" class="hover:bg-gray-200 py-0.5 w-full text-left">{{ __('Name Z To A') }}</button>
                                <button name="orderBy" value="asc" class="hover:bg-gray-200 py-0.5 w-full text-left">{{ __('Latest Created Date') }}</button>
                                <button name="orderBy" value="desc" class="hover:bg-gray-200 py-0.5 w-full text-left">{{ __('Oldest Created Date') }}</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Listing -->
                <div>
                    @if($courses->count())
                    @foreach($courses as $course)
                        <div class="bg-white border-b rounded-md border-gray-200 mt-6 w-full max-h-54 overflow-hidden">
                            <div class="flex mt-0.5 px-4 py-1">
                                <div class="p-3 w-1/5 bg-gray-200">
                                    <img src="{{ asset('/storage/'.$course->image->image_path) }}" alt="images"  class="h-44 object-fill w-full">
                                </div>
                                <div class="inline w-4/5 ml-8 p-4">
                                    <div class="flex justify-between">
                                        <span class="bg-gray-100 border font-bold px-6 py-0.5 text-gray-400 text-sm rounded-md">
                                            {{ $course->category->name }}
                                        </span>
                                        @if($course->certificate == 1)
                                            <div>
                                                <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" fill="darkgreen">
                                                    <path d="M866.9 169.9L527.1 54.1C523 52.7 517.5 52 512 52s-11 .7-15.1 2.1L157.1 169.9c-8.3 2.8-15.1 12.4-15.1 21.2v482.4c0 8.8 5.7 20.4 12.6 25.9L499.3 968c3.5 2.7 8 4.1 12.6 4.1s9.2-1.4 12.6-4.1l344.7-268.6c6.9-5.4 12.6-17 12.6-25.9V191.1c.2-8.8-6.6-18.3-14.9-21.2zM694.5 340.7L481.9 633.4a16.1 16.1 0 0 1-26 0l-126.4-174c-3.8-5.3 0-12.7 6.5-12.7h55.2c5.1 0 10 2.5 13 6.6l64.7 89 150.9-207.8c3-4.1 7.8-6.6 13-6.6H688c6.5.1 10.3 7.5 6.5 12.8z"></path>
                                                </svg>
                                                <span>
                                                    {{__('Certification')}}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="text-2xl mt-2">
                                        {{ $course->title }}
                                    </div>
                                    <div class="text-sm mt-2">
                                        {{ $course->pivot->completed_percentage.__( '% Completed')}}
                                    </div>
                                    <div class="mr-16 text-gray-500 mt-2">
                                        {{ $course->description }}
                                    </div>
                                    <div class="mt-4 flex justify-between">
                                        <div>
                                            <svg class="align-middle h-4 inline w-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="currentColor">
                                                <defs></defs>
                                                <title>skill-level--intermediate</title>
                                                <path d="M30,30H22V4h8Zm-6-2h4V6H24Z"></path>
                                                <path d="M20,30H12V12h8Z"></path>
                                                <path d="M10,30H2V18h8Z"></path>
                                                <rect id="_Transparent_Rectangle_" data-name="<Transparent Rectangle>" class="cls-1" width="32" height="32" style="fill: none"></rect>
                                            </svg>
                                            <span class="align-middle text-sm text-gray-600 ml-2">
                                                {{ $course->level->name }}
                                            </span>
                                            <svg class="align-middle h-4 inline w-4 text-gray-700 ml-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"></path>
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"></path>
                                            </svg>
                                            <span class="align-middle text-sm text-gray-600 ml-2">
                                                {{ date('i:s', $course->units->sum('duration')) }}
                                            </span>
                                            <svg class="align-middle h-4 inline w-4 text-gray-700 ml-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                                                <path d="M216,40H136V24a8,8,0,0,0-16,0V40H40A16,16,0,0,0,24,56V176a16,16,0,0,0,16,16H79.4L57.8,219A8,8,0,0,0,64,232a7.8,7.8,0,0,0,6.2-3l29.6-37h56.4l29.6,37a7.8,7.8,0,0,0,6.2,3,8,8,0,0,0,6.2-13l-21.6-27H216a16,16,0,0,0,16-16V56A16,16,0,0,0,216,40Zm0,136H40V56H216V176ZM104,120v24a8,8,0,0,1-16,0V120a8,8,0,0,1,16,0Zm32-16v40a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm32-16v56a8,8,0,0,1-16,0V88a8,8,0,0,1,16,0Z"></path>
                                            </svg>
                                            <span class="align-middle text-sm text-gray-600 ml-2">
                                                {{ $course->units->sum('lesson_count')  . __(' Lessons') }}
                                            </span>
                                        </div>
                                        <div>
                                            <a href="{{ route('my-courses.show', $course) }}" class="border border-blue-400 px-2 py-1 rounded-md text-blue-400">
                                                <span>
                                                    {{ __('View') }}
                                                </span>
                                                <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="none" viewBox="0 0 24 24">
                                                    <path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="bg-white border-b rounded-md border-gray-200 mt-6 w-full max-h-54 overflow-hidden">
                            <div class="flex mt-0.5 px-4 py-1">
                                <span class="font-semibold italic ml-10 py-4 text-gray-400 text-xl">
                                    {{ __('No Courses Found...') }}
                                </span>
                            </div>
                        </div>
                    @endif
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>