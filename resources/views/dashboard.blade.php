<x-app-layout>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- رسالة نجاح --}}
            @if(session('success'))
                <div class="mb-4 p-4 rounded bg-green-100 text-green-800 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            {{-- قائمة المقالات --}}
            <div class=" bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6 ">
                <div class="text-white">
                    <center>
                        <h1 class="text-center font-semibold mb-4" style="color:#CBDCEB;">مرحبًا بك في صفحة المقالات
                        </h1>
                        <p class="text-center mb-5 font-semibold " style="color:#CBDCEB;">هنا تجد مجموعة من المقالات
                            المميزة التي تغطي مواضيع متنوعة. استمتع
                            بالقراءة!</p>
                    </center>
                </div>
                <h3 class="font-semibold text-lg mb-4 mt-4 text-gray-200 text-white" style="color:red;">All Articles
                </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @forelse($posts as $post)
                                <div class="border rounded-lg mt-3 p-4 bg-gray-50 dark:bg-gray-700">
                                    <h4 class="font-semibold text-lg  " style="color:#4D2D8C;">{{ $post->title }}</h4>
                                    <p class="mt-2 text-gray-600 dark:text-gray-300" style="color:white;">
                                        {{ $post->description }}</p>

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
            <div class="bg-white dark:bg-gray-300 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-300">Insert a new Article</h3>
                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block font-medium text-large text-gray-700 text-drck">
                            Title
                        </label>
                        <input type="text" name="title" id="title" class="w-full rounded border-gray-300"
                            placeholder="Enter Title">
                        @error('title')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block font-medium text-large text-gray-700 text-drck">
                            Description
                        </label>
                        <textarea name="description" id="description" rows="4" class="w-full rounded border-gray-200"
                            placeholder="Enter Description"></textarea>
                        @error('description')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                            <button type="submit" style="color:white;padding: 10px 15px ;margin-left:5px; background:#1F2937;border-radius: 10px;">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>