@props(['user'])
<div class="bg-blue-50 border-b border-gray-200 font-semibold px-6 py-4">
    <a class="px-10" href="{{ route('users.edit', $user) }}">Personal Information</a>
    <a class="px-10" href="{{ route('teams.index', $user) }}">Trainers</a>
</div>