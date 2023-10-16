<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :has-inline-label="$hasInlineLabel()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-actions="$getHintActions()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :state-path="$getStatePath()"
>
    <div
        {{
            $attributes
                ->merge($getExtraAttributes(), escape: false)
                ->class([
                    'fi-fo-placeholder sm:text-sm',
                    'sm:pt-1.5' => $hasInlineLabel()
                ])
        }}
    >
        {{ $getContent() }}
    </div>
</x-dynamic-component>
