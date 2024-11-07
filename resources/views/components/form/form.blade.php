@props(['action','method'])
<form {{$attributes->merge(['class'=>'shadow p-10 bg-cypher-gray'])}} action="{{$action}}" method="post">
    @method(strtoupper($method)) 
    @csrf
    {{ $slot }}
</form>