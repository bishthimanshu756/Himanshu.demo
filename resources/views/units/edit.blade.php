<x-app-layout>
    <div class="mx-24 my-6 py-12">
        <!-- BreadCrum Bar -->
        <div class="flex items-center justify-between mb-8">
            <h3 class="font-extrabold text-blue-900 text-xl">
                <a href="{{ route('courses.index') }}">
                    {{ __('Courses') }}
                </a>
                <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <line x1="13" y1="18" x2="19" y2="12"></line>
                    <line x1="13" y1="6" x2="19" y2="12"></line>
                </svg>
                <a href="{{ route('courses.show', $course) }}">
                    {{ $course->title }}
                </a>
                <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <line x1="13" y1="18" x2="19" y2="12"></line>
                    <line x1="13" y1="6" x2="19" y2="12"></line>
                </svg>
                <span class="text-black">
                    {{ __('Edit ').$unit->title}}
                </span>
            </h3>
        </div>
        <!-- Edit Form Div -->
        <div class="flex bg-white">
            <!-- Left Div Edit Form -->
            <div class="p-6 w-1/2">
                <form method="POST" action="{{ route('courses.units.update', [$course, $unit]) }}" class="px-5 pt-6" enctype="multipart/form-data">
                    @csrf
                    <!-- Title -->
                    <div>
                        <label for="title" class="block font-black required">
                            {{ __('Title') }}
                        </label>
                        <input type="text" name="title" value="{{ $unit->title }}" required class="border-gray-200 rounded-md w-full" placeholder="Enter Unit Name">

                        <x-validation-error name="title" />
                    </div>

                    <!-- Description -->
                    <div class="mt-4 mb-4 h-40">
                        <label for="description" class="block font-black required">
                            {{ __('Description') }}
                        </label>
                        <textarea name="description" class="h-full border-gray-200 rounded-md w-full" placeholder="Description" required>{{ $unit->description }}</textarea>

                        <x-validation-error name="description"/>
                    </div>
                    <!-- Buttons -->
                    <div class="mt-10">
                        <button type="submit" class="bg-gray-500 text-white border-0.5 border-2 border-gray-500 font-bold hover: hover:bg-gray-600 hover:border-gray-900 hover:text-white mx-auto px-8 py-1.5 rounded-md">
                            {{ __('Update') }}
                        </button>
                        <div class="bg-blue-100 border-2 font-bold hover:bg-blue-600 hover:border-blue-700 hover:text-white inline ml-4 px-4 py-1.5 rounded-md text-gray-700">
                            <a href="{{ route('courses.show', $course) }}">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Right Div Files -->
            <div class="mt-8 pl-24 w-1/2">
                <div class="flex">
                    <div class="border rounded-md text-center w-2/5">
                        <svg class="inline w-20 h-20 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                            <path d="M112,180l32-16v49.2L112,196v12a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V168a8,8,0,0,1,8-8h56a8,8,0,0,1,8,8ZM152,32V88h56Z" opacity="0.2"></path><path d="M216,88a7.8,7.8,0,0,0-2.4-5.7l-55.9-56A8.1,8.1,0,0,0,152,24H56A16,16,0,0,0,40,40v88a8,8,0,0,0,16,0V40h88V88a8,8,0,0,0,8,8h48V216H176a8,8,0,0,0,0,16h24a16,16,0,0,0,16-16V88ZM160,51.3,188.7,80H160ZM148.2,157.2a8,8,0,0,0-7.8-.4L120,167.1A16.1,16.1,0,0,0,104,152H48a16,16,0,0,0-16,16v40a16,16,0,0,0,16,16h56a16,16,0,0,0,15.9-14.7l20.3,10.9a7.5,7.5,0,0,0,3.8,1,7.8,7.8,0,0,0,4.1-1.2,7.9,7.9,0,0,0,3.9-6.8V164A7.9,7.9,0,0,0,148.2,157.2ZM104,208H48V168h56v40Zm32-8.2-16-8.6v-6.3l16-8Z"></path>
                        </svg>
                        <span class="block text-sm">
                            {{ __('+ Add Video') }}
                        </span>
                    </div>
                    <div class="border rounded-md text-center w-2/5 ml-8">
                        <svg class=" h-20  inline w-20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                            <path d="M214,88a6,6,0,0,0-1.8-4.3l-56-55.9A5.6,5.6,0,0,0,152,26H56A14,14,0,0,0,42,40v88a6,6,0,0,0,12,0V40a2,2,0,0,1,2-2h90V88a6,6,0,0,0,6,6h50V216a2,2,0,0,1-2,2H168a6,6,0,0,0,0,12h32a14,14,0,0,0,14-14V88ZM158,46.5,193.5,82H158ZM98.5,146.6a5.8,5.8,0,0,0-6.3.8L69.8,166H48a6,6,0,0,0-6,6v32a6,6,0,0,0,6,6H69.8l22.4,18.6A5.9,5.9,0,0,0,96,230a5.4,5.4,0,0,0,2.5-.6A5.9,5.9,0,0,0,102,224V152A5.9,5.9,0,0,0,98.5,146.6ZM90,211.2,75.8,199.4A5.7,5.7,0,0,0,72,198H54V178H72a5.7,5.7,0,0,0,3.8-1.4L90,164.8ZM146,188a38.1,38.1,0,0,1-14.2,29.7A7,7,0,0,1,128,219a6,6,0,0,1-3.8-10.7,25.9,25.9,0,0,0,0-40.6,6,6,0,0,1-.9-8.4,6.1,6.1,0,0,1,8.5-1A38.1,38.1,0,0,1,146,188Z"></path>
                        </svg>
                        <span class="block text-sm">
                            {{ __('+ Add Audio') }}
                        </span>
                    </div>
                </div>
                <div class="mt-8 flex">
                    <div class="border rounded-md text-center w-2/5">
                        <svg class="h-20 inline w-20 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                            <path d="M18.5 20C18.5 20.275 18.276 20.5 18 20.5H12.2678C11.9806 21.051 11.6168 21.5557 11.1904 22H18C19.104 22 20 21.104 20 20V9.828C20 9.298 19.789 8.789 19.414 8.414L13.585 2.586C13.57 2.57105 13.5531 2.55808 13.5363 2.5452C13.5238 2.53567 13.5115 2.5262 13.5 2.516C13.429 2.452 13.359 2.389 13.281 2.336C13.2557 2.31894 13.2281 2.30548 13.2005 2.29207C13.1845 2.28426 13.1685 2.27647 13.153 2.268C13.1363 2.25859 13.1197 2.24897 13.103 2.23933C13.0488 2.20797 12.9944 2.17648 12.937 2.152C12.74 2.07 12.528 2.029 12.313 2.014C12.2933 2.01274 12.2738 2.01008 12.2542 2.00741C12.2271 2.00371 12.1999 2 12.172 2H6C4.896 2 4 2.896 4 4V11.4982C4.47417 11.3004 4.97679 11.1572 5.5 11.0764V4C5.5 3.725 5.724 3.5 6 3.5H12V8C12 9.104 12.896 10 14 10H18.5V20ZM13.5 4.621L17.378 8.5H14C13.724 8.5 13.5 8.275 13.5 8V4.621ZM12 17.5C12 14.4624 9.53757 12 6.5 12C3.46243 12 1 14.4624 1 17.5C1 20.5376 3.46243 23 6.5 23C9.53757 23 12 20.5376 12 17.5ZM7.00065 18L7.00111 20.5035C7.00111 20.7797 6.77725 21.0035 6.50111 21.0035C6.22497 21.0035 6.00111 20.7797 6.00111 20.5035L6.00065 18H3.4956C3.21973 18 2.99609 17.7762 2.99609 17.5C2.99609 17.2239 3.21973 17 3.4956 17H6.00046L6 14.4993C6 14.2231 6.22386 13.9993 6.5 13.9993C6.77614 13.9993 7 14.2231 7 14.4993L7.00046 17H9.49659C9.77246 17 9.99609 17.2239 9.99609 17.5C9.99609 17.7762 9.77246 18 9.49659 18H7.00065Z" fill="currentColor"></path>
                        </svg>
                        <span class="block text-sm">
                            {{ __('+ Add Documents') }}
                        </span>
                    </div>
                    <div class="border rounded-md text-center w-2/5 ml-8 pt-2">
                        <a href="{{ route('courses.units.tests.create', [$course, $unit]) }}">
                            <svg class="h-20 inline w-20" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"></path>
                                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"></path>
                            </svg>
                            <span class="block text-sm">
                                {{ __('+ Add Test') }}
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="font-bold text-lg mt-10">
            <span>
                {{ __('Lessons') }}
            </span>
        </h3>

        <!-- Lessons Listing -->
        <div class="bg-white mt-8 shadow-xl">
            @if($lessons->count())
                @foreach($lessons as $lesson)
                    <div class="p-4 flex">
                        <svg class="h-6 mt-2 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                            <path d="M108,60A16,16,0,1,1,92,44,16,16,0,0,1,108,60Zm56,16a16,16,0,1,0-16-16A16,16,0,0,0,164,76ZM92,112a16,16,0,1,0,16,16A16,16,0,0,0,92,112Zm72,0a16,16,0,1,0,16,16A16,16,0,0,0,164,112ZM92,180a16,16,0,1,0,16,16A16,16,0,0,0,92,180Zm72,0a16,16,0,1,0,16,16A16,16,0,0,0,164,180Z"></path>
                        </svg>
                        <svg class="inline w-10 h-6 border bg-gray-200 m-2 rounded-md" width="24" height="24" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 11H14.5H17" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M12 7H14.5H17" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M8 15V3.6C8 3.26863 8.26863 3 8.6 3H20.4C20.7314 3 21 3.26863 21 3.6V17C21 19.2091 19.2091 21 17 21V21" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M5 15H8H12.4C12.7314 15 13.0031 15.2668 13.0298 15.5971C13.1526 17.1147 13.7812 21 17 21H8H6C4.34315 21 3 19.6569 3 18V17C3 15.8954 3.89543 15 5 15Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <div class="flex-grow">
                            <span>
                                {{ $lesson->name}}
                            </span>
                            <div>
                                <span>
                                    {{ ($lesson->test->total_questions) .__(' Questions') }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('courses.tests.edit', [$course, $lesson->lessonable]) }}">
                                <svg class="w-6 h-6 inline mr-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="blue" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </a>
                            <a href="{{ route('courses.lessons.delete', [$course, $lesson]) }}">
                                <svg class="w-6 h-6 inline" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg" stroke="red">
                                    <path d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4V4zm2 2h6V4H9v2zM6.074 8l.857 12H17.07l.857-12H6.074zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1z" fill="red" stroke-width="1"></path>
                                </svg>
                            </a>
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
</x-app-layout>