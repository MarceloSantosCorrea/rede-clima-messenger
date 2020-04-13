<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Horário</th>
            <th>Programa</th>
            <th>Apresentador</th>
            <th>Categoria</th>
        </tr>
    </thead>
    <tbody>
        @if($data)
            @foreach($data as $item)
                <tr>
                    <td>{{ $item['start_time'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['presenter'] }}</td>
                    <td>{{ $item['category'] }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>