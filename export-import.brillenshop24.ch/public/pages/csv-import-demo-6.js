
"use strict";

var $ = jQuery.noConflict();
var FileName = '';
var FileExt = '';
var Filetype = '';
var FileUpload = '';
var CSVImportServer = '';

/*Form reset function*/
function resetForm(id) {
	$('#' + id).each(function() {
		this.reset();
	});
}

function onConfirmDataInsert() {

	$.ajax({
		type : 'post',
		dataType : "json",
		url : CSVImportServer,
		data : {
			"action" : 'InsertData',
			"FileName" : FileName
		},
		success : function(response) {

			var msgType = response.msgType;
			var msg = response.msg;
			FileName = '';
			FileExt = '';
			Filetype = '';
			
			if (msgType == 'success') {
				
				resetForm("uploadForm");
				$("#selectFile").val('Choose a file');
				$(".selectFile").text('');
				$(".SuccessMgs").show();
				$(".SuccessMgs").html(msg);
				
			} else {
				
				resetForm("uploadForm");
				$("#selectFile").val('Choose a file');
				$(".selectFile").html('');
				$(".SuccessMgs").show();
				$(".SuccessMgs").html(msg);
			}
		}
	});
}

jQuery(document).ready(function (e) {
	
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	
	$('input[type="file"]').change(function(e){
		
		FileUpload = $("#FileUploadId").val();
		CSVImportServer = $("#ImportServerId").val();
		
		FileName = e.target.files[0].name;
		FileExt = FileName.split('.').pop(); //get file extension
		Filetype = FileExt.toLowerCase(); //Convert uppercase to lowercase
		
		/*The file Check extension*/
		if((Filetype == 'csv') || (Filetype == 'CSV')){
			
			$("#selectFile").val(FileName);
			$(".selectFile").html('');
			$(".SuccessMgs").hide();
			$(".SuccessMgs").html('');

		}else{
			resetForm("uploadForm");
			$("#selectFile").val('Choose a file');
			$(".selectFile").html('<span class="red">Sorry, only csv file are allowed.</span>');
			$(".SuccessMgs").hide();
			$(".SuccessMgs").html('');
		}
	});
		
	$("#uploadForm").on('submit',(function(e) {
		e.preventDefault();

		if((FileName =='') || (typeof FileName ==="undefined")){
			$("#selectFile").val('Choose a file');
			$(".selectFile").html('<span class="red">Please upload your file.</span>');
			$(".SuccessMgs").hide();
			$(".SuccessMgs").html('');
			return;
		}

		/*The file Check extension*/
		if((Filetype == 'csv') || (Filetype == 'CSV')){
			$.ajax({
				url: FileUpload,
				type: "POST",
				dataType : "json",
				data:  new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				success: function(response){

					var msgType = response.msgType;
					var msg = response.msg;

					if(msgType == 'success'){
						
						onConfirmDataInsert();
						
					}else{
						resetForm("uploadForm");
						$(".SuccessMgs").show();
						$(".SuccessMgs").html(msg);
					}
				},
				error: function(){
					
				} 	        
			});
		}else{
			$("#selectFile").val('Choose a file');
			$(".selectFile").html('<span class="red">Sorry, only csv file are allowed.</span>');
			$(".SuccessMgs").hide();
			$(".SuccessMgs").html('');
			return;
		}
	   
	}));

});
