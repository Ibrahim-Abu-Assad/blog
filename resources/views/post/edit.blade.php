<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Category Navigation -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4 p-8">
                <form action="{{ route('posts.update',$post->id) }}" method="post" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="text-center text-3xl mb-6">
                        Update Post: <strong>{{ $post->title }}</strong>
                    </div>

                    @if ($post->imageUrl())
                        <div>
                            <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}"
                                class="w-full">
                        </div>
                    @endif

                    <!-- Image -->
                    <div>
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black" for="file_input">
                        Image</label>
                    <input
                        class="mb-4 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 light:text-gray-400 focus:outline-none light:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="file_input" name="image" type="file">

                    <!-- Title -->
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" name="title" :value="old('title', $post->title)"
                            autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    {{-- Category --}}
                    <div class="mt-2">
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select name="category_id" id="category_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value = "" selected hidden>Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $post->category->id) == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    {{-- Content --}}
                    <div class="mt-4">
                        <x-input-label for="content" :value="__('Content')" />
                        <x-input-textarea id="content" class="block mt-1 w-full" name="content"
                            autofocus>{{ old('content', $post->content) }}</x-input-textarea>
                        <x-input-error :messages="$errors->get('content', $post->content)" class="mt-2" />
                    </div>

                    {{-- Submit and Cancel buttons --}}
                    <div>
                        <x-cancel-button
                            href="{{ route('post.show', ['username' => $post->user->username, 'post' => $post->slug]) }}">
                            Cancel
                        </x-cancel-button>
                        <x-primary-button class="mt-4 ml-4">
                            Update
                        </x-primary-button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
