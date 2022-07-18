<x-app-layout>
    <div class="py-12 mb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-4 py-4 ">
                <div class="flex items-center justify-between ">
                    <h3 class="font-extrabold text-blue-900 text-xl">
                        <span>
                            {{ $course->name }}
                        </span>
                        <svg class="w-8 h-8 inline" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                        </svg>
                        <span>
                            {{ $file->name }}
                        </span>
                    </h3>
                </div>
                    <embed src="{{ $file->storage_url }}" type="application/pdf">
            </div>
        </div>
    </div>
</x-app-layout>