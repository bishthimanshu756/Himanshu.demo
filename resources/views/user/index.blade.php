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
                    <a href="/user/add" class="bg-indigo-50 border font-semibold p-2">Add New User</a>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <?php $no=1?>
                    <table class="w-full h-full" >
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>City</th>
                                <th colspan="3">Actions</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center ;">
                            @foreach($users as $user)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->number}}</td>
                                        <td>{{$user->city}}</td>
                                        <td><a href="users/{{$user->id}}/edit">Edit</a></td>
                                        <td><a href="users/{{$user->id}}/delete">Delete</a></td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>