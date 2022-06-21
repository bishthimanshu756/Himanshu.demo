<x-app-layout>
    <div class="h-screen overflow-x-auto py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" px-4 py-4 ">
                <div class="flex items-center justify-between ">
                    <h3 class="font-extrabold text-blue-900 text-xl">Categories</h3>
                    <a href="{{ route('categories.create') }}" class="bg-blue-400 border font-bold hover:bg-white hover:text-blue-900 p-2 rounded-md text-center text-sm text-white w-32">{{ __('Create Category') }}</a>
                </div>
                <div class="bg-white border-b border-gray-200 mt-8 w-full"">
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>