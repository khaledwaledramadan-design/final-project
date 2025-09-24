<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- رسالة نجاح --}}
            @if(session('success'))
                <div class="mb-4 p-4 rounded bg-green-100 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            {{-- قائمة المقالات --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold mb-4 text-gray-300">All Articles</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @forelse($posts as $post)
                        <div class="border rounded-lg p-4 bg-gray-50 dark:bg-gray-700">
                            <h4 class="font-semibold text-lg">{{ $post->title }}</h4>
                            <p class="mt-2 text-gray-600 dark:text-gray-300">{{ $post->description }}</p>

                            {{-- زر الحذف يظهر للأدمن فقط --}}
                            @if(auth()->user()->role === 'admin')
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="mt-3"
                                      onsubmit="return confirm('Are you sure?!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </div>
                    @empty
                        <p class="col-span-3 text-center text-gray-500">No Articles found</p>
                    @endforelse
                </div>
            </div>

            {{-- فورم الإضافة --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Insert a new Article</h3>
                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                            Title
                        </label>
                        <input type="text" name="title" id="title" class="w-full rounded border-gray-300"
                               placeholder="Enter Title">
                        @error('title')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                            Description
                        </label>
                        <textarea name="description" id="description" rows="4"
                                  class="w-full rounded border-gray-300"
                                  placeholder="Enter Description"></textarea>
                        @error('description')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
