var msg = new SpeechSynthesisUtterance();
var suara;
var myTimeout;
function myTimer()
{
    speechSynthesis.pause();
    speechSynthesis.resume();
    myTimeout = setTimeout(myTimer, 10000);
}
if(rsvc==false)
{
    setTimeout(() => {		
        suara = window.speechSynthesis.getVoices();		
        msg.voice = suara[11];	
        msg.lang = 'in-ID';
        msg.rate = 0.9;		
    }, 1000);
}
var path = window.location.pathname; //"/antrian_baru/jadwal/ruang/1"
var namanya = path.split("/"); //["", "antrian_baru", "jadwal", "ruang", "1"]
var ruang_sidang = namanya[namanya.length - 1]; //"1"
var dt_antrian;

function nama_ruang(ruang_sidang) {
    switch (ruang_sidang) {
        case 'ruang sidang i':
            ruang_sidang = 'ruang sidang 1';
            break;
        case 'ruang sidang ii':
            ruang_sidang = 'ruang sidang 2';
            break;
        case 'ruang sidang iii':
            ruang_sidang = 'ruang sidang 3';
            break;
        case 'ruang sidang iv':
            ruang_sidang = 'ruang sidang 4';
            break;
        case 'ruang sidang v':
            ruang_sidang = 'ruang sidang 5';
            break;
        case 'ruang sidang vi':
            ruang_sidang = 'ruang sidang 6';
            break;
        case 'ruang sidang vii':
            ruang_sidang = 'ruang sidang 7';
            break;
        case 'ruang sidang viii':
            ruang_sidang = 'ruang sidang 8';
            break;
        case 'ruang sidang ix':
            ruang_sidang = 'ruang sidang 9';
            break;
        case 'ruang sidang x':
            ruang_sidang = 'ruang sidang 10';
            break;
    }
    return ruang_sidang;
}

function panggil(id, no_antrian, perkara, penggugat, tergugat, ruang_sidang, ruang_sidang_id) {
    voice = "Indonesian Male";
    rate = 1;
    perkara = perkara.split("PA.");
    penggugat = penggugat.replace("<br />", " ");
    tergugat = tergugat.replace("<br />", " ");
    ruang_sidang = ruang_sidang.toLowerCase();
    ruang_sidang = nama_ruang(ruang_sidang);
    $.ajax({
        url: base_url+'jadwal/ubah_status',
        method: "POST",
        data: {
            id: id,
            ruang_sidang_id: ruang_sidang_id
        },
        dataType: "json",
        beforeSend: function() {
            $(".loader2").show();
        },
        success: function(data) {
            if (panggil_melalui == "pc") {
                if (data) {
                    if (tergugat) {
                        if(rsvc!=false)
                        {
                            responsiveVoice.speak("Dipanggil nomor antrian " + no_antrian + ". Nomor perkara " + perkara[0] + "P,A." + perkara[1] + ". " + penggugat + ". Dan " + tergugat + ". Silahkan ke " + ruang_sidang, voice, {
                                rate: rate,
                                onstart: function() {
                                    $(".loader2").show();
                                },
                                onend: function() {
                                    $(".loader2").hide();
                                }									
                            });
                        }
                        else
                        {
                            $(".loader2").show();
                            myTimeout = setTimeout(myTimer, 10000);
                            msg.text = "Dipanggil nomor antrian " + no_antrian + ". Nomor perkara " + perkara[0] + "P,A." + perkara[1] + ". " + penggugat + ". Dan " + tergugat + ". Silahkan ke " + ruang_sidang;									
                            msg.onend = function()
                            {
                                clearTimeout(myTimeout);
                                $(".loader2").hide();
                            }
                            speechSynthesis.speak(msg);
                        }
                    } else {
                        if(rsvc!=false)
                        {
                            responsiveVoice.speak("Dipanggil nomor antrian " + no_antrian + ". Nomor perkara " + perkara[0] + "P,A." + perkara[1] + ". " + penggugat + ". Silahkan ke " + ruang_sidang, voice, {
                                rate: rate,
                                onend: function() {
                                    $(".loader2").hide();
                                }
                            });
                        }
                        else
                        {
                            $(".loader2").show();										
                            myTimeout = setTimeout(myTimer, 10000);
                            msg.text = "Dipanggil nomor antrian " + no_antrian + ". Nomor perkara " + perkara[0] + "P,A." + perkara[1] + ". " + penggugat + ". Silahkan ke " + ruang_sidang;									
                            msg.onend = function()
                            {
                                clearTimeout(myTimeout);
                                $(".loader2").hide();
                            }
                            speechSynthesis.speak(msg);
                        }
                    }
                    dt_antrian.ajax.reload(null, false);
                }
            } else {
                if (tergugat) {
                    insert_panggilan("Dipanggil nomor antrian " + no_antrian + ". Nomor perkara " + perkara[0] + "P,A." + perkara[1] + ". " + penggugat + ". Dan " + tergugat + ". Silahkan ke " + ruang_sidang, no_antrian, ruang_sidang);
                } else {
                    insert_panggilan("Dipanggil nomor antrian " + no_antrian + ". Nomor perkara " + perkara[0] + "P,A." + perkara[1] + ". " + penggugat + ". Silahkan ke " + ruang_sidang, no_antrian, ruang_sidang);
                }
            }
            // $(".loader2").hide();
        },
        error: function(err) {
            console.log(err);
            $(".loader2").hide();
            $("#responModalIcon").text('error');
            $("#responModalTitle").text('Error');
            $("#responModalBody").html("<p>Ada kesalahan, harap refresh halaman</p>");
            $("#responModal").modal({
                backdrop: 'static',
                keyboard: false
            });
            setTimeout(function() {
                $("#responModal").modal('hide');
            }, 3000);
        }
    });
}

