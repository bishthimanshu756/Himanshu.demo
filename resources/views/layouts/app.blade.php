<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
            <div class="flex">
                @if(session()->has('success'))
                <p class="fixed bg-blue-500 text-white py-2 px-4 rounded-xl mt-4 right-10 text-sm">
                    {{ session('success') }}
                </p>
                @elseif(session()->has('error'))
                <p class="fixed bg-red-500 text-white py-2 px-4 rounded-xl mt-4 right-10 text-sm">
                        {{ session('error') }}
                    </p>
                @endif
                <!-- Side Bar -->
                <nav class="font-bold text-lg text-white w-1/6 bg-sky-900 min-h-screen">
                    <ul class="mt-14 leading-loose sticky top-0">
                        @can('trainer')
                            <div>
                                <li class=" pl-6 active:bg-white active:text-blue-400 hover:bg-white hover:text-blue-900 p-2.5 rounded-xl">
                                    <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 512 512" fill="currentColor"><path d="M305.70047,342.3598022c-36.0198364,38.2903137-100.3905792,23.0903625-115.5892029-27.2943115c-15.1921387-50.3630371,30.0319519-98.4650574,81.2234497-86.4274597c58.1559753-49.7401428,148.5025024-126.6914368,200.8326111-169.3078308c18.2505493-14.8694839,33.8878479,1.9211006,19.671875,19.6718674C450.3439026,130.8521423,372.6500244,221.857605,322.4714355,280.219696C327.3044128,301.2219849,322.4901428,324.5118408,305.70047,342.3598022z M432.747467,255.971817c0-15.0874023-16.4451904-24.5682373-29.5302734-17.0245209c-13.085083,7.5437012-13.085083,26.5053406,0,34.0490417S432.747467,271.0592346,432.747467,255.971817z M137.6693115,177.2846375c0-15.0874023-16.4451675-24.568222-29.5302658-17.0245209s-13.0850906,26.5053558,0.0000076,34.049057S137.6693115,192.3720551,137.6693115,177.2846375z M117.9977722,255.971817c0-15.0874023-16.4451752-24.5682373-29.5302658-17.0245209c-13.0850906,7.5437012-13.0850906,26.5053406,0,34.0490417S117.9977722,271.0592346,117.9977722,255.971817z M196.6849518,118.2690125c0-15.0874023-16.4451752-24.5682297-29.5302734-17.0245285c-13.0850983,7.5437088-13.085083,26.5053558,0,34.0490646C180.2397766,142.8372498,196.6849518,133.3564148,196.6849518,118.2690125z M354.0592957,118.2690125c0-15.0874023-16.4451904-24.5682297-29.5302734-17.0245285c-13.085083,7.5437088-13.085083,26.5053558,0,34.0490646C337.6141052,142.8372498,354.0592957,133.3564148,354.0592957,118.2690125z M275.3721313,98.5974731c0-15.08741-16.4451904-24.5682297-29.5302887-17.0245285c-13.085083,7.5437012-13.085083,26.5053558,0.0000153,34.049057C258.9269409,123.1657028,275.3721313,113.6848755,275.3721313,98.5974731z M445.1410217,203.6339111c23.2225342,85.9554749-12.5137024,184.7849731-102.7443848,229.0373535C206.9379578,499.1051331,49.4041405,393.2025452,59.516304,242.5041656C69.6272507,91.8237,239.8304443,8.3328886,365.172821,92.5475616l48.8909302-37.368309C260.0759888-66.6424866,31.0267067,24.4521122,2.7645309,218.7560425C-25.4975834,413.059906,168.0320587,566.1639404,350.2819824,493.6817322c142.9860229-56.8665771,195.6464233-219.4277954,137.3392334-345.6645813L445.1410217,203.6339111z"></path></svg>
                                    <a href="{{ route('dashboard') }}"> {{ __('Dashboard') }} </a>
                                </li>
                            </div>
                            <div>
                                <li class="pl-6 active:bg-white active:text-blue-400 hover:bg-white hover:text-blue-900 p-2.5 rounded-xl">
                                    <svg class="align-text-top h-5 inline w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15" fill="currentColor"><path d="M5.5 0a3.499 3.499 0 100 6.996A3.499 3.499 0 105.5 0zm-2 8.994a3.5 3.5 0 00-3.5 3.5v2.497h11v-2.497a3.5 3.5 0 00-3.5-3.5h-4zm9 1.006H12v5h3v-2.5a2.5 2.5 0 00-2.5-2.5z" fill="currentColor"></path><path d="M11.5 4a2.5 2.5 0 100 5 2.5 2.5 0 000-5z" fill="currentColor"></path></svg>
                                    <a href="{{ route('users.index') }}"> {{ __('Users') }} </a>
                                </li>
                            </div>
                            <div>
                                <li class="pl-6 active:bg-white active:text-blue-400 hover:bg-white hover:text-blue-900 p-2.5 rounded-xl">
                                <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" role="img" viewBox="0 0 24 24" fill="currentColor"><title>BookStack</title><path d="M.3013 17.6146c-.1299-.3387-.5228-1.5119-.1337-2.4314l9.8273 5.6738a.329.329 0 0 0 .3299 0L24 12.9616v2.3542l-13.8401 7.9906-9.8586-5.6918zM.1911 8.9628c-.2882.8769.0149 2.0581.1236 2.4261l9.8452 5.6841L24 9.0823V6.7275L10.3248 14.623a.329.329 0 0 1-.3299 0L.1911 8.9628zm13.1698-1.9361c-.1819.1113-.4394.0015-.4852-.2064l-.2805-1.1336-2.1254-.1752a.33.33 0 0 1-.1378-.6145l5.5782-3.2207-1.7021-.9826L.6979 8.4935l9.462 5.463 13.5104-7.8004-4.401-2.5407-5.9084 3.4113zm-.1821-1.7286.2321.938 5.1984-3.0014-2.0395-1.1775-4.994 2.8834 1.3099.108a.3302.3302 0 0 1 .2931.2495zM24 9.845l-13.6752 7.8954a.329.329 0 0 1-.3299 0L.1678 12.0667c-.3891.919.003 2.0914.1332 2.4311l9.8589 5.692L24 12.1993V9.845z"></path></svg>
                                    <a href="{{ route('courses.index') }}"> {{ __('Courses') }} </a>
                                </li>
                            </div>
                            @can('sub_admin')
                                <div >
                                    <li class="pl-6 active:bg-white active:text-blue-400 hover:bg-white hover:text-blue-900 p-2.5 rounded-xl">
                                        <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="currentColor"><defs></defs><title>collapse-categories</title><rect x="14" y="25" width="14" height="2"></rect><polygon points="7.17 26 4.59 28.58 6 30 10 26 6 22 4.58 23.41 7.17 26"></polygon><rect x="14" y="15" width="14" height="2"></rect><polygon points="7.17 16 4.59 18.58 6 20 10 16 6 12 4.58 13.41 7.17 16"></polygon><rect x="14" y="5" width="14" height="2"></rect><polygon points="7.17 6 4.59 8.58 6 10 10 6 6 2 4.58 3.41 7.17 6"></polygon><rect id="_Transparent_Rectangle_" data-name="<Transparent Rectangle>" class="cls-1" width="32" height="32" style="fill:none"></rect></svg>
                                        <a href="{{ route('categories.index') }}"> {{ __('Categories') }} </a>
                                    </li>
                                </div>
                            @endcan
                            <div>
                                <li class="pl-6 active:bg-white active:text-blue-400 hover:bg-white hover:text-blue-900 p-2.5 rounded-xl">
                                    <svg class="w-6 h-6 inline" width="24" height="24" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 21H15M9 21V16M9 21H3.6C3.26863 21 3 20.7314 3 20.4V16.6C3 16.2686 3.26863 16 3.6 16H9M15 21V9M15 21H20.4C20.7314 21 21 20.7314 21 20.4V3.6C21 3.26863 20.7314 3 20.4 3H15.6C15.2686 3 15 3.26863 15 3.6V9M15 9H9.6C9.26863 9 9 9.26863 9 9.6V16" stroke="currentColor" stroke-width="1.5"></path>
                                    </svg>
                                    <a href="#"> {{ __('Reports') }} </a>
                                </li>
                            </div>
                        @endcan
                        @can('is_employee')
                            <div>
                                <li class="pl-6 active:bg-white active:text-blue-400 hover:bg-white hover:text-blue-900 p-2.5 rounded-xl">
                                <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" role="img" viewBox="0 0 24 24" fill="currentColor"><title>BookStack</title><path d="M.3013 17.6146c-.1299-.3387-.5228-1.5119-.1337-2.4314l9.8273 5.6738a.329.329 0 0 0 .3299 0L24 12.9616v2.3542l-13.8401 7.9906-9.8586-5.6918zM.1911 8.9628c-.2882.8769.0149 2.0581.1236 2.4261l9.8452 5.6841L24 9.0823V6.7275L10.3248 14.623a.329.329 0 0 1-.3299 0L.1911 8.9628zm13.1698-1.9361c-.1819.1113-.4394.0015-.4852-.2064l-.2805-1.1336-2.1254-.1752a.33.33 0 0 1-.1378-.6145l5.5782-3.2207-1.7021-.9826L.6979 8.4935l9.462 5.463 13.5104-7.8004-4.401-2.5407-5.9084 3.4113zm-.1821-1.7286.2321.938 5.1984-3.0014-2.0395-1.1775-4.994 2.8834 1.3099.108a.3302.3302 0 0 1 .2931.2495zM24 9.845l-13.6752 7.8954a.329.329 0 0 1-.3299 0L.1678 12.0667c-.3891.919.003 2.0914.1332 2.4311l9.8589 5.692L24 12.1993V9.845z"></path></svg>
                                    <a href="{{ route('my-courses.index') }}"> {{ __('My Courses') }} </a>
                                </li>
                            </div>
                            <div>
                                <li class="pl-6 active:bg-white active:text-blue-400 hover:bg-white hover:text-blue-900 p-2.5 rounded-xl">
                                <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" role="img" viewBox="0 0 24 24" fill="currentColor"><title>BookStack</title><path d="M.3013 17.6146c-.1299-.3387-.5228-1.5119-.1337-2.4314l9.8273 5.6738a.329.329 0 0 0 .3299 0L24 12.9616v2.3542l-13.8401 7.9906-9.8586-5.6918zM.1911 8.9628c-.2882.8769.0149 2.0581.1236 2.4261l9.8452 5.6841L24 9.0823V6.7275L10.3248 14.623a.329.329 0 0 1-.3299 0L.1911 8.9628zm13.1698-1.9361c-.1819.1113-.4394.0015-.4852-.2064l-.2805-1.1336-2.1254-.1752a.33.33 0 0 1-.1378-.6145l5.5782-3.2207-1.7021-.9826L.6979 8.4935l9.462 5.463 13.5104-7.8004-4.401-2.5407-5.9084 3.4113zm-.1821-1.7286.2321.938 5.1984-3.0014-2.0395-1.1775-4.994 2.8834 1.3099.108a.3302.3302 0 0 1 .2931.2495zM24 9.845l-13.6752 7.8954a.329.329 0 0 1-.3299 0L.1678 12.0667c-.3891.919.003 2.0914.1332 2.4311l9.8589 5.692L24 12.1993V9.845z"></path></svg>
                                    <a href="#"> {{ __('Certificate') }} </a>
                                </li>
                            </div>
                        @endcan
                    </ul>
                </nav>
                <!-- Page Content -->
                <main class="bg-gray-100 overflow-y-scroll w-full">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
