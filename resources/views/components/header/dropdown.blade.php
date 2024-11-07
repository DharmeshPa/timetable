<button @click="open = ! open" class="text-white flex flex-col items-center font-bold float-right py-3 px-5">
    <i class="fa-solid fa-power-off text-white text-[23px]"></i>
    {{ Auth::user()->name }}
</button>
<div x-show="open" x-transition class="absolute p-3 bg-cypher-gray w-full rounded top-[100%] border border-cypher-black/20">
    <form method="post" action="/logout">
        @method('POST')
        @csrf
        <button type="submit" name="submit" class="cypher-black cursor-pointer">
            {{__('forms.btn_logout')}}
        </button>
    </form>
</div>