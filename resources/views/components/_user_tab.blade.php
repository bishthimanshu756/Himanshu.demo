@props(['user'])
<div class="bg-blue-50 border-b border-gray-200 font-semibold px-6 py-4">
    <a class="px-10" href="{{ route('users.edit', $user) }}">Personal Information</a>
    @can('admin')
        @if($user->can('is_trainer'))
            <a class="px-10" href="{{ route('teams.users.index', $user) }}">Employers</a>
            <a class="px-10" href="{{ route('teams.courses.index', $user) }}">{{ __('Manage Courses') }}</a>
            <a class="px-10" href="{{ route('users.courses.index', $user) }}">{{ __('Courses') }}</a>
        @elseif($user->can('is_employee'))
            <a class="px-10" href="{{ route('users.teams.index', $user) }}">Trainers</a>
            <a class="px-10" href="{{ route('users.courses.index', $user) }}">{{ __('Courses') }}</a>
        @endif
    @endcan
</div>