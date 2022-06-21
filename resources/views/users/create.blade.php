<x-app-layout>
    <div class="mx-24 my-6 py-12 w-3/5">
        <div class="flex items-center justify-between mb-8">
            <h3 class="font-extrabold text-blue-900 text-xl">
                <a href="{{ route('users.index') }}">Users</a> 
                <span class="text-black"> > Create User</span>
            </h3>
        </div>
        <div class="p-6 bg-white border-b border-gray-200">
            <form method="POST" action="{{ route('users.store') }}" class="px-5">

                @csrf
                <!-- First Name -->
                <div>
                    <label for="first_name" class="block font-black required">{{ __('First name') }}</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" required class="rounded-md w-full" placeholder="Enter First Name">
                    
                    <x-validation-error name="first_name" />
                </div>

                <!-- Last Name -->
                <div class="mt-4">
                    <label for="last_name" class="block font-black required">{{ __('Last name') }}</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" required class="rounded-md w-full" placeholder="Enter Last Name">
                    
                    <x-validation-error name="last_name" />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <label for="email" class="block font-black required">{{ __('Email') }}</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="rounded-md w-full" placeholder="Enter Email Address">
                    
                    <x-validation-error name="email" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="block font-black required">{{ __('Password') }}</label>
                    <input type="password" id="password" name="password" required class="rounded-md w-full" placeholder="Enter Your Password">

                    <x-validation-error name="password" />
                </div>
                
                <!-- Role -->
                <div class="mt-4">
                    <label for="role_id" class="block font-black">{{ __('User Type') }}</label>
                    <select name="role_id" id="role_id" class="font-semibold rounded-md w-full">

                        @foreach($roles as $role)
                            @if(Auth::user()->role_id < $role->id)
                                <option name="role" value="{{ $role->id }}" class=" w-full" placeholder="">{{ $role->name }}</option>
                            @endif
                        @endforeach
                        
                    </select>

                    <x-validation-error name="role" />
                </div>

                <!-- Buttons -->
                <div class="mt-4">
                    <button type="submit" name="action" value="create" class="bg-gray-500 text-white border-0.5 border-2 border-gray-500 font-bold hover: hover:bg-gray-600 hover:border-gray-900 hover:text-white mx-auto px-4 py-1.5 rounded-md">
                        Create User
                    </button>
                    <button type="submit"name="action" value="create_another" class="bg-gray-500 text-white border-0.5 border-2 border-gray-500 font-bold hover: hover:bg-gray-600 hover:border-gray-900 hover:text-white ml-4 px-4 py-1.5 rounded-md">
                        Create User & Create Another
                    </button>
                    <div class="bg-blue-100 border-2 font-bold hover:bg-blue-600 hover:border-blue-700 hover:text-white inline ml-4 px-4 py-1.5 rounded-md text-gray-700">
                        <a href="{{ route('users.index') }}" >Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>