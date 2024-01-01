@extends('layouts.main')

@section('title', 'Export List')

@section('content')
	<!-- Section -->
	<section class="pt-150 pb-150">
		<div class="container">
			<!-- Excel Export and Import -->
			<div class="row">
				<div class="col">
					<!-- <h4 class="pb-10">Excel, CSV and Multiple Worksheet Export</h4> -->
					<h4 class="pb-10">Excel, CSV  Export</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('excel-export-data-all')}}" class="module-box">
						Excel Export
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('csv-export-data-list-all')}}" class="module-box">
						CSV Export
					</a>
				</div>
				<!-- <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('multiple-worksheet-export-data-list')}}" class="module-box">
						Multiple Worksheet Excel
					</a>
				</div> -->
			</div><!--end Excel Export and Import -->
		</div>
	</section>
	<!-- /Section -->
@endsection
