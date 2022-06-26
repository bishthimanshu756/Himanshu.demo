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

                <!-- Filters -->
                <div class="flex justify-end mt-4">
                    <div x-data="{ show:false}" @click.away="show = false" class="bg-white border-2 font-semibold inline px-4 py-2 relative text-sm">
                        <button @click="show = !show">
                            {{isset($currentRole) ? $currentRole->name : __('All User Type') }}
                            <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.098 8H6.902c-.751 0-1.172.754-.708 1.268L9.292 12.7c.36.399 1.055.399 1.416 0l3.098-3.433C14.27 8.754 13.849 8 13.098 8z"></path>
                            </svg>
                        </button>
                        <div x-show="show" class="absolute bg-white border-2 border-black-600 left-0 mt-1 p-2 w-36 z-50" style="display: none;">
                            <a href="{{ route('users.index') }}" class="block hover:bg-gray-200 px-2 py-0.5 text-left w-full {{ isset($currentRole) ? '' : 'bg-blue-500 text-white' }}">
                                {{ __('All') }}
                            </a>
                            <form action="{{ route('users.index') }}" method="get">
                                @if(request('date_filter'))
                                    <input type="hidden" name="date_filter" value="{{ request('date_filter') }}" class="">
                                @endif
                                @foreach($roles as $role)
                                    <button type="submit" name="roleId" value="{{ $role->id }}" class="block hover:bg-gray-200 px-2 py-0.5 text-left w-full {{ isset($currentRole) && $currentRole->is($role) ? 'bg-blue-500 text-white' : ''}} ">{{ $role->name }}</button>
                                @endforeach
                            </form>    
                        </div>
                    </div>
                    <div x-data="{ show:false}" @click.away="show = false" class="ml-4 bg-white border-2 font-semibold inline px-4 py-2 relative text-sm">
                        <button @click="show = !show">
                            {{ (request('date_filter')== 'desc') ? __('Oldest Created Date') : __('Lastest Created Date') }}
                            <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.098 8H6.902c-.751 0-1.172.754-.708 1.268L9.292 12.7c.36.399 1.055.399 1.416 0l3.098-3.433C14.27 8.754 13.849 8 13.098 8z"></path>
                            </svg>
                        </button>
                        <div x-show="show" class="absolute bg-white border-2 left-0 mt-1 p-2 w-44 z-50" style="display: none;">
                            <form action="{{ route('users.index') }}" method="get">
                                @if(request('roleId'))
                                    <input type="hidden" name="roleId" value="{{ request('roleId') }}">
                                @endif  
                                <button type="submit" name="date_filter" value="asc" class="hover:bg-gray-200 py-0.5 w-full {{ request('date_filter') == 'desc' ? '' : 'bg-blue-500 text-white'}}">Lastest Created Date</button>
                                <button type="submit" name="date_filter" value="desc" class="hover:bg-gray-200 py-0.5 w-full {{ request('date_filter') == 'desc' ? 'bg-blue-500 text-white' : ''}}">Oldest Created Date</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Listing -->
                <div class="bg-white border-b border-gray-200 mt-8 w-full">
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
                                            <div x-show="show" class="absolute border-2 border-black-600 w-50 z-50" style="display:none;">
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