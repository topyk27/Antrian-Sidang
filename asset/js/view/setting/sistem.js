$(document).ready(function(){
    $("#sidebar_setting").addClass("active");
    $("#sidebar_setting_sistem").addClass("active");

    $("#btnSecurityUbah").click(function(){
        $("#btnSecuritySimpan").show();
        $(this).hide();
        $("textarea[name='textsecurity']").attr("readonly",false);
    });
    $("#btnSecuritySimpan").click(function(){
        let data = $("textarea[name='textsecurity']").val();
        $.ajax({
            url: base_url+'setting/save_text/security',
            type: "POST",
            data: {data: data},
            dataType: "TEXT",
            success: function(respon)
            {
                if(respon>0)
                {
                    $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'>Data berhasil diubah</div>")
                    $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                }
                else
                {
                    $("#respon").html("<div class='alert alert-info' role='alert' id='responMsg'>Data tidak ada perubahan</div>")
                    $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                }
                $("#btnSecuritySimpan").hide();
                $("#btnSecurityUbah").show();
                $("textarea[name='textsecurity']").attr("readonly",true);
            },
            error: function(err)
            {
                console.log(err);
                $("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'>Data gagal diubah, mohon periksa jaringan internet anda.</div>")
                $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
            }
        });
    });

    $("#btnSidangUbah").click(function(){
        $("#btnSidangSimpan").show();
        $(this).hide();
        $("textarea[name='textbukasidang']").attr("readonly",false);
    });
    $("#btnSidangSimpan").click(function(){
        let data = $("textarea[name='textbukasidang']").val();
        $.ajax({
            url: base_url+'setting/save_text/sidang',
            method: "POST",
            data: {data: data},
            dataType: "TEXT",
            success: function(respon)
            {
                if(respon>0)
                {
                    $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'>Data berhasil diubah</div>")
                    $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                }
                else
                {
                    $("#respon").html("<div class='alert alert-info' role='alert' id='responMsg'>Data tidak ada perubahan</div>")
                    $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                }
                $("#btnSidangSimpan").hide();
                $("#btnSidangUbah").show();
                $("textarea[name='textbukasidang']").attr("readonly",true);
            },
            error: function(err)
            {
                console.log(err);
                $("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'>Data gagal diubah, mohon periksa jaringan internet anda.</div>")
                $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
            }
        });
    });
});