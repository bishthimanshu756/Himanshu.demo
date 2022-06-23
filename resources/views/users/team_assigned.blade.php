<x-app-layout>
    <div class="h-screen py-12 h-screen mx-24 my-6">
        <div class="flex items-center justify-between mb-8">
            <h3 class="font-extrabold text-blue-900 text-xl">
                <a href="{{ route('users.index') }}">Users</a>
                <span class="text-black"> > {{ $user->full_name }}</span>
            </h3>
            <div x-data="{ show:false}" @click.away="show = false">
                <button @click="show = !show" class="bg-black font-bold px-8 py-2 rounded-xl text-white">
                    Add Employers
                </button>
                <div x-show="show" class="max-h-80  absolute bg-black border-2 border-black-600 font-bold rounded-xl text-white w-44 py-4">
                    @if($trainers->count())
                    <form action="{{ route('users.teams.store', $user) }}" method="POST">
                        @csrf
                        @foreach($trainers as $trainer)
                        <div class="block p-2 text-sm">
                            <input type="checkbox" name="trainerIds[]" id="{{ $trainer->slug }}" value="{{ $trainer->id }}">
                            <label for="{{ $trainer->slug }}">{{ ($trainer->full_name) }}</label>
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
        <div class="bg-white border-b border-gray-200">
            <x-tab :user=$user :trainer=$user />
            <table class="w-full">
                <thead>
                    <tr class="border-b-2 w-full bg-gray-300">
                        <th class="px-24 py-2">{{ __('Name') }}</th>
                        <th class="px-24 py-2">{{ __('Created Date') }}</th>
                        <th class="px-24 py-2">{{ __('Action') }}</th>
                    </tr >
                </thead>
                <tbody>
                    @if($assignedtrainers->count())
                    @foreach($assignedtrainers as $trainer)
                    <tr class="border-b-2">
                        <td class="text-center py-2">{{ $trainer->full_name }}</td>
                        <td class="text-center py-2">{{ $trainer->updated_at }}</td>
                        <td class="text-center py-2">
                            <form method="post" action="{{ route('users.team.destroy', $user) }}">
                                @csrf
                                <button name="trainerId" value="{{ $trainer->id }}" type="submit" class="bg-gray-300 border-2 border-gray-500 hover:bg-gray-700 hover:border-gray-800 hover:text-white px-4 py-1">{{ __('Unassigned') }}</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td>
                            <span>{{ __('No records found...') }}</span>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>