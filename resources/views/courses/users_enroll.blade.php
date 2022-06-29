<x-app-layout>
    <div class="h-screen py-12 h-screen mx-24 my-6">
        <div class="flex items-center justify-between mb-8">
            <h3 class="font-extrabold text-blue-900 text-xl">
                <a href="{{ route('courses.index') }}">Courses</a>
                <span class="text-black"> > {{ $course->title }}</span>
            </h3>
            <div x-data="{ show:false}" @click.away="show = false">
                <button @click="show = !show" class="bg-gray-500 font-bold px-8 py-2 rounded-md text-white">
                    {{ _('Add Employers') }}
                    <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.098 8H6.902c-.751 0-1.172.754-.708 1.268L9.292 12.7c.36.399 1.055.399 1.416 0l3.098-3.433C14.27 8.754 13.849 8 13.098 8z">
                        </path>
                    </svg>
                </button>
                <div x-show="show" class="absolute bg-gray-500 border-2 border-black-600 font-bold max-h-80 py-4 rounded-md text-white w-52">
                    @if($users->count())
                    <form action="{{ route('courses.users.store', $course) }}" method="POST">
                        @csrf
                        @foreach($users as $user)
                        <div class="block p-2 text-sm">
                            <input type="checkbox" name="usersIds[]" id="{{ $user->slug }}" value="{{ $user->id }}">
                            <label for="{{ $user->slug }}">{{ $user->full_name }}</label>
                        </div>
                        @endforeach
                        <button type="submit" class="border-2 ml-10 px-4 py-1">{{ __('Add') }}</button>
                    </form>
                    @else
                    <span class="ml-4 text-sm">{{ __('No Data Available...') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="bg-white border-b border-gray-200 pb-4">
            <div class="w-full bg-blue-100 px-2 py-4 font-semibold">
                <a href="{{ route('courses.edit', $course) }}" class="ml-14">{{ __('Course Information') }}</a>
                <a href="#" class="ml-14">{{ __('Trainers') }}</a>
                <a href="{{ route('courses.users.index', $course) }}" class="ml-14">{{ __('Users') }}</a>
            </div>
            <table class="w-full border-b-2">
                <thead>
                    <tr class="bg-blue-50 border-b-2 w-full">
                        <th class="pl-6 pr-20 py-2 text-gray-700 text-left">{{ __('NAME') }}</th>
                        <th class="px-24 py-2 text-gray-700">{{ __('E-MAIL') }}</th>
                        <th class="px-24 py-2 text-gray-700">{{ __('STATUS') }}</th>
                    </tr >
                </thead>
                <tbody>
                    @if($enrolledUsers->count())
                        @foreach($enrolledUsers as $enrolledUser)
                            <tr class="border-b-2">
                                <td class="text-center py-2">{{ $enrolledUser->full_name }}</td>
                                <td class="text-center py-2">{{ $enrolledUser->email }}</td>
                                <td class="text-center py-2">
                                    <form method="post" action="{{ route('courses.users.delete', $course) }}">
                                        @csrf
                                        <button name="userId" value="{{ $enrolledUser->id }}" type="submit" class="bg-gray-500 font-bold border-2 border-gray-500 hover:bg-gray-700 hover:border-gray-800 hover:text-white px-4 py-1 rounded-md text-white">{{ __('Unassigned') }}</button>
                                    </form>                                
                                </td>
                            </tr>
                        @endforeach
                    @else
                    <tr>
                        <td class="py-2" colspan="3">
                            <span class="font-semibold pl-4 text-gray-300 text-lg italic">{{ __('No records found...') }}</span>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>