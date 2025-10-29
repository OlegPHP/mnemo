<x-layouts.app title="Мнемотехники — список упражнений">
    <div class="theory-list mx-auto max-w-3xl p-6">
        @foreach($exercises as $exercise)
            <flux:text class="text-lg border-b border-gray-200 dark:border-gray-700 py-3">
                <flux:link
                    href="{{ route('exercises.start', ['exercise' => $exercise->slug]) }}"
                    class="text-gray-800 dark:text-gray-200 hover:text-blue-500"
                    style="text-decoration: none !important;"
                >
                    {{ $exercise->title }}
                </flux:link>
            </flux:text>
        @endforeach
    </div>
</x-layouts.app>
