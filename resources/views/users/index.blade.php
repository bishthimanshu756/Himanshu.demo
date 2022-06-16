<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden px-4 py-4 ">
                <div class="flex items-center justify-between ">
                    <h3 class="font-extrabold text-blue-900 text-xl">Users</h3>
                    @if (auth()->user()->role_id != 4)
                        <a href="{{ route( 'users.create' ) }}" class="bg-blue-400 border font-bold hover:bg-white hover:text-blue-900 p-2 rounded-md text-center text-sm text-white w-32">{{ __('Create User') }}</a>
                    @endif

                </div>
                <div class="bg-white border-b border-gray-200 mt-8 w-full"">
                    <?php $no=1?>
                    <table class="border-2 border-gray-200 h-full w-full" >
                        <thead class="bg-gray-200">
                            <tr class="bg-blue-50 font-serif">
                                <th class="p-2.5 text-gray-800">{{ __('S.No.') }}</th>
                                <th class="p-2.5 text-gray-800">{{ __('User name') }}</th>
                                <th class="p-2.5 text-gray-800">{{ __('Type Of User') }}</th>
                                <th class="p-2.5 text-gray-800">{{ __('Created Date') }}</th">
                                <th class="p-2.5 text-gray-800">{{ __('Status')}}</th>
                                <th class="p-2.5 text-gray-800" colspan="3">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center ;">
                        
                            @foreach($users as $user)
                                @if(Auth::user()->role_id < $user->role_id)
                                    <tr class="border-gray-200 border-t-2 py-10">
                                        <td class="p-2">{{ $no++ }}</td>
                                        <td class="p-2">
                                            <span>{{ $user->full_name }}</span>
                                            <span class="block text-gray-400 text-xs">{{ $user->email }}</span>
                                        </td>
                                        <td class="p-2">{{ $user->role->name }}</td>
                                        <td class="p-2">
                                            <span ><date>{{ date_format($user->created_at, 'd-m-Y') }}</date></span>
                                            <span class="block text-xs text-gray-400"><time>{{ date_format($user->created_at, 'H:i:s')}}</time></span>
                                        </td>
                                        <td class="p-2">{{ $user->status ? 'Active' : 'Not Active' }}</td>
                                        <td class="font-bold p-2">
                                            <a href="{{ route('users.update', $user) }}" class="bg-green-400 border-2 hover:bg-green-800 hover:text-white m-1 px-4 py-1">Edit</a>
                                        </td>
                                        
                                        <td class="font-bold p-2">
                                            <a href="{{ route('users.delete', $user) }}" class="bg-red-500 border-2 hover:bg-red-700 hover:text-white m-1 px-1.5 py-1">Delete</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>