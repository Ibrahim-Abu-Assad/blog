<div class="flex flex-col sm:flex-row-reverse bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
    <!-- Image Section -->
    <div class="w-full max:60 sm:w-1/3">
        <a href="{{ route('post.show', [$post->user->username, $post]) }}">
            <img class="w-full h-full object-cover" src="{{ Storage::url($post->image) }}"
                alt="Image for {{ $post->title }}" />
        </a>
    </div>

    <!-- Content Section -->
    <div class="p-5 flex-1">
        <a
            href="{{ route('post.show', [
                'username' => $post->user->username,
                'post' => $post->slug,
            ]) }}">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                {{ $post->title }}
            </h5>
        </a>
        <p class="mb-3 font-normal text-gray-700">
            {{ \Illuminate\Support\Str::words($post->content, 20) }}
        </p>
        <a href="{{ route('post.show', [$post->user->username, $post]) }}" class="text-sm text-gray-400 flex gap-4">
            {{ $post->createdAtFormatting() }}
            <span class="inline-flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
                {{ $post->loves->count() }}
            </span>
        </a>
        <div class="mt-10">
            <a href="{{ route('post.show', [$post->user->username, $post]) }}">
                <x-primary-button>View Post</x-primary-button>
            </a>
        </div>
    </div>
</div>
