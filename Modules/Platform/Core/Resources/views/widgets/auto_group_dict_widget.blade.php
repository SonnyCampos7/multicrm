
@foreach($records as $record)
@if($loop->iteration <= $config['max'])
<div class="{{ $config['coll_class'] }}">

    <div class="info-box-2 hover-expand-effect {{ isset($config['dataTableToFilter']) && $config['dataTableToFilter']  != '' ? "filterable-group-widget pointer": '' }}" data-col-name="{{$config['groupBy']}}" data-name="{{$record['title']}}" >
        <div class="icon">
            @if(!strpos($record['icon'], 'fa-'))
                <i class=" material-icons {{ $record['color'] }}">{{ $record['icon'] }}</i>
            @else
                <i class="{{ $record['icon'] }} {{ $record['color'] }}"></i>
            @endif
        </div>
        <div class="content">

            <div class="text">{{ $record['title'] }}</div>
            <div class="number {{ !config('bap.disableCountTo') ? 'count-to': '' }}" data-from="0" data-to="{{ $record['count'] }}" data-speed="2000" data-fresh-interval="20">{{ $record['count'] }}</div>
        </div>

    </div>


</div>
@endif

@endforeach


@push('scripts')

    @if($config['dataTableToFilter'] !== '' )
        <script type="text/javascript">

            $( document ).ready(function() {
                $(document).on('click','.filterable-group-widget', function(attr){

                    var filterColumnName = $(this).attr('data-col-name');

                    var foundColumn = $("#{{$config['dataTableToFilter']}}").DataTable().settings().init().columns.filter(function(element){
                        return element.column_name == filterColumnName;
                    });

                    if(foundColumn[0] != null ) {
                        yadcf.exFilterColumn($("#{{$config['dataTableToFilter']}}").DataTable(), [[foundColumn[0].column_number, $(this).attr('data-name')]]);
                        $("#{{$config['dataTableToFilter']}}").DataTable().ajax.reload(null, false);
                    }
                });
            });
        </script>
    @endif

@endpush
