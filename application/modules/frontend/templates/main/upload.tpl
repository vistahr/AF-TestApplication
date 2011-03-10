<script type="text/javascript" >
	$(document).ready(function(){
		
		var uploadTarget = document.getElementById("uploader");
		
		uploadTarget.addEventListener("dragenter"	, dragenter	, false);
		uploadTarget.addEventListener("dragleave"	, dragleave	, false);
		uploadTarget.addEventListener("dragover"	, dragover	, false);
		uploadTarget.addEventListener("drop"		, drop		, false);
		
		function dragenter(e) {  
            e.stopPropagation();  
            e.preventDefault();
            $("#uploader").css("background","#000");
            $("#uploader").html("<img src='http://www.loadinfo.net/images/preview/18_clock_five_24.gif?1200916238' />");
            return false;  
        } 
		function dragover(e) {  
            e.stopPropagation();  
            e.preventDefault();
            return false;  
        }
		function dragleave(e) {  
            e.stopPropagation();  
            e.preventDefault(); 
            $("#uploader").css("background","black");
            $("#uploader").text("DROP FILE HERE");
            return false;  
        }
		function drop(e) {
		    e.stopPropagation();  
		    e.preventDefault();  
		  
		    var dt 		= e.dataTransfer;  
		    var files 	= dt.files;  
		    jQuery.each(files ,function(){
		    	var reader 	= new FileReader(); 
		    	reader.onload = function(e) { 
			    	$('#showUpload').append('FILE: ' + e.target.result + '<br /><br />');
			    };  
		    	reader.readAsText(this);
		    });
		    
		    return false;  
		}
		
		
	});
</script>


<div id="uploader" style="margin:auto;width:60px;height:60px;background:#000;color:#FFF;padding:100px;">DROP FILE HERE</div>


<div id="showUpload"></div>