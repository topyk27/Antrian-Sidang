var path = window.location.pathname; //jadinya /ptsp_tamu/informasi
var namanya = path.split("/"); // jadinya ["", "ptsp", "tamu"]
var host = window.location.hostname; //localhost
var dt_informasi;
$(document).ready(function(){
	dt_informasi = $("#dt_informasi").DataTable({
		
	});
});