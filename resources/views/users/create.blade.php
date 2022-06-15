<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white border-b border-gray-200">
            <form method="POST" action="{{ route('users.create') }}" class="mx-auto w-1/4 mt-10">

                @csrf
                <!-- First Name -->
                <div>
                    <label for="first_name" class="block font-black text-center">{{ __('First name') }}</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" required class=" text-center w-full bg-gray-200">
                    
                    @error('first_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Last Name -->
                <div>
                    <label for="last_name" class="block font-black text-center">{{ __('Last name') }}</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" required class=" text-center w-full bg-gray-200">
                    
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <label for="email" class="block font-black text-center">{{ __('Email') }}</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class=" text-center w-full bg-gray-200">
                    
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Number -->
                <div class="mt-4">
                    <label for="number" class="block font-black text-center">{{ _('Ph. Number') }}</label>
                    <input type="number" id="number" name="number" value="{{ old('number') }}" required class=" text-center w-full bg-gray-200">

                    @error('number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="block font-black text-center">{{ __('Password') }}</label>
                    <input type="password" id="password" name="password" required class=" text-center w-full bg-gray-200">

                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- City -->
                <div class="mt-4">
                    <label for="City" class="block font-black text-center">{{ __('City') }}</label>
                    <input type="text" id="city" name="city" value="{{ old('city') }}" required class=" text-center w-full bg-gray-200">

                    @error('city')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Role -->
                <div class="mt-4">
                    <label for="role_id" class="block font-black text-center">{{ __('Role') }}</label>
                    <select name="role_id" id="role_id" class="text-center w-full">

                        @foreach($roles as $role)
                            @if(Auth::user()->role_id < $role->id)
                                <option name="role" value="{{ $role->id }}" class=" text-center w-full bg-gray-200">{{ $role->name }}</option>
                            @endif
                        @endforeach
                        
                    </select>

                    @error('role')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-4 ml-4">
                    <button type="submit" class="border-2 px-4 py-1.5 mx-auto font-bold bg-gray-200 border-0.5 border-gray-500 hover:bg-blue-300 hover:border-blue-500 ">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>