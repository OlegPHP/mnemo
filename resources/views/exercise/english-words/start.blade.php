<x-layouts.app :title="'Мнемотехники — список английских слов'">

    <form action="{{route('exercises.learn', ['exercise' => $exercise->slug])}}" method="POST">
        @csrf
    <flux:select name="number"  placeholder="Выберите количество слов">
        @for($i = 1; $i <= 25; $i++)
        <flux:select.option>{{$i}}</flux:select.option>
        @endfor
    </flux:select>
        <br>
        <flux:button type="submit" variant="primary" color="yellow">Начать</flux:button>
    </form>
</x-layouts.app>
