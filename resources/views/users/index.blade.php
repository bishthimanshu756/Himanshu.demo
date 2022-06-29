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
                <div class="flex justify-between mt-6">
                    <!-- Search -->
                    <form method="get" action="{{ route('users.index') }}" class="bg-white border border-gray-200 py-1 rounded-md w-1/3">
                        <input type="text" name="search" value="{{ request()->input('search') }}" class="border-0 h-8 ml-4 px-4 py-4 w-10/12" placeholder="Search by Name or Email">
                        <button type="submit">
                            <svg class="w-4 h-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </form>

                    <!-- Filters -->
                    <div class="mt-1">
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
                                    @if(request('orderBy'))
                                        <input type="hidden" name="orderBy" value="{{ request('orderBy') }}" class="">
                                    @endif
                                    @foreach($roles as $role)
                                        <button type="submit" name="roleId" value="{{ $role->id }}" class="block hover:bg-gray-200 px-2 py-0.5 text-left w-full {{ isset($currentRole) && $currentRole->is($role) ? 'bg-blue-500 text-white' : ''}} ">{{ $role->name }}</button>
                                    @endforeach
                                </form>    
                            </div>
                        </div>
                        <div x-data="{ show:false}" @click.away="show = false" class="ml-4 bg-white border-2 font-semibold inline px-4 py-2 relative text-sm">
                            <button @click="show = !show">
                                @if(request('orderBy') == 'a-z')
                                    {{ __('Name A To Z') }}
                                @elseif(request('orderBy') == 'z-a')
                                    {{ __('Name Z To A') }}
                                @elseif(request('orderBy') == 'asc')
                                    {{ __('Latest Created Date') }}
                                @else
                                    {{ __('Oldest Created Date') }}
                                @endif
                                <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.098 8H6.902c-.751 0-1.172.754-.708 1.268L9.292 12.7c.36.399 1.055.399 1.416 0l3.098-3.433C14.27 8.754 13.849 8 13.098 8z"></path>
                                </svg>
                            </button>
                            <div x-show="show" class="absolute bg-white border-2 left-0 mt-1 p-2 w-44 z-50" style="display: none;">
                                <form action="{{ route('users.index') }}" method="get">
                                    @if(request('roleId'))
                                        <input type="hidden" name="roleId" value="{{ request('roleId') }}">
                                    @endif  
                                    <button class= "hover:bg-gray-200 py-0.5 w-full text-left" name="orderBy" value="a-z">Name A To Z</button>
                                    <button class= "hover:bg-gray-200 py-0.5 w-full text-left" name="orderBy" value="z-a">Name Z To A</button>
                                    <button type="submit" name="orderBy" value="asc" class="hover:bg-gray-200 py-0.5 w-full text-left {{ request('orderBy') == 'asc' ? 'bg-blue-500 text-white' : ''}}">Lastest Created Date</button>
                                    <button type="submit" name="orderBy" value="desc" class="hover:bg-gray-200 py-0.5 w-full text-left {{ request('orderBy') == 'desc' ? 'bg-blue-500 text-white' : ''}}">Oldest Created Date</button>
                                </form>
                            </div>
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
                            @if($users->count())
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
                            @else
                                <tr>
                                    <td class="italic py-4 text-gray-400 text-lg text-left pl-12" colspan="6">No Records Found...</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>