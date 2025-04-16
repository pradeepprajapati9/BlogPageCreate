<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>

    <!-- Main Content Section -->
    <div class="container mx-auto px-6 py-12">
        <!-- Heading Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-4">
                Explore Our Latest Blog Posts
            </h1>
            <p class="text-lg md:text-xl text-gray-600">
                Stay updated with the latest news and insights. Read our curated articles on various topics.
            </p>
        </div>

        <!-- Blog Cards Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="blog-cards-container">
            @foreach($blogs as $blog)
            <a href="{{ url('blog', $blog['url']) }}" class="block group" style="text-decoration: none;">
                <div class="bg-white border border-gray-200 rounded-lg shadow-xl overflow-hidden transform transition-all group-hover:scale-105 group-hover:shadow-2xl">
                    <div class="w-full h-64 relative">
                        <img class="absolute inset-0 w-full h-full object-cover object-center rounded-t-lg group-hover:opacity-80 transition-opacity duration-300" src="{{ $blog['thumbnail'] }}" alt="{{ $blog['title'] }}">
                    </div>
                    <div class="p-6 bg-gradient-to-t from-white via-gray-50 to-transparent">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                            {{ $blog['title'] }}
                        </h3>
                        <p class="text-gray-600 mb-4">
                            {{ Str::words($blog['short_description'], 10, '...') }}
                        </p>
                        <div class="inline-block text-white bg-gradient-to-r from-blue-500 to-blue-700 font-medium py-2 px-6 rounded-lg text-center group-hover:bg-blue-600 group-hover:scale-105 transition-all duration-300">
                            <i class="fas fa-arrow-right"></i> Read More
                        </div>
                    </div>
                </div>
            </a>


        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>