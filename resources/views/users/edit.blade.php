<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <form method="POST" action="{{ route('users.update', $user) }}" class="mx-auto w-1/4 mt-10">

                    @csrf
                        <!-- First Name -->
                        <div>
                            <label for="first_name" class="block font-black text-center">{{ __('First name') }}</label>
                            <input type="text" name="first_name" value="{{ $user->first_name }}" required class="w-full bg-gray-200 text-center">
                            
                            @error('first_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Last Name -->
                        <div>
                            <label for="last_name" class="block font-black text-center">{{ ('Last name') }}</label>
                            <input type="text" name="last_name" value="{{ $user->last_name }}" required class="w-full bg-gray-200 text-center">
                            
                            @error('last_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <label for="email" class="block font-black text-center">{{ __('Email') }}</label>
                            <input type="email" name="email" value="{{ $user->email }}" required class="w-full bg-gray-200 text-center">
                            
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <label for="password" class="block font-black text-center">{{ __('Password') }}</label>
                            <input type="password" name="password" required class="w-full bg-gray-200 text-center">
                            
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Number -->
                        <div class="mt-4">
                            <label for="number" class="block font-black text-center">{{ __('Ph. Number') }}</label>
                            <input type="number" id="number" name="number" value="{{ $user->number }}" required class="w-full bg-gray-200 text-center">

                            @error('number')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>

                        <!-- City -->
                        <div class="mt-4">
                            <label for="city" class="block font-black text-center">{{ __('City') }}</label>
                            <input type="text" id="city" name="city" value="{{ $user->city }}" required class="w-full bg-gray-200 text-center">

                            @error('city')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="mt-4">
                            <label for="role_id" class="block font-black text-center">{{ __('Role') }}</label>
                            <select name="role_id" id="role_id" class="text-center w-full">

                                @if(auth()->user()->role_id==1)
                                    @foreach($roles as $role)
                                        @if($role->id == 2 || $role->id == 3 || $role->id == 4)
                                            <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }} > {{ $role->name }} </option>
                                        @endif
                                    @endforeach
                                @endif

                                @if(auth()->user()->role_id==2)
                                    @foreach($roles as $role)
                                        @if($role->id == 3 || $role->id == 4)
                                        <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }} > {{ $role->name }} </option>
                                        @endif
                                    @endforeach
                                @endif

                                @if(auth()->user()->role_id==3)
                                    @foreach($roles as $role)
                                        @if($role->id == 4)
                                        <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }} > {{ $role->name }} </option>
                                        @endif
                                    @endforeach
                                @endif

                            </select>
                        </div>

                        <!-- Submit -->
                        <div class="mt-4 ml-4">
                            <button type="submit" class="border-2 px-4 py-1.5">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>