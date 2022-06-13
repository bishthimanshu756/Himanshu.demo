<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="/user/add">

                        @csrf
                        <div>
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ old('name')}}" class="ml-14">
                            
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ old('email')}}" class="ml-14">
                            
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="number">Ph. Number</label>
                            <input type="number" id="number" name="number" value="{{ old('number')}}" class="ml-14">

                            @error('number')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password">

                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="City">City</label>
                            <input type="text" id="city" name="city" value="{{old('city')}}" class="ml-14">

                            @error('city')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mt-4 ml-4">
                            <button type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>