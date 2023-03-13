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
        table td,
        table td * {
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
        .fw-700{
            font-weight: 700;
        }
        .contract-table{
            border: 1px solid black;
        }
        .contract-table tr, td {
            border:  1px solid black;
        }
        .signature{
            border: 0px;
            border-bottom: 1px solid black;
        }
        .company-input{
            margin-left: 30px
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
            <img src="{{ asset('images/logo.webp') }}" class="rounded" width="200px">
        </div>
        <div class="container-md mt-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p class="m-0"><strong>Contract ID</strong></p>
                                        <p class="m-0">[#CID20022023]</p>
                                    </div>
                                    <div class="col-md-8 d-flex align-items-center">
                                        <h5 style="margin-left: 80px">TERMS AND CONDITIONS</h5>
                                    </div>
                                </div>
                                <hr>
                                 <p class="m-0 mb-2 fw-700">1. General Responsibility</p>
                                 <p class="m-0 mb-2">1.1. The lessee agrees and warrants that the leased space shall be used exclusively for its declared purpose and is hereby strictly prohibited to use it for any other purpose or business without prior written consent from the lessor.</p>
                                 <p class="m-0 mb-2">1.2. The client is expected to do his/her business limited to the occupied office space given.</p>
                                 <p class="m-0 mb-2">1.3. The lessee is held responsible for all his/her belongings, employees, invitees or visitors inside the occupied office space. The lessor, therefore, is not responsible for any losses, damages, and injuries sustained inside the occupied space.</p>
                                 <p class="m-0 mb-2">1.4. The lessee is expected not to conduct any improper, immoral, unlawful, or unsafe practices in any part of the premise and its immediate vicinity.</p>
                                 <p class="m-0 mb-2">1.5. The lessee is discouraged to alter, modify or install anything inside the occupied office space unless a written notice has been submitted. The letter will then be subject for review and approval of the lessor.</p>
                                 <p class="m-0 mb-2">1.6. The lessee agrees to pay all the charges for any extra work that needs to be done (etisalat installation, cctv camera installation, etc.) inside the office apart from the regular maintenance.</p>
                                 <p class="m-0 mb-2">1.7. The lessee and its employees are expected to adhere to the rules and regulations set by the management. Accepting visitors is allowed but only limited to the permissible premises within the building.</p>
                                 <p class="m-0 mb-2">1.8. The lessee agrees to permit the company and its authorized representatives/employees to enter their office spaces at all reasonable times during usual business hours for the purpose of inspection, or for the making of any necessary repairs, cleaning for which the first party is responsible or feels necessary for the safety and preservation of the premises.
                                </p>
                                 <p class="m-0 mb-2">1.9. In case of fire and any other urgent cases, the lessee permits the lessor and its authorized representative to open the leased office space by using the master key.</p>
                                 <p class="m-0 mb-2">1.10. The client is free to use the pantry, meeting rooms and other accessible facilities therein, but should make sure not to loiter, dump garbage, and cause any damages to the premises or cause any disturbances to other people.</p>
                                 <p class="m-0 mb-2">1.11. The client is encouraged to adhere to our office practice “CLEAN AS YOU GO”.</p>
                                 <p class="m-0 mb-2">1.12. The client, its employees, and its visitors are held responsible for their own garbage on all common areas.</p>
                                 <p class="m-0 mb-2">1.13. A weekly cleaning shall be scheduled. The assigned cleaner will only be allowed to enter the offices once permission has been secured from the authorized personnel of each office space. Otherwise, only the common areas shall be cleaned.</p>
                                 <p class="m-0 mb-2">1.14. The lessee can forward their inquiries or concerns to info@totalproperty.ae or via telephone +971585020978, +971585042436.</p>
                                 <p class="m-0 mb-2 fw-700">2. Lease Term and Rent</p>
                                 <p class="m-0 mb-2">2.1. The lessee has no right to sublease, assign or transfer the leased office space, directly or indirectly, to anybody during the term of the lease.</p>
                                 <p class="m-0 mb-2">2.2. The lessee is expected to hand over the occupied office space, together with its original keys, at the end of each contract with the same condition as it has been handed over at the beginning of the contract</p>
                                 <p class="m-0 mb-2">2.3. The lessee agrees that the lessor will have the right to refuse to accept the turnover of the office space, if, by proper assessment, the leased office space is not in a good and tenable condition.</p>
                                 <p class="m-0 mb-2 fw-700">3. Fees and Payment</p>
                                 <p class="m-0 mb-2">3.1. First payment should be in cash or bank transfer.</p>
                                 <p class="m-0 mb-2">3.2. The lessee is expected to pay the due amount on time. In case of any cheque return for whatsoever reason, request to withdraw or delay the cheque deposit, the lessee will pay the amount of AED 5000 per month, as penalty.</p>
                                 <p class="m-0 mb-2">3.3. A security deposit of AED 3000 shall be paid in cash or bank transfer, paid together with the first payment. It will be refunded accordingly at the end of the contract.</p>
                                 <p class="m-0 mb-2">3.4. After first payment, during transfer, only (1) original key to the office glass door will be given to the lessee or its authorized representative. Loss or failure to handover the original key upon end of contract shall mean a penalty amounting to AED 500 and will be deducted from the security deposit.</p>
                                 <p class="m-0 mb-2">3.5. For renewal, the first payment can be done with a PDC dated with the start date of the new contract.</p>
                                 <p class="m-0 mb-2">3.6. The lessor can issue a Tawtheeq to the lessee, if required, based on the signed lease agreement period. However, the lessee will shoulder all the government entitled fees and taxes during this process.</p>
                                 <p class="m-0 mb-2 fw-700">4. Renewal and Termination</p>
                                 <p class="m-0 mb-2">4.1. The lessor will send an electronic reminder to the lessee one (1) week prior to the 3-months’ notice period.</p>
                                 <p class="m-0 mb-2">4.2. If the lessee decides to renew or discontinue the contract, he/she is required to submit a written notice three (3) months prior to the end of contract. The written notice should be in the company letterhead, with signature and company stamp.</p>
                                 <p class="m-0 mb-2">4.3. The written notice shall only be recognized if it bears the stamp and signature of the lessor or any of its authorized representatives.</p>
                                 <p class="m-0 mb-2">4.4. If the lessee decides to renew, a new contract will be provided one (1) week prior the commencement date of the new contract.</p>
                                 <p class="m-0 mb-2">4.5. Failure to submit the written notice on time will cost the lessee a penalty of AED 1000 and an additional AED 50 per day from then on.</p>
                                 <p class="m-0 mb-2">4.6. If in any case, for any reason whatsoever, that the lessee decides to terminate the contract after submitting a renewal notice, the lessee will then have to pay a penalty of AED50 per day, counted from the day of submission of the notice</p>
                                 <p class="m-0 mb-2">4.7. If the lessee decides to discontinue the contract, and was able to notify the lessor on time, the lessee is expected to fully vacate the premises on the indicated end-of-contract (EOC) date.</p>
                                 <p class="m-0 mb-2">4.8. Failure to vacate the leased office space on the EOC date will hereby give authority to the lessor to remove any remaining equipment, furniture or other stuff to be transferred in a storage room.</p>
                                 <p class="m-0 mb-2">4.9. The lessee will then be charged AED 500 as compensation for the transfer, storage and delay caused to the lessor. The remaining belongings will be released once this amount has been cleared.</p>
                                 <p class="m-0 mb-2">4.10. If the lessee decides to discontinue the contract prematurely, he/she agrees that there will be no refund for the rent amount paid. The lessor will refund the security deposit in full.</p>
                                 <p class="m-0 mb-2 fw-700">5. Governing Law</p>
                                 <p class="m-0 mb-2">5.1. This contract shall be governed and construed in all respects in accordance with the laws of the UAE. Any dispute arising from this contract shall be resolved amicably, and in the event of no amicable success, then the dispute shall be referred to the competent courts.</p>

                                 <div class="mt-3 mb-3 bg-secondary p-3 rounded d-flex text-primary w-75 ml-auto mr-auto" style="column-gap: 2rem">
                                    <div>
                                        <p class="m-0 fw-700 text-primary">Invoice No</p>
                                        <p class="m-0"><a href="#">[#IN20022023001]</a></p>
                                    </div>
                                    <div>
                                        <p class="m-0 fw-700 text-primary">Quotation No</p>
                                        <p class="m-0"><a href="#">[#IN20022023001]</a></p>
                                    </div>
                                 </div>
                                 <div class="position-relative mb-5">
                                    <table class="w-100 contract-table">
                                        <tr>
                                            <td style="width: 50%; padding: 10px">
                                                <p class="m-0 fw-700 mb-3">LESSOR:</p>
                                                <input class="signature">
                                                <small class="d-block">Signature and Company Stamp</small>
                                            </td>
                                            <td style="width: 50%; padding: 10px">
                                                <p class="m-0 fw-700 mb-3">LESSEE:</p>
                                                <input class="signature">
                                                <small class="d-block">Signature</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:50%; padding:10px">
                                            <p class="m-0 mb-2">Company: <strong>Total Property Solutions Real Estate LLC</strong></p>
                                            <p class="m-0 mb-2">Representative: <strong>Ziad Qamar</strong></p>
                                            <p class="m-0 mb-2">Designation: <strong>General Manager</strong></p>
                                            <p class="m-0 mb-2">Date: <strong>13.02.2023</strong></p>
                                            </td>
                                            <td style="width:50%; padding:10px">
                                                <div class="row mb-1"><div class="col-md-4">Company:</div> <div class="col-md-8"> <input class="company-input" /></div></div>
                                                <div class="row mb-1"><div class="col-md-4">Representative:</div> <div class="col-md-8"> <input class="company-input" /></div></div>
                                                <div class="row mb-1"><div class="col-md-4">Designation:</div> <div class="col-md-8"> <input class="company-input" /></div></div>
                                                <div class="row mb-1"><div class="col-md-4">Date:</div> <div class="col-md-8"> <input class="company-input" /></div></div>
                                            </td>
                                        </tr>
                                    </table>
                                    <img src="{{asset('images/stamp.png')}}" style="width: 200px; top: 70%; left: 30%" class="position-absolute">
                                </div>

                                 <div class="" style="margin-top: 100px">
                                    <div class="text-center mb-2">
                                      <button class="btn btn-sm btn-dark">Download Contract</button>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-sm btn-primary w-25">Submit Contract</button>
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
            var expandImg = document.getElementById("expand-" + id);
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
