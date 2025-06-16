<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Category Navigation -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 text-gray-900">
                    <ul class="flex flex-wrap justify-center gap-4">
                        <li>
                            <a href="/" class="{{ request('category') ? 'px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300' : 'px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700' }}">All</a>
                        </li>
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('post.byCategory', $category) }}"
                                    class="{{
                                        Route::currentRouteNamed('post.byCategory') && request('category')->id == $category->id
                                        ? 'px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700'
                                        : 'px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300' }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Posts Section -->
            <div class="space-y-6">
                @forelse ($posts as $post)
                    <!-- Components were used -->
                    <x-post-item :post="$post" />
                @empty
                    <div class="text-center text-gray-400 py-14">
                        No Posts Found
                    </div>
                @endforelse
            </div>
            {{ $posts->onEachSide(1)->links() }}
        </div>
    </div>
</x-app-layout>
