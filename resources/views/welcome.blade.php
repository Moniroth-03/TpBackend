<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    }
                }
            }
        }
    </script>
</head>

<body>
    <!-- Include the Category component for each category -->

    <section class="flex flex-col gap-12 items-center justify-center min-h-screen mx-8 mt-8">
        <a class="bg-pink-200 p-2 rounded-md px-4" href="{{ route('products.create') }}">Create Product</a>
        <div class="flex flex-row gap-4">
            @foreach ($categories as $category)
                <x-category :category="$category" />
            @endforeach
        </div>

        <div class="flex w-full gap-4">
            @foreach ($promotions as $promotion)
                <x-promotion :promotion="$promotion" />
            @endforeach
        </div>

        <div class="grid grid-cols-5 justify-center gap-4 mb-16">
            @foreach ($products as $product)
                <x-product :product="$product" />
            @endforeach
        </div>

    </section>
</body>

</html>
