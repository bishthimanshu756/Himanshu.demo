<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border-b-2 overflow-hidden px-4 py-4 shadow-sm sm:rounded-t-lg">
                <h3>Welcome to {{$user->role->name}} Panel</h3>
            </div>
            <div class="bg-white flex justify-around py-12 sm:rounded-b-lg">
                <div class="inline">
                    <svg class="h-12 inline w-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15" fill="currentColor">
                        <path d="M5.5 0a3.499 3.499 0 100 6.996A3.499 3.499 0 105.5 0zm-2 8.994a3.5 3.5 0 00-3.5 3.5v2.497h11v-2.497a3.5 3.5 0 00-3.5-3.5h-4zm9 1.006H12v5h3v-2.5a2.5 2.5 0 00-2.5-2.5z" fill="currentColor"></path><path d="M11.5 4a2.5 2.5 0 100 5 2.5 2.5 0 000-5z" fill="currentColor"></path>
                    </svg>
                    <h4 class="inline">{{ $users->count() . __(' Users') }}</h4>
                </div>
                <div class="inline">
                <svg class="h-12 inline w-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="currentColor">
                    <defs></defs><title>collapse-categories</title><rect x="14" y="25" width="14" height="2"></rect><polygon points="7.17 26 4.59 28.58 6 30 10 26 6 22 4.58 23.41 7.17 26"></polygon><rect x="14" y="15" width="14" height="2"></rect><polygon points="7.17 16 4.59 18.58 6 20 10 16 6 12 4.58 13.41 7.17 16"></polygon><rect x="14" y="5" width="14" height="2"></rect><polygon points="7.17 6 4.59 8.58 6 10 10 6 6 2 4.58 3.41 7.17 6"></polygon><rect id="_Transparent_Rectangle_" data-name="<Transparent Rectangle>" class="cls-1" width="32" height="32" style="fill:none"></rect>
                </svg>
                    <h4 class="inline">{{ $categories->count(). __(' Categories') }}</h4>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>