<x-layout :city="$selected">
    @foreach($cities as $city)
        <a @style(['font-weight: bold'=>$selected->slug==$city->slug]) href="{{$city->slug}}">{{$city->name}}</a><br>
    @endforeach
</x-layout>

