<x-layouts.app :title="'Мнемотехники — результат упражнения'">
    <div class="article-content mx-auto max-w-4xl p-6 space-y-6 text-lg">

        <!-- Карточка с результатом и полосой прогресса -->
        <div class="relative bg-neutral-50 dark:bg-neutral-900 border border-neutral-300 dark:border-neutral-800 rounded-2xl p-6 shadow-md transition-colors overflow-hidden">

            <!-- Полоска прогресса -->
            <div class="absolute top-0 left-0 h-1 w-full bg-neutral-200 dark:bg-neutral-800">
                <div class="h-1 bg-yellow-400 dark:bg-yellow-500 transition-all duration-500" style="width: {{$percent}}%;"></div>
            </div>

            <!-- Заголовок и текст -->
            <h1 class="text-2xl font-semibold text-neutral-900 dark:text-white mb-2 text-center">Результаты упражнения</h1>
            <p class="text-lg text-neutral-700 dark:text-neutral-300 mb-1 text-center">Правильных ответов: <span class="font-medium">{{$percent}}%</span></p>
            <p class="text-lg text-neutral-700 dark:text-neutral-300 text-center">Очки: <span class="font-medium">{{$score}}</span> из <span class="font-medium">{{$total}}</span></p>
        </div>

        <!-- Таблица с деталями -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-left">
                <thead>
                <tr class="bg-neutral-200 dark:bg-neutral-800 text-neutral-900 dark:text-white">
                    <th class="px-4 py-2 border-b border-neutral-300 dark:border-neutral-700">Позиция</th>
                    <th class="px-4 py-2 border-b border-neutral-300 dark:border-neutral-700">Ответ</th>
                    <th class="px-4 py-2 border-b border-neutral-300 dark:border-neutral-700">Верно</th>
                    <th class="px-4 py-2 border-b border-neutral-300 dark:border-neutral-700">Правильный ответ</th>
                </tr>
                </thead>
                <tbody>
                @foreach($details as $detail)
                    <tr class="@if($loop->even) bg-neutral-50 dark:bg-neutral-900 @else bg-neutral-100 dark:bg-neutral-800 @endif">
                        <td class="px-4 py-2 border-b border-neutral-300 dark:border-neutral-700 font-medium">{{$detail['position']}}</td>
                        <td class="px-4 py-2 border-b border-neutral-300 dark:border-neutral-700">{{$detail['answer']}}</td>
                        <td class="border-b border-neutral-300 dark:border-neutral-700 py-2">
                            <div class="flex justify-start items-center h-full w-full pointer-events-none pl-6">
                                @if ($detail['correct'])
                                    <flux:navlist.item icon="check-circle" class="p-0 m-0" />
                                @else
                                    <flux:navlist.item icon="x-circle" class="p-0 m-0" />
                                @endif
                            </div>
                        </td>

                        <td class="px-4 py-2 border-b border-neutral-300 dark:border-neutral-700">{{$detail['number']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <div class="text-center mt-6">
        <flux:button href="{{ route('exercises.phones.start', ['exercise' => $exercise->slug]) }}" variant="primary" color="yellow">
            Пройти снова
        </flux:button>
    </div>
</x-layouts.app>
