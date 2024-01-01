@extends('layouts.main')

@section('title', 'Export Data')

@section('content')
	<!-- Section -->
	<section class="pt-150 pb-150">
		<div class="container">
			<!-- Excel Export and Import -->
			<div class="row">
				<div class="col">
			
					<h4 class="pb-10">Excel Export</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('excel-export-data-users')}}" class="module-box">
					Users Export
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-20">
					<a href="{{url('excel-export-data-list')}}" class="module-box">
						Products Export
					</a>
				</div>
				
			</div><!--end Excel Export and Import -->
		</div>
	</section>
	<!-- /Section -->
@endsection
