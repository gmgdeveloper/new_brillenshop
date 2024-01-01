@extends('layouts.main')

@section('title', 'CSV Import Demo 3')

@section('content')
	<!-- Section -->
	<section class="pt-150 pb-150">
		<div class="container">
			<div class="row">
			  <div class="col-md-6 offset-md-3">
				<!--Upload Box-->
				<div class="tp-upload-box">
					<form id="uploadForm" action="{{url('csv-import-demo-3')}}" method="post" enctype="multipart/form-data">
						<div class="tp-header">
							CSV Import
						</div>
						<div class="tp-body">
							<div class="tp-file-upload">
								<input type="file" name="FileName" id="FileName" class="tp-upload">
								<label for="FileName" class="tp-uploader tp-b-solid tp-b-radius-10 tp-bg-2" id="file-uploader">
									<span class="icon-upload"></span>
									<div class="selectFile">Choose a file</div>
								</label>
							</div>
							<div class="SuccessMgs display-none"></div>
						</div>
						<div class="tp-footer text-right">
							<input id="FileUploadId" type="text" class="display-none" value="{{ route('FileUpload.csv-import-demo-3') }}"/>
							<input id="ImportServerId" type="text" class="display-none" value="{{ route('CSVImportServer-3.csv-import-demo-3') }}"/>
							<input type="submit" value="Upload" class="tp-btn blue-btn tp-b-radius-5"/>
						</div>
					</form>
				</div>
				<!--/Upload Box-->
			  </div>
			</div>
		</div>
	</section>
	<!-- /Section -->
@endsection

@push('scripts')
<!-- upload js -->
<script src="{{ asset('public/pages/csv-import.js') }}" type="text/javascript"></script>
@endpush