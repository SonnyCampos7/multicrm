@if(isset($entity->$fieldName))
    @if(is_array($entity->$fieldName))
        {!! implode(',',$entity->$fieldName)!!} %
    @else
        {{ $entity->$fieldName }}%
    @endif
@endif
