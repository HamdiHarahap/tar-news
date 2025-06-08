<x-layout>
    <x-slot:title>Berita | {{$categoryName}}</x-slot:title>

    <section class="px-44">
        <div class="grid grid-cols-3 gap-10">
            @foreach ($data as $item)
            <div class="flex flex-col gap-5">
                <img src="{{ asset('storage/' . $item->image) }}" alt="" class="rounded-md object-cover h-[12rem]">
                <div class="flex flex-col gap-3 mt-2">
                    <span class="bg-gray-400 px-8 py-1 rounded-md w-fit text-white">
                        {{ $item->category->name ?? 'Uncategorized' }}
                    </span>  
                    <a href="" class="text-xl font-semibold hover:text-red-500">
                        {{ $item->title }}
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</x-layout>