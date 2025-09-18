<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition.opacity.duration.500ms>
    <!-- success -->
    <div
        class="absolute z-50 top-10 right-10 flex items-center gap-x-2 border p-4 pr-6 rounded-lg max-w-md shadow-md {{ $type == 'success' ? 'bg-green-100 text-green-500 border-green-500' : 'bg-red-100 text-red-500 border-red-500' }} ">
        @if ($type === 'success')
            <i data-lucide="circle-check-big" class="h-4 text-success" stroke-width="2.5"></i>
        @else
            <i data-lucide="circle-x" class="h-4 text-danger" stroke-width="2.5"></i>
        @endif
        <!-- Text -->
        <p class="text-xs font-semibold">
            {{ $message }}
        </p>
    </div>
</div>
