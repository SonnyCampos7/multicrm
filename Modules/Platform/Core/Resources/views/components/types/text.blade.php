@if(isset($entity->$fieldName))
    @if(isset($options['prefix']))
        {{ $options['prefix'] }}
    @endif
    @if(is_array($entity->$fieldName))
        {!! implode(',',$entity->$fieldName)!!}
    @else
        {{ $entity->$fieldName }}
    @endif
    @if(isset($options['suffix']))
        {{ $options['suffix'] }}
    @endif
@endif
