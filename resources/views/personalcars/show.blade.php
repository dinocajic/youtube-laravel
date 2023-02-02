<x-layouts.app title="{{ $title }}">
    <div class="flex bg-white mt-12" style="height:600px;">
        <div class="w-full max-w-6xl rounded bg-white shadow-xl p-10 lg:p-20 mx-auto text-gray-800 relative md:text-left">
            <div class="md:flex items-center -mx-10">
                <div class="w-full md:w-1/2 px-10 mb-10 md:mb-0">
                    <div class="relative">
                        <img src="{{ asset( 'storage/' . $car->images[0]->url ) }}" class="w-full relative z-10" alt="">
                        <div class="border-4 border-blue-200 absolute top-10 bottom-10 left-10 right-10 z-0"></div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-10">
                    <div class="mb-10">
                        <h1 class="font-bold uppercase text-2xl mb-5">{{ $car->year . " " . $car->brand->name . " " . $car->model->name }}</h1>
                        <ul class="text-sm">
                            <li>Year: {{ $car->year }}</li>
                            <li>Make: {{ $car->brand->name }}</li>
                            <li>Make: {{ $car->model->name }}</li>
                            <li>Transmission: {{ $car->is_manual }}</li>
                            <li>Purchase Amount: {{ $car->purchase_amount }}</li>
                            <li>Current Value: {{ $car->current_value }}</li>
                            <li>Sales Amount: {{ $car->sales_amount }}</li>
                            <li>Date Purchased: {{ $car->date_purchased }}</li>
                            <li>Date Sold: {{ $car->date_sold }}</li>
                        </ul>
                    </div>
                    <div>
                        <div class="inline-block align-bottom mr-5">
                            <span class="font-bold text-5xl leading-none align-baseline">{{ $car->current_value }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex w-full flex-wrap content-center justify-center p-10">
        <div class="grid grid-cols-4 gap-3">

            @foreach( $car->images as $image )
                <div class="w-80 bg-white p-3">
                    <img class="h-52 w-full object-cover" src="{{ asset( 'storage/' . $image->url ) }}" alt="{{ $image->alt }}" />
                </div>
            @endforeach

        </div>
    </div>
</x-layouts.app>
