<x-layouts.app title="Мнемотехники — теория">
    @foreach($theories as $theory)

         <a href="{{ route('theories.show', ['theory' => $theory->slug]) }}">{{ $theory->title }}</a>


    @endforeach
</x-layouts.app>
