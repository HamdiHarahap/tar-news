<x-layout>
    <x-slot:title>Berita | {{$data->title}}</x-slot:title>

    <section class="px-44 flex justify-between gap-14">
        <div class="w-[50rem]">
            <div class="flex flex-col gap-1 mb-7">
                <h2 class="font-bold text-2xl">{{$data->title}}</h2>
                <p class="text-zinc-500 text-sm">{{ $data->created_at->format('d F Y') }}</p>

            </div>
            <img src="{{ asset('storage/' . $data->image) }}" alt="" class="w-full rounded-md mb-7">
            @foreach (explode("\n", $data->body) as $paragraph)
                <p class="text-zinc-700 mb-4">{{ $paragraph }}</p>
            @endforeach

        </div>
        <div>
            <img src="{{ asset('/assets/images/news_card.jpg') }}" alt="" class="w-[15rem]">
        </div>
    </section>
</x-layout>