function insert_panggilan(text, no_antrian, ruang_sidang) {
    $.ajax({
        url: base_url+'jadwal/insert_panggilan',
        method: "POST",
        data: {
            text: text,
            no_antrian: no_antrian,
            ruang_sidang: ruang_sidang
        },
        dataType: "TEXT",
        beforeSend: function() {
            $(".loader2").show();
        },
        success: function(data) {

            if (data != 0) {
                cek_panggilan(data);
            }
        },
        error: function(err) {
            console.log(err);
            $(".loader2").hide();
            $("#responModalIcon").text('error');
            $("#responModalTitle").text('Error');
            $("#responModalBody").html("<p>Ada kesalahan, harap refresh halaman</p>");
            $("#responModal").modal({
                backdrop: 'static',
                keyboard: false
            });
            setTimeout(function() {
                $("#responModal").modal('hide');
            }, 3000);
        }
    });
}

function cek_panggilan(id) {
    $.ajax({
        url: base_url+'jadwal/cek_panggilan',
        method: "POST",
        data: {
            id,
            id
        },
        dataType: "TEXT",
        beforeSend: function() {
            $(".loader2").show();
        },
        success: function(data) {

            if (data == "sudah") {
                $(".loader2").hide();
            } else {
                setTimeout(function() {
                    cek_panggilan(id);
                }, 3000);
            }
        },
        error: function(err) {
            console.log(err);
            $(".loader2").hide();
            $("#responModalIcon").text('error');
            $("#responModalTitle").text('Error');
            $("#responModalBody").html("<p>Ada kesalahan, harap refresh halaman</p>");
            $("#responModal").modal({
                backdrop: 'static',
                keyboard: false
            });
            setTimeout(function() {
                $("#responModal").modal('hide');
            }, 3000);
        }
    });
}


