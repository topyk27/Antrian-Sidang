var dt_user;
function hapusData(id) {
    $.ajax({
        url: base_url+'setting/user_hapus',
        type: "POST",
        data: {id: id},
        dataType: "TEXT",
        beforeSend: function()
        {
            $(".loader2").show();
        },
        success: function(data)
        {
            $(".loader2").hide();
            if(data)
            {
                dt_user.ajax.reload(null,false);
                $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'><strong>Selamat</strong> Data berhasil dihapus</div>")
                $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
            }
            else
            {
                $("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'><strong>Maaf</strong> Data gagal dihapus</div>")
                $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
            }
        },
        error: function(err)
        {
            console.log(err);
            $(".loader2").hide();
            $("#respon").html("<div class='alert alert-danger' role='alert' id='responMsg'><strong>Error</strong> mohon periksa jaringan internet anda.</div>")
            $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});

        }
    });
}
$(document).ready(function(){
    $("#sidebar_setting").addClass("active");
    $("#sidebar_setting_user").addClass("active");
    dt_user = $("#dt_user").DataTable({
        ajax: {
            url: base_url+'setting/data_user',
            dataSrc: "user",
        },
        columns: [
        {data:'id'},
        {data: null, sortable: false, render: function(data,type,row, meta){
        return meta.row + meta.settings._iDisplayStart + 1;
        }},
        {data:'username'},
        {data:'nama'},
        {data:'ruangan'},
        {data: null, sortable: false, render: function(data,type,row,meta){
            return "<a href="+base_url+'setting/user_ubah/'+row['id']+" class='btn btn-warning'><i class='fas fa-edit'></i>Ubah</a>";
        }},
        {data: null, sortable: false, render: function(data,type,row,meta){
            return "<a href='#' class='btn btn-danger deleteButton'><i class='fas fa-trash'></i>Hapus</a>";
        }}
        ],
        columnDefs : [
        {
            targets: [0],
            visible: false,
        },
        {
            targets: [1,2,4],
            responsivePriority: 1,
        }
        ],
        responsive : true,
        autoWidth: false,
    });

    $("#dt_user tbody").on('click', 'tr .deleteButton', function(e){
        e.preventDefault();
        var currentRow = $(this).closest('li').length ? $(this).closest('li') : $(this).closest('tr');
        var data = $("#dt_user").DataTable().row(currentRow).data();
        $('#hapusModal').modal('show');
        $('#hapusModal').find('.modal-body').html("<p>Apakah anda ingin menghapus data "+data['nama']+"? Data ini tidak bisa dipulihkan kembali.");
        $('#hapusModal').find('#deleteButton').attr("onclick", "hapusData("+data['id']+")");
    });
});