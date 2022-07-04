@props(['course'])

<div class="w-full bg-blue-100 px-2 py-4 font-semibold">
    <a href="{{ route('courses.edit', $course) }}" class="ml-14">{{ __('Course Information') }}</a>
    <a href="{{ route('courses.teams.index', $course) }}" class="ml-14">{{ __('Trainers') }}</a>
    <a href="{{ route('courses.users.index', $course) }}" class="ml-14">{{ __('Users') }}</a>
</div>