//fix
// function panggil_saksi(penggugat, tergugat, ruang_sidang, no_antrian) {
//     voice = "Indonesian Male";
//     rate = 1;
//     penggugat = penggugat.replace("<br />", " ");
//     tergugat = tergugat.replace("<br />", " ");
//     ruang_sidang = ruang_sidang.toLowerCase();
//     ruang_sidang = nama_ruang(ruang_sidang);
//     if (panggil_melalui == "pc") {
//         if (tergugat) {
//             if(rsvc!=false)
//             {
//                 responsiveVoice.speak("Dipanggil saksi-saksi dari " + penggugat + ". Atau " + tergugat + ". Silahkan ke " + ruang_sidang, voice, {
//                     rate: rate,
//                     onstart: function() {
//                         $(".loader2").show();
//                     },
//                     onend: function() {
//                         $(".loader2").hide();
//                     }
//                 });
//             }
//             else
//             {
//                 $(".loader2").show();
//                 myTimeout = setTimeout(myTimer, 10000);
//                 msg.text = "Dipanggil saksi-saksi dari " + penggugat + ". Atau " + tergugat + ". Silahkan ke " + ruang_sidang;						
//                 msg.onend = function()
//                 {
//                     clearTimeout(myTimeout);
//                     $(".loader2").hide();
//                 }
//                 speechSynthesis.speak(msg);
//             }
//         } else {
//             if(rsvc!=false)
//             {
//                 responsiveVoice.speak("Dipanggil saksi-saksi dari " + penggugat + ". Silahkan ke " + ruang_sidang, voice, {
//                     rate: rate,
//                     onstart: function() {
//                         $(".loader2").show();
//                     },
//                     onend: function() {
//                         $(".loader2").hide();
//                     }
//                 });
//             }
//             else
//             {
//                 $(".loader2").show();										
//                 myTimeout = setTimeout(myTimer, 10000);
//                 msg.text = "Dipanggil saksi-saksi dari " + penggugat + ". Silahkan ke " + ruang_sidang;						
//                 msg.onend = function()
//                 {
//                     clearTimeout(myTimeout);
//                     $(".loader2").hide();
//                 }
//                 speechSynthesis.speak(msg);
//             }
//         }
//     } else {
//         if (tergugat) {
//             insert_panggilan("Dipanggil saksi-saksi dari " + penggugat + ". Atau " + tergugat + ". Silahkan ke " + ruang_sidang, no_antrian, ruang_sidang);
//         } else {
//             insert_panggilan("Dipanggil saksi-saksi dari " + penggugat + ". Silahkan ke " + ruang_sidang, no_antrian, ruang_sidang);
//         }
//     }
// }
//end fix

//coba tombol saksinya dipisah
function panggil_saksi(penggugat, tergugat, ruang_sidang, no_antrian) {
    voice = "Indonesian Male";
    rate = 1;
    penggugat = penggugat.replace("<br />", " ");
    tergugat = tergugat.replace("<br />", " ");
    ruang_sidang = ruang_sidang.toLowerCase();
    ruang_sidang = nama_ruang(ruang_sidang);
    if (panggil_melalui == "pc") {
        if (tergugat) {
            if(rsvc!=false)
            {
                if(saksiPisah)
                {
                    if(penggugat == 'skip')
                    {
                        responsiveVoice.speak("Dipanggil saksi-saksi dari " + tergugat + ". Silahkan ke " + ruang_sidang, voice, {
                            rate: rate,
                            onstart: function() {
                                $(".loader2").show();
                            },
                            onend: function() {
                                $(".loader2").hide();
                            }
                        });
                    }
                    else
                    {
                        responsiveVoice.speak("Dipanggil saksi-saksi dari " + penggugat + ". Silahkan ke " + ruang_sidang, voice, {
                            rate: rate,
                            onstart: function() {
                                $(".loader2").show();
                            },
                            onend: function() {
                                $(".loader2").hide();
                            }
                        });
                    }
                }
                else
                {
                    responsiveVoice.speak("Dipanggil saksi-saksi dari " + penggugat + ". Atau " + tergugat + ". Silahkan ke " + ruang_sidang, voice, {
                        rate: rate,
                        onstart: function() {
                            $(".loader2").show();
                        },
                        onend: function() {
                            $(".loader2").hide();
                        }
                    });
                }
            }
            else
            {
                $(".loader2").show();
                myTimeout = setTimeout(myTimer, 10000);
                if(!saksiPisah)
                {
                    msg.text = "Dipanggil saksi-saksi dari " + penggugat + ". Atau " + tergugat + ". Silahkan ke " + ruang_sidang;
                }
                else
                {
                    if(penggugat == 'skip')
                    {
                        msg.text = "Dipanggil saksi-saksi dari " + tergugat + ". Silahkan ke " + ruang_sidang;
                    }
                    else
                    {
                        msg.text = "Dipanggil saksi-saksi dari " + penggugat + ". Silahkan ke " + ruang_sidang;
                    }
                }
                msg.onend = function()
                {
                    clearTimeout(myTimeout);
                    $(".loader2").hide();
                }
                speechSynthesis.speak(msg);
            }
        } else {
            if(rsvc!=false)
            {
                responsiveVoice.speak("Dipanggil saksi-saksi dari " + penggugat + ". Silahkan ke " + ruang_sidang, voice, {
                    rate: rate,
                    onstart: function() {
                        $(".loader2").show();
                    },
                    onend: function() {
                        $(".loader2").hide();
                    }
                });
            }
            else
            {
                $(".loader2").show();										
                myTimeout = setTimeout(myTimer, 10000);
                msg.text = "Dipanggil saksi-saksi dari " + penggugat + ". Silahkan ke " + ruang_sidang;						
                msg.onend = function()
                {
                    clearTimeout(myTimeout);
                    $(".loader2").hide();
                }
                speechSynthesis.speak(msg);
            }
        }
    } else {
        if (tergugat) {
            if(!saksiPisah)
            {
                insert_panggilan("Dipanggil saksi-saksi dari " + penggugat + ". Atau " + tergugat + ". Silahkan ke " + ruang_sidang, no_antrian, ruang_sidang);
            }
            else
            {
                if(penggugat=='skip')
                {
                    insert_panggilan("Dipanggil saksi-saksi dari " + tergugat + ". Silahkan ke " + ruang_sidang, no_antrian, ruang_sidang);
                }
                else
                {
                    insert_panggilan("Dipanggil saksi-saksi dari " + penggugat + ". Silahkan ke " + ruang_sidang, no_antrian, ruang_sidang);
                }
            }
        } else {
            insert_panggilan("Dipanggil saksi-saksi dari " + penggugat + ". Silahkan ke " + ruang_sidang, no_antrian, ruang_sidang);
        }
    }
}
//end coba

