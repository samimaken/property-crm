{{-- @dd($errors) --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> --}}
    <title>Datum | CRM Admin Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" />

    <link rel="stylesheet" href="{{ asset('css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend.css?v=1.0.0') }}">
    <style>
       table td, table td * {
          vertical-align: top !important;
       }
        .column img {
            padding: 5px;
            transition: 1s all
        }
        .column-images {
            display: flex;
            column-gap: 15px;
            margin-left: 10px
        }
        .column-images img {
            width: 50px;
            height: 50px;
            cursor: pointer;
            transition: 1s all
        }
    </style>

</head>
<body>
     <!-- loader Start -->
     <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        <div class="text-center mt-3">
            <img src="{{asset('images/logo.webp')}}" class="rounded" width="200px">
        </div>
        <div class="container-md mt-2">
            <div class="container-fluid">
                <div class="row">
                   <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="m-0 mb-2 text-center">Total Business Centre - Quotation</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-8 col-12 order-md-1 order-2">
                                    <p class="m-0 mb-2"><strong>From:</strong></p>
                                    <p class="m-0">Office Space CRM LLC </p>
                                    <p class="m-0">Khalidiyah Towers,</p>
                                    <p class="m-0">Mezanine Floor, </p>
                                    <p class="m-0">Abu Dhabi, United Arab Emirates.</p>
                                </div>
                                <div class="col-md-4 col-12 order-md-2 order-1 text-right">
                                    <p class="m-0 mt-2"><strong>Quotation No</strong></p>
                                    <p class="m-0">#{{$item->quotation_number}}</p>
                                    <p class="m-0"><strong>Date</strong></p>
                                    <p class="m-0">{{$item->formated}}</p>
                                    <p class="m-0"><strong>Quote Validity</strong></p>
                                    <p class="m-0">{{$item->quotation_validity}} Days</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <p class="m-0 mb-2"><strong>To:</strong></p>
                                    <p class="m-0">{{$item->company}} </p>
                                    <p class="m-0">{{$item->client_name}}</p>
                                    <p class="m-0">{{$item->client_email}}</p>
                                    <p class="m-0">{{$item->client_telephone}}</p>
                                    <p class="m-0">United Arab Emirates</p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 mb-2">
                                    <p class="m-0 mb-1"><strong>Property Name:</strong></p>
                                    <p class="m-0">{{$item->property->name}}</p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 mb-2">
                                    <p class="m-0 mb-1"><strong>Address:</strong></p>
                                    <p class="m-0">{{$item->property->address}}</p>
                                </div>
                            </div>
                            {{-- units --}}
                            <form method="POST" action="{{route('store.contract', ['quotation' => request()->quotation])}}">
                                @csrf
                                <div class="row mt-5">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th>Description</th>
                                                <th>Type</th>
                                                <th>Sq Ft Size</th>
                                                <th>Amount</th>
                                            </tr>
                                            @foreach ($item->items as $key => $quotationItem)
                                            <input name="items[{{$key}}][payment_term]" value="{{$quotationItem->payment_term}}" type="hidden">
                                            <input name="items[{{$key}}][property_unit_id]" value="{{$quotationItem->unit->id}}" type="hidden">
                                            <tr>
                                                <td rowspan="2" style="width: 50%">
                                                    <p class="m-0 mb-2">{{$key + 1}}. {{$quotationItem->unit->unit_id}}</p>
                                                    <p class="m-0 ml-2 mt-5 text-capitalize">Payment Term : {{ $quotationItem->payment_term == 'unit_price_1' ? 'One Payment Rate' : ($quotationItem->payment_term == 'unit_price_2' ? 'Two Payments Rate' : 'Monthly Payment Rate')}}</p>
                                                    <p class="m-0 ml-2">Deposit Amount AED : {{$quotationItem->unit->deposit_amount}}</p>
                                                    <p class="m-0 ml-2">Furnished: {!! $quotationItem->unit->furnished == 1 ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-success">Yes</span>' !!}</p>
                                                    <p class="m-0 ml-2">Desks Allocated:  {{$quotationItem->unit->desks_allocated }}</p>
                                                    <p class="m-0 ml-2">+ VAT (5% ) - AED {{$quotationItem->amount * 0.05}}</p>

                                                    <div class="form-group mb-2 mt-2">
                                                        <label>Contract Start Date</label>
                                                        <input class="form-control start-date" data-id="{{$key}}"  type="date" name="items[{{$key}}][start_date]" value="{{old("items")[$key]['start_date'] ?? ""}}">
                                                        @error("items.$key.start_date")
                                                           <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label>Contract End Date</label>
                                                        <input class="form-control"  type="date" name="items[{{$key}}][end_date]" value="{{old("items")[$key]['end_date'] ?? ""}}">
                                                        @error("items.$key.end_date")
                                                           <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    @if ($quotationItem->payment_term != "unit_price_monthly")
                                                    <div class="form-group mb-2">
                                                        <label>Initial Payment Precentage</label>
                                                        <select class="form-control" name="items[{{$key}}][initial_percentage]">
                                                            @for ($i=0; $i<=10; $i++)
                                                             <option value="{{$i*10}}">{{$i*10}} %</option>
                                                            @endfor
                                                        </select>
                                                        @error("items.$key.initial_percentage")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label>Second Payment Date</label>
                                                        <input class="form-control second-date-{{$key}}" type="date" name="items[{{$key}}][second_payment_date]" value="{{old("items")[$key]['second_payment_date'] ?? ""}}">
                                                        @error("items.$key.second_payment_date")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label>Payment Method</label>
                                                        <select class="form-control" name="items[{{$key}}][payment_method]">
                                                            <option value="Post Dated Cheque">Post Dated Cheque</option>
                                                            <option value="Cash Deposit">Cash Deposit</option>
                                                        </select>
                                                        @error("items.$key.payment_method")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    @endif
                                                </td>
                                                <td style="border-bottom: 0px">
                                                    <p class="m-0">{{$quotationItem->unit->type == 'private-unit' ? 'Private Unit' : 'Co-Space'}}</p>
                                                </td>
                                                <td style="border-bottom: 0px">
                                                    <p class="m-0">{{$quotationItem->unit->sqft_size}}</p>
                                                </td>
                                                <td style="border-bottom: 0px">
                                                    <p class="m-0">{{$quotationItem->amount}}</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="border-top: 0px; vertical-align: center">
                                                    <div class="column">
                                                        <span onclick=
                                                            "this.parentElement.style.display='none'">
                                                        </span>

                                                        <img id="expand-{{$quotationItem->id}}" src="{{$quotationItem->unit->image1}}" style="width:100%;
                                                            height: 300px">
                                                    </div>
                                                    <div class="column-images">
                                                        @if ($quotationItem->unit->image1 != null)
                                                        <img src="{{$quotationItem->unit->image1}}"
                                                            onclick="gfg(this, {{$quotationItem->id}});">
                                                        @endif
                                                        @if ($quotationItem->unit->image2 != null)
                                                        <img src="{{$quotationItem->unit->image2}}"
                                                            onclick="gfg(this, {{$quotationItem->id}});">
                                                        @endif
                                                        @if ($quotationItem->unit->image3 != null)
                                                        <img src="{{$quotationItem->unit->image3}}"
                                                            onclick="gfg(this, {{$quotationItem->id}});">
                                                        @endif
                                                        @if ($quotationItem->unit->image4 != null)
                                                        <img src="{{$quotationItem->unit->image4}}"
                                                            onclick="gfg(this, {{$quotationItem->id}});">
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                        <hr>
                                    </div>
                                    <div class="text-center col-12 mt-5">
                                        <button type="submit" class="btn btn-primary w-25">Generate Invoices and Contract</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                   </div>
                </div>
                <!-- Page end  -->
            </div>
        </div>
    </div>



     <!-- Backend Bundle JavaScript -->
     <script src="{{ asset('js/backend-bundle.min.js') }}"></script>
     <!-- Chart Custom JavaScript -->
     <script src="{{ asset('js/customizer.js') }}"></script>

     <script src="{{ asset('js/sidebar.js') }}"></script>

     <!-- Flextree Javascript-->
     <script src="{{ asset('js/flex-tree.min.js') }}"></script>
     <script src="{{ asset('js/tree.js') }}"></script>

     <!-- Table Treeview JavaScript -->
     <script src="{{ asset('js/table-treeview.js') }}"></script>

     <!-- SweetAlert JavaScript -->
     <script src="{{ asset('js/sweetalert.js') }}"></script>

     <!-- Vectoe Map JavaScript -->
     <script src="{{ asset('js/vector-map-custom.js') }}"></script>

     <!-- Chart Custom JavaScript -->
     <script src="{{ asset('js/chart-custom.js') }}"></script>
     <script src="{{ asset('js/charts/01.js') }}"></script>
     <script src="{{ asset('js/charts/02.js') }}"></script>

     <!-- slider JavaScript -->
     <script src="{{ asset('js/slider.js') }}"></script>

     <!-- Emoji picker -->
     <script src="{{asset('vendor/emoji-picker-element/index.js')}}" type="module"></script>


     <!-- app JavaScript -->
     <script src="{{ asset('js/app.js') }}"></script>
     <script>
         function gfg(imgs, id) {
        var expandImg = document.getElementById("expand-"+id);
        var imgText = document.getElementById("geeks");
        expandImg.src = imgs.src;
        expandImg.parentElement.style.display = "block";
    }
    $('#rejectBtn').on('click', function() {
        $('#reject').submit();
    })
    $('#acceptBtn').on('click', function() {
        $('#accept').submit();
    })
    </script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if (Session::has('success'))
        <script>
            Swal.fire({
                text: "{!! Session::get('success') !!}",
                icon: "success",
                button: "Ok",
                });
        </script>
        @endif
    <script>
        $('.start-date').on("change", function(){
            var id = $(this).attr("data-id");
            var date = $(this).val();
            var mydate = new Date(date);
            mydate.setMonth(mydate.getMonth() + 6)
            var dd = String(mydate.getDate()).padStart(2, '0');
            var mm = String(mydate.getMonth() + 1).padStart(2, '0');
            var yyyy = mydate.getFullYear();

            var second_date = yyyy + '-' + mm + '-' + dd;
            $(`.second-date-${id}`).val(second_date);
        })
    </script>
</body>
</html>
