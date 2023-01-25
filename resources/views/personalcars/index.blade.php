<x-layouts.app title="{{ $title }}">
    <div class="flex bg-white mt-12" style="height:600px;">
        <div class="items-center text-center lg:text-left px-8 md:px-12 lg:w-full">
            <div class="relative overflow-x-auto">
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>
