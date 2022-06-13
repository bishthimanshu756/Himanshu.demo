<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <form method="POST" action="/users/{{$user->id}}/edit">

                    @csrf
                        <div>
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{$user->name}}">
                            
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{$user->email}}">
                            
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="number">Ph. Number</label>
                            <input type="number" id="number" name="number" value="{{$user->number}}">

                            @error('number')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="City">City</label>
                            <input type="text" id="city" name="city" value="{{$user->city}}">

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