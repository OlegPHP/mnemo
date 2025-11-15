<x-layouts.app :title="'Статистика по упражнениям'">

    <div class="mx-auto max-w-5xl p-6 space-y-8">

        <flux:heading size="xl" level="1" class="text-2xl font-bold">
            Статистика по упражнениям
        </flux:heading>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($grouped as $attemptId => $items)
                <div class="p-4 border rounded-xl">
                    <h3 class="text-xl font-bold mb-2">
                        Упражнение №{{ $loop->iteration }}
                    </h3>

                    <p class="text-sm text-neutral-500 mb-2">
                        Дата: {{ $items->first()->created_at->format('d.m.Y H:i') }}
                    </p>

                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($items as $item)
                            <li>
                                <span class="font-medium">Слово:</span> {{ $item->word }},
                                <span class="font-medium">Ответ:</span> {{ $item->answer }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="border-t border-neutral-300 dark:border-neutral-700 pt-6">
            <flux:heading level="2" class="text-xl font-semibold mb-2">
                Общий результат
            </flux:heading>
            <p>Упражнений выполнено: <span class="font-bold">{{ $total }}</span></p>
        </div>

    </div>
</x-layouts.app>
