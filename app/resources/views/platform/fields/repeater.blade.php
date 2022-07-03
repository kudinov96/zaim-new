@component($typeForm, get_defined_vars())
    <div data-controller="repeater"
         data-repeater-name="{{ $name }}"
         data-repeater-layout="{{ $layout }}"
         data-repeater-url-fetch="{{ route("platform.fields.repeater.fetch_blocks") }}"
         data-repeater-url-add="{{ route("platform.fields.repeater.add_block") }}"
         data-repeater-count="{{ $value ? count($value) : 0 }}"
         data-repeater-value="{{ $value ? json_encode($value) : "" }}">
        <div class="repeater" id="repeater-{{ $id }}">
            <div class="repeater__blocks"></div>
            <button class="btn btn-success" type="button" data-action="click->repeater#addBlock">
                <x-orchid-icon path="plus" />
            </button>
        </div>
    </div>
@endcomponent
