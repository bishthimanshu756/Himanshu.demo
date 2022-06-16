<x-app-layout>
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
                            <input type="email" name="email" value="{{ $user->email }}" readonly class="w-full bg-gray-200 text-center">
                            
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        @if(Auth::user()->role_id == 1)
                            <!-- Password -->
                            <div class="mt-4">
                                <label for="password" class="block font-black text-center">{{ __('Password') }}</label>
                                <input type="password" name="password" required class="w-full bg-gray-200 text-center">
                                
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif

                        <!-- Role -->
                        <div class="mt-4">
                            <label for="role_id" class="block font-black text-center">{{ __('Role') }}</label>
                            <select name="role_id" id="role_id" class="text-center w-full bg-gray-200">

                                @foreach($roles as $role)
                                    @if(Auth::user()->role_id < $role->id)
                                        <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}  > {{ $role->name }} </option>
                                    @endif
                                @endforeach
                        
                            </select>

                        </div>

                        <!-- Status -->
                        <div class="mt-4 text-center">
                            <label for="status" class="block font-black text-center">{{ __('Status') }}</label>
                            <input type="radio" name="is_active" id="status" value="1" {{$user->status=='1'? 'checked':''}}>
                            <label for="status" class="mr-4">{{ __('Active') }}</label>
                            <input type="radio" name="is_active" id="status" value="0" {{$user->status=='0'? 'checked':''}}>
                            <label for="status">{{ __('Inactive') }}</label>
                            
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