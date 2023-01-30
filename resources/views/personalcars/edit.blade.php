<x-layouts.app title="{{ $title }}">
    <div class="flex bg-white mt-12">
        <div class="flex justify-center items-center w-full">
            <div class="w-1/2 bg-white rounded shadow-2xl p-8 m-4">
                <h1 class="block w-full text-center text-gray-800 text-2xl font-bold mb-6">Edit Car</h1>
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                @if (session('status'))
                    <div class="block bg-green-200 p-4 mb-4">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="/personalcars/{{ $car->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-bold text-lg text-gray-900" for="year">Year</label>
                        <input class="border py-2 px-3 text-grey-800" type="number" name="year" id="year" value="{{ $car->year }}" min="1920" max="{{ date('Y') + 1 }}" placeholder="2003">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-bold text-lg text-gray-900" for="make">Make</label>
                        <input class="border py-2 px-3 text-grey-800" type="text" name="make" id="make" value="{{ $car->brand->name }}" placeholder="Chevy">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-bold text-lg text-gray-900" for="model">Model</label>
                        <input class="border py-2 px-3 text-grey-800" type="text" name="model" id="model" value="{{ $car->model->name }}" placeholder="Corvette">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-bold text-lg text-gray-900" for="password">Transmission</label>
                        <div class="flex items-center mb-4">
                            <input id="is-manual-1" type="radio" name="is_manual" value="1" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300" {{ $car->is_manual == "Manual" ? "checked" : "" }}>
                            <label for="is-manual-1" class="text-sm font-medium text-gray-900 ml-2">
                                Manual
                            </label>
                        </div>
                        <div class="flex items-center mb-4">
                            <input id="is-manual-2" type="radio" name="is_manual" value="0" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300" {{ $car->is_manual == "Automatic" ? "checked" : "" }}>
                            <label for="is-manual-2" class="text-sm font-medium text-gray-900 ml-2">
                                Automatic
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-bold text-lg text-gray-900" for="exterior_color">Exterior Color</label>
                        <input class="border py-2 px-3 text-grey-800" type="text" name="exterior_color" id="exterior_color" value="{{ $car->exterior_color }}" placeholder="Blue">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-bold text-lg text-gray-900" for="purchase_amount">Purchase Amount (in USD)</label>
                        <input class="border py-2 px-3 text-grey-800" type="text" name="purchase_amount" id="purchase_amount" value="{{ preg_replace("#[^0-9.]#", "", $car->purchase_amount) }}" placeholder="9532.57">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-bold text-lg text-gray-900" for="current_value">Current Value (in USD)</label>
                        <input class="border py-2 px-3 text-grey-800" type="text" name="current_value" id="current_value" value="{{ preg_replace("#[^0-9.]#", "", $car->current_value) }}" placeholder="95532.57">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-bold text-lg text-gray-900" for="sales_amount">Sales Amount (in USD)</label>
                        <input class="border py-2 px-3 text-grey-800" type="text" name="sales_amount" id="sales_amount" value="{{ $car->sales_amount == "N/A" ? 0 : preg_replace("#[^0-9.]#", "", $car->sales_amount) }}" placeholder="0.00">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-bold text-lg text-gray-900" for="date_purchased">Date Purchased</label>
                        <input class="border py-2 px-3 text-grey-800" type="date" name="date_purchased" id="date_purchased" value="{{ $car->date_purchased }}">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-bold text-lg text-gray-900" for="date_sold">Date Sold</label>
                        <input class="border py-2 px-3 text-grey-800" type="date" name="date_sold" id="date_sold" value="{{ $car->date_sold }}">
                    </div>

                    <div class="flex flex-col mb-4">
                        @foreach( $car->images as $image )
                            <div class="w-80 bg-white p-3">
                                <img class="h-52 w-full object-cover" src="{{ asset( 'storage/' . $image->url ) }}" alt="{{ $image->alt }}" />
                            </div>
                        @endforeach

                        <div class="mb-8">
                            <label class="mb-2 font-bold text-lg text-gray-900 block" for="file">Add Another Image</label>
                            <input type="file" name="file" id="file" class="mb-2 text-lg text-gray-900" />
                        </div>
                    </div>

                    <button class="block bg-green-400 hover:bg-green-600 text-white uppercase text-lg mx-auto p-4 rounded" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
