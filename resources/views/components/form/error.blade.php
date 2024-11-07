@props(['name'])
@error($name)
    <div class="text-cypher-red font-sm mt-1 mb-2">{{ $message }}</div>
@enderror