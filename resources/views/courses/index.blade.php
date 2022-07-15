<x-app-layout>
    @php
        $categories = App\Models\Category::get();
        $levels = App\Models\Level::get();
    @endphp
    <div class="py-12 mb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-4 py-4 ">
                <div class="flex items-center justify-between ">
                    <h3 class="font-extrabold text-blue-900 text-xl">
                        Courses
                    </h3>
                    @if (auth()->user()->role_id != App\Models\Role::EMPLOYEE)
                        <a href="{{ route( 'courses.create' ) }}" class="bg-blue-400 border font-bold hover:bg-white hover:text-blue-900 p-2 rounded-md text-center text-sm text-white">
                            {{ __('Create New Course') }}
                        </a>
                    @endif
                </div>
                <!-- Filters and Search Div -->
                <div class="flex justify-between w-full mt-4">
                    <div class="flex w-full">
                        <!-- Search -->
                        <form method="get" action="{{ route('courses.index') }}" class="bg-white border border-gray-200 py-1 rounded-md w-1/3">
                            <input type="text" name="search" value="{{ request()->input('search') }}" class="text-sm border-0 h-8 ml-4 px-4 py-4 w-10/12" placeholder="Search by Name or Description">
                            <button type="submit">
                                <svg class="w-4 h-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </form>

                        <!-- Category and Level Filter Wrapper -->
                        <div class="flex ml-4">
                            <!-- Category Filter -->
                            <div x-data="{ show:false}" @click.away="show = false" class="bg-white border-2 font-semibold inline px-4 py-2 relative text-sm">
                                <button @click="show = !show">
                                    {{ isset($currentCategory) ? $currentCategory->name : __('Category') }}
                                    <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.098 8H6.902c-.751 0-1.172.754-.708 1.268L9.292 12.7c.36.399 1.055.399 1.416 0l3.098-3.433C14.27 8.754 13.849 8 13.098 8z"></path>
                                    </svg>
                                </button>
                                <div x-show="show" class="absolute bg-white border-2 border-black-600 left-0 mt-2 w-30 z-50" style="display: none;">
                                    <form action="{{ route('courses.index') }}" method="get" class="max-h-28 overflow-y-auto bg-gray-100">
                                        @if(request()->level)
                                            <input type="hidden" name="level" value="{{ request()->level }}">
                                        @endif
                                        @foreach($categories as $category)
                                            <button name="category" value="{{ $category->id }}" class="w-full text-left hover:bg-gray-300 py-1 px-2">{{ $category->name }}</button>
                                        @endforeach
                                    </form>
                                </div>
                            </div>
                            <!-- Level Filter -->
                            <div x-data="{ show:false}" @click.away="show = false" class="bg-white border-2 font-semibold inline px-4 py-2 relative text-sm ml-4 text-left">
                                <button @click="show = !show">
                                    {{ isset($currentLevel)? $currentLevel->name : __('Level') }}
                                    <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.098 8H6.902c-.751 0-1.172.754-.708 1.268L9.292 12.7c.36.399 1.055.399 1.416 0l3.098-3.433C14.27 8.754 13.849 8 13.098 8z"></path>
                                    </svg>
                                </button>
                                <div x-show="show" class="absolute bg-white border-2 border-black-600 left-0 mt-2 w-24 z-50" style="display: none;">
                                    <form action="{{ route('courses.index') }}" method="get" class="max-h-28 overflow-y-auto bg-gray-100">
                                        @if(request()->category)
                                            <input type="hidden" name="category" value="{{ request()->category }}">
                                        @endif
                                        @foreach($levels as $level)
                                            <button name="level" value="{{ $level->id }}" class="w-full text-left hover:bg-gray-300 py-1 px-2">{{ $level->name }}</button>
                                        @endforeach
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <form action="{{ route('courses.index') }}" method="get">
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
                                    <img src="{{ asset('/storage/'.$course->image->image_path) }}" alt="images"  class="h-full object-fill w-full">
                                </div>
                                <div class="inline w-4/5 ml-8 p-4">
                                    <div class="flex justify-between">
                                        <span class="bg-gray-100 border font-bold px-6 py-0.5 text-gray-400 text-sm">
                                            {{$course->category->name}}
                                        </span>
                                        <div>
                                            <span class="mr-2.5 border text-sm text-green-500 bg-green-100 rounded-md py-0.5 px-2.5">{{ $course->status->name }}</span>
                                            <div x-data="{ show:false}" @click.away="show = false" class="relative inline">
                                                <button @click="show = !show">
                                                    <svg class="w-6 h-6 inline" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path d="M10.001 7.8a2.2 2.2 0 1 0 0 4.402A2.2 2.2 0 0 0 10 7.8zm-7 0a2.2 2.2 0 1 0 0 4.402A2.2 2.2 0 0 0 3 7.8zm14 0a2.2 2.2 0 1 0 0 4.402A2.2 2.2 0 0 0 17 7.8z"></path>
                                                    </svg>
                                                </button>
                                                <div x-show="show" class="absolute border-2 border-black-600 w-50 z-50 right-0" style="display:none;">
                                                    <a href="{{ route('courses.edit', $course) }}" class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7">{{ __('Edit') }}
                                                    </a>
                                                    <form action="{{ route('courses.status', $course) }}" method="POST">
                                                        @csrf
                                                        @if($course->status->name == 'Draft')
                                                            <button type="submit" name="statusId" value="1" class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7 w-full">{{ __('Published') }}</button>
                                                            <button type="submit" name="statusId" value="3" class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7 w-full">{{ __('Archived') }}</button>
                                                        @elseif($course->status->name == 'Published')
                                                            <button type="submit" name="statusId" value="2" class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7 w-full">{{ __('Draft') }}</button>
                                                            <button type="submit" name="statusId" value="3" class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7 w-full">{{ __('Archived') }}</button>
                                                        @else
                                                            <button type="submit" name="statusId" value="1" class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7 w-full">{{ __('Published') }}</button>
                                                            <button type="submit" name="statusId" value="2" class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7 w-full">{{ __('Draft') }}</button>
                                                        @endif
                                                    </form>
                                                    <a href="{{ route('courses.users.index', $course) }}" class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7">{{ __('Users') }}</a>
                                                    <a href="{{ route('courses.delete', $course) }}" class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7">{{__('Delete')}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-2xl mt-2">
                                        <a href="{{ route('courses.edit', $course) }}">
                                            {{ $course->title }}
                                        </a>
                                    </div>
                                    <div class="text-sm mt-2">
                                        <span class="font-serif text-gray-400">{{ __('Created By: ') }}</span>
                                        <span class="font-bold">{{ $course->user->full_name }}</span>
                                        |
                                        <span class="font-serif text-gray-400">{{ __('Created On: ') }} </span>
                                        <span class="font-bold">{{ $course->created_at->format('M-d-Y') }}</span>
                                    </div>
                                    <div class="mr-16 text-gray-500 mt-2">
                                        {{ $course->description }}
                                    </div>
                                    <div class="mt-4">
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
                                        <svg class="align-middle h-4 inline w-4 text-gray-700 ml-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                                            <path d="M216,40H136V24a8,8,0,0,0-16,0V40H40A16,16,0,0,0,24,56V176a16,16,0,0,0,16,16H79.4L57.8,219A8,8,0,0,0,64,232a7.8,7.8,0,0,0,6.2-3l29.6-37h56.4l29.6,37a7.8,7.8,0,0,0,6.2,3,8,8,0,0,0,6.2-13l-21.6-27H216a16,16,0,0,0,16-16V56A16,16,0,0,0,216,40Zm0,136H40V56H216V176ZM104,120v24a8,8,0,0,1-16,0V120a8,8,0,0,1,16,0Zm32-16v40a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm32-16v56a8,8,0,0,1-16,0V88a8,8,0,0,1,16,0Z"></path>
                                        </svg>
                                        <span class="align-middle text-sm text-gray-600 ml-2">
                                            {{ $course->enrollments->count(). __(' Enrolled') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="bg-white border-b rounded-md border-gray-200 mt-6 w-full max-h-54 overflow-hidden">
                            <div class="flex mt-0.5 px-4 py-1">
                                <span class="font-semibold italic ml-10 py-4 text-gray-400 text-xl">
                                    {{ __('No Records Found...') }}
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