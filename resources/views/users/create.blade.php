<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white border-b border-gray-200">
            <form method="POST" action="{{ route('users.create') }}" class="mx-auto w-1/4 mt-10">

                @csrf
                <div>
                    <label for="name" class="block font-black text-center">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class=" text-center w-full bg-gray-200">
                    
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="email" class="block font-black text-center">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class=" text-center w-full bg-gray-200">
                    
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="number" class="block font-black text-center">Ph. Number</label>
                    <input type="number" id="number" name="number" value="{{ old('number') }}" required class=" text-center w-full bg-gray-200">

                    @error('number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="password" class="block font-black text-center">Password</label>
                    <input type="password" id="password" name="password" required class=" text-center w-full bg-gray-200">

                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="City" class="block font-black text-center">City</label>
                    <input type="text" id="city" name="city" value="{{ old('city') }}" required class=" text-center w-full bg-gray-200">

                    @error('city')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4 ml-4">
                    <button type="submit" class="border-2 px-4 py-1.5 mx-auto font-bold bg-gray-200 border-0.5 border-gray-500 hover:bg-blue-300 hover:border-blue-500 ">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>