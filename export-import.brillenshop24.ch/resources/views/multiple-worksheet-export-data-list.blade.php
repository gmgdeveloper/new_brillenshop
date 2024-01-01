@extends('layouts.main')

@section('title', 'Data List for Multiple Worksheet Excel Export')

@push('style')
	<!-- dataTable css-->
	<link href="{{ asset('public/assets/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
	<link href="{{ asset('public/assets/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
	<!-- Section -->
	<section class="pt-100 pb-50">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section-heading mb-20">
						<h2>Data List for Multiple Worksheet Excel Export</h2>
					</div>
				</div>
			</div>
			<!-- Excel Export -->
			<div class="row">
				<div class="col-lg-12">

				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel-area">
						<div class="panel-header">
							<div class="inner-panel">
								<a href="{{url('multiple-worksheet-excel-export')}}" class="btn btn-primary pull-right">
									<i class="fa fa-download"></i> Excel Export
								</a>
							</div>
						</div>
						<div class="panel-content">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" href="#ComputerAccessories" role="tab" data-toggle="tab">Computer Accessories</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#MobileAccessories" role="tab" data-toggle="tab">Mobile Accessories</a>
								</li>
							</ul>

							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane fade in active show" id="ComputerAccessories">
									<div class="table-responsive">
										<table id="DataTable_Id_tab_1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
											<thead> 
												<tr>
													<th class="txt-center w-5">SL</th>
													<th class="w-35">Item Name</th> 
													<th class="w-15">Item Code</th> 
													<th class="w-15">Date</th> 
													<th class="txt-right w-15">Price</th> 
													<th class="txt-right w-15">Quantity</th> 
												</tr>
											</thead> 
											<tbody>
												@php 
													$i=1 
												@endphp
												@foreach ($data['computer'] as $aRow)
												<tr> 
													<td class="txt-center">{{ $i++}}</td> 
													<td>{{ $aRow->ItemName }}</td> 
													<td>{{ $aRow->ItemCode }}</td> 
													<td>{{ $aRow->Date }}</td> 
													<td class="txt-right">{{ number_format($aRow->Price) }}</td> 
													<td class="txt-right">{{ number_format($aRow->Quantity) }}</td>
												</tr>
												@endforeach
											</tbody> 
										</table>
									</div>
								</div><!--End of Computer Accessories-->
								
								<div role="tabpanel" class="tab-pane fade" id="MobileAccessories">
									<div class="table-responsive">
										<table id="DataTable_Id_tab_2" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
											<thead> 
												<tr>
													<th class="txt-center w-5">SL</th>
													<th class="w-35">Item Name</th> 
													<th class="w-15">Item Code</th> 
													<th class="w-15">Date</th> 
													<th class="txt-right w-15">Price</th> 
													<th class="txt-right w-15">Quantity</th> 
												</tr>
											</thead> 
											<tbody>
												@php 
													$i=1 
												@endphp
												@foreach ($data['mobile'] as $aRow)
												<tr> 
													<td class="txt-center">{{ $i++}}</td> 
													<td>{{ $aRow->ItemName }}</td> 
													<td>{{ $aRow->ItemCode }}</td> 
													<td>{{ $aRow->Date }}</td> 
													<td class="txt-right">{{ number_format($aRow->Price) }}</td> 
													<td class="txt-right">{{ number_format($aRow->Quantity) }}</td>
												</tr>
												@endforeach
											</tbody> 
										</table>
									</div>
								</div><!--End of Mobile Accessories-->
							</div>
						</div>
					</div>
				</div>
			</div><!--end of row-->
		</div>
	</section>
	<!-- /Section -->
@endsection

@push('scripts')
	<!-- dataTable js -->
	<script src="{{ asset('public/assets/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('public/assets/datatable/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('public/assets/datatable/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('public/assets/datatable/js/responsive.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('public/assets/datatable/js/custom-datatable.js') }}"></script>
@endpush