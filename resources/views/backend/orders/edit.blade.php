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
						<!--begin::Post-->
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<!--begin::Container-->
							<div id="kt_content_container" class="container-xxl">
								<!--begin::Form-->
								<form id="kt_ecommerce_edit_order_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="../../demo1/dist/apps/ecommerce/sales/listing.html">
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
														<div class="fw-bolder fs-3">{{ $order->reference_id }}</div>
														<!--end::Input-->
													</div>
													<!--end::Input group-->
													<!--begin::Input group-->
													<div class="fv-row">
														<!--begin::Label-->
														<label class="form-label">Order Date</label>
														<!--end::Label-->
														<!--begin::Auto-generated ID-->
														<div class="fw-bolder fs-3">{{ $order->created_at }}</div>
														<!--end::Input-->
													</div>
													<!--end::Input group-->
													<!--begin::Input group-->
													<div class="fv-row">
														<!--begin::Label-->
														<label class="form-label">Delivery</label>
														<!--end::Label-->
														<!--begin::Auto-generated ID-->
														<div class="fw-bolder fs-3">{{ $order->delivery }}</div>
														<!--end::Input-->
													</div>
													<!--end::Input group-->
													<!--begin::Input group-->
													<div class="fv-row">
														<!--begin::Label-->
														<label class="required form-label">Status</label>
														<!--end::Label-->
														<!--begin::Select2-->
														<select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" name="status" id="kt_ecommerce_edit_order_payment">
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
															<input class="form-control" name="first_name" placeholder="" value="{{ $order->customers->phone_number }}" />
															<!--end::Input-->
														</div>
														<div class="fv-row flex-row-fluid">
															<!--begin::Label-->
															<label class="form-label">Email</label>
															<!--end::Label-->
															<!--begin::Input-->
															<input type="text" class="form-control" name="last_name" placeholder="" value="{{ $order->customers->email }}" />
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
															<input class="form-control" name="city" placeholder="" value="Melbourne" />
															<!--end::Input-->
														</div>
													</div>
													<!--end::Input group-->
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
													<!--begin::Table-->
													<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_edit_order_product_table">
														<!--begin::Table head-->
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
															<tr>
																<!--begin::Checkbox-->
																<td>
																	<div class="form-check form-check-sm form-check-custom form-check-solid">
																		<input class="form-check-input" type="checkbox" value="1" />
																	</div>
																</td>
																<!--end::Checkbox-->
																<!--begin::Product=-->
																<td>
																	<div class="d-flex align-items-center" data-kt-ecommerce-edit-order-filter="product" data-kt-ecommerce-edit-order-id="product_1">
																		<!--begin::Thumbnail-->
																		<a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="symbol symbol-50px">
																			<span class="symbol-label" style="background-image:url(assets/media//stock/ecommerce/1.gif);"></span>
																		</a>
																		<!--end::Thumbnail-->
																		<div class="ms-5">
																			<!--begin::Title-->
																			<a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" 
																			class="text-gray-800 text-hover-primary fs-5 fw-bolder">
																				{{ $item->product_name }}
																			</a>
																			<!--end::Title-->
																			<!--begin::Price-->
																			<div class="fw-bold fs-7">USD$
																				@php 
																				$product_total = $item->product_total / 100
																				@endphp
																				<span data-kt-ecommerce-edit-order-filter="price">{{ number_format((float)$product_total, 2, '.', '') }}</span>
																			</div>
																			<!--end::Price-->
																			<!--begin::SKU-->
																			<div class="text-muted fs-7">ZWL$: 
																				@php 
																				$product_zwl_total = $item->product_zwl_total / 100
																				@endphp
																			<span data-kt-ecommerce-edit-order-filter="price">{{ number_format((float)$product_zwl_total, 2, '.', '') }}</span>
																			</div>
																			<!--end::SKU-->
																		</div>
																	</div>
																</td>
																<!--end::Product=-->
																<!--begin::Qty=-->
																<td class="text-end pe-5" data-order="16">
																	<span class="fw-bolder ms-3">{{ $item->quantity }}</span>
																</td>
																<!--end::Qty=-->
															</tr>
															<!--end::Table row-->
															@endforeach
														</tbody>
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
								</form>
								<!--end::Form-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Post-->
					</div>
					<!--end::Content-->



@endsection