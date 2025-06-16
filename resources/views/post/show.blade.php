<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4 p-8 space-y-10">
                <h1 class="text-2xl mb-4">{{ $post->title }}</h1>

                {{-- User Avatar and Actions Section --}}
                <div class="flex gap-4 justify-between items-start w-full">

                    <div class="flex gap-4">
                        <x-user-avatar :user="$post->user" />

                        <div>
                            <x-follow-ctr :user="$post->user" class="flex gap-2 items-center">
                                <a href="{{ route('profile.show', $post->user->username) }}"
                                    class="hover:underline">{{ $post->user->name }}</a>
                                @if (Auth::check() && Auth::id() !== $post->user->id)
                                    &middot;
                                    <button x-text="following ? 'Unfollow' : 'Follow'"
                                        :class="following ? 'text-red-600' : 'text-emerald-600'" @click="follow()">
                                    </button>
                                @endif
                            </x-follow-ctr>
                            <div class="text-gray-500 text-sm">
                                {{ $post->createdAtFormatting() }}
                            </div>
                        </div>
                    </div>

                    @if (Auth::check() && Auth::id() === $post->user->id)
                        <div class="flex gap-2">
                            <a href="{{ route('posts.edit',$post->slug) }}"
                                class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Edit</a>

                            <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this post?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>

                {{-- User Avatar and Actions Section --}}

                {{-- Content Section --}}
                <div class="mt-4">
                    {{ $post->content }}
                </div>
                {{-- Content Section --}}

                {{-- Image Section --}}
                <div class="mt-8">
                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="w-full">
                </div>
                {{-- Image Section --}}

                {{-- Category Section --}}
                <div class="mt-4 bg-gray-200 text-black px-4 py-2 rounded-full inline-block font-semibold">
                    {{ $post->category->name }}
                </div>
                {{-- Category Section --}}

                {{-- Love Button --}}
                <x-love-button :post="$post" />

            </div>
        </div>
    </div>
</x-app-layout>
{{--

@if (auth()->user() && auth()->user()->id !== $user->id)
    <button @click="follow" class="rounded-full bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2"
        x-text="following ? 'Unfollow' : 'Follow'"
        :class="following ? 'bg-red-600 hover:bg-red-700' : 'bg-emerald-600'">

    </button>
@endif --}}
