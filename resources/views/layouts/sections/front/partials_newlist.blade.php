@foreach ($news as $new)
    <div class="border-bottom py-2">
        <a href="{{ route('news.detail', ['id' => $new->id])}}"
            class="text-decoration-none text-black">
            {{ $new->name }}
        </a>
    </div>
@endforeach
