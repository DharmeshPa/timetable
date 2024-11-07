<div class="rounded-md alert alert-{{ $attributes->get('type') }} mb-5 {{ $attributes->get('type') === 'error' ? 'bg-cypher-red': 'bg-cypher-green' }} text-white p-3">
    {{$slot}}
</div>