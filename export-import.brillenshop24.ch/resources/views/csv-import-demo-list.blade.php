@extends('layouts.main')

@section('title', 'CSV Import Demo List')

@section('content')
	<!-- Section -->
	<section class="pt-150 pb-150">
		<div class="container">
			<!-- CSV Import -->
			<div class="row">
				<div class="col">
					<h4 class="pb-10">CSV Import  List</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('csv-import-demo-1')}}" class="module-box">
					CSV Import
					</a>
				</div>
				<!-- <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('csv-import-demo-2')}}" class="module-box">
						Demo 2
					</a>
				</div> -->
				<!-- <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('csv-import-demo-3')}}" class="module-box">
						Demo 3
					</a>
				</div> -->
				<!-- <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('csv-import-demo-4')}}" class="module-box">
						Demo 4
					</a>
				</div> -->
				<!-- <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('csv-import-demo-5')}}" class="module-box">
						Demo 5
					</a>
				</div> -->
				<!-- <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('csv-import-demo-6')}}" class="module-box">
						Demo 6
					</a>
				</div> -->
			</div>
			<!--end CSV Import -->
		</div>
	</section>
	<!-- /Section -->
@endsection