function hapusData(id) {
    $.ajax({
        url: base_url+'jadwal/hapus',
        method: "POST",
        data: {
            id: id
        },
        dataType: "json",
        beforeSend: function() {
            $(".loader2").show();
        },
        success: function(data) {
            $(".loader2").hide();
            if (data) {
                $("#responModalIcon").text('done');
                $("#responModalTitle").text('Berhasil');
                $("#responModalBody").html("<p>Data berhasil dihapus</p>");
            } else {
                $("#responModalIcon").text('close');
                $("#responModalTitle").text('Gagal');
                $("#responModalBody").html("<p>Data gagal dihapus, harap refresh halaman</p>");
            }
            dt_antrian.ajax.reload(null, false);
            $("#responModal").modal({
                backdrop: 'static',
                keyboard: false
            });
            setTimeout(function() {
                $("#responModal").modal('hide');
            }, 3000);
        },
        error: function(err) {
            console.log(err);
            $(".loader2").hide();
            $("#responModalIcon").text('error');
            $("#responModalTitle").text('Error');
            $("#responModalBody").html("<p>Ada kesalahan, harap refresh halaman</p>");
            $("#responModal").modal({
                backdrop: 'static',
                keyboard: false
            });
            setTimeout(function() {
                $("#responModal").modal('hide');
            }, 3000);
        }
    });
}

function ubahData(id) {
    var ruang_sidang_id = $("select[name='ruang_sidang_id']").val();
    // console.log(ruang_sidang_id);
    $.ajax({
        url: base_url+'jadwal/ubah',
        method: "POST",
        data: {
            id: id,
            ruang_sidang_id: ruang_sidang_id
        },
        dataType: "json",
        beforeSend: function() {
            $(".loader2").show();
        },
        success: function(data) {
            $(".loader2").hide();
            if (data.success) {
                $("#responModalIcon").text('done');
                $("#responModalTitle").text('Berhasil');
                $("#responModalBody").html("<p>Data berhasil diubah</p>");
            } else {
                $("#responModalIcon").text('close');
                $("#responModalTitle").text('Gagal');
                $("#responModalBody").html("<p>Data gagal diubah</p>");
            }
            dt_antrian.ajax.reload(null, false);
            $("#responModal").modal({
                backdrop: 'static',
                keyboard: false
            });
            setTimeout(function() {
                $("#responModal").modal('hide');
            }, 3000);
        },
        error: function(err) {
            console.log(err);
            $(".loader2").hide();
            $("#responModalIcon").text('error');
            $("#responModalTitle").text('Error');
            $("#responModalBody").html("<p>Ada kesalahan, harap refresh halaman</p>");
            $("#responModal").modal({
                backdrop: 'static',
                keyboard: false
            });
            setTimeout(function() {
                $("#responModal").modal('hide');
            }, 3000);
        }
    });
}

