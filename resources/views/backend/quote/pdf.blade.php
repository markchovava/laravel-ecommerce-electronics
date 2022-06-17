<!DOCTYPE html>
<html lang="en">
    <!--begin::Head-->
    @include('backend.layouts.head')
    
	<!--end::Head-->
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js" ></script>

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
   <!--begin::Post-->
   <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!-- begin::Invoice 3-->
            <div class="card">
                <!-- begin::Body-->
                <div class="card-body py-20">
                    <!-- begin::Wrapper-->
                    <div id="quotation__area" class="mw-lg-950px mx-auto w-100">
                        <section>
                            <!-- begin::Header-->
                            <div class="d-flex justify-content-between flex-column flex-sm-row mb-19">
                                <h4 class="fw-boldest text-gray-800 fs-2qx pe-5 pb-7">Quotation</h4>
                                <!--end::Logo-->
                                <div class="text-sm-end">
                                    <!--begin::Logo-->
                                    <a href="#" class="d-block mw-150px ms-sm-auto">
                                        <img alt="Logo" src="{{ asset('backend/assets/images/logos/lunar-logo.png') }}" class="w-100" />
                                    </a>
                                    <!--end::Logo-->
                                    <!--begin::Text-->
                                    <div class="text-sm-end fw-bold fs-4 mt-7">
                                        <div style="width:220px;">
                                            {{ $info->company_name }} <br>
                                            {{ $info->company_address }} <br>
                                            {{ $info->company_phone_number }} <br>
                                            {{ $info->company_email }}
                                        </div>
                                    </div>
                                    <!--end::Text-->
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="pb-12">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column gap-7 gap-md-10">
                                    <!--begin::Message-->
                                    <div class="fw-bolder fs-2">Dear {{ $quote->billing_name }}
                                    <span class="fs-6">({{ $quote->billing_email }})</span>,
                                    <br />
                                    <span class="text-muted fs-5">Here are your quotation details. We look forward to your purchase.</span></div>
                                    <!--begin::Message-->
                                    <!--begin::Separator-->
                                    <div class="separator"></div>
                                    <!--end::Separator-->
                                     <!--begin::Order details-->
                                     <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bolder">
                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Quatation Date</span>
                                            <span class="fs-5">{{ $quote->quote_date }}</span>
                                        </div>
                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Due Date</span>
                                            <span class="fs-5">{{ $quote->quote_due_date}}</span>
                                        </div>
                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Quotation ID</span>
                                            <span class="fs-5">{{ $quote->quote_number }}</span>
                                        </div>
                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Quotation Number</span>
                                            <span class="fs-5">{{ $quote->id }}</span>
                                        </div>
                                    </div>
                                    <!--end::Order details-->
                                    <!--begin::Billing & shipping-->
                                    <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bolder">
                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Customer Details</span>
                                            <span class="fs-6" style="width:200px">
                                                {{ $quote->billing_name }} <br>
                                                {{ $quote->billing_address }} <br>
                                                {{ $quote->billing_phone }} <br>
                                                {{ $quote->billing_email }}
                                            </span>
                                        </div>
                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Shipping Details</span>
                                            <span class="fs-6" style="width:200px">
                                                {{ $quote->shipping_name }} <br>
                                                {{ $quote->shipping_address }} <br>
                                                {{ $quote->shipping_phone }} <br>
                                                {{ $quote->shipping_email }}
                                            </span>
                                        </div>
                                    </div>
                                    <!--end::Billing & shipping-->
                                    <!--begin:Order summary-->
                                    <div class="d-flex justify-content-between flex-column">
                                        <!--begin::Table-->
                                        <div class="table-responsive border-bottom mb-9">
                                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                <thead>
                                                    <tr class="border-bottom fs-6 fw-bolder text-muted">
                                                        <th class="min-w-175px pb-2">Products</th>
                                                        <th class="min-w-70px text-end pb-2">Price</th>
                                                        <th class="min-w-80px text-end pb-2">QTY</th>
                                                        <th class="min-w-100px text-end pb-2">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fw-bold text-gray-600">
                                                    <!--begin::Products-->
                                                    @foreach($quote_items as $quote_item)
                                                    <tr>
                                                        <!--begin::Product-->
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                
                                                                <!--begin::Title-->
                                                                <div class="ms-5">
                                                                    <div class="fw-bolder">{{ $quote_item->product_name }}</div>
                                                                    <div class="fs-7 text-muted">{{ $quote_item->description }}</div>
                                                                </div>
                                                                <!--end::Title-->
                                                            </div>
                                                        </td>
                                                        <!--end::Product-->
                                                        <!--begin::SKU-->
                                                        <td class="text-end">
                                                        @php 
                                                        $price = $quote_item->price_cents / 100;
                                                        @endphp
                                                        ${{ number_format((float)$price, 2, '.', '') }}
                                                        </td>
                                                        <!--end::SKU-->
                                                        <!--begin::Quantity-->
                                                        <td class="text-end">{{ $quote_item->quantity }}</td>
                                                        <!--end::Quantity-->
                                                        <!--begin::Total-->
                                                        <td class="text-end">
                                                        @php 
                                                        $total = $quote_item->total_cents / 100;
                                                        @endphp
                                                        ${{ number_format((float)$total, 2, '.', '') }}
                                                        </td>
                                                        <!--end::Total-->
                                                    </tr>
                                                    @endforeach
                                                    <!--end::Products-->


                                                    <!--begin::Subtotal-->
                                                    <tr>
                                                        <td colspan="3" class="text-end">Subtotal</td>
                                                        <td class="text-end">
                                                        @php 
                                                        $subtotal = $quote->subtotal_cents / 100;
                                                        @endphp
                                                            ${{ number_format((float)$subtotal, 2, '.', '') }}
                                                        </td>
                                                    </tr>
                                                    <!--end::Subtotal-->
                                                    <!--begin::VAT-->
                                                    <tr>
                                                        <td colspan="3" class="text-end">VAT (%)</td>
                                                        <td class="text-end">{{ $quote->tax }}%</td>
                                                    </tr>
                                                    <!--end::VAT-->
                                                    <tr>
                                                        <td colspan="3" class="text-end">Discount (%)</td>
                                                        <td class="text-end">{{ $quote->discount }}%</td>
                                                    </tr>
                                                    <!--begin::Grand total-->
                                                    <tr>
                                                        <td colspan="3" class="fs-3 text-dark fw-bolder text-end">Grand Total</td>
                                                        <td class="text-dark fs-3 fw-boldest text-end">
                                                        @php 
                                                        $grandtotal = $quote->grandtotal_cents / 100;
                                                        @endphp
                                                            ${{ number_format((float)$grandtotal, 2, '.', '') }}
                                                        </td>
                                                    </tr>
                                                    <!--end::Grand total-->
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                    </div>
                                    <!--end:Order summary-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Body-->
                        </section>
                    </div>
                    <!-- end::Wrapper-->
                        <!-- begin::Footer-->
                        <div class="d-flex flex-stack flex-wrap mt-lg-20 pt-13">
                            <!-- begin::Actions-->
                            <div class="my-1 me-5">
                                <!-- begin::Pint-->
                                <button type="button" class="btn btn-success my-1 me-12" onclick="window.print();">Print Quotation</button>
                                <!-- end::Pint-->
                            </div>
                            <!-- end::Actions-->
                            <!-- begin::Action-->
                            <a href="{{ route('admin.quote') }}" class="btn btn-primary my-1">View Quotations</a>
                            <!-- end::Action-->
                        </div>
                        <!-- end::Footer-->
                </div>
                <!-- end::Body-->
            </div>
            <!-- end::Invoice 1-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->


<script>
    /* async function generate_pdf(){
    
        var generate__pdf = $(this).text('Please wait, your download will start shortly.')
        var quotation__area = $('#quotation__area');
        //alert(quotation__area);
        var doc = new jsPDF('l', 'pt');

        await html2canvas(quotation__area, {
                allowTaint: true,
                useCORS: true,
                width: 1200
            }).then((canvas) => {
                //Canvas (convert to PNG)
                doc.addImage(canvas.toDataURL("image/png"), 'PNG', 10, 10, 1220, 3000);
            });

        doc.save("Quote.pdf");

        generate__pdf = $(this).text('Generate PDF');

    }*/
</script>
<script type="text/javascript">
    $("#generate_pdf").on("click", function () {
        window.print();
    });
  </script>
</body>
</html>
