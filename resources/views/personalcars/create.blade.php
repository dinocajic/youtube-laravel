<x-layouts.app title="{{ $title }}">
    <div class="flex bg-white mt-12">
        <div class="flex justify-center items-center w-full">
            <div class="w-1/2 bg-white rounded shadow-2xl p-8 m-4">
                <h1 class="block w-full text-center text-gray-800 text-2xl font-bold mb-6">Add New Car</h1>
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form action="/personalcars/" method="post">
                    @csrf
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-bold text-lg text-gray-900" for="year">Year</label>
                        <input class="border py-2 px-3 text-grey-800" type="number" name="year" id="year" min="1920" max="{{ date('Y') + 1 }}" placeholder="2003">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-bold text-lg text-gray-900" for="make">Make</label>
                        <input class="border py-2 px-3 text-grey-800" type="text" name="make" id="make" placeholder="Chevy">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-bold text-lg text-gray-900" for="model">Model</label>
                        <input class="border py-2 px-3 text-grey-800" type="text" name="model" id="model" placeholder="Corvette">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-bold text-lg text-gray-900" for="password">Transmission</label>
                        <div class="flex items-center mb-4">
                            <input id="is-manual-1" type="radio" name="is_manual" value="1" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300" checked>
                            <label for="is-manual-1" class="text-sm font-medium text-gray-900 ml-2">
                                Manual
                            </label>
                        </div>
                        <div class="flex items-center mb-4">
                            <input id="is-manual-2" type="radio" name="is_manual" value="0" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300">
                            <label for="is-manual-2" class="text-sm font-medium text-gray-900 ml-2">
                                Automatic
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-bold text-lg text-gray-900" for="exterior_color">Exterior Color</label>
                        <input class="border py-2 px-3 text-grey-800" type="text" name="exterior_color" id="exterior_color" placeholder="Blue">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-bold text-lg text-gray-900" for="purchase_amount">Purchase Amount (in USD)</label>
                        <input class="border py-2 px-3 text-grey-800" type="text" name="purchase_amount" id="purchase_amount" placeholder="9532.57">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-bold text-lg text-gray-900" for="current_value">Current Value (in USD)</label>
                        <input class="border py-2 px-3 text-grey-800" type="text" name="current_value" id="current_value" placeholder="95532.57">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-bold text-lg text-gray-900" for="sales_amount">Sales Amount (in USD)</label>
                        <input class="border py-2 px-3 text-grey-800" type="text" name="sales_amount" id="sales_amount" placeholder="0.00">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-bold text-lg text-gray-900" for="date_purchased">Date Purchased</label>
                        <input class="border py-2 px-3 text-grey-800" type="date" name="date_purchased" id="date_purchased">
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="mb-2 font-bold text-lg text-gray-900" for="date_sold">Date Sold</label>
                        <input class="border py-2 px-3 text-grey-800" type="date" name="date_sold" id="date_sold">
                    </div>
                    <div class="flex flex-col mb-4">
                        <div class="mb-8">
                            <label class="mb-2 font-bold text-lg text-gray-900 block" for="file">Select Image</label>
                            <input type="file" name="file" id="file" class="mb-2 text-lg text-gray-900" />
                        </div>
                    </div>

                    <button class="block bg-green-400 hover:bg-green-600 text-white uppercase text-lg mx-auto p-4 rounded" type="submit">Save Car</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
