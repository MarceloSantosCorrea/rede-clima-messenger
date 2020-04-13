<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Horário</th>
            <th>Programa</th>
            <th>Slogan</th>
            <th class="text-right">Opções</th>
        </tr>
    </thead>
    <tbody>
        @if($data)
            @foreach($data as $item)
                <tr>
                    <td>{{ $item['start_time'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['slogan'] }}</td>
                    <td class="text-right">
                        <a href="{{ route('web.calendars.edit', $item['uid']) }}" class="action-icon">
                            <i class="mdi mdi-square-edit-outline"></i>
                        </a>

                        <a href="javascript:void(0)" onclick="confirmation('{{ "{$item['start_time']} - {$item['name']}" }}', 'calendars-delete-form-{{$item['uid']}}')" class="action-icon">
                            <i class="mdi mdi-delete"></i>
                        </a>
                        <form id="calendars-delete-form-{{$item['uid']}}" action="{{ route('web.calendars.destroy', $item['uid']) }}" method="POST" class="form-hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>