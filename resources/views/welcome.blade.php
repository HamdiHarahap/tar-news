<?php 
    $kategori = App\Models\Category::all();

     $categoryColors = [
        'bg-red-500',
        'bg-blue-500',
        'bg-green-500',
        'bg-orange-500',
        'bg-yellow-500',
        'bg-pink-500',
        'bg-indigo-500',
        'bg-teal-500',
        'bg-gray-500',
        'bg-purple-500',
    ];

    $categoryColorMap = [];
    $colorIndex = 0;

    foreach ($kategori as $cat) {
        $categoryColorMap[$cat->id] = $categoryColors[$colorIndex % count($categoryColors)];
        $colorIndex++;
    }

    $items = $trending->skip(9)->all();
    $chunks = array_chunk($items, 4); 
?>

<x-layout>
    <x-slot:title>Home</x-slot:title>

    <section class="px-44 flex justify-between gap-8">
        <div class="flex flex-col gap-8 w-[48rem]">
            <p class="px-8 py-2 bg-red-500 rounded-md text-white font-semibold w-fit mb-8">TRENDING NOW</p>
            @if ($trending->count())
                @php $top = $trending->first(); @endphp
                <div class="relative">
                    <div>
                        <img src="{{ asset('storage/' . $top->image) }}" alt="" class="brightness-75 rounded-md w-[48rem]">
                    </div>
                    <div class="absolute flex flex-col gap-4 bottom-6 left-8">
                       <span class="{{ $categoryColorMap[$top->category->id] ?? 'bg-gray-400' }} px-8 py-1 rounded-md w-fit text-white">
                            {{ $top->category->name ?? 'Uncategorized' }}
                        </span>

                        <a href="post/{{$top->slug}}" class="text-white text-2xl font-bold">
                            {{ $top->title }}
                        </a>
                    </div>
                </div>
            @endif

            <div class="flex gap-5 justify-between">
                @foreach ($trending->skip(1)->take(3) as $item)
                    <div class="w-[15rem]">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="" class="rounded-md object-cover h-[10rem]">
                        <div class="flex flex-col gap-3 mt-5">
                            <span class="{{ $categoryColorMap[$item->category->id] ?? 'bg-gray-400' }} px-8 py-1 rounded-md w-fit text-white">
                                {{ $item->category->name ?? 'Uncategorized' }}
                            </span>

                            <a href="post/{{$item->slug}}" class="text-xl font-semibold hover:text-red-500">
                                {{ $item->title }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex flex-col gap-8">
            @foreach ($trending->skip(4)->take(5) as $item)
                <div class="flex gap-5">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="" class="rounded-md w-40 object-cover">

                    <div class="flex flex-col gap-3">
                        <span class="{{ $categoryColorMap[$item->category->id] ?? 'bg-gray-400' }} px-8 py-1 rounded-md w-fit text-white">
                            {{ $item->category->name ?? 'Uncategorized' }}
                        </span>

                        <a href="post/{{$item->slug}}" class="text-xl font-semibold hover:text-red-500">
                            {{ $item->title }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <hr class="my-10 mx-44">

    <section class="px-44 py-12 flex justify-between">
        <div class="w-[50rem]">
            <h2 class="font-bold text-2xl mb-8">Whats New</h2>
            <section class="splide" aria-label="Splide Basic HTML Example">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($chunks as $chunk)
                            <li class="splide__slide">
                                <div class="grid grid-cols-2 gap-12">
                                    @foreach ($chunk as $item)
                                        <div class="w-[20rem] h-[20rem] relative">
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="" class="w-full h-full object-cover rounded-md" />
                                            <div class="bg-gray-100 flex flex-col gap-5 w-[75%] rounded-e-md py-7 absolute -bottom-8">
                                                <span class="{{ $categoryColorMap[$item->category->id] ?? 'bg-gray-400' }} px-8 py-1 rounded-md w-fit text-white">
                                                    {{ $item->category->name ?? 'Uncategorized' }}
                                                </span>
                                                <a href="post/{{$item->slug}}" class="text-xl font-semibold hover:text-red-500">
                                                    {{ $item->title }}
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
        <div>
            <img src="{{ asset('/assets/images/news_card.jpg') }}" alt="">
        </div>
    </section>
</x-layout>

