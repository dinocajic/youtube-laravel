<div>
    <p class="font-medium">
        {{ $attributes['column-title'] }}
    </p>
    <nav class="flex flex-col mt-4 space-y-2 text-sm text-gray-500">
        @foreach($attributes['links'] as $link => $link_title)
            <a class="hover:opacity-75" href="{{ $link }}"> {{ $link_title }} </a>
        @endforeach
    </nav>
</div>
