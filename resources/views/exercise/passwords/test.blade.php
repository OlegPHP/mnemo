<x-layouts.app :title="'Мнемотехники — тест номера телефонов'">
    <div class="flex flex-col items-center justify-center min-h-[70vh] px-4 py-12">
        <div class="w-full max-w-md bg-neutral-100 dark:bg-neutral-900 border border-neutral-300 dark:border-neutral-800 rounded-2xl p-8 shadow-md transition-colors">
            <h1 class="text-2xl font-semibold text-center text-neutral-900 dark:text-white mb-4">
                Введите номера телефонов
            </h1>

            <p id="progress" class="text-center text-sm text-neutral-700 dark:text-neutral-300 mb-6">
                1 / {{ count($items) }}
            </p>

            <form id="words-form" action="{{ route('exercises.phones.result', ['exercise' => $exercise->slug]) }}" method="POST" class="space-y-4">
                @csrf

                @foreach ($items as $index => $item)
                    <div class="word-card" data-index="{{ $index }}" @if($index !== 0) style="display:none" @endif>
                        <div class="flex flex-col items-center space-y-3">
                            <div class="w-full bg-neutral-50 dark:bg-neutral-800 rounded-lg p-6 shadow-sm text-center transition-colors">
                                <p class="text-lg font-medium text-neutral-900 dark:text-white">
                                    {{ $loop->iteration }}
                                </p>
                            </div>

                            <flux:input
                                name="answers[{{ $item }}]"
                                placeholder="Введите номер"
                                class="w-full"
                                class:input="text-base"
                                aria-label="Ответ для {{ $item }}"
                                data-answer-input
                            />
                            <p class="text-red-500 text-sm hidden" data-error>Введите номер, прежде чем перейти дальше</p>
                        </div>
                    </div>
                @endforeach

                <div class="flex items-center justify-between mt-4">
                    <flux:button
                        type="button"
                        id="prevBtn"
                        variant="subtle"
                        color="neutral"
                        class="cursor-pointer"
                        disabled>
                        Назад
                    </flux:button>

                    <div class="flex gap-2">
                        <flux:button
                            type="button"
                            id="nextBtn"
                            variant="primary"
                            color="yellow"
                            class="cursor-pointer">
                            Далее
                        </flux:button>
                        <flux:button
                            type="submit"
                            id="submitBtn"
                            variant="primary"
                            color="yellow"
                            class="cursor-pointer"
                            style="display:none">
                            Проверить ответы
                        </flux:button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function () {
            const cards = Array.from(document.querySelectorAll('.word-card'));
            const total = cards.length;
            const progress = document.getElementById('progress');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const submitBtn = document.getElementById('submitBtn');
            const form = document.getElementById('words-form');
            let current = 0;

            function showIndex(i) {
                cards.forEach((c, idx) => c.style.display = idx === i ? '' : 'none');
                updateControls();
                focusCurrentInput();
                progress.textContent = `${i + 1} / ${total}`;
            }

            function updateControls() {
                prevBtn.disabled = current === 0;
                nextBtn.style.display = current === total - 1 ? 'none' : '';
                submitBtn.style.display = current === total - 1 ? '' : 'none';
            }

            function focusCurrentInput() {
                const input = cards[current].querySelector('input');
                if (input) {
                    input.focus();
                    input.select?.();
                }
            }

            function validateCard(card) {
                const input = card.querySelector('input');
                const error = card.querySelector('[data-error]');
                if (input.value.trim() === '') {
                    error.classList.remove('hidden');
                    input.classList.add('border-red-500');
                    input.focus();
                    return false;
                } else {
                    error.classList.add('hidden');
                    input.classList.remove('border-red-500');
                    return true;
                }
            }

            function validateCurrent() {
                return validateCard(cards[current]);
            }

            function goNext() {
                if (!validateCurrent()) return;
                if (current < total - 1) {
                    current++;
                    showIndex(current);
                }
            }

            function goPrev() {
                if (current > 0) {
                    current--;
                    showIndex(current);
                }
            }

            // Валидация перед отправкой формы
            form.addEventListener('submit', (e) => {
                if (!validateCurrent()) {
                    e.preventDefault();
                }
            });

            // Клавиатура: Enter → Далее / Отправить, стрелки ←→
            form.addEventListener('keydown', (e) => {
                if (e.ctrlKey || e.altKey || e.metaKey) return;

                if (e.key === 'Enter') {
                    e.preventDefault();
                    if (current === total - 1) {
                        if (validateCurrent()) form.submit();
                    } else {
                        goNext();
                    }
                } else if (e.key === 'ArrowLeft') {
                    e.preventDefault();
                    goPrev();
                } else if (e.key === 'ArrowRight') {
                    e.preventDefault();
                    goNext();
                }
            });

            prevBtn.addEventListener('click', (e) => {
                e.preventDefault();
                goPrev();
            });

            nextBtn.addEventListener('click', (e) => {
                e.preventDefault();
                goNext();
            });

            // Старт
            showIndex(current);
            setTimeout(focusCurrentInput, 120);
        })();
    </script>
</x-layouts.app>
