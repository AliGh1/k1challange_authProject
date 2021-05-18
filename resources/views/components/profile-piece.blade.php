@props(['title'])
<div>
    <div class="block font-medium text-sm text-gray-700">
        {{ $title }}
    </div>

    <div class="rounded-md shadow-sm border-gray-300 p-2 border bg-purple-50">
        {{ $slot }}
    </div>
</div>
