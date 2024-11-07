<x-login-layout>
    <div>
        <x-logo 
            logo="{{asset('images/POD-With-Text.svg')}}" 
            type="image" 
            class="w-[300px] mb-5"/>

    </div>
    <div>
        <x-form.form action="/login" method="post">
             <x-form.field 
                name="email" 
                label="{{ __('forms.lbl_email') }}" 
                type="email" value="{{ old('email') }}" 
                field-classes="mb-3" />

                <x-form.field 
                name="password" 
                label="{{ __('forms.lbl_password') }}" 
                type="password" 
                field-classes="mb-10" />

                <x-form.submit class="w-full" icon="arrow-right-to-bracket">
                    {{ __('forms.btn_login') }}
                </x-form.submit>
        </x-form.form>
    </div>
</x-login-layout>