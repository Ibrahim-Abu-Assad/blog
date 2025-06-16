<a href="{{ $href ?? route('dashboard') }}"
    {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-gray-300 hover:bg-gray-400 text-black rounded-md font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150']) }}>
    {{ $slot }}
</a>
