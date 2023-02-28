<h1>Cars</h1>

<ul>
    @foreach($cars as $car)
        <li>{{ $car->make }} {{ $car->model }}</li>
    @endforeach
</ul>
