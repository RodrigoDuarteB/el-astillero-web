<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <button class="bg-blue-500 sm:bg-red-400 md:bg-green-600 lg:bg-gray-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg mt-3">Mi Botón</button>

        <div class="m-5 mt-10 border rounded-md p-5 pr-10 bg-gray-500 shadow-xl">
            <p class="text-xl sm:text-lg md:text-sm text-center uppercase text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem inventore voluptate accusantium modi aspernatur magnam quo. Labore ea minus deserunt, nostrum tempora unde error. Ea modi voluptatem tenetur explicabo. Cumque.</p>
        </div>
    </div>


    <div class="container mx-auto mb-5">
        <div class="rounded shadow-lg w-2/6">
            <img src="https://www.blogartesvisuales.net/wp-content/uploads/2008/07/fotografia-paisaje-01.jpg" alt="">
            <div class="ml-5 mr-14 mt-4">
                <h2 class="mb-3 text-lg font-bold">The Coldest Sunset</h2>
                <p class="mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora et placeat, vero deserunt, dolorum velit maiores, deleniti atque numquam quaerat cumque nam doloribus aspernatur repellat! Provident quasi ipsum nisi vitae.</p>
                <span class="inline-block mb-4 bg-gray-300 rounded-lg py-1 px-2 text-sm font-bold">#photography</span>
                <span class="bg-gray-300 rounded-lg py-1 px-2 text-sm font-bold ml-2">#travel</span>
                <span class="bg-gray-300 rounded-lg py-1 px-2 text-sm font-bold ml-2">#winter</span>
            </div>
        </div>
    </div>

    <div class="container mx-auto mt-5 text-center">
        <div class="grid grid-cols-3 gap-4 my-2">
            <div class="bg-red-500">A</div>
            <div class="bg-red-500">A</div>
            <div class="bg-red-500">A</div>
            <div class="bg-red-500">A</div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 xl:grid-cols-4 gap-4">
            <div class="bg-blue-500 col-span-2">A</div>
            <div class="bg-blue-500">A</div>
            <div class="bg-blue-500">A</div>
            <div class="bg-blue-500 col-span-4">A</div>
        </div>

        <div class="grid grid-cols-12 gap-2 my-2">
            <div class="bg-gray-500">A</div>
            <div class="bg-gray-500">A</div>
            <div class="bg-gray-500">A</div>
            <div class="bg-gray-500">A</div>
            <div class="bg-gray-500">A</div>
            <div class="bg-gray-500">A</div>
            <div class="bg-gray-500">A</div>
            <div class="bg-gray-500">A</div>
            <div class="bg-gray-500">A</div>
            <div class="bg-gray-500">A</div>
            <div class="bg-gray-500">A</div>
            <div class="bg-gray-500">A</div>
        </div>

    </div>

</x-app-layout>
