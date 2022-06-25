var dt_antrian;
function ambil(id,perkara,penggugat,tergugat,jadwal_sidang,agenda,ruang_sidang_id, ruang_sidang)
{
    $.ajax({
        url: base_url+'jadwal/insert_antrian',
        method: "POST",
        data: {perkara_id: id, perkara: perkara, penggugat: penggugat, tergugat: tergugat, jadwal_sidang: jadwal_sidang, agenda: agenda, ruang_sidang_id: ruang_sidang_id, ruang_sidang: ruang_sidang},
        dataType: 'json',
        beforeSend: function()
        {
            $(".loader2").show();
        },
        success: function(data)
        {
            $(".loader2").hide();
            if(printable=="enable")
            {
                if(data.success)
                {
                    var process_cetak = cetak(data.no_antrian,perkara,jadwal_sidang,ruang_sidang);
                    if(process_cetak=="ok")
                    {
                        dt_antrian.ajax.reload();
                        $("#responSimbol").text('done');
                        $("#modal_title").html('Nomor Antrian '+ data.no_antrian + '<br>di ' + data.ruang_sidang);
                        $("#modal_body").text('Silahkan menunggu nomor antrian anda dipanggil');
                        $("#modal_footer").hide();
                        $("#ambil_modal").modal({backdrop: 'static', keyboard: false});
                        setTimeout(function(){$("#ambil_modal").modal('hide');},5000);
                    }
                }
                else
                {
                    alert('ada kesalahan, harap refresh halaman');
                }
            }
            else
            {
                if(data.success)
                {
                    dt_antrian.ajax.reload();
                    $("#responSimbol").text('done');
                    $("#modal_title").html('Nomor Antrian '+ data.no_antrian + '<br>di ' + data.ruang_sidang);
                    $("#modal_body").text('Silahkan menunggu nomor antrian anda dipanggil');
                    $("#modal_footer").hide();
                    $("#ambil_modal").modal({backdrop: 'static', keyboard: false});
                    setTimeout(function(){$("#ambil_modal").modal('hide');},5000);
                }
                else
                {
                    alert('ada kesalahan, harap refresh halaman');
                }
            }
        },
        error: function(err)
        {
            $(".loader2").hide();
            alert('ada yang salah');
            console.log(err);
        }
    });
}

function cetak(no_antrian,perkara,jadwal,ruang) {
    jadwal = jadwal.split("-");
    jadwal = jadwal[2]+"-"+jadwal[1]+"-"+jadwal[0];
    var a;
    $.ajax({
        url: base_url+'jadwal/cetak',
        data: {no_antrian: no_antrian, perkara: perkara, jadwal: jadwal, ruang: ruang},
        method: "JSON",
        dataType: "TEXT",
        beforeSend: function()
        {
            $(".loader2").show();
        },
        success: function(respon)
        {
            if(respon.success==1)
            {
                a ="ok";
            }
            else
            {
                a = "ok";
                alert("Gagal cetak antrian");
            }
            $(".loader2").hide();
            return a;
        },
        error: function(err)
        {
            console.log(err);
            $(".loader2").hide();
            alert('ada yang salah, harap periksa jaringan');
            return a;
        }
    });
}
$(document).ready(function(){
    $("#sidebar_ambil_antrian").addClass("active");
    dt_antrian = $("#dt_antrian").DataTable({
        order: [[1,"asc"]],
        ajax: {
            url: base_url+'jadwal/ambil_antrian_hari_ini',
            dataSrc: "data_jadwal",
        },
        columns: [
        {data:"id"},
        {data:"perkara"},
        {data:"penggugat"},
        {data:"tergugat"},
        {data:"ruang"},
        {data:"ruang_sidang_id"},
        {data:"tanggal_sidang"},
        {data:"agenda"},
        ],
        columnDefs: [
        {
            targets: [0,5,6,7],
            visible: false,
        },
        {
            responsivePriority: 1,
            targets: [1,2],
        }
        ],
        responsive: true,
        autoWidth: false,
    });

    $("#dt_antrian tbody").on('click','tr', function(e){
        e.preventDefault();
        var currentRow = $(this).closest('li').length ? $(this).closest('li') : $(this).closest('tr');
        var data = $("#dt_antrian").DataTable().row(currentRow).data();
        $("#modal_title").html('Ambil antrian');
        $("#ambil_modal").modal({backdrop: 'static', keyboard: false});
        $("#modal_footer").show();
        if(data['tergugat'])
        {
        $("#ambil_modal").find('.modal-body').html("<p>Ambil antrian nomor perkara "+data['perkara']+"<br>Penggugat : "+data['penggugat']+"<br>Tergugat : "+data['tergugat']);
        }
        else
        {
        $("#ambil_modal").find('.modal-body').html("<p>Ambil antrian nomor perkara "+data['perkara']+"<br>Penggugat : "+data['penggugat']);
        }
        $("#ambil_modal").find("#ambil_button").attr("onclick", "ambil("+data['id']+",'"+data['perkara']+"','"+data['penggugat']+"','"+data['tergugat']+"','"+data['tanggal_sidang']+"','"+data['agenda']+"',"+data['ruang_sidang_id']+",'"+data['ruang']+"')");
    });

    setInterval(function(){
        dt_antrian.ajax.reload(null,false);
    },30000);
});