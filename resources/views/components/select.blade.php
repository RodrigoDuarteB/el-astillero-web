<div>
    <select {{ $attributes->merge(['class' => 'rounded-lg shadow-md border-gray-300 cursor-pointer text-gray-500 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) }}>
        {{ $slot }}
    </select>
</div>
