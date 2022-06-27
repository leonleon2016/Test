<li >
    @include('renderJsonItemName')
    @if ($json['children'])
        <ul style="display: {{$json['display']}}">
            @each('renderJsonItem', $json['children'], 'json')
        </ul>
    @endif
</li>
