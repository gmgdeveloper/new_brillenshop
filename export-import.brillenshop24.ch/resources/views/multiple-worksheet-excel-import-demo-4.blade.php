@extends('layouts.main')

@section('title', 'Multiple Worksheet Excel Import Demo 4')

@section('content')
	<!-- Section -->
	<section class="pt-150 pb-150">
		<div class="container">
			<div class="row">
			  <div class="col-md-6 offset-md-3">
				<!--Upload Box-->
				<div class="tp-upload-box">
					<form id="uploadForm" action="{{url('multiple-worksheet-excel-import-demo-4')}}" method="post" enctype="multipart/form-data">
						<div class="tp-header">
							Excel Multiple Worksheet Import
						</div>
						<div class="tp-body">
							<div class="tp-file-upload">
								<input type="file" name="FileName" id="FileName" class="tp-upload">
								<label for="FileName" class="tp-uploader tp-b-solid tp-bg-2" id="file-uploader">
									<span class="icon-upload"></span>
									<div class="selectFile">Choose a file</div>
								</label>
							</div>
							<div class="SuccessMgs display-none"></div>
						</div>
						<div class="tp-footer text-right">
							<input id="FileUploadId" type="text" class="display-none" value="{{ route('FileUpload.multiple-worksheet-excel-import-demo-4') }}"/>
							<input id="ImportServerId" type="text" class="display-none" value="{{ route('MultipleWorksheetExcelImportServer-4.multiple-worksheet-excel-import-demo-4') }}"/>
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
<script src="{{ asset('public/pages/multiple-worksheet-excel-import.js') }}" type="text/javascript"></script>
@endpush