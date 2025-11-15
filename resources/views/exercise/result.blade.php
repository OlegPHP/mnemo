<x-layouts.app :title="'Статистика по упражнениям'">

    <div class="mx-auto max-w-5xl p-6 space-y-8">

        <flux:heading size="xl" level="1" class="text-3xl font-bold">
            Статистика по упражнениям
        </flux:heading>

        <!-- Сообщение об успешном сбросе -->
        @if(session('success'))
            <div class="p-4 bg-green-100 text-green-800 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach ($stats as $type => $data)
                <div class="border rounded-2xl p-4">
                    <div class="flex justify-between items-center mb-2">
                        <flux:heading size="lg" level="2" class="text-lg font-semibold">
                            @if($type == 'words') Список английских слов
                            @elseif($type == 'list') Список покупок
                            @elseif($type == 'passwords') Пароли
                            @elseif($type == 'phones') Номера телефонов
                            @endif
                        </flux:heading>

                        <!-- Кнопка сброса -->
                        <form action="{{ route('result.reset', $type) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-500 text-sm cursor-pointer">
                                Сбросить
                            </button>
                        </form>
                    </div>

                    <p>Всего элементов: <span class="font-medium">{{ $data['count'] }}</span></p>
                    <p>Средний балл: <span class="font-medium">{{ $data['accuracy'] }}%</span></p>

                    <p class="text-sm mt-2">
                        Последнее упражнение: {{ $data['latest'] ? $data['latest']->format('d.m.Y H:i') : '—' }}
                    </p>

                    <flux:link :href="route('result.type', $type)" class="mt-3 inline-block text-blue-600 hover:text-blue-500">
                        Смотреть результаты →
                    </flux:link>
                </div>

            @endforeach

            <!-- Карточка со средней точностью -->
            <div class="border rounded-2xl p-6 bg-gray-50 dark:bg-gray-800 flex flex-col items-center justify-center text-center">
                <flux:heading size="lg" level="2" class="text-lg font-semibold mb-2">
                    Средняя точность
                </flux:heading>
                <p class="text-3xl font-bold">{{ $totalAverage }}%</p>
            </div>

        </div>

    </div>
</x-layouts.app>
