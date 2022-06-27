<x-app-layout>
    <div class="h-screen overflow-x-auto py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-4 py-4 ">
                <div class="flex items-center justify-between ">
                    <h3 class="font-extrabold text-blue-900 text-xl">Courses</h3>
                    @if (auth()->user()->role_id != 4)
                    <a href="{{ route( 'courses.create' ) }}" class="bg-blue-400 border font-bold hover:bg-white hover:text-blue-900 p-2 rounded-md text-center text-sm text-white w-32">{{ __('Create Course') }}</a>
                    @endif

                </div>

                <!-- Filters -->
                <div class="flex justify-between mt-4">
                    <div class="flex w-full">
                        <form method="get" action="{{ route('courses.index') }}" class="bg-white border border-gray-200 py-1 rounded-md w-1/3">
                            <input type="text" name="search"  class= "border-0 h-8 px-4 py-4 w-11/12" placeholder="Search by Name or Email">
                            <button type="submit">
                                <svg class="w-4 h-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </form>
                        <div class="ml-4">
                            <select>
                                <option>Category</option>
                            </select>
                        </div>
                        <div class="ml-4">
                            <select>
                                <option>Level</option>
                            </select>
                        </div>
                    </div>
                    <div class="inline">
                        <select>
                            <option>{{ __('Sort By') }}</option>
                        </select>
                    </div>
                </div>

                <!-- Listing -->
                <div>
                    @foreach($courses as $course)
                        <div class="bg-white border-b rounded-md border-gray-200 mt-6 w-full max-h-54 overflow-hidden">
                            <div class="flex mt-0.5 px-4 py-1">
                                <div class="p-3 w-1/5">
                                    <img src="#" alt="image" class="inline ">
                                </div>
                                <div class="inline w-4/5 ml-8 p-4">
                                    <div class="flex justify-between">
                                        <span class="bg-gray-100 border font-bold px-6 py-0.5 text-gray-400 text-sm">
                                            {{$course->category->name}}
                                        </span>
                                        <div x-data="{ show:false}" @click.away="show = false" class="relative">
                                            <button @click="show = !show">
                                                <svg class="w-6 h-6 inline" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path d="M10.001 7.8a2.2 2.2 0 1 0 0 4.402A2.2 2.2 0 0 0 10 7.8zm-7 0a2.2 2.2 0 1 0 0 4.402A2.2 2.2 0 0 0 3 7.8zm14 0a2.2 2.2 0 1 0 0 4.402A2.2 2.2 0 0 0 17 7.8z"></path>
                                                </svg>
                                            </button>
                                            <div x-show="show" class="absolute border-2 border-black-600 w-50 z-50" style="display:none;">
                                                <a href="{{ route('courses.edit', $course) }}" class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7">{{ __('Edit') }}</a>
                                                <a href="{{ route('courses.delete', $course) }}" class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7">{{__('Delete')}}</a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="text-2xl mt-2">{{ $course->title }}</div>
                                    <div class="text-sm mt-2">
                                        <span class="font-serif text-gray-400">{{ __('Created By: ') }}</span> 
                                        <span class="font-bold">{{ $course->user->full_name }}</span>
                                        |
                                        <span class="font-serif text-gray-400">{{ __('Created On: ') }} </span> 
                                        <span class="font-bold">{{ $course->created_at->format('M-d-Y') }}</span>
                                    </div>
                                    <div class="mr-16 text-gray-500 mt-2">{{ $course->description }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $courses->links() }}
            </div>
        </div>
    </div>
</x-app-layout>