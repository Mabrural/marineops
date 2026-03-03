@if ($logs->count())

    <table class="table table-sm table-bordered">
        <thead class="table-light">
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Cost</th>
                <th>Performed By</th>
                <th>Next</th>
                <th class="text-end">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td>{{ optional($log->maintenance_date)->format('d M Y') }}</td>
                    <td>
                        <span class="badge bg-secondary">
                            {{ ucfirst($log->type) }}
                        </span>
                    </td>
                    <td>Rp {{ number_format($log->cost, 0, ',', '.') }}</td>
                    <td>{{ $log->performed_by ?? '-' }}</td>
                    <td>{{ optional($log->estimate_next_maintenance)->format('d M Y') ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="text-center text-muted py-3">
        No maintenance history.
    </div>
@endif
