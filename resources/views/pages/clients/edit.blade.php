@extends('layouts.app')
@section('title', 'Редактиране на клиент')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Редактиране на клиент
                        <a href="{{ url('crm/pages/clients') }}" class="btn btn-primary btn-sm text-white float-end">Назад</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('crm/pages/clients/' . $client->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="client" class="fw-bold">Име*</label>
                                <input type="text" name="client" class="form-control" value="{{ old('client', $client->client) }}">
                                @error('client')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="company_identifier" class="fw-bold">ЕИК*</label>
                                <input type="text" name="company_identifier" class="form-control" value="{{ old('company_identifier', $client->company_identifier) }}">
                                @error('company_identifier')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="vat_number">ЗДДС №</label>
                                <input type="text" name="vat_number" class="form-control" value="{{ old('vat_number', $client->vat_number) }}">
                                @error('vat_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="contact_person" class="fw-bold">Лице за контакт*</label>
                                <input name="contact_person" type="text" class="form-control" value="{{ old('contact_person', $client->contact_person) }}">
                                @error('contact_person')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="email">Имейл за контакт</label>
                                <input name="email" type="text" class="form-control" value="{{ old('email', $client->email) }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="phone_number" class="fw-bold">Номер за контакт*</label>
                                <input name="phone_number" type="text" class="form-control" value="{{ old('phone_number', $client->phone_number) }}">
                                @error('phone_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="address" class="fw-bold">Адрес*</label>
                                <input name="address" type="text" class="form-control" value="{{ old('address', $client->address) }}">
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="contragent_client_id" class="fw-bold"> Контрагент, предоставил контакта*</label>
                                <select name="contragent_client_id" id="contragent_client_id" class="form-control">
                                    @foreach ($contragents as $contragent)
                                        <option value="{{ $contragent->id }}" {{ old('contragent_client_id', $client->contragent_client_id) == $contragent->id ? 'selected' : '' }}>
                                            {{ $contragent->contragent_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="additional_information">Допълнителна информация</label>
                                <textarea name="additional_information" class="form-control" rows="3">{{ old('additional_information', $client->additional_information) }}</textarea>
                                @error('additional_information')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div id="objectsContainer">
                                @foreach ($objects as $index => $object)
                                    <div class="row object-group">
                                        <div class="col-md-6 mb-3">
                                            <label for="objects[{{ $index }}][object]" class="fw-bold">Обект {{ $index + 1 }}*</label>
                                            <input name="objects[{{ $index }}][object]" type="text" class="form-control" value="{{ old('objects.' . $index . '.object', $object->object) }}" required>
                                        </div>
                                        <div class="col-md-5 mb-3">
                                            <label for="objects[{{ $index }}][object_address]">Адрес за обект {{ $index + 1 }}</label>
                                            <input name="objects[{{ $index }}][object_address]" type="text" class="form-control" value="{{ old('objects.' . $index . '.object_address', $object->object_address) }}">
                                        </div>
                                        <div class="col-md-1 mb-3 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger remove-object">Премахни</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-md-12 mb-5 d-flex align-items-center justify-content-center">
                                <button type="button" id="addObject" class="btn btn-primary">Добави още един обект</button>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3 mt-5 d-flex align-items-center justify-content-center">
                            <button type="submit" class="btn btn-success text-center">Запази</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const objectsContainer = document.getElementById('objectsContainer');
    const addObjectButton = document.getElementById('addObject');
    
    // Initialize objectCount based on existing objects
    let objectCount = objectsContainer.querySelectorAll('.object-group').length;

    addObjectButton.addEventListener('click', function() {
        const newObjectGroup = document.createElement('div');
        newObjectGroup.className = 'row object-group';
        newObjectGroup.innerHTML = `
            <div class="col-md-6 mb-3">
                <label for="objects[${objectCount}][object]" class="fw-bold">Обект ${objectCount + 1}*</label>
                <input name="objects[${objectCount}][object]" type="text" class="form-control" required>
            </div>
            <div class="col-md-5 mb-3">
                <label for="objects[${objectCount}][object_address]">Адрес за обект ${objectCount + 1}</label>
                <input name="objects[${objectCount}][object_address]" type="text" class="form-control">
            </div>
            <div class="col-md-1 mb-3 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-object">Премахни</button>
            </div>
        `;
        objectsContainer.appendChild(newObjectGroup);
        objectCount++;
    });

    objectsContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-object')) {
            e.target.closest('.object-group').remove();
            updateObjectNumbers();
        }
    });

    function updateObjectNumbers() {
        const objectGroups = objectsContainer.querySelectorAll('.object-group');
        objectGroups.forEach((group, index) => {
            const objectLabel = group.querySelector('label[for^="objects"]');
            const objectInput = group.querySelector('input[name^="objects"][name$="[object]"]');
            const addressLabel = group.querySelector('label[for^="objects"][for$="[object_address]"]');
            const addressInput = group.querySelector('input[name^="objects"][name$="[object_address]"]');

            objectLabel.setAttribute('for', `objects[${index}][object]`);
            objectLabel.textContent = `Обект ${index + 1}*`;
            objectInput.setAttribute('name', `objects[${index}][object]`);

            addressLabel.setAttribute('for', `objects[${index}][object_address]`);
            addressLabel.textContent = `Адрес за обект ${index + 1}`;
            addressInput.setAttribute('name', `objects[${index}][object_address]`);
        });
        objectCount = objectGroups.length;
    }
});
</script>
@endpush
