<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <style>
        .splide .splide__pagination {
            position: absolute;
            bottom: -50px; 
            left: 50%;
            transform: translateX(-50%);
        }

        .splide__pagination__page {
            background-color: orange; 
            opacity: 1;
        }
        
        .splide__pagination__page.is-active {
            background-color: darkorange; 
        }
    </style>
</head>
<body>
    <x-header></x-header>

    <main class="bg-gray-100 py-10">
        {{$slot}}
    </main>

    <x-footer></x-footer>
</body>
</html>