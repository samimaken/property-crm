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
                            <h4 class="m-0 mb-2 text-center">
                                Total Business Centre - Invoice</h4>
                            <hr>
                            <div class="row mb-2">
                                <div class="col-md-8 col-12 order-md-1 order-2">
                                    <p class="m-0 mb-2"><strong>From:</strong></p>
                                    <p class="m-0">Total Property Solutions Real Estate LLC</p>
                                    <p class="m-0">Golden Tulip Downtown,</p>
                                    <p class="m-0">6 Fatima Bint Mubarak St - Zone 1E8 - Abu Dhabi,</p>
                                    <p class="m-0">Abu Dhabi, Corniche Area</p>
                                    <p class="m-0">United Arab Emirates</p>
                                    <p class="m-0">Tax ID: TRN Number: 100593093600003</p>
                                </div>
                                <div class="col-md-4 col-12 order-md-2 order-1 text-right">
                                    <p class="m-0 mt-2"><strong>Invoice No</strong></p>
                                    <p class="m-0">#{{'$item->quotation_number'}}</p>
                                    <p class="m-0"><strong>Date</strong></p>
                                    <p class="m-0">{{'$item->formated'}}</p>
                                    <p class="m-0"><strong>Invoice Date</strong></p>
                                    <p class="m-0">{{'$item->quotation_validity'}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <p class="m-0 mb-2"><strong>To:</strong></p>
                                    <p class="m-0">{{'$item->company'}} </p>
                                    <p class="m-0">{{'$item->client_name'}}</p>
                                    <p class="m-0">{{'$item->client_email'}}</p>
                                    <p class="m-0">{{'$item->client_telephone'}}</p>
                                    <p class="m-0">United Arab Emirates</p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 mb-2">
                                    <p class="m-0 mb-1"><strong>Property Name:</strong></p>
                                    <p class="m-0">{{'$item->property->name'}}</p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 mb-2">
                                    <p class="m-0 mb-1"><strong>Unit Number:</strong></p>
                                    <p class="m-0">{{'$item->property->name'}}</p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 mb-2">
                                    <p class="m-0 mb-1"><strong>Address:</strong></p>
                                    <p class="m-0">{{'$item->property->address'}}</p>
                                </div>
                            </div>
                            {{-- units --}}
                            <div class="row mt-5">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Rate</th>
                                            <th>Amount</th>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" style="width: 50%">
                                                <p class="m-0 mb-2">{{'$quotationItem->unit->unit_id'}}</p>
                                                <p class="m-0 ml-2 mt-5"><strong>Payment Term: </strong> Yearly</p>
                                                <p class="m-0 ml-2 mt-2"><strong>Contract Start Date: </strong> Yearly</p>
                                                <p class="m-0 ml-2 mt-2"><strong>Contract End Date: </strong> Yearly</p>
                                                <p class="m-0 ml-2 mt-2"><strong>[50%] Payment To Be Made Now</strong></p>
                                                <p class="m-0 ml-2 mt-2">+ Vat 5% : AED 600.00</p>
                                                <p class="m-0 ml-2 mt-2">Initial Payment [6300].00 Rent + Deposit [600].00 = [6900].00 AED</p>
                                                <p class="m-0 ml-2 mt-2">2nd Payment [6300].00 AED - [17th of July 2023] Via [Post Dated Cheque]</p>
                                            </td>
                                            <td style="border-bottom: 0px">
                                                <p class="m-0">1</p>
                                            </td>
                                            <td style="border-bottom: 0px">
                                                <p class="m-0">[12000].00</p>
                                            </td>
                                            <td style="border-bottom: 0px">
                                                <p class="m-0">[12000].00</p>
                                            </td>
                                        </tr>
                                    </table>

                                    <table class="mt-5 w-100 table">
                                        <tr>
                                            <td style="width: 50%">Security Deposit</td>
                                            <td>1</td>
                                            <td>[600].00</td>
                                            <td>[600].00</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%">Tax Total</td>
                                            <td>1</td>
                                            <td>[600].00</td>
                                            <td>[600].00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><strong>Sub Total</strong></td>
                                            <td><strong>[13200].00</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><strong>Paid to Date</strong></td>
                                            <td>[6900].00</td>
                                        </tr>
                                    </table>
                                    <div class="bg-primary rounded p-2 d-flex justify-content-between text-white mb-2 mt-2">
                                        <p class="m-0"><strong>Balance</strong></p>
                                        <p class="m-0">AED [6300].00</p>
                                    </div>
                                    <hr>
                                    <div class="pl-2 pr-2">
                                    <p class="m-0 mb-2 mt-2">Company Name: Total Property Solutions Real Estate LLC</p>
                                    <p class="m-0 mb-2">ADCB (Abu Dhabi Commercial Bank) </p>
                                    <p class="m-0 mb-2">Branch: IBD-ABU Dhabi MAIN </p>
                                    <p class="m-0 mb-2">    Account Number: 11880849820001 </p>
                                    <p class="m-0 mb-2">    IBAN: AE200030011880849820001 </p>
                                    <p class="m-0 mb-2">    Cheques to be made payable to: Total Property Solutions Real Estate LLC
                                    </p>
                                        <div class="col-md-4 m-0 p-0">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="pma_agreement" name="pma_agreement" accept="application/pdf">
                                                <label class="custom-file-label" for="pma_agreement">Payment Receipt</label>
                                             </div>
                                        </div>

                                        <div class="mt-5">
                                            <hr>
                                            <div class="text-right">
                                                <button class="btn btn-dark btn-sm">Download Invoice</button>
                                            </div>
                                            <div class="text-center">
                                                <button class="btn btn-primary w-25">Payment Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
</body>
</html>
