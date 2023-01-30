<x-layouts.app title="{{ $title }}">
    <div class="flex bg-white mt-12">
        <div class="items-center text-center lg:text-left px-8 md:px-12 lg:w-full">
            <div class="relative overflow-x-auto">
                @if (session('status'))
                    <div class="block bg-green-200 p-4">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Year
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Make
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Model
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Exterior Color
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Current Value
                            </th>
                            <th scope="col" class="px-6 py-3">
                                View
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Edit
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cars as $car)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $car->year }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $car->brand->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $car->model->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $car->exterior_color }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $car->current_value }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="/personalcars/{{ $car->id }}">
                                        Show Car
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="/personalcars/{{ $car->id }}/edit">
                                        Edit Car
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <a href="/personalcars/create">
        <button class="block bg-green-400 hover:bg-green-600 text-white uppercase text-lg mx-auto p-4 rounded" type="submit">Add New Car</button>
    </a>
</x-layouts.app>
