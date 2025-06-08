<?php 
    $kategori = App\Models\Category::all();
?>

<header>
    <div class="px-44 py-6 flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-bold">TAR News</h1>
            <p class="font-semibold">THE ART OF PUBLISHING</p>
        </div>
        <img src="{{ asset('/assets/images/header_card.jpg') }}" alt="">
    </div>
    <hr>
</header>
<nav class="px-44 py-6 sticky top-0 z-50 bg-white">
    <ul class="flex gap-10 font-semibold">
        <li><a href="/" class="text-blue-900 hover:text-red-500">Beranda</a></li>
        @foreach ($kategori as $item)
            <li><a href="/category/{{$item->id}}" class="text-blue-900 hover:text-red-500">{{$item->name}}</a></li>
        @endforeach
    </ul>
</nav>
