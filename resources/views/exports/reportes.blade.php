<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha de creación</th>
            <th>Usuario</th>
            <th>Falla</th>
            <th>Detalles</th>
            <th>Atiende</th>
            <th>Acciones realizadas</th>
            <th>Urgencia</th>
            <th>Fecha de resolución</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datos as $dato)
            <tr>
                <td>
                    {{ $dato->id }}
                </td>
                <td>
                    {{ date('d/m/Y H:i', strtotime($dato->created_at)) }}
                </td>
                <td>
                    {{ $dato->creador_name . ' ' . $dato->creador_lastName }}
                </td>
                <td>
                    {{ $dato->Falla }}
                </td>
                <td>
                    {{ $dato->Detalles }}
                </td>
                <td>
                    {{ $dato->resuelto_name . ' ' . $dato->resuelto_lastName }}
                </td>
                <td>
                    {{ $dato->Diagnostico }}
                </td>
                <td>
                    {{ $dato->Urgencia }}
                </td>
                <td>
                    @if (isset($dato->fecha_resuelto))
                        {{ date('d/m/Y H:i', strtotime($dato->fecha_resuelto)) }}
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
