$(document).ready(function(){
	link = window.location.href;
	last_char_link = link[link.length - 1];
	svr = null;
	if(last_char_link == "/")
	{
		svr = link.slice(0, -1);
	}
	else
	{
		svr = link;
	}
	$("form").submit(function(event){
		event.preventDefault();
		$.ajax({
			type: 'post',
			url: svr+"/insert",
			data: $(this).serialize(),
			beforeSend: function()
			{
				console.log("ini mau ngirim");
			},
			success: function(respon)
			{
				console.log("ini respon" + respon);
				if(respon="1")
				{
					console.log("berhasil tambah data informasi");
				}
				else
				{
					console.log("gagal tambah data informasi");
				}
			},
			error: function(jqXHR, exception)
			{
				console.log(jqXHR.status);
				console.log(exception);
			}
		});
	});
});