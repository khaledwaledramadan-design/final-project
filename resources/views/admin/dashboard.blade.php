<x-app-layout>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- رسالة نجاح --}}
            @if(session('success'))
                <div class="mb-4 p-4 rounded bg-green-100 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            {{-- إحصائيات سريعة --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded shadow">
                    <h3 class="font-bold text-lg text-gray-800 dark:text-gray-200">Total Articles</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ \App\Models\Post::count() }}</p>
                </div>
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded shadow">
                    <h3 class="font-bold text-lg text-gray-800 dark:text-gray-200">Total Users</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ \App\Models\User::count() }}</p>
                </div>
            </div>

            {{-- قائمة المقالات --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold mb-4 text-gray-300">All Articles</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @forelse($posts as $post)
                        <div class="border rounded-lg p-4 bg-gray-50 dark:bg-gray-700">
                            <h4 class="font-semibold text-lg">{{ $post->title }}</h4>
                            <p class="mt-2 text-gray-600 dark:text-gray-300">{{ $post->description }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Author: {{ $post->user->name }}</p>

                            {{-- زر الحذف للأدمن --}}
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="mt-3"
                                  onsubmit="return confirm('Are you sure you want to delete this article?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="col-span-3 text-center text-gray-500">No Articles found</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
