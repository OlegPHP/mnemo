<x-layouts.app title="Мнемотехники — теория">
    @foreach($theories as $theory)

        <div> <a href="{{--{{ route('theories.show', ['slug' => $theory->slug]) }}--}}">{{ $theory->title }}</a></div>


    @endforeach
</x-layouts.app>
