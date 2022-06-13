<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <form method="POST" action="{{ route('users.update', $user) }}" class="mx-auto w-1/4 mt-10">

                    @csrf
                        <!-- Name -->
                        <div>
                            <label for="name" class="block font-black text-center">Name</label>
                            <input type="text" name="name" value="{{ $user->name }}" required class="w-full bg-gray-200 text-center">
                            
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <label for="email" class="block font-black text-center">Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" required class="w-full bg-gray-200 text-center">
                            
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <label for="password" class="block font-black text-center">Password</label>
                            <input type="password" name="password" required class="w-full bg-gray-200 text-center">
                            
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Number -->
                        <div class="mt-4">
                            <label for="number" class="block font-black text-center">Ph. Number</label>
                            <input type="number" id="number" name="number" value="{{ $user->number }}" required class="w-full bg-gray-200 text-center">

                            @error('number')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>

                        <!-- City -->
                        <div class="mt-4">
                            <label for="City" class="block font-black text-center">City</label>
                            <input type="text" id="city" name="city" value="{{ $user->city }}" required class="w-full bg-gray-200 text-center">

                            @error('city')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
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