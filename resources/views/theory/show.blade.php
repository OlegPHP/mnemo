<x-layouts.app :title="'Мнемотехники — ' . $theory->title">
    @vite('resources/css/theory.css') <!-- отдельный CSS -->
    <article class="article-content mx-auto max-w-3xl p-6">
        {!! $theory->content !!}
    </article>
</x-layouts.app>
