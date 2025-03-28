<table>
    <thead>
    <tr>
        @foreach($dates as $date_start)
        <th>Fecha inicio: {{ date_format(date_create($date_start->setting_date), 'Y-m-d') }}</th>
        @endforeach
        <th>Fecha fin: {{ $date_end }}</th>
    </tr>
    <tr>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Oficina</th>
        <th>Departamento</th>
        <th>Dias acumulados</th>
        <th>Fecha ingreso</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            @foreach($user->offices as $office)
            <td>{{ $office->name }}</td>
            @endforeach
            @foreach($user->departments as $department)
            <td>{{ $department->name }}</td>
            @endforeach
            <td>{{ $user->days }}</td>
            <td>{{ Carbon\Carbon::parse($user->admission_date)->format('d/m/Y') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
