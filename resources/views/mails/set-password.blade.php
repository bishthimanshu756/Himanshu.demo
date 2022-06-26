<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form action="{{ route('users.set-password', $user) }}" method="POST" class="px-8">
            @csrf
                <div class="mt-4">
                    <lable class="block font-black required">Password</lable>
                    <input type="password" name="password" class="rounded-md w-full">
                    <x-validation-error name="password" />

                </div>
                <div class="mt-4">
                    <label class="block font-black required">Confirm Password</label>
                    <input type="password" name="confirm_password" class="rounded-md w-full">
                    <x-validation-error name='confirm_password'/>
                </div>
                <div class="mt-4">
                    <button type="submit" class="bg-gray-500 text-white border-0.5 border-2 border-gray-500 font-bold hover: hover:bg-gray-600 hover:border-gray-900 hover:text-white mx-auto px-4 py-1.5 rounded-md">
                        {{ __('Create Password') }}
                    </button>
                    <div class="bg-blue-100 border-2 font-bold hover:bg-blue-600 hover:border-blue-700 hover:text-white inline ml-4 px-4 py-1.5 rounded-md text-gray-700"> 
                        <a href="{{ route('login') }}">{{ __('Cancel') }}</a>
                    </div>
                </div>
        </form>
    </x-auth-card>
</x-guest-layout>