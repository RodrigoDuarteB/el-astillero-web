<div>
    <div class="rounded-md shadow-xl w-full h-full">
        <img src="{{ $source }}" alt="" style="width: 640px; height: 480px; background-size: contain">
        <div class="p-4">
            <h2 class="text-lg mb-1">{{ $title }}</h2>
            <p class="text-xs">{{ $summary }}</p>
            <div class="text-sm">
                {{ $others }}
            </div>
        </div>
    </div>
</div>
