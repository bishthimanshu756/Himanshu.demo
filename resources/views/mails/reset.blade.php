<x-app-layout>
    <div class="h-screen overflow-x-auto py-12 h-screen mx-auto w-3/5">
        <div class="p-6 bg-white border-b border-gray-200 mt-20">
            <form action="{{ route('users.reset', $user) }}" method="POST" class="mt-4">
                @csrf
                <div class="ml-8">
                    <label class="block font-black">Password</label>
                    <input type="password" name="password" class="w-5/6">
                    
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="mt-4 ml-8">
                    <label class="block font-black">Confirm Password</label>
                    <input type="password" name="confirm_password" class="w-5/6">

                    @error('confirm_password')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <button type="submit" class="bg-gray-400 border border-gray-700 font-bold hover:bg-gray-700 hover:text-white ml-60 mt-4 py-2 px-6">Submit</button>
            </form>
        </div>
    </div>
</x-app-layout>