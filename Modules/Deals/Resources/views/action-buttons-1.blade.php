@if(isset($submitButtons))
<div class="btn-group btn-crud pull-right">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @lang('deals::deals.submit') <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
        @foreach($submitButtons as $link)
            <li>
                {{ Html::link($link['href'],$link['label'],$link['attr']) }}
            </li>
        @endforeach

    </ul>
</div>
@endif
