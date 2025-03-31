<div>
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Изтриване на задача</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyTask">
                    <div class="modal-body">
                        <h6>Сигурни ли сте, че искате да изтриете записа?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Затвори</button>
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Да, изтрий!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12">
                <div class="table-container">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th>№
                                    <div class="d-flex mt-5">
                                        <button wire:click="refreshPage" class="btn btn-white border border-2 border-end-0 rounded-0">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        <input wire:model.debounce.50ms="filters.id" type="text"
                                            class="form-control border border-2 border-start-0 rounded-0 filter-input"
                                            id="number">
                                    </div>
                                </th>
                                <th>Клиент
                                    <div class="d-flex mt-5">
                                        <button  wire:click="refreshPage" class="btn btn-white border border-2 border-end-0 rounded-0">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        <input wire:model.debounce.50ms="filters.client_id" type="text" class="form-control border border-2 border-start-0 rounded-0 filter-input"
                                                                                                        id="client"/>
                                    </div>
                                </th>
                                <th>Обект
                                    <div class="d-flex mt-5">
                                        <button  wire:click="refreshPage" class="btn btn-white border border-2 border-end-0 rounded-0">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        <input wire:model.debounce.50ms="filters.client_address_1" type="text"
                                            class="form-control border border-2 border-start-0 rounded-0 filter-input"
                                            id="object">
                                    </div>
                                </th>
                                <th>Дата на измерване
                                    <div class="d-flex mt-4">
                                        <button  wire:click="refreshPage" class="btn btn-white border border-2 border-end-0 rounded-0">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        <input wire:model.debounce.50ms="filters.dateOfMeasurement" type="text"
                                            class="form-control border border-2 border-start-0 rounded-0 filter-input"
                                            id="date_measure">
                                    </div>
                                </th>

                                <th>Номер на сертификат
                                    <div class="d-flex mt-4">
                                        <button  wire:click="refreshPage" class="btn btn-white border border-2 border-end-0 rounded-0">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        <input wire:model.debounce.50ms="filters.certificateNumber" type="text"
                                            class="form-control border border-2 border-start-0 rounded-0 filter-input"
                                            id="cert_num">
                                    </div>
                                </th>
                                <th>Дата на сертификат
                                    <div class="d-flex mt-4">
                                        <button  wire:click="refreshPage" class="btn btn-white border border-2 border-end-0 rounded-0">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        <input wire:model.debounce.50ms="filters.certificateDate" type="text"
                                            class="form-control border border-2 border-start-0 rounded-0 filter-input"
                                            id="cert_date">
                                    </div>
                                </th>

                                <th>Номер на фактура
                                    <div class="d-flex mt-4">
                                        <button  wire:click="refreshPage" class="btn btn-white border border-2 border-end-0 rounded-0">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        <input wire:model.debounce.50ms="filters.invoice" type="text"
                                            class="form-control border border-2 border-start-0 rounded-0 filter-input"
                                            id="invoice">
                                    </div>
                                </th>
                                <th>Платено
                                    <div class="d-flex mt-5">
                                        <button  wire:click="refreshPage" class="btn btn-white border border-2 border-end-0 rounded-0">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        <input wire:model.debounce.50ms="filters.paid" type="text"
                                            class="form-control border border-2 border-start-0 rounded-0 filter-input"
                                            id="paid">
                                    </div>
                                </th>
                                <th>Дата на фактура
                                    <div class="d-flex mt-4">
                                        <button  wire:click="refreshPage" class="btn btn-white border border-2 border-end-0 rounded-0">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        <input wire:model.debounce.50ms="filters.invoice_date" type="text"
                                            class="form-control border border-2 border-start-0 rounded-0 filter-input"
                                            id="invoice_date">
                                    </div>
                                </th>
                                <th>Начин на плащане
                                    <div class="d-flex mt-4">
                                        <button  wire:click="refreshPage" class="btn btn-white border border-2 border-end-0 rounded-0">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        <input wire:model.debounce.50ms="filters.payment_method" type="text"
                                            class="form-control border border-2 border-start-0 rounded-0 filter-input"
                                            id="payment_method">
                                    </div>
                                </th>
                                <th><p class="mb-5">Сума без ДДС</p>
                                    <div class="d-flex">
                                        <button  wire:click="refreshPage" class="btn btn-white border border-2 border-end-0 rounded-0">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        <input wire:model.debounce.50ms="filters.price_without_vat" type="text"
                                            class="form-control border border-2 border-start-0 rounded-0 filter-input"
                                            id="price_no_vat">
                                    </div>
                                </th>
                                <th>Сума на контрагент
                                    <div class="d-flex mt-4">
                                        <button  wire:click="refreshPage" class="btn btn-white border border-2 border-end-0 rounded-0">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        <input wire:model.debounce.50ms="filters.contragent_sum" type="text"
                                            class="form-control border border-2 border-start-0 rounded-0 filter-input"
                                            id="contractor_sum">
                                    </div>
                                </th>
                                <th>Реално пост. сума
                                    <div class="d-flex mt-4">
                                        <button wire:click="refreshPage" class="btn btn-white border border-2 border-end-0 rounded-0">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        <input wire:model.debounce.50ms="filters.total_sum" type="text"
                                            class="form-control border border-2 border-start-0 rounded-0 filter-input"
                                            id="total_sum">
                                    </div>
                                </th>
                                <th>Действие
                                    <input type="none" class="mt-5" style="visibility: hidden"/>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td><a
                                            href="{{ url('/crm/pages/tasks/view/' . $task->id) }}">{{ sprintf('%04d', $task->id) }}</a>
                                    </td>
                                    <td>{{ $task->client->client ?? '' }}</td>
                                    <td>{{ $task->client_address_1 }}</td>
                                    <td>{{ $task->dateOfMeasurement }}</td>
                                    <td>{{ $task->certificateNumber }}</td>
                                    <td>{{ $task->certificateDate }}</td>
                                    <td>{{ $task->invoice }}</td>
                                    <td>{{ $task->paid == '0' ? 'Не' : 'Да' }}</td>
                                    <td>{{ $task->invoice_date }}</td>
                                    <td>{{ $task->payment_method }}</td>
                                    <td>{{ $task->price_without_vat }}</td>
                                    <td>{{ $task->contragent_sum }}</td>
                                    <td>{{ $task->total_sum }}</td>
                                    <td>
                                        <div class="d-flex w-auto gap-4">
                                            <a href="{{ url('crm/pages/tasks/' . $task->id . '/edit') }}"
                                                class="btn btn-success btn-sm">Редактиране</a>
                                            <a wire:click="deleteTask({{ $task->id }})" href="#"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                class="btn btn-danger btn-sm">Изтриване</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $tasks->links() }}
                    </div>
                    <div>
                        <a href="/crm/pages/tasks/create" class="btn btn-primary float-end">Добави нов</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#deleteModal').modal('hide');
        });
        Livewire.on('refreshTable', () => {
        location.reload();
    });
    </script>
@endpush
