<x-app-layout>
    <div class="h-screen py-12 h-screen mx-24 my-6">
        <div class="flex items-center justify-between mb-8">
            <h3 class="font-extrabold text-blue-900 text-xl">
                <a href="{{ route('users.index') }}">Users</a>
                <span class="text-black"> > {{ $trainer->full_name }}</span>
            </h3>
            <div x-data="{ show:false}" @click.away="show = false">
                <button @click="show = !show" class="bg-black font-bold px-8 py-2 rounded-xl text-white">
                    Add Employers
                </button>
                <div x-show="show" class= "max-h-80  absolute bg-black border-2 border-black-600 font-bold rounded-xl text-white w-44">
                    @if($employees->count())
                        <form method="POST" action="{{ route('teams.users.store', $trainer) }}">
                            @csrf
                            @foreach($employees as $employee)
                                <div class="block p-2 text-sm">
                                    <input type="checkbox" name="userIds[]" value="{{ $employee->id }}">
                                    <label>{{ $employee->full_name }}</label>
                                </div>
                            @endforeach
                            <button type="submit" class="border-2 ml-10 px-4 py-1"> {{ __('Add') }}</button>
                        </form>
                    @else
                        <span class="ml-4 text-sm">{{ __('No Data Available...') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="bg-white border-b border-gray-200">
            <x-tab :user=$trainer :trainer=$trainer />
            <table class="mx-auto">
                <thead>
                    <tr>
                        <th class="px-24 py-2">{{ __('Name') }}</th>
                        <th class="px-24 py-2">{{ __('Created Date') }}</th>
                        <th class="px-24 py-2">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($assingedUsers->count())
                        @foreach($assingedUsers as $user)
                            <tr>
                                <td class="px-24 py-4">{{ $user->full_name }}</td>
                                <td class="px-24 py-4">{{ $user->updated_at }}</td>
                                <td class="px-24 py-4">
                                <form action="{{ route('teams.users.destroy', $trainer) }}" method="POST">
                                    @csrf
                                    <button type="submit" name="userId" value="{{ $user->id }}">{{ __('Unassigned') }}</button>
                                        
                                </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">{{ __('No record found..') }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>