<x-layouts.app title="Мнемотехники — Выбор темы">

<x-settings.layout :heading="'Выбор темы'" :subheading="'Настройки внешнего вида'">

@if(session('status'))
    <div>Данные сохранены</div>
@endif

<form method="POST" action="{{ route('appearance.update') }}">
    @csrf
    @method('PUT')

    <p>Тут потом добавишь тему / dark mode / что угодно</p>

    <button type="submit">Сохранить</button>
</form>

</x-settings.layout>
</x-layouts.app>