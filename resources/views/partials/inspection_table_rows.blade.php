<!-- inspection_table_rows.blade.php -->

@foreach($inspections as $inspection)
    <tr>
        <td>{{ $inspection->report_no }}</td>
        <td>{{ $inspection->inspection_date }}</td>
        <td>{{ $inspection->inspector_name }}</td>
        <td>{{ $inspection->vin_no }}</td>
        <td>{{ $inspection->model_make }}</td>
        <td>{{ $inspection->updated_at->format("Y-m-d H:i:s") }}</td>
        <td>
            <a href="{{ route('test-pdf', [$inspection->id]) }}" class="btn btn-primary"><i class="bi-eye"></i></a>
            <a href="{{ route('edit.pdf', [$inspection->id]) }}" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
            <a href="#" class="btn btn-primary email-icon" data-toggle="modal" data-target="#emailModal" data-id="{{ $inspection->id }}"><i class="bi-envelope"></i></a>
        </td>
    </tr>
@endforeach

<!--{!! $inspections->links() !!}-->



