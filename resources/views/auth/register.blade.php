<x-layout>
@section('title', __('titles.register'))
<x-heading heading="{{__('titles.register')}}" class="text-4xl text-black"/>
<div>
    <x-form.form action="/register" method="post">
        <x-form.field 
            name="name" 
            label="{{ __('forms.lbl_name') }}" 
            type="text"/>

        <x-form.field 
            name="email" 
            label="{{ __('forms.lbl_email') }}" 
            type="email"/>

        <x-form.field 
            name="password" 
            label="{{ __('forms.lbl_password') }}" 
            type="password"/>

        <x-form.field 
            name="password_confirmation" 
            label="{{ __('forms.lbl_confirmed_password') }}" 
            type="password"/>

        <x-form.submit class="w-auto">
            {{ __('forms.btn_register') }}
            <img src="{{asset('images/right-to-bracket.svg')}}"/>
        </x-form.submit>
    </x-form.form>
</div>
</x-layout>