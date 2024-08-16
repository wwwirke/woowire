<div>
    @isset($categories)
        @foreach ($categories as $category)
            <a href="{{ $category['link'] }}" class="mt-1 text-sm text-gray-500">{{ $category['name'] }}</a>
        @endforeach
    @endisset
</div>
