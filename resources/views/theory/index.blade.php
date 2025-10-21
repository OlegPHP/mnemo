<x-layouts.app title="Мнемотехники — список теорий">
    <div class="theory-list mx-auto max-w-3xl p-6">
        @foreach($theories as $theory)
            <flux:text class="text-lg border-b border-gray-200 dark:border-gray-700 py-3">
                <flux:link
                    href="{{ route('theories.show', ['theory' => $theory->slug]) }}"
                    class="text-gray-800 dark:text-gray-200 hover:text-blue-500"
                    style="text-decoration: none !important;"
                >
                    {{ $theory->title }}
                </flux:link>
            </flux:text>
        @endforeach
    </div>
</x-layouts.app>
