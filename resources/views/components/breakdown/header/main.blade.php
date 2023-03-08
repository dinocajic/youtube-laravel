<header class="w-full text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800">
    <div x-data="{ open: false }" class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
        <x-breakdown.header.logo page-title="{{ $attributes['page-title'] }}" />
        <x-breakdown.header.nav />
    </div>
</header>
