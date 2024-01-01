@extends('layouts.main')

@section('title', 'Home')

@section('content')
	<!-- Section -->
	<section class="pt-100 pb-50">
		<div class="container">
			<!-- Excel Export and Import -->
			<div class="row">
				<div class="col">
					<h4 class="pb-10">Excel Export and Import</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('excel-export-data-all')}}" class="module-box">
						Excel Export
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
				
				<a href="{{url('excel-import-data')}}" class="module-box">
					<!-- <a href="{{url('excel-import-demo-list')}}" class="module-box"> -->
						Excel Import
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('excel-imported-data-list')}}" class="module-box">
						Excel Imported Data
					</a>
				</div>
			</div><!--end Excel Export and Import -->
			
			<!-- CSV Export and Import -->
			<div class="row">
				<div class="col">
					<h4 class="pt-40 pb-10">CSV Export and Import</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<!-- <a href="{{url('csv-export-data-list')}}" class="module-box"> -->
					<a href="{{url('csv-export-data-list-all')}}" class="module-box">
					
						CSV Export
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<!-- <a href="{{url('csv-import-demo-list')}}" class="module-box"> -->
					<a href="{{url('csv-import-data-list')}}" class="module-box">
					
						CSV Import
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('csv-imported-data-list')}}" class="module-box">
						CSV Imported Data
					</a>
				</div>
			</div><!--end CSV Export and Import -->
			
			<!-- CSV Export and Import -->
			<!-- <div class="row">
				<div class="col">
					<h4 class="pt-40 pb-10">Excel Multiple Worksheet Export and Import</h4>
				</div>
			</div> -->
			<!-- <div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('multiple-worksheet-export-data-list')}}" class="module-box">
						Multiple Worksheet<br>Excel Export
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('multiple-worksheet-excel-import')}}" class="module-box">
						Multiple Worksheet<br>Excel Import
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('multiple-worksheet-imported-data-list')}}" class="module-box">
						Multiple Worksheet<br>Excel Imported Data
					</a>
				</div>
			</div> -->
			<!-- end CSV Export and Import				 --> 
		</div>
	</section>
	<!-- /Section -->
@endsection