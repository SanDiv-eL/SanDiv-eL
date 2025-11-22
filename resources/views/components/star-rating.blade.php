@props(['rating', 'size' => 'w-3 h-3 sm:w-4 sm:h-4'])

<div class="flex items-center text-yellow-400">
    <span class="mr-1 text-xs font-bold text-gray-700">{{ $rating }}</span>
    @for ($i = 0; $i < 5; $i++)
        <svg class="{{ $size }} {{ $i < round($rating) ? 'fill-current' : 'text-gray-300 fill-current' }}" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
        </svg>
    @endfor
</div>
