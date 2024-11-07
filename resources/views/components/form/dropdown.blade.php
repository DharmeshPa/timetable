<div class="flex justify-center">
    <div
        x-data="{
            open: false,
            toggle() {
                if (this.open) {
                    return this.close()
                }

                this.$refs.button.focus()

                this.open = true
            },
            close(focusAfter) {
                if (! this.open) return

                this.open = false

                focusAfter && focusAfter.focus()
            }
        }"
        x-on:keydown.escape.prevent.stop="close($refs.button)"
        x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
        x-id="['dropdown-button']"
        class="relative">
        <!-- Button -->
        <button
            x-ref="button"
            x-on:click="toggle()"
            :aria-expanded="open"
            :aria-controls="$id('dropdown-button')"
            type="button"
            class="bg-cypher-purple flex text-white items-center gap-2 px-5 py-2.5 rounded-md shadow">
            {{ __('forms.btn_content')}}
            <i class="fa-solid fa-angle-down"></i>
        </button>

        <!-- Panel -->
        <div
            x-ref="panel"
            x-show="open"
            x-transition.origin.top.left
            x-on:click.outside="close($refs.button)"
            :id="$id('dropdown-button')"
            style="display: none;"
            class="absolute left-0 mt-2 w-40 rounded-md bg-white shadow-md">
            
            <x-link href="/contents/create/{{$attributes->get('timetable-id')}}/topics" icon="" class="text-black">{{__('anchors.sessions')}}</x-link>
            <x-link href="/contents/create/{{$attributes->get('timetable-id')}}/message" icon="" class="text-black">{{__('anchors.message')}}</x-link>
            <x-link href="/contents/create/{{$attributes->get('timetable-id')}}/graphics" icon="" class="text-black">{{__('anchors.graphics')}}</x-link>
            <x-link href="/contents/create/{{$attributes->get('timetable-id')}}/video" icon="" class="text-black">{{__('anchors.video')}}</x-link>
        </div>
    </div>
</div>
