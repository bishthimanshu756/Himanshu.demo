@props(['user', 'trainer'])
<div class="bg-blue-50 border-b border-gray-200 font-semibold px-6 py-4">
    <a class="px-10" href="{{ route('users.edit', $user) }}">Personal Information</a>
    @can('admin')
        @if($trainer->can('is_trainer'))
            <a class="px-10" href="{{ route('teams.users.index', $trainer) }}">Employers</a>
        @elseif($user->can('is_employee'))
            <a class="px-10" href="{{ route('users.teams.index', $user) }}">Trainers</a>
        @endif
    @endcan
</div>