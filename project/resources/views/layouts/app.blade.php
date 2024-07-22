<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel Import</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Excel Import</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item {{ request()->routeIs('upload.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/upload') }}">Import</a>
                </li>
                <li class="nav-item {{ request()->routeIs('redis.history') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/redis-history') }}">Redis</a>
                </li>
                <li class="nav-item {{ request()->routeIs('rows.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/rows') }}">Rows</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main>
    <div class="container mt-4">
        @yield('content')
    </div>
</main>
</body>
</html>
