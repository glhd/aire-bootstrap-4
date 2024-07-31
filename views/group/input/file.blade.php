<?php /** @var \Galahad\Aire\Elements\Attributes\Collection $attributes */ ?>

<div {{ $attributes }}>
    @if($prepend || $append)
        <div {{ $attributes->input_group }}>
            @endif
            
            @if($prepend)
                <div {{ $attributes->prepend }}>
                    <div class="input-group-text">
                        {{ $prepend }}
                    </div>
                </div>
            @endif
    
            <div class="custom-file">
                {{ $label }}
                {{ $element }}
            </div>
            
            @if($append)
                <div {{ $attributes->append }}>
                    <div class="input-group-text">
                        {{ $append }}
                    </div>
                </div>
            @endif
            
            @if($prepend || $append)
        </div>
    @endif
    
    @isset($help_text)
        <small {{ $attributes->help_text }}>
            {{ $help_text }}
        </small>
    @endisset
    
    <div {{ $attributes->errors }}>
        @each($error_view, $errors, 'error')
    </div>

</div>
