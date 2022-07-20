@extends('backend.layouts.master')

@section('backend')


<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Toolbar-->
	<div class="toolbar" id="kt_toolbar">
		<!--begin::Container-->
		<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
			<!--begin::Page title-->
			<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
				<!--begin::Title-->
				<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Edit Order</h1>
				<!--end::Title-->
				<!--begin::Separator-->
				<span class="h-20px border-gray-300 border-start mx-4"></span>
				<!--end::Separator-->
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">
						<a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item">
						<span class="bullet bg-gray-300 w-5px h-2px"></span>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item text-dark">Edit Order</li>
					<!--end::Item-->
				</ul>
				<!--end::Breadcrumb-->
			</div>
			<!--end::Page title-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Toolbar-->	
	<form action="{{ route('admin.orders.update', $order->id) }}"  method="post" >
	@csrf
		<!--begin::Post-->
		<div class="post d-flex flex-column-fluid" id="kt_post">
			<!--begin::Container-->
			<div id="kt_content_container" class="container-xxl">
				<!--begin::Form-->
				<section class="form d-flex flex-column flex-lg-row">				
					<!--begin::Aside column-->
					<div class="w-100 flex-lg-row-auto w-lg-300px mb-7 me-7 me-lg-10">
						<!--begin::Order details-->
						<div class="card card-flush py-4">
							<!--begin::Card header-->
							<div class="card-header">
								<div class="card-title">
									<h2>Order Details</h2>
								</div>
							</div>
							<!--end::Card header-->
							<!--begin::Card body-->
							<div class="card-body pt-0">
								<div class="d-flex flex-column gap-10">
									<!--begin::Input group-->
									<div class="fv-row">
										<!--begin::Label-->
										<label class="form-label">Order ID</label>
										<!--end::Label-->
										<!--begin::Auto-generated ID-->
										<div class="fw-bolder fs-3">
											{{ $order->reference_id }}
											<input type="hidden" name="reference_id" value="{{ $order->reference_id }}">
										</div>
										<!--end::Input-->
									</div>
									<!--end::Input group-->
									<!--begin::Input group-->
									<div class="fv-row">
										<!--begin::Label-->
										<label class="form-label">Order Date</label>
										<!--end::Label-->
										<!--begin::Auto-generated ID-->
										<div class="fw-bolder fs-3">
											{{ $order->created_at }}
										</div>
										<!--end::Input-->
									</div>
									<!--end::Input group-->
									<!--begin::Input group-->
									<div class="fv-row">
										<!--begin::Label-->
										<label class="required form-label">Delivery</label>
										<!--end::Label-->
										<!--begin::-->
										<div class="fw-bolder fs-3">
											<label class="form-check form-check-custom form-check-solid mb-3">
												<input name="include_shipping" class="form-check-input" type="checkbox" value="Yes"
												{{ ($order->include_shipping == "Yes") ? 'checked="checked"' : '' }}/>
												<span class="form-check-label">
													Include Delivery
												</span>
											</label>
												<input type="hidden" name="shipping_fee" value="{{ $shipping->fee }}">
										</div>
										<!--end::Input-->
										<!--begin::Select2-->
										<select name="delivery" class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_edit_order_payment">
											<option value="">Select an option</option>
											<option value="To Company Address" {{ ($order->delivery == "To Company Address") ? 'selected="selected"' : '' }}>To Company Address</option>
											<option value="To Delivery Address" {{ ($order->delivery == "To Delivery Address") ? 'selected="selected"' : '' }}>To Delivery Address</option>
										</select>
										<!--end::Select2-->
										<!--begin::Description-->
										<div class="text-muted fs-7">Set the date of the order to process.</div>
										<!--end::Description-->
									</div>
									<!--end::Input group-->
									<!--begin::Input group-->
									<div class="fv-row">
										<!--begin::Label-->
										<label class="form-label">USD TO ZWL</label>
										<!--end::Label-->
										<!--begin::Auto-generated ID-->
										<div class="fw-bolder fs-3 mb-2">
											USD$1.00 : 
											ZWL${{ number_format((float)$currency->value, 2, '.', '') }}
											<input type="hidden" name="currency_zwl_rate" class="currency__value" value="{{ $currency->value }}">
										</div>
										<!--begin::Select2-->
										<select name="currency" class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_edit_order_payment">
											<option value="">Select an option</option>
											<option value="ZWL" {{ ($order->currency == "ZWL") ? 'selected="selected"' : '' }}>ZWL</option>
											<option value="USD" {{ ($order->currency == "USD") ? 'selected="selected"' : '' }}>USD</option>
										</select>
										<!--end::Select2-->
										<!--end::Input-->
									</div>
									<!--end::Input group-->
									<!--begin::Input group-->
									<div class="fv-row">
										<!--begin::Label-->
										<label class="required form-label">Status</label>
										<!--end::Label-->
										<!--begin::Select2-->
										<select name="status" class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_edit_order_payment">
											<option value="">Select an option</option>
											<option value="Processing" {{ ($order->status == "Processing") ? 'selected="selected"' : '' }}>Processing</option>
											<option value="Paid" {{ ($order->status == "Paid") ? 'selected="selected"' : '' }}>Paid</option>
											<option value="In-transit" {{ ($order->status == "In-transit") ? 'selected="selected"' : '' }}>In-transit</option>
											<option value="Delivered" {{ ($order->status == "Delivered") ? 'selected="selected"' : '' }}>Delivered</option>
										</select>
										<!--end::Select2-->
										<!--begin::Description-->
										<div class="text-muted fs-7">Set the date of the order to process.</div>
										<!--end::Description-->
									</div>
									<!--end::Input group-->
								</div>
							</div>
							<!--end::Card header-->
						</div>
						<!--end::Order details-->
					</div>
					<!--end::Aside column-->
					<!--begin::Main column-->
					<div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">
						<!--begin::Order details-->
						<div class="card card-flush py-4">
							<!--begin::Card header-->
							<div class="card-header">
								<div class="card-title">
									<h2>Customer Details</h2>
								</div>
							</div>
							<!--end::Card header-->
							<!--begin::Card body-->
							<div class="card-body pt-0">
								<!--begin::Billing address-->
								<div class="d-flex flex-column gap-5 gap-md-7">
									<!--begin::Input group-->
									<div class="d-flex flex-column flex-md-row gap-5">
										<div class="flex-row-fluid">
											<!--begin::Label-->
											<label class="form-label">First Name</label>
											<!--end::Label-->
											<!--begin::Input-->
											<input class="form-control" name="first_name" placeholder="" value="{{ $order->customers->first_name }}" />
											<input type="hidden" name="customer_id" value="{{ $order->customer_id}}">
											<!--end::Input-->
										</div>
										<div class="fv-row flex-row-fluid">
											<!--begin::Label-->
											<label class="form-label">Last Name</label>
											<!--end::Label-->
											<!--begin::Input-->
											<input type="text" class="form-control" name="last_name" placeholder="" value="{{ $order->customers->last_name }}" />
											<!--end::Input-->
										</div>
									</div>
									<!--end::Input group-->
									<div class="d-flex flex-column flex-md-row gap-5">
										<div class="flex-row-fluid">
											<!--begin::Label-->
											<label class="form-label">Phone Number</label>
											<!--end::Label-->
											<!--begin::Input-->
											<input class="form-control" name="phone_number" placeholder="" value="{{ $order->customers->phone_number }}" />
											<!--end::Input-->
										</div>
										<div class="fv-row flex-row-fluid">
											<!--begin::Label-->
											<label class="form-label">Email</label>
											<!--end::Label-->
											<!--begin::Input-->
											<input type="text" class="form-control" name="email" placeholder="" value="{{ $order->customers->email }}" />
											<!--end::Input-->
										</div>
									</div>
									<!--end::Input group-->
									<!--begin::Input group-->
									<div class="d-flex flex-column flex-md-row gap-5">
										<div class="fv-row flex-row-fluid">
											<!--begin::Label-->
											<label class="required form-label">Delivery Address</label>
											<!--end::Label-->
											<textarea name="delivery_address" class="form-control" cols="30" rows="3">{{ $order->customers->delivery_address }}</textarea>
										</div>
									</div>
									<!--end::Input group-->
									<!--begin::Input group-->
									<div class="d-flex flex-column flex-md-row gap-5">
										<div class="flex-row-fluid">
											<!--begin::Label-->
											<label class="form-label">City</label>
											<!--end::Label-->
											<!--begin::Input-->
											<input class="form-control" name="delivery_city" placeholder="" value="Melbourne" />
											<!--end::Input-->
										</div>
									</div>
									<!--end::Input group-->
								</div>
								<!--end::Billing address-->
							</div>
							<!--end::Card body-->
						</div>
						<!--end::Order details-->
						<!--begin::Order details-->
						<div class="card card-flush py-4">
							<!--begin::Card header-->
							<div class="card-header">
								<div class="card-title">
									<h2>Company Details</h2>
								</div>
							</div>
							<!--end::Card header-->
							<!--begin::Card body-->
							<div class="card-body pt-0">
								<!--begin::Billing address-->
								<div class="d-flex flex-column gap-5 gap-md-7">
									<!--begin::Input group-->
									<div class="d-flex flex-column flex-md-row gap-5">
										<div class="flex-row-fluid">
											<!--begin::Label-->
											<label class="form-label">Company Name</label>
											<!--end::Label-->
											<!--begin::Input-->
											<input class="form-control" name="company_name" placeholder="" value="{{ $order->customers->company_name }}" />
											<!--end::Input-->
										</div>
									</div>
									<!--end::Input group-->
									<!--end::Input group-->
									<div class="d-flex flex-column flex-md-row gap-5">
										<div class="flex-row-fluid">
											<!--begin::Label-->
											<label class="form-label">Company Phone Number</label>
											<!--end::Label-->
											<!--begin::Input-->
											<input class="form-control" name="company_phone_number" placeholder="" value="{{ $order->customers->company_phone_number }}" />
											<!--end::Input-->
										</div>
										<div class="fv-row flex-row-fluid">
											<!--begin::Label-->
											<label class="form-label">Company Email</label>
											<!--end::Label-->
											<!--begin::Input-->
											<input type="text" class="form-control" name="company_email" placeholder="" value="{{ $order->customers->company_email }}" />
											<!--end::Input-->
										</div>
									</div>
									<!--end::Input group-->
									<!--begin::Input group-->
									<div class="d-flex flex-column flex-md-row gap-5">
										<div class="fv-row flex-row-fluid">
											<!--begin::Label-->
											<label class="required form-label">Company Address</label>
											<!--end::Label-->
											<textarea name="company_address" class="form-control" cols="30" rows="3">{{ $order->customers->company_address }}</textarea>
										</div>
									</div>
									<!--end::Input group-->
									<!--begin::Input group-->
									<div class="d-flex flex-column flex-md-row gap-5">
										<div class="flex-row-fluid">
											<!--begin::Label-->
											<label class="form-label">Company City</label>
											<!--end::Label-->
											<!--begin::Input-->
											<input class="form-control" name="company_city" placeholder="" value="{{ $order->customers->company_city }}" />
											<!--end::Input-->
										</div>
									</div>
									<!--end::Input group-->
								</div>
								<!--end::Billing address-->
							</div>
							<!--end::Card body-->
						</div>
						<!--end::Order details-->
						<!--begin::Order details-->
						<div class="card card-flush py-4">
							<!--begin::Card body-->
							<div class="card-body pt-0">
								<!--begin::Billing address-->
								<div class="d-flex flex-column gap-5 gap-md-7">
									<!--begin::Input group-->
									<div class="d-flex flex-column flex-md-row gap-5">
										<div class="fv-row flex-row-fluid">
											<!--begin::Label-->
											<label class="form-label">Notes</label>
											<!--end::Label-->
											<textarea name="notes" class="form-control" cols="30" rows="3">{{ $order->notes }}</textarea>
										</div>
									</div>
									<!--end::Input group-->
								</div>
								<!--end::Billing address-->
							</div>
							<!--end::Card body-->
						</div>
						<!--end::Order details-->
						<!--begin::Order details-->
						<div class="card card-flush py-4">
							<!--begin::Card header-->
							<div class="card-header">
								<div class="card-title">
									<h2>Products</h2>
								</div>
							</div>
							<!--end::Card header-->
							<!--begin::Card body-->
							<div class="card-body pt-0">
								<div class="d-flex flex-column gap-10">
									<!--begin::Separator-->
									<div class="separator"></div>
									<!--end::Separator-->
									<!--begin::Search products-->
									<div class="d-flex align-items-center position-relative mb-n7" style="justify-content: space-between;">
										<div class="product__search">
											<div class="input-group">
												<input type="text" class="product__name form-control form-control-solid mb-2" placeholder="Search Product Name" />
												<div class="input-group-append">
													<button type="button" href="{{ route('admin.orders.search.product') }}" 
													style="border-top-left-radius:0px; border-bottom-left-radius:0px;" 
													class="search__btn btn btn-primary" id="search__btn">
														<i class="fa fa-search" aria-hidden="true"></i>
													</button>
												</div>
											</div>
											<ul class="product__results">
											</ul>
										</div> 
										<div class="product__add"  style="float:right">
											<button type="button" class="calculate__total btn btn-sm btn-light-danger" 
											style="padding:12.75px 20px; ">
												Calculate Total
											</button>	
										</div>
										
									</div>
									<!--end::Search products-->
									<!--begin::Table-->
									<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_edit_order_product_table">
										<!--begin::Table head-->
										<thead>
											<tr class="text-start fw-bolder fs-7 text-uppercase gs-0">
												<th class="w-25px pe-2"></th>
												<th class="min-w-200px">Total </th>
												<th class="min-w-100px text-end pe-5">
													USD$
													<span class="total__usd"></span><br>
													<input type="hidden" name="total_usdCents" class="total__usdCents">
													ZWL$
													<span class="total__zwl"></span>
													<input type="hidden" name="total_zwlCents" class="total__zwlCents">
												</th>
											</tr>
										</thead>
										<thead>
											<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
												<th class="w-25px pe-2"></th>
												<th class="min-w-200px">Product</th>
												<th class="min-w-100px text-end pe-5">Quantity</th>
											</tr>
										</thead>
										<!--end::Table head-->
										<!--begin::Table body-->
										<tbody class="fw-bold text-gray-600">
											@foreach($order_items as $item)
												<!--begin::Table row-->
												<tr class="product__row">
													<!--begin::Checkbox-->
													<td>
														<div class="form-check form-check-sm form-check-custom form-check-solid">
															<button class="remove__productItem btn btn-sm btn-light-danger">
																<i class="la la-trash-o"></i>
															</button>
														</div>
													</td>
													<!--end::Checkbox-->
													<!--begin::Product=-->
													<td>
														<div class="d-flex align-items-center">
															
															<div class="ms-5">
																<!--begin::Title-->
																<a href="{{ route('admin.products.edit', $item->product->id) }}" 
																class="text-gray-800 text-hover-primary fs-5 fw-bolder">
																	{{ $item->product_name }}
																	<input type="hidden" name="product_name[]" class="product__nameValue" value="{{ $item->product_name }}">
																	<input type="hidden" name="product_id[]"class="product__idValue" value="{{ $item->product_id }}">
																</a>
																<!--end::Title-->
																<!--begin::Price-->
																<div class="fw-bold fs-7">USD$
																	@php 
																	$unit_price = $item->unit_price / 100
																	@endphp
																	<span>{{ number_format((float)$unit_price, 2, '.', '') }}</span>
																	<input type="hidden" name="product_unit_price[]" value="{{ $item->unit_price }}" class="product__usdCentsValue">
																</div>
																<!--end::Price-->
																<!--begin::SKU-->
																<div class="text-muted fs-7">ZWL$: 
																	@php 
																	$zwl_unit_price_cents = $item->unit_price * intval($currency->value);
																	$zwl_unit_price = $zwl_unit_price_cents / 100;
																	@endphp
																	<span>{{ number_format((float)$zwl_unit_price, 2, '.', '') }}</span>
																	<input type="hidden" name="product_zwl_unit_price[]" value="{{ $zwl_unit_price }}" class="product__zwlCentsValue">
																</div>
																<!--
																	end::SKU-->
																<!--begin::-->
																<div class="text-muted fs-7">QTY: 
																	<span class="product__totalQuantity">
																		{{ $item->product->inventories->in_store_quantity }}
																	</span>
																	<input type="hidden" name="product_totalQuantity[]" 
																	value="{{ $item->product->inventories->in_store_quantity }}" class="product__totalQuantityValue">
																</div>
																<!--end::-->
																<!--begin::-->
																<div class="text-muted fs-7">
																	<input type="text" name="product_total[]" value="{{ $item->product_total }}" class="product__priceUsdTotal">
																	<input type="text" name="product_zwl_total[]" value="{{ $item->product_zwl_total }}" class="product__priceZwlTotal">
																</div>
																<!--end::-->
															</div>
														</div>
													</td>
													<!--end::Product=-->
													<!--begin::Qty=-->
													<td class="justify-content-end pe-5" >
														<input type="number" name="product_quantity[]" value="{{ intval($item->quantity) }}" 
															class="product__quantity form-control" 
															style="width:100px; margin-right:3px;" >
													</td>
													<!--end::Qty=-->
												</tr>
												<!--end::Table row-->
											@endforeach
										</tbody>
										<!--end::Table body-->
										<!--begin::Table body-->
										<tbody class="product__itemInsert fw-bold text-gray-600">
											
											<!--begin::Table row-->
											<tr class="product__item product__row display__none">
												<!--begin::Checkbox-->
												<td>
													<div class="form-check form-check-sm form-check-custom form-check-solid">
														<button type="button" class="remove__productItem btn btn-sm btn-light-danger">
															<i class="la la-trash-o"></i>
														</button>
													</div>
												</td>
												<!--end::Checkbox-->
												<!--begin::Product=-->
												<td>
													<div class="d-flex align-items-center">
														<div class="ms-5">
															<!--begin::Title-->
															<a href="#" 
															class="product__name text-gray-800 text-hover-primary fs-5 fw-bolder">
															</a>
															<input type="hidden" class="product__nameValue" value="">
															<input type="hidden" class="product__idValue" value="">
															<!--end::Title-->
															<!--begin::Price-->
															<div class="fw-bold fs-7">USD$
																<span class="product__usd"></span>
																<input type="hidden" class="product__usdCentsValue">
															</div>
															<!--end::Price-->
															<!--begin::SKU-->
															<div class="text-muted fs-7">ZWL$ 
																<span class="product__zwl"></span>
																<input type="hidden" class="product__zwlCentsValue">
															</div>
															<!--end::SKU-->
															<!--begin::SKU-->
															<div class="text-muted fs-7">QTY: 
																<span class="product__totalQuantity"></span>
																<input type="hidden" class="product__totalQuantityValue">
															</div>
															<!--end::SKU-->
															<!--begin::-->
															<div class="text-muted fs-7">
																<input type="text" value="" class="product__priceUsdTotal">
																<input type="text" value="" class="product__priceZwlTotal">
															</div>
															<!--end::-->
														</div>
													</div>
												</td>
												<!--end::Product=-->
												<!--begin::Qty=-->
												<!--begin::Qty=-->
												<td class="justify-content-end pe-5" >
													<input type="number" min="0" value=""
														class="product__quantity form-control" 
														style="width:100px; margin-right:3px;" />
												</td>
												<!--end::Qty=-->
											</tr>
											<!--end::Table row-->
										<!--end::Table body-->
									</table>
									<!--end::Table-->
								</div>
							</div>
							<!--end::Card header-->
						</div>
						<!--end::Order details-->
						<div class="d-flex justify-content-end">
							<!--begin::Button-->
							<button type="submit" id="kt_ecommerce_edit_order_submit" class="btn btn-primary">
								<span class="indicator-label">Save</span>
							</button>
							<!--end::Button-->
						</div>
					</div>
					<!--end::Main column-->
				</section>
				<!--end::Form-->
			</div>
			<!--end::Container-->
		</div>
		<!--end::Post-->
	</form>
</div>
<!--end::Content-->


<script src="{{ asset('backend/assets/custom/order.custom.js') }}"></script>

@endsection