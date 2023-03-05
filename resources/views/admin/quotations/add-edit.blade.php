@extends('admin.layouts.app')

@section('page_title', 'Quotations')

@section('page_styles')

@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{ $item->id ? 'Edit' : 'Create' }} Quotation</h4>
                </div>
            </div>
            <div class="card-body">
                <form id="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12 mb-2">
                            <div class="row">
                                <div class="col-md-4 col-12 d-flex align-items-center">
                                    <label for="company">Company:</label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="company" name="company"
                                            value="{{ isset($item->company) ? $item->company : old('company') }}">
                                        <span class="error text-danger" id="company_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-12 d-flex align-items-center">
                                    <label for="client_name">Clent Name:</label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="client_name" name="client_name"
                                            value="{{ isset($item->client_name) ? $item->client_name : old('client_name') }}">
                                        <span class="error text-danger" id="client_name_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-12 d-flex align-items-center">
                                    <label for="quotation_validity">Quote Validity:</label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <div class="form-group">
                                        <select class="form-control mb-3" id="quotation_validity" name="quotation_validity">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $item->quotation_validity == $i ? 'selected' : '' }}>
                                                    {{ $i }} Day</option>
                                            @endfor
                                        </select>
                                        <span class="error text-danger" id="quotation_validity_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-12 d-flex align-items-center">
                                    <label for="property">Select Property:</label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <div class="form-group">
                                        <select class="form-control mb-3" id="property" name="property">
                                            <option value="">Select Property</option>
                                            @foreach ($properties as $property)
                                                <option value="{{ $property->id }}"
                                                    {{ $item->property_id == $property->id ? 'selected' : '' }}>
                                                    {{ $property->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="error text-danger" id="property_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-2">
                            <div class="row">
                                <div class="col-md-4 col-12 d-flex align-items-center">
                                    <label for="client_telephone">Client Telephone:</label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <div class="form-group">
                                        <input type="tel" class="form-control" id="client_telephone"
                                            name="client_telephone"
                                            value="{{ isset($item->client_telephone) ? $item->client_telephone : old('client_telephone') }}">
                                        <span class="error text-danger" id="client_telephone_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-12 d-flex align-items-center">
                                    <label for="client_email">Clent Email:</label>
                                </div>
                                <div class="col-md-8 col-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="client_email" name="client_email"
                                            value="{{ isset($item->client_email) ? $item->client_email : old('client_email') }}">
                                        <span class="error text-danger" id="client_email_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0 mb-2">Units</p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Date Added</th>
                                        <th>Unit ID</th>
                                        <th>Sqft Size</th>
                                        <th>Type</th>
                                        <th>Desks Allocated</th>
                                        <th>Furnished</th>
                                        <th>Action</th>
                                    </tr>
                                    <tbody id="propertyUnits">
                                        @if (isset($units))
                                        @foreach ($units as $unit)
                                            <tr>
                                                    <td>{{ $unit->created_at }}</td>
                                                    <td>{{ $unit->unit_id }}</td>
                                                    <td>{{ $unit->sqft_size }}</td>
                                                    <td>{{ $unit->type }}</td>
                                                    <td>{{ $unit->desks_allocated }}</td>
                                                    <td>{!! $unit->furnished == 1 ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">No</span>' !!}
                                                    </td>
                                                    <td><button type="button" class="btn btn-sm btn-primary btn-unit"
                                                            data-id="{{ $unit->id }}" data-selected="{{isset($quotation_unit_ids) &&  in_array($unit->id, $quotation_unit_ids) ? 'true': 'false'}}"
                                                            id="unit-btn-{{ $unit->id }}">{{isset($quotation_unit_ids)  && in_array($unit->id, $quotation_unit_ids) ? 'Unselect': 'Select'}}</button></td>
                                            </tr>
                                            @endforeach
                                        @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0 mb-2">Selected Units for Quote</p>
                            <div id="selectedUnits">
                                @if (isset($items))
                                   @foreach ($items as $quotation)
                                   <div class="row mb-2 border-bottom" id="selected-unit-{{$quotation->unit->id}}">
                                    <div class="col-md-6 col-12">
                                        <input type="hidden" name="units[unit_id][]" value="{{$quotation->unit->id}}">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Date Added</th>
                                                <th>Unit ID</th>
                                                <th>Sqft Size</th>
                                                <th>Type</th>
                                            </tr>
                                            <tr>
                                                <td>{{$quotation->unit->created_at}}</td>
                                                <td>{{$quotation->unit->unit_id}}</td>
                                                <td>{{$quotation->unit->sqft_size}}</td>
                                                <td class="text-nowrap">{{$quotation->unit->type}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div
                                        class="col-md-6 col-12 align-items-center justify-content-center d-flex flex-column">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <label>Payment Term</label>
                                                <input name="units[id][]" type="hidden" value="{{$quotation->id}}">
                                                <select class="form-control unit-price" name="units[term][]"
                                                    data-id="{{$quotation->unit->id}}">
                                                    <option value="unit_price_1" {{$quotation->payment_term == 'unit_price_1' ? 'selected': ''}}>Unit Price 1</option>
                                                    <option value="unit_price_2" {{$quotation->payment_term == 'unit_price_2' ? 'selected': ''}}>Unit Price 2</option>
                                                    <option value="unit_price_monthly" {{$quotation->payment_term == 'unit_price_monthly' ? 'selected': ''}}>Unit Price Monthly</option>
                                                </select>
                                            </div>
                                            <div class="ml-2">
                                                <label>Amount</label>
                                                <input class="form-control" disabled name="units[amount][]"
                                                    id="unit-{{$quotation->id}}-amount" value="{{$quotation->amount}}" />
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-link text-danger unit-remove"
                                                    data-id="{{$quotation->unit->id}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                   @endforeach
                                @endif
                            </div>
                        </div>
                        <span class="error text-danger" id="units_error"></span>
                        <span class="error text-danger" id="message_error"></span>
                        <div class="col-12 mt-2">
                            <button type="button" id="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page_scripts')
    <script>
        $(document).ready(function() {

            /*------------------------------------------
            --------------------------------------------
            Country Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            let units = <?php echo json_encode($units); ?>;
            let selected = <?php echo json_encode($quotation_unit_ids); ?>;
            $('#property').on('change', function() {
                var idProperty = this.value;
                $("#propertyUnits").html('');
                $("#selectedUnits").html('');
                units = [];
                selected = [];
                $.ajax({
                    url: "{{ url('admin/fetch-units') }}",
                    type: "POST",
                    data: {
                        property: idProperty,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#propertyUnits').html();
                        units = result.units
                        $.each(result.units, function(key, value) {
                            $("#propertyUnits").append(`
                            <tr>
                                <td>${value.created_at}</td>
                                <td>${value.unit_id}</td>
                                <td>${value.sqft_size}</td>
                                <td>${value.type}</td>
                                <td>${value.desks_allocated}</td>
                                <td>${value.furnished == 1 ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">No</span>'}</td>
                                <td><a target="_blank" class="btn btn-sm btn-primary btn-unit" href="/admin/properties/${value.property_id}/units/${value.id}">View</a>
                                    <button type="button" class="btn btn-sm btn-primary btn-unit ml-2" data-id="${value.id}" data-selected="false" id="unit-btn-${value.id}">Select</button></td>
                            </tr>`);
                        });
                    }
                });
            });

            $(document).on('click', '.btn-unit', function() {
                var id = $(this).attr("data-id")
                var isSelected = $(this).attr("data-selected")
                if (isSelected == "false") {
                    if (selected.indexOf(id) === -1) {
                        selected.push(id)
                        $(this).attr('data-selected', 'true');
                        $(`#unit-btn-${id}`).html('Unselect')
                        let unit = units.find(f => {
                            return f.id == id
                        })
                        $('#selectedUnits').append(`
                <div class="row mb-2 border-bottom" id="selected-unit-${unit.id}">
                    <div class="col-md-6 col-12">
                        <input type="hidden" name="units[unit_id][]" value="${unit.id}">
                        <table class="table table-striped">
                            <tr>
                                <th>Date Added</th>
                                <th>Unit ID</th>
                                <th>Sqft Size</th>
                                <th>Type</th>
                            </tr>
                            <tr>
                                <td>${unit.created_at}</td>
                                <td>${unit.unit_id}</td>
                                <td>${unit.sqft_size}</td>
                                <td class="text-nowrap">${unit.type}</td>
                            </tr>
                        </table>
                        </div>
                        <div class="col-md-6 col-12 align-items-center justify-content-center d-flex flex-column">
                            <div class="d-flex align-items-center">
                                <div>
                                    <label>Payment Term</label>
                                    <select class="form-control unit-price" name="units[term][]" data-id="${unit.id}">
                                        <option value="unit_price_1">One Payment Rate</option>
                                        <option value="unit_price_2">Two Payments Rate</option>
                                        <option value="unit_price_monthly">Monthly Payment Rate</option>
                                    </select>
                                </div>
                                <div class="ml-2">
                                        <label>Amount</label>
                                        <input class="form-control" disabled name="units[amount][]" id="unit-${unit.id}-amount" value="${unit.unit_price_1}" />
                                </div>
                                <div>
                                    <button type="button" class="btn btn-link text-danger unit-remove" data-id="${unit.id}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                </div>`)
                    }
                } else {
                    $(this).attr('data-selected', 'false');
                    $(`#selected-unit-${id}`).remove()
                    selected = selected.filter(function(item) {
                        return item !== id
                    })
                    $(`#unit-btn-${id}`).html('Select')
                }

            });
            $(document).on('click', '.unit-remove', function() {
                var id = $(this).attr("data-id")
                selected = selected.filter(function(item) {
                    return item !== id
                })
                $(`#selected-unit-${id}`).remove()
                $(`#unit-btn-${id}`).html('Select')
                $(`#unit-btn-${id}`).attr('data-selected', 'false');

            });
            $(document).on('change', '.unit-price', function() {
                var id = $(this).attr("data-id");
                var price = $(this).val();
                let unit = units.find(f => {
                    return f.id == id
                })
                if (unit != null) {
                    $(`#unit-${id}-amount`).val(unit[price])
                }
            });

            $(document).on('click', '#submit', function() {
                $('#submit').html('Please Wait .....');
                $('#submit').prop("disabled", true);
                let data = $('form').serialize()
                $('.error').html('')
                $.ajax({
                    url: '{{ url($item->id == null ? "admin/quotations" : "admin/quotations/$item->id") }}',
                    type: "{{$item->id ==  null ? 'POST' : 'PATCH'}}",
                    data: data,
                    dataType: 'json',
                    success: function(result) {
                        $('#submit').html('Submit')
                        $('#submit').removeAttr("disabled");
                        Swal.fire({
                            title: "Good job!",
                            text: `${result.data}`,
                            icon: "success",
                            button: "Ok",
                        }).then(function() {
                            window.location = "{{ route('quotations.index') }}";
                        });
                    },
                    error: function(reject) {
                        $('#submit').html('Submit')
                        $('#submit').removeAttr("disabled");
                        if (reject.status === 422) {
                            console.log(reject)
                            var errors = $.parseJSON(reject.responseText);
                            $.each(errors.errors, function(key, val) {
                                $("#" + key + "_error").text(val[0]);
                            });
                        }
                    }
                });
            })
        });
    </script>

@endsection
