<table>
    <thead>
        <tr>
            <th>Waktu</th>
            <th>Tegangan</th>
            <th>Arus</th>
            <th>Daya</th>
            <th>KWH Meter</th>
            <th>Frekuensi</th>
            <th>Power Factor</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->waktu }}</td>
            <td>{{ $item->Voltage }}</td>
            <td>{{ $item->Current }}</td>
            <td>{{ $item->Power }}</td>
            <td>{{ $item->Frequency }}</td>
            <td>{{ $item->Energy }}</td>
            <td>{{ $item->PowerFactor }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
