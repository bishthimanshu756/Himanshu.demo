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
                <div x-show="show" class= "overflow-y-scroll  absolute bg-black border-2 border-black-600 font-bold rounded-xl text-white w-44">
                    <form action="{{ route('teams.assign', $user) }}" method="Post">
                        @dd($user)
                        @csrf
                        @foreach($employees as $employee)
                            <div class="block p-2 text-sm">
                                <input type="checkbox" name="checked[]" value="{{ $employee->id }}">
                                <label >{{ $employee->full_name }}</label>
                            </div>
                        @endforeach
                        <button type="submit" class="border-2 ml-10 px-4 py-1"> Assign</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="bg-white border-b border-gray-200">
            <x-tab :user=$user/>
            <table class="mx-auto">
                <thead>
                    <tr>
                        <th class="px-24 py-2">{{ __('Name') }}</th>
                        <th class="px-24 py-2">{{ __('Type of User') }}</th>
                        <th class="px-24 py-2">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>