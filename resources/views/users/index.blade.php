<x-app-layout>
    <div class="h-screen overflow-x-auto py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-4 py-4 ">
                <div class="flex items-center justify-between ">
                    <h3 class="font-extrabold text-blue-900 text-xl">Users</h3>
                    @if (auth()->user()->role_id != 4)
                    <a href="{{ route( 'users.create' ) }}" class="bg-blue-400 border font-bold hover:bg-white hover:text-blue-900 p-2 rounded-md text-center text-sm text-white w-32">{{ __('Create User') }}</a>
                    @endif

                </div>
                <div class="bg-white border-b border-gray-200 mt-8 w-full"">
                    <?php $no = 1 ?>
                    <table class=" border-2 border-gray-200 h-full w-full">
                    <thead class="bg-gray-200">
                        <tr class="bg-blue-50 font-serif">
                            <th class="p-2.5 text-gray-800">{{ __('S.No.') }}</th>
                            <th class="p-2.5 text-gray-800">{{ __('User name') }}</th>
                            <th class="p-2.5 text-gray-800">{{ __('Type Of User') }}</th>
                            <th class="p-2.5 text-gray-800">{{ __('Created Date') }}</th">
                            <th class="p-2.5 text-gray-800">{{ __('Status')}}</th>
                            <th class="p-2.5 text-gray-800" colspan="4">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                        <tbody style="text-align:center ;">
                            @foreach($users as $user)
                                <tr class="border-gray-200 border-t-2 py-10">
                                    <td class="p-2">{{ $no++ }}</td>
                                    <td class="p-2">
                                        <span>{{ $user->full_name }}</span>
                                        <span class="block text-gray-400 text-xs">{{ $user->email }}</span>
                                    </td>
                                    <td class="p-2">{{ $user->role->name }}</td>
                                    <td class="p-2">
                                        <span>
                                            <date>{{ date_format($user->created_at, 'd-m-Y') }}</date>
                                        </span>
                                        <span class="block text-xs text-gray-400"><time>{{ date_format($user->created_at, 'H:i:s')}}</time></span>
                                    </td>
                                    <td class="p-2">{{ $user->status ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <div x-data="{ show:false}" @click.away="show = false" class="relative">
                                            <button @click="show = !show">
                                                <svg id="Layer_1" class="w-4 h-6" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29.96 122.88">
                                                    <defs><style>.cls-1 {fill-rule: evenodd;}</style></defs><title>3-vertical-dots</title>
                                                    <path class="cls-1" d="M15,0A15,15,0,1,1,0,15,15,15,0,0,1,15,0Zm0,92.93a15,15,0,1,1-15,15,15,15,0,0,1,15-15Zm0-46.47a15,15,0,1,1-15,15,15,15,0,0,1,15-15Z"></path>
                                                </svg>
                                            </button>
                                            <div x-show="show" class="absolute border-2 border-black-600 w-50 z-50">
                                                <a href="{{ route('users.edit', $user) }}" class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7">{{ __('Edit') }}</a>
                                                <a href="{{ route('users.delete', $user) }}" class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7">{{__('Delete')}}</a>
                                                <a href="{{ route('users.status', $user) }}" class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7">{{ $user->status ? 'Inactive' : 'Active'}}</a>
                                                <a href="{{ route('users.reset-password', $user) }}" class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7">{{__('Reset Password')}}</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>