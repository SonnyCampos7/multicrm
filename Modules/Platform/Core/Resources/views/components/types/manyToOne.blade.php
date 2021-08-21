@if(isset($options['route']) && $entity->$fieldName != null )
    <a class="relation-link"  href="{{ route($options['route'],$entity->{$options['relation']}->id ) }}">
        <i  class="material-icons">
            link
        </i>
    </a>
@endif

@if($entity->$fieldName != null  )
    @if(isset($options['dont_translate']))
        {{
                    optional($entity->{$options['relation']})->{$options['column']}
        }}

    @else
        {{
            optional($entity->{$options['relation']})->{$options['column']}
        }}
    @endif
@endif
