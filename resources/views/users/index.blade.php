<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-4 py-4">
                <div class="flex items-center justify-between ">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">Users</h3>
                    @if (auth()->user()->role_id != 4)
                        <a href="{{ route( 'users.create' ) }}" class="bg-red-50 border font-semibold p-2 hover:bg-red-400">{{ __('Add New User') }}</a>
                    @endif

                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <?php $no=1?>
                    <table class="border-2 border-gray-700 h-full w-full" >
                        <thead class="bg-gray-200">
                            <tr>
                                <th>{{ __('S.No.') }}</th>
                                <th>{{ __('First name') }}</th>
                                <th>{{ __('Last name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Phone Number') }} </th>
                                <th>{{ __('City') }}</th>
                                <th>{{ __('Role') }}</th>
                                <th colspan="3">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center ;">

                                @if (auth()->user()->role_id == 1) 
                                    @foreach($users as $user)
                                        @if($user->role_id==2 || $user->role_id==3 || $user->role_id==4)
                                            <tr class="border-black border-t-2 py-10">
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $user->first_name }}</td>
                                                <td>{{ $user->last_name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->number }}</td>
                                                <td>{{ $user->city }}</td>
                                                <td>{{ $user->role->name }}</td>
                                                <td><a href="{{ route('users.update', $user) }}" class="bg-green-400 border-2 m-1 px-1.5">Edit</a></td>
                                                
                                                <td><a href="{{ route('users.delete', $user) }}" class="bg-red-500 border-2 m-1 px-1.5 py-1">Delete</a></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif

                                @if (auth()->user()->role_id == 2) 
                                    @foreach($users as $user)
                                        @if($user->role_id==2 || $user->role_id==3 || $user->role_id==4)
                                            <tr class="border-black border-t-2 py-10">
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $user->first_name }}</td>
                                                <td>{{ $user->last_name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->number }}</td>
                                                <td>{{ $user->city }}</td>
                                                <td>{{ $user->role->name }}</td>
                                                <td><a href="{{ route('users.update', $user) }}" class="bg-green-400 border-2 m-1 px-1.5">Edit</a></td>
                                                
                                                <td><a href="{{ route('users.delete', $user) }}" class="bg-red-500 border-2 m-1 px-1.5 py-1">Delete</a></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif

                                @if (auth()->user()->role_id == 3) 
                                    @foreach($users as $user)
                                        @if($user->role_id==3 || $user->role_id==4)
                                            <tr class="border-black border-t-2 py-10">
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $user->first_name }}</td>
                                                <td>{{ $user->last_name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->number }}</td>
                                                <td>{{ $user->city }}</td>
                                                <td>{{ $user->role->name }}</td>
                                                <td><a href="{{ route('users.update', $user) }}" class="bg-green-400 border-2 m-1 px-1.5">Edit</a></td>
                                                
                                                <td><a href="{{ route('users.delete', $user) }}" class="bg-red-500 border-2 m-1 px-1.5 py-1">Delete</a></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif

                                @if (auth()->user()->role_id == 4) 
                                    @foreach($users as $user)
                                        @if($user->role_id==4)
                                            <tr class="border-black border-t-2 py-10">
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $user->first_name }}</td>
                                                <td>{{ $user->last_name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->number }}</td>
                                                <td>{{ $user->city }}</td>
                                                <td>{{ $user->role->name }}</td>
                                                <td><a href="{{ route('users.update', $user) }}" class="bg-green-400 border-2 m-1 px-1.5">Edit</a></td>
                                                
                                                <td><a href="{{ route('users.delete', $user) }}" class="bg-red-500 border-2 m-1 px-1.5 py-1">Delete</a></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>