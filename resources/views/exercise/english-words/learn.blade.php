<x-layouts.app :title="'Мнемотехники — список английских слов'">
    <div class="article-content mx-auto max-w-3xl p-6 space-y-6 text-lg">
        @foreach($selectedWords as $word)

            <p>{{$word['word']}} - {{$word['translation']}}<p>
        @endforeach
    </div>
</x-layouts.app>
