@props([
    'method' => 'post',
])

<form
    method="{{ $method }}"
    x-data="{
        isUploadingFile: false,
        init() {
            Livewire.hook('commit', ({ succeed }) => {
                succeed(() => {
                    this.$nextTick(() => {
                        const firstErrorMessage = document.querySelector('.fi-fo-field-wrp-error-message')

                        if (firstErrorMessage !== null) {
                            firstErrorMessage.scrollIntoView({ block: 'center', inline: 'center' })
                        }
                    })
                })
            })
        }
    }"
    x-on:submit="if (isUploadingFile) $event.preventDefault()"
    x-on:file-upload-started="isUploadingFile = true"
    x-on:file-upload-finished="isUploadingFile = false"
    {{ $attributes->class(['fi-form grid gap-y-6']) }}
>
    {{ $slot }}
</form>
