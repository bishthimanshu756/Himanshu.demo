<x-app-layout>
    <div class="h-screen py-12 h-screen mx-24 my-6">
        <div class="flex items-center justify-between mb-8">
            <h3 class="font-extrabold text-blue-900 text-xl">
                <a href="{{ route('users.index') }}">Users</a> 
                <span class="text-black"> > {{ $user->full_name }}</span>
            </h3>
        </div>
        <div class="bg-white border-b border-gray-200">
            <x-tab :user=$user :trainer=$user/>
            <form method="POST" action="{{ route('users.update', $user) }}" class=" px-12 py-6 w-3/5">
                @csrf
                <!-- First Name -->
                <div>
                    <label for="first_name" class="block font-black required">{{ __('First name') }}</label>
                    <input type="text" name="first_name" value="{{ $user->first_name }}" required class="rounded-md w-full" placeholder="Enter First Name">
                    
                    <x-validation-error name="first_name" />
                </div>

                <!-- Last Name -->
                <div class="mt-4">
                    <label for="last_name" class="block font-black required">{{ ('Last name') }}</label>
                    <input type="text" name="last_name" value="{{ $user->last_name }}" required class="rounded-md w-full" placeholder="Enter Last Name">

                    <x-validation-error name="last_name" />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <label for="email" class="block font-black">{{ __('Email') }}</label>
                    <input type="email" name="email" value="{{ $user->email }}" readonly class="rounded-md w-full" placeholder="Enter Email Address">

                    <x-validation-error name="email" />
                </div>

                <!-- Role -->
                <div class="mt-4">
                    <label for="role_id" class="block font-black">{{ __('Role') }}</label>
                    <select name="role_id" id="role_id" class="w-full rounded-md font-bold">

                        @foreach($roles as $role)
                        @if(Auth::user()->role_id < $role->id)
                            <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}> {{ $role->name }} </option>
                            @endif
                            @endforeach

                    </select>

                </div>

                <!-- Buttons -->
                <div class="mt-4">
                    <button type="submit" class="bg-gray-600 border-2 border-gray-600 text-white font-bold hover: hover:bg-gray-800 hover:border-gray-900 hover:text-white mx-auto px-4 py-1.5 rounded-md">Update User</button>
                    <div class="bg-blue-100 border-2 border-blue-200 font-bold hover:bg-blue-400 hover:text-white inline ml-8 px-4 py-1.5 rounded-md">
                        <a href="{{ route('users.index') }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>