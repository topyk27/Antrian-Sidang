$.ajax({
    url: "https://raw.githubusercontent.com/topyk27/Antrian-Sidang/main/asset/mine/token/token.json",
    method: "GET",
    dataType: "JSON",
    beforeSend: function()
    {
        $(".loader2").show();
    },
    success: function(data)
    {
        try{
            if(nama_pa==data[nama_pa_pendek][0].nama_pa && nama_pa_pendek==data[nama_pa_pendek][0].nama_pa_pendek && token==data[nama_pa_pendek][0].token)
            {
                
            }
            else
            {
                location.replace(base_url+'aktivasi');
            }
        }
        catch(err)
        {
            location.replace(base_url+'aktivasi');
        }
        $(".loader2").hide();
    },
    error: function(err)
    {
        location.replace(base_url+'aktivasi');
    }
});