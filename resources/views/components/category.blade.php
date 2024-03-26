<article
    class="`h-[170px] w-[130px] {{ $category['backgroundcolor'] }} rounded-md shadow-md overflow-hidden cursor-pointer border-2 hover:border-slate-100 border-transparent`">
    <img class="h-[120px] w-full" src="{{ $category['image'] }}" :alt="$category['image']" />
    <h3 class="text-center font-semibold">{{ $category['name'] }}</h3>
    <p class="text-center text-xs text-[#B6B6B6]">{{ $category['quantity'] }} items</p>
</article>