$(document).ready(function() {		
    if(!saksiPisah)	
    {
        dt_antrian = $("#dt_antrian").DataTable({
            order: [
                [2, "asc"]
            ],
            ajax: {
                url: base_url+'jadwal/getby/' + ruang_sidang + "/" + jadwal_sidang,
                // url: svr+"jadwal/getby/"+ruang_sidang+"/"+jadwal_sidang,
                dataSrc: "data_jadwal",
            },
            columns: [{
                    data: "id"
                },
                {
                    data: null,
                    sortable: false,
                    render: function(data, type, row, meta) {
                        return "<a href='#' class='btn btn-primary panggilBtnRow'><i class='fas fa-bullhorn'></i> Pihak</a><a href='#' class='btn btn-secondary panggil_saksiBtnRow'><i class='fas fa-bullhorn'></i> Saksi</a>";
                    }
                },
                {
                    data: "no_antrian"
                },
                {
                    data: "perkara"
                },
                {
                    data: "penggugat"
                },
                {
                    data: "tergugat",
                    render: function(data,type,row,meta){ return (data==null || data=="null") ? "" : data;}
                },
                {
                    data: "agenda"
                },
                {
                    data: "status"
                },
                {
                    data: "ruang_sidang_id"
                },
                {
                    data: "ruang_sidang"
                },
                {
                    data: null,
                    sortable: false,
                    render: function(data, type, row, meta) {
                        return "<a href='#' class='btn btn-warning ubahBtnRow'><i class='fas fa-edit'></i>Ubah</a>";
                    }
                },
                {
                    data: null,
                    sortable: false,
                    render: function(data, type, row, meta) {
                        return "<a href='#' class='btn btn-danger deleteButton'><i class='fas fa-trash'></i>Hapus</a>";
                    }
                },
                {
                    data: "pihak_hadir"
                }
            ],
            columnDefs: [{
                    targets: [0, 7, 8, 9,12],
                    visible: false,
                },
                {
                    responsivePriority: 1,
                    targets: [1, 2, 3],
                },
                {
                    targets: [4, 5, 6],
                    orderable: false,
                }
            ],
            createdRow: function(row, data, index) {
                if (data['status'] == "masuk") {
                    $(row).addClass('bg-lime');
                }
                if(data['pihak_hadir'] == 'p')
                {
                    $('td:eq(3)',$(row)).addClass('bg-primary');
                }
                else if(data['pihak_hadir'] == 't')
                {
                    $('td:eq(4)',$(row)).addClass('bg-primary');
                }
                else
                {
                    $('td:eq(3)',$(row)).addClass('bg-primary');
                    $('td:eq(4)',$(row)).addClass('bg-primary');
                }
            },
            responsive: true,
            autoWidth: false,
        });
    }
    else
    {
        dt_antrian = $("#dt_antrian").DataTable({
            order: [
                [2, "asc"]
            ],
            ajax: {
                url: base_url+'jadwal/getby/' + ruang_sidang + "/" + jadwal_sidang,
                // url: svr+"jadwal/getby/"+ruang_sidang+"/"+jadwal_sidang,
                dataSrc: "data_jadwal",
            },
            columns: [{
                    data: "id"
                },
                {
                    data: null,
                    sortable: false,
                    render: function(data, type, row, meta) {
                        let btnTergugat = "<a href='#' class='btn btn-secondary panggil_saksiBtnRowT'><i class='fas fa-bullhorn'></i> Saksi Tergugat</a>";
                        if(row['tergugat']==null || row['tergugat']=='null')
                        {
                            btnTergugat = '';
                        }
                        // console.log('ini btn tergugat ' + btnTergugat);
                        // console.log('ini btn row tergugat ' + row['tergugat']);
                        return "<a href='#' class='btn btn-primary mb-2 panggilBtnRow'><i class='fas fa-bullhorn'></i> Pihak</a><br><a href='#' class='btn btn-secondary mb-2 panggil_saksiBtnRowP'><i class='fas fa-bullhorn'></i> Saksi Penggugat</a><br>";
                    }
                },
                {
                    data: "no_antrian"
                },
                {
                    data: "perkara"
                },
                {
                    data: "penggugat"
                },
                {
                    data: "tergugat",
                    render: function(data,type,row,meta){ return (data==null || data=="null") ? "" : data;}
                },
                {
                    data: "agenda"
                },
                {
                    data: "status"
                },
                {
                    data: "ruang_sidang_id"
                },
                {
                    data: "ruang_sidang"
                },
                {
                    data: null,
                    sortable: false,
                    render: function(data, type, row, meta) {
                        return "<a href='#' class='btn btn-warning ubahBtnRow'><i class='fas fa-edit'></i>Ubah</a>";
                    }
                },
                {
                    data: null,
                    sortable: false,
                    render: function(data, type, row, meta) {
                        return "<a href='#' class='btn btn-danger deleteButton'><i class='fas fa-trash'></i>Hapus</a>";
                    }
                },
                {
                    data: "pihak_hadir"
                }
            ],
            columnDefs: [{
                    targets: [0, 7, 8, 9,12],
                    visible: false,
                },
                {
                    responsivePriority: 1,
                    targets: [1, 2, 3],
                },
                {
                    targets: [4, 5, 6],
                    orderable: false,
                }
            ],
            createdRow: function(row, data, index) {
                
                if (data['status'] == "masuk") {
                    $(row).addClass('bg-lime');
                }
                if(data['pihak_hadir'] == 'p')
                {
                    $('td:eq(3)',$(row)).addClass('bg-primary');
                }
                else if(data['pihak_hadir'] == 't')
                {
                    $('td:eq(4)',$(row)).addClass('bg-primary');
                }
                else
                {
                    $('td:eq(3)',$(row)).addClass('bg-primary');
                    $('td:eq(4)',$(row)).addClass('bg-primary');
                }
                if(data['tergugat'] != "")
                {
                    $('td:eq(0)',$(row)).append("<a href='#' class='btn btn-warning panggil_saksiBtnRowT'><i class='fas fa-bullhorn'></i> Saksi Tergugat</a>");
                }
            },
            responsive: true,
            autoWidth: false,
        });
    }

    setInterval(function() {
        dt_antrian.ajax.reload(null, false);
    }, 30000);

    // ubah antrian
    $("#dt_antrian tbody").on("click", "tr .ubahBtnRow", function(e) {
        e.preventDefault();
        var currentRow = $(this).closest('li').length ? $(this).closest('li') : $(this).closest('tr');
        var data = $("#dt_antrian").DataTable().row(currentRow).data();
        $("#ubahTitle").html("Ubah ruang sidang nomor perkara " + data['perkara']);
        $("select[name='ruang_sidang_id']").val(data['ruang_sidang_id']).change();
        $("#ubahModal").find("#ubahButton").attr("onclick", "ubahData(" + data['id'] + ")");
        $("#ubahModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    });
    // end ubah

    // hapus antrian
    $("#dt_antrian tbody").on("click", "tr .deleteButton", function(e) {
        e.preventDefault();

        var currentRow = $(this).closest('li').length ? $(this).closest('li') : $(this).closest('tr');
        var data = $("#dt_antrian").DataTable().row(currentRow).data();
        $("#hapusModal").find(".modal-title").text("Hapus antrian nomor perkara " + data['perkara'] + "?");
        $("#hapusModal").find(".modal-body").html("<p>Nomor perkara akan muncul kembali pada menu ambil antrian untuk pihak</p>");
        $("#hapusModal").find("#deleteButton").attr("onclick", "hapusData(" + data['id'] + ")");
        $("#hapusModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    });
    // end hapus antrian

    // panggil pihak
    $("#dt_antrian tbody").on("click", "tr .panggilBtnRow", function(e) {
        e.preventDefault();
        var currentRow = $(this).closest('li').length ? $(this).closest('li') : $(this).closest('tr');
        var data = $("#dt_antrian").DataTable().row(currentRow).data();
        panggil(data['id'], data['no_antrian'], data['perkara'], data['penggugat'], data['tergugat'], data['ruang_sidang'], data['ruang_sidang_id']);
    });
    // end panggil pihak

    // panggil saksi
    if(!saksiPisah)
    {
        $("#dt_antrian tbody").on("click", "tr .panggil_saksiBtnRow", function(e) {
            e.preventDefault();
            var currentRow = $(this).closest('li').length ? $(this).closest('li') : $(this).closest('tr');
            var data = $("#dt_antrian").DataTable().row(currentRow).data();
            panggil_saksi(data['penggugat'], data['tergugat'], data['ruang_sidang'], data['no_antrian']);
        });
    }
    else
    {
        $("#dt_antrian tbody").on("click", "tr .panggil_saksiBtnRowP", function(e) {
            e.preventDefault();
            var currentRow = $(this).closest('li').length ? $(this).closest('li') : $(this).closest('tr');
            var data = $("#dt_antrian").DataTable().row(currentRow).data();
            panggil_saksi(data['penggugat'], 'skip', data['ruang_sidang'], data['no_antrian']);
        });
        $("#dt_antrian tbody").on("click", "tr .panggil_saksiBtnRowT", function(e) {
            e.preventDefault();
            var currentRow = $(this).closest('li').length ? $(this).closest('li') : $(this).closest('tr');
            var data = $("#dt_antrian").DataTable().row(currentRow).data();
            panggil_saksi('skip', data['tergugat'], data['ruang_sidang'], data['no_antrian']);
        });
    }
    // end panggil saksi

    // panggil security
    $("#btn_security").click(function() {
        voice = "Indonesian Male";
        rate = 1;
        
        ruang = ruang.toLowerCase();
        ruang = nama_ruang(ruang);
        if (panggil_melalui == "pc") {
            if(rsvc!=false)
            {
                responsiveVoice.speak(panggilan_security, voice, {
                    rate: rate,
                    onstart: function() {
                        $(".loader2").show();
                    },
                    onend: function() {
                        $(".loader2").hide();
                    }
                });
            }
            else
            {
                $(".loader2").show();
                msg.text = panggilan_security;
                msg.onend = function(e)
                {
                    clearTimeout(myTimeout);
                    $(".loader2").hide();
                }						
                speechSynthesis.speak(msg);
            }
        } else {
            insert_panggilan(panggilan_security + " ke " + ruang, "security", nama_ruangan);
        }
    });
    // end panggil security

    // buka sidang
    $("#btn_buka_sidang").click(function() {
        voice = "Indonesian Male";
        rate = 1;
        if (panggil_melalui == "pc") {
            if(rsvc!=false)
            {
                responsiveVoice.speak(panggilan_sidang, voice, {
                    rate: rate,
                    onstart: function() {
                        $(".loader2").show();
                    },
                    onend: function() {
                        $(".loader2").hide();
                    }
                });
            }
            else
            {
                $(".loader2").show();
                msg.text = panggilan_sidang;	
                msg.onend = function(e)
                {
                    clearTimeout(myTimeout);
                    $(".loader2").hide();
                }						
                speechSynthesis.speak(msg);
            }
        } else {
            insert_panggilan(panggilan_sidang, "buka sidang", nama_ruangan);
        }
    });
    // end buka sidang

    // pengumuman
    $("#btn_pengumuman").click(function() {
        $("#pengumumanModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    });
    $("#modal_pengumuman").click(function(){
        voice = "Indonesian Male";
        rate = 1;
        isi = $("#text_pengumuman").val();
        if (panggil_melalui == "pc")
        {
            if(rsvc!=false)
            {
                responsiveVoice.speak(isi, voice, {
                    rate: rate,
                    onstart: function() {
                        $(".loader2").show();
                    },
                    onend: function() {
                        $(".loader2").hide();
                    }
                });
            }
            else
            {
                $(".loader2").show();
                msg.text = isi;
                msg.onend = function(e)
                {
                    clearTimeout(myTimeout);
                    $(".loader2").hide();
                }						
                speechSynthesis.speak(msg);
            }
        }
        else
        {
            insert_panggilan(isi, "pengumuman", nama_ruangan);
        }
    });
    // end pengumuman
});