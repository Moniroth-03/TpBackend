<span
    class="flex flex-1 {{ $promotion['backgroundcolor'] }} justify-center h-[250px] hover:border-slate-100 items-center w-[350px] rounded-md shadow-md overflow-hidden">
    <div class="flex flex-col m-auto flex-1 px-4 gap-4">
        <div class="flex items-center">
            <h3 class="font-semibold">{{ $promotion['title'] }}</h3>
        </div>
        <button class="bg-green-500 text-white p-2 rounded-lg">Shop Now</button>
    </div>

    <div class="relative h-full w-1/2 overflow-visible">
        <img class="h-full absolute w-full object-cover top-5 bottom-5" src="{{ $promotion['image'] }}"
            :alt="name" />
    </div>
</span>
