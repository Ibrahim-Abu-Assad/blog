@props(['user', 'size' => 'w-16 h-16'])

<div>
    <a href="{{ route('profile.show',$user->username) }}">
    @if ($user->image)
        <img src="{{ $user->imageUrl() }}" alt="{{ $user->name }}"
            class="{{ $size }}  rounded-full border-2 border-gray-300 shadow-sm object-cover">
    @else
        <img src="/Avatar.jfif" alt="Avatar"
            class="{{ $size }}  rounded-full border-2 border-gray-300 shadow-sm object-cover">
    @endif
    </a>
</div>
