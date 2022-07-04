<x-app-layout>
    <div class="h-screen overflow-x-auto py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" px-4 py-4 ">
                <div class="flex items-center justify-between ">
                    <h3 class="font-extrabold text-blue-900 text-xl">Categories</h3>
                    <a href="{{ route('categories.create') }}" class="bg-blue-400 border font-bold hover:bg-white hover:text-blue-900 p-2 rounded-md text-center text-sm text-white w-32">{{ __('Create Category') }}</a>
                </div>
                <div class="flex justify-between mt-6">
                    <!-- Search -->
                    <form method="get" action="{{ route('categories.index') }}" class="bg-white border border-gray-200 py-1 rounded-md w-1/3">
                        @if(request('orderBy'))
                            <input type="hidden" name="orderBy" value="{{ request('orderBy') }}">
                        @endif
                        <input type="text" name="search" value="{{ request()->input('search') }}" class="border-0 h-8 ml-4 px-4 py-4 w-10/12" placeholder="Search by Name or Email">
                        <button type="submit">
                            <svg class="w-4 h-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </form>
                    <!-- Filter -->
                    <div x-data="{ show:false}" @click.away="show = false" class="bg-white border-2 font-semibold inline px-4 py-2 relative text-sm">
                        <button @click="show = !show">
                            @if(request('orderBy') == 'a-z')
                                {{ __('Name A To Z') }}
                            @elseif(request('orderBy') == 'z-a')
                                {{ __('Name Z To A') }}
                            @elseif(request('orderBy') == 'desc')
                                {{ __('Oldest Created Date') }}
                            @else
                                {{ __('Latest Created Date') }}
                            @endif
                            <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.098 8H6.902c-.751 0-1.172.754-.708 1.268L9.292 12.7c.36.399 1.055.399 1.416 0l3.098-3.433C14.27 8.754 13.849 8 13.098 8z"></path>
                            </svg>
                        </button>
                        <div x-show="show" class="absolute bg-white border-2 border-black-600 left-0 mt-1 p-2 w-36 z-50" style="display: none;">
                            <a href="{{ route('categories.index') .'?orderBy=a-z' }}" class="block hover:bg-gray-200 px-2 py-0.5 text-left w-full {{ request('orderBy')=='a-z' ? 'bg-blue-500 text-white': '' }}">
                                {{ __('Name A To Z') }}
                            </a>
                            <a href="{{ route('categories.index') .'?orderBy=z-a' }}" class="block hover:bg-gray-200 px-2 py-0.5 text-left w-full {{ request('orderBy')=='z-a' ? 'bg-blue-500 text-white': '' }}">
                                {{ __('Name Z To A') }}
                            </a>
                            <a href="{{ route('categories.index') .'?orderBy=asc' }}" class="block hover:bg-gray-200 px-2 py-0.5 text-left w-full {{ request('orderBy')=='asc' ? 'bg-blue-500 text-white':'' }}">
                                {{ __('Latest Created Date') }}
                            </a>
                            <a href="{{ route('categories.index') .'?orderBy=desc' }}" class="block hover:bg-gray-200 px-2 py-0.5 text-left w-full {{ request('orderBy')=='desc' ? 'bg-blue-500 text-white':'' }}">
                                {{ __('Oldest Created Date') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="bg-white border-b border-gray-200 mt-8 w-full">
                    <?php $no=1?>
                    <table class="border-2 border-gray-200 h-full w-full" >
                        <thead class="bg-gray-200">
                            <tr class="bg-blue-50 font-serif">
                                <th class="p-2.5 text-gray-800">{{ __('S.No.') }}</th>
                                <th class="p-2.5 text-gray-800">{{ __('Name') }}</th>
                                <th class="p-2.5 text-gray-800">{{ __('Created By') }}</th>
                                <th class="p-2.5 text-gray-800">{{ __('Courses') }}</th>
                                <th class="p-2.5 text-gray-800">{{ __('Created Date') }}</th">
                                <th class="p-2.5 text-gray-800">{{ __('Status')}}</th>
                                <th class="p-2.5 text-gray-800" colspan="3">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center ;">
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td class="p-2">
                                        <span>{{ $category->user->full_name  }}</span>
                                        <span class="block text-xs text-gray-400">{{ $category->user->email }}</span>
                                    </td>
                                    <td>{{ __('0') }}</td>
                                    <td class="p-2">
                                        <span ><date>{{ date_format($category->created_at, 'd-m-Y') }}</date></span>
                                        <span class="block text-xs text-gray-400"><time>{{ date_format($category->created_at, 'H:i:s')}}</time></span>
                                    </td>
                                    <td>{{ $category->status ? 'Active' : 'Inactive'}}</td>
                                    <td>
                                        <div class="w=2/3 dropdown">
                                            <svg id="Layer_1" class="w-4 h-6" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29.96 122.88"><defs><style>.cls-1{fill-rule:evenodd;}</style></defs><title>3-vertical-dots</title><path class="cls-1" d="M15,0A15,15,0,1,1,0,15,15,15,0,0,1,15,0Zm0,92.93a15,15,0,1,1-15,15,15,15,0,0,1,15-15Zm0-46.47a15,15,0,1,1-15,15,15,15,0,0,1,15-15Z"></path>
                                            </svg>
                                            <div class="dropdown_content bg-gray-200 z-50">
                                                    <a href="{{ route('categories.edit', $category) }}" class="hover:bg-gray-400 hover:font-bold text-sm" style="padding: 4px 25px">Edit</a>
                                                    <a href="{{ route('categories.delete', $category) }}" class="hover:bg-gray-400 hover:font-bold text-sm " style="padding: 4px 19px">Delete</a>
                                                    <a href="{{ route('categories.status', $category) }}" class="hover:bg-gray-400 hover:font-bold text-sm " style="padding: 4px 15px">{{ $category->status ? 'Inactive' : 'Active'}} </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>