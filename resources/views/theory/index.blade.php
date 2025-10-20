<x-layouts.app title="Мнемотехники — список теорий">
    @vite('resources/css/theory-index.css')
    <div class="theory-list mx-auto max-w-3xl p-6">
        <ul>
            @foreach($theories as $theory)
                <li>
                    <a href="{{ route('theories.show', ['theory' => $theory->slug]) }}">
                        {{ $theory->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</x-layouts.app>
