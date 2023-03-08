<h1>{{ $fastcar->make }} {{ $fastcar->model }}</h1>

<ul>
    @foreach($cars as $car)
        <li>
            <a href="/fast-cars/{{ $car->id }}">{{ $car->make }} {{ $car->model }}</a>
        </li>
    @endforeach
</ul>
