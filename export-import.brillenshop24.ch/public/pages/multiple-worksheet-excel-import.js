
"use strict";

var $ = jQuery.noConflict();
var FileName = '';
var FileExt = '';
var Filetype = '';
var FileUpload = '';
var MultipleWorksheetExcelImportServer = '';

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
		url : MultipleWorksheetExcelImportServer,
		data : {
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
				$(".selectFile").text('Choose a file');
				$(".SuccessMgs").show();
				$(".SuccessMgs").html(msg);
				
			} else {
				
				resetForm("uploadForm");
				$(".selectFile").html('<span class="done">Choose a file</span>');
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
		MultipleWorksheetExcelImportServer = $("#ImportServerId").val();
		
		FileName = e.target.files[0].name;
		FileExt = FileName.split('.').pop(); //get file extension
		Filetype = FileExt.toLowerCase(); //Convert uppercase to lowercase
		
		/*The file Check extension*/
		if((Filetype == 'xlsx') || (Filetype == 'xls') || (Filetype == 'xltx')){
			
			$(".selectFile").html('<span class="done">'+FileName+'</span>');
			$(".SuccessMgs").hide();
			$(".SuccessMgs").html('');
			
		}else{
			resetForm("uploadForm");
			$(".selectFile").html('<span class="red">Sorry, only excel file are allowed.</span>');
			$(".SuccessMgs").hide();
			$(".SuccessMgs").html('');
		}
	});
		
	$("#uploadForm").on('submit',(function(e) {
		e.preventDefault();

		if((FileName =='') || (typeof FileName ==="undefined")){
			$(".selectFile").html('<span class="red">Please upload your file.</span>');
			$(".SuccessMgs").hide();
			$(".SuccessMgs").html('');
			return;
		}

		/*The file Check extension*/
		if((Filetype == 'xlsx') || (Filetype == 'xls') || (Filetype == 'xltx')){
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
			$(".selectFile").html('<span class="red">Sorry, only excel file are allowed.</span>');
			$(".SuccessMgs").hide();
			$(".SuccessMgs").html('');
			return;
		}
	   
	}));

});
