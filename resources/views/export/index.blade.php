<table>
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Oficina</th>
        <th>Departamento</th>
        <th>Puesto</th>
        <th>Dias acumulados</th>
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
            @foreach($user->positions as $position)
            <td>{{ $position->name }}</td>
            @endforeach
            <td>{{ $user->days }}</td>
        </tr>
    @endforeach
    </tbody>
</table>