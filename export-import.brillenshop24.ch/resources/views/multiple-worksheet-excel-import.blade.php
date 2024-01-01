@extends('layouts.main')

@section('title', 'Excel Multiple Worksheet Import Demo List')

@section('content')
	<!-- Section -->
	<section class="pt-150 pb-150">
		<div class="container">
			<!-- Excel Multiple Worksheet Import -->
			<div class="row">
				<div class="col">
					<h4 class="pb-10">Excel Multiple Worksheet Import Demo List</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('multiple-worksheet-excel-import-demo-1')}}" class="module-box">
						Demo 1
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('multiple-worksheet-excel-import-demo-2')}}" class="module-box">
						Demo 2
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('multiple-worksheet-excel-import-demo-3')}}" class="module-box">
						Demo 3
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('multiple-worksheet-excel-import-demo-4')}}" class="module-box">
						Demo 4
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('multiple-worksheet-excel-import-demo-5')}}" class="module-box">
						Demo 5
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('multiple-worksheet-excel-import-demo-6')}}" class="module-box">
						Demo 6
					</a>
				</div>
			</div>
			<!--end Excel Multiple Worksheet Import -->
		</div>
	</section>
	<!-- /Section -->
@endsection
