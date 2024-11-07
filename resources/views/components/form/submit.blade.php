<div class="{{ request()->is('login') ? 'text-center' : ''}}">
    <button 
        type="submit" 
        name="submit" {{ $attributes->merge(['class'=> 'flex gap-3 justify-center items-center bg-cypher-purple text-white pt-2 pb-2 ps-3 pe-3 font-bold rounded mt-2 shadow shadow-cypher-purple hover:bg-cypher-purple/50 hover:text-white transition-colors duration-300 cursor-pointer']) }}>

        <i class="fa-solid fa-{{$attributes->get('icon')}}"></i>

        {{$slot}}
    </button>
</div>