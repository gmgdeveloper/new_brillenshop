@extends('layouts.main')

@section('title', 'Data List for Excel Export')

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
						<h2>Data List for Excel Export</h2>
					</div>
				</div>
			</div>
			<!-- Excel Export -->
			<div class="row">
				<div class="col-lg-12">
					<div class="panel-area">
						<div class="panel-header">
							<div class="inner-panel">
								<a href="{{url('excel-export-users')}}" class="btn btn-primary pull-right">
									<i class="fa fa-download"></i> Excel Export
								</a>
							</div>
						</div>
						<div class="panel-content">
							<div class="table-responsive">
								<table id="DataTable_Id" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead> 
										<tr>
											<th class="txt-center w-5">SL</th>
											<th class="w-35">Email</th> 
											<th class="w-15">First Name</th> 
											<th class="w-15">last Name</th> 
											<th class="txt-right w-15">Phone</th> 
											<th class="txt-right w-15">Status</th> 
										</tr>
									</thead> 
									<tbody>
										@php 
											$i=1 
										@endphp
										@foreach ($data as $aRow)
										<tr> 
											<td class="txt-center">{{ $i++}}</td> 
											<td>{{ $aRow->email }}</td> 
											<td>{{ $aRow->first_name }}</td> 
											<td>{{ $aRow->last_name }}</td> 
											<td class="txt-right">{{ $aRow->phone }}</td> 
											<td class="txt-right">{{ $aRow->status }}</td>
										</tr>
										@endforeach
									</tbody> 
								</table>
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