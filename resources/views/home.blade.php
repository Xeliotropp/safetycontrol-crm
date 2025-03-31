@extends('layouts.app')

@section('content')
    <div>
        <div class="container-fluid mt-5 pd-5">
            <div class="row container-fluid">
                <div class="col-11 container-fluid">
                    <div class="d-flex column col-12 gap-4">
                        <div class="d-flex mx-5 gap-3">
                            <label for="date-picker">Избор на дата:</label>
                            <br>
                            <input type="date" name="date-picker" id="date" class="form-control">
                        </div>
                        <div class="d-flex mx-5 gap-3">
                            <label for="">Покажи подстоящите задачи за следващите:</label>
                            <select name="range" id="range" class="form-control">
                                <option value="30" class="form-control">30 дни</option>
                                <option value="15" class="form-control">15 дни</option>
                                <option value="45" class="form-control">45 дни</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-5">
                        <table class="table table-bordered table-striped col-8" id="tableData">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Клиент</th>
                                    <th>Контрагент</th>
                                    <th>Дата на следващо измерване</th>
                                    <th>Номер на сертификат</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td id="id_num"><a
                                                href="{{ url('/crm/pages/tasks/view/' . $task->id) }}">{{ sprintf('%04d', $task->id) }}</a>
                                        </td>
                                        <td id="client">{{ $task->client->client ?? ''}}</td>
                                        <td>{{ $task->contragent }}</td>
                                        <td value="{{ $task->nextMeasurement }}">{{ $task->nextMeasurement }}</td>
                                        <td>{{ $task->certificateNumber }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('date');
    const rangeSelect = document.getElementById('range');
    const table = document.getElementById('tableData');

    // Set today's date as the default
    const today = new Date();
    dateInput.valueAsDate = today;

    // Initial filter
    filterTable();

    // Add event listeners
    dateInput.addEventListener('change', filterTable);
    rangeSelect.addEventListener('change', filterTable);

    function filterTable() {
        const selectedDate = new Date(dateInput.value);
        const rangeDays = parseInt(rangeSelect.value);
        const endDate = new Date(selectedDate);
        endDate.setDate(endDate.getDate() + rangeDays);

        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) { // Start from 1 to skip header row
            const nextMeasurementCell = rows[i].cells[3]; // Assuming the date is in the 4th column
            const nextMeasurementDate = new Date(nextMeasurementCell.getAttribute('value'));

            if (nextMeasurementDate >= selectedDate && nextMeasurementDate <= endDate) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
});
</script>
@endpush
