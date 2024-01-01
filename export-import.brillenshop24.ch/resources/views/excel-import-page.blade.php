@extends('layouts.main')

@section('title', 'Import List')

@section('content')
	<!-- Section -->
	<section class="pt-100 pb-50">
	


		<div class="container">
			<!-- Excel Export and Import -->
			<div class="row">
				<div class="col">
					<!-- <h4 class="pb-10">Excel, CSV and Multiple Worksheet Export</h4> -->
					<h4 class="pb-10">Excel Import </h4>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('excel-import-users')}}" class="module-box">
					Excel Users Import
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('excel-import-demo-1')}}" class="module-box">
					Excel Products Import
					</a>
				</div>	
			</div>
            <!--end Excel Export and Import -->
		</div>
	</section>
	<!-- /Section -->
@endsection
