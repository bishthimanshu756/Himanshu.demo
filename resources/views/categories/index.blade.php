<x-app-layout>
    <div class="h-screen overflow-x-auto py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden px-4 py-4 ">
                <div class="flex items-center justify-between ">
                    <h3 class="font-extrabold text-blue-900 text-xl">Categories</h3>
                    <a href="#" class="bg-blue-400 border font-bold hover:bg-white hover:text-blue-900 p-2 rounded-md text-center text-sm text-white w-32">{{ __('Create Category') }}</a>
                    
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
                            <tr>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>