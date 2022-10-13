var dt_antrian;
let isMobile = false;
if (
	/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(
		navigator.userAgent
	) ||
	/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(
		navigator.userAgent.substr(0, 4)
	)
) {
	isMobile = true;
}
function ambil(
	id,
	perkara,
	penggugat,
	tergugat,
	jadwal_sidang,
	agenda,
	ruang_sidang_id,
	ruang_sidang
) {
	setTimeout(() => {
		$.ajax({
			url: base_url + "jadwal/insert_antrian",
			method: "POST",
			data: {
				perkara_id: id,
				perkara: perkara,
				penggugat: penggugat,
				tergugat: tergugat,
				jadwal_sidang: jadwal_sidang,
				agenda: agenda,
				ruang_sidang_id: ruang_sidang_id,
				ruang_sidang: ruang_sidang,
			},
			dataType: "json",
			beforeSend: function () {
				$(".loader2").show();
			},
			success: function (data) {
				$(".loader2").hide();
				if (isMobile) {					
					$("#responSimbol").text("done");
					$("#modal_title").html(
						"Nomor Antrian " + data.no_antrian + "<br>di " + data.ruang_sidang
					);
					$("#modal_body").text(
						"Silahkan menunggu nomor antrian anda dipanggil"
					);
					$("#modal_footer").hide();
					// $("#ambil_modal").modal({backdrop: 'static', keyboard: false});
					$("#ambil_modal").modal("show");
                    setTimeout(function () {
                        let perkaraUnderScore = perkara.replaceAll('/','_');
                        location.replace(base_url+"jadwal/cetak_gambar/"+data.no_antrian+"/"+ruang_sidang+"/"+perkaraUnderScore);
                    }, 3000);
				} else {
					if (printable == "enable") {
						if (data.success) {
							cetak(data.no_antrian, perkara, jadwal_sidang, ruang_sidang);
							// console.log(data.no_antrian+'-'+perkara+'-'+jadwal_sidang+'-'+ruang_sidang);
							// var process_cetak = cetak(data.no_antrian,perkara,jadwal_sidang,ruang_sidang);
							// console.log('ini proses cetak'+process_cetak);
							// if(process_cetak=="ok")
							// {
							//     dt_antrian.ajax.reload();
							//     $("#responSimbol").text('done');
							//     $("#modal_title").html('Nomor Antrian '+ data.no_antrian + '<br>di ' + data.ruang_sidang);
							//     $("#modal_body").text('Silahkan menunggu nomor antrian anda dipanggil');
							//     $("#modal_footer").hide();
							//     $("#ambil_modal").modal({backdrop: 'static', keyboard: false});
							//     setTimeout(function(){$("#ambil_modal").modal('hide');},5000);
							// }
						} else {
							alert("ada kesalahan, harap refresh halaman");
						}
					} else {
						if (data.success) {
							dt_antrian.ajax.reload();
							$("#responSimbol").text("done");
							$("#modal_title").html(
								"Nomor Antrian " +
									data.no_antrian +
									"<br>di " +
									data.ruang_sidang
							);
							$("#modal_body").text(
								"Silahkan menunggu nomor antrian anda dipanggil"
							);
							$("#modal_footer").hide();
							// $("#ambil_modal").modal({backdrop: 'static', keyboard: false});
							$("#ambil_modal").modal("show");
							setTimeout(function () {
								$("#ambil_modal").modal("hide");
							}, 5000);
						} else {
							alert("ada kesalahan, harap refresh halaman");
						}
					}
				}
			},
			error: function (err) {
				$(".loader2").hide();
				alert("ada yang salah");
				console.log(err);
			},
		});
	}, 1000);
}

function cetak(no_antrian, perkara, jadwal, ruang) {
	jadwal = jadwal.split("-");
	jadwal = jadwal[2] + "-" + jadwal[1] + "-" + jadwal[0];

	$.ajax({
		url: base_url + "jadwal/cetak",
		data: {
			no_antrian: no_antrian,
			perkara: perkara,
			jadwal: jadwal,
			ruang: ruang,
		},
		method: "POST",
		dataType: "JSON",
		beforeSend: function () {
			// $("#ambil_modal").modal('hide');
			$(".loader2").show();
		},
		success: function (respon) {
			if (respon.success == 1) {
				dt_antrian.ajax.reload();
				$("#responSimbol").text("done");
				$("#modal_title").html(
					"Nomor Antrian " + no_antrian + "<br>di " + ruang
				);
				$("#modal_body").text("Silahkan menunggu nomor antrian anda dipanggil");
				$("#modal_footer").hide();
				// $("#ambil_modal").modal({backdrop: 'static', keyboard: false});
				$("#ambil_modal").modal("show");
				setTimeout(function () {
					$("#ambil_modal").modal("hide");
				}, 5000);
			} else {
				alert("Gagal cetak antrian");
			}
			$(".loader2").hide();
		},
		error: function (err) {
			console.log(err);
			$(".loader2").hide();
			alert("ada yang salah, harap periksa jaringan");
		},
	});
}
$(document).ready(function () {
	$("#sidebar_ambil_antrian").addClass("active");
	dt_antrian = $("#dt_antrian").DataTable({
		order: [[1, "asc"]],
		ajax: {
			url: base_url + "jadwal/ambil_antrian_hari_ini",
			dataSrc: "data_jadwal",
		},
		columns: [
			{ data: "id" },
			{ data: "perkara" },
			{ data: "penggugat" },
			{
				data: "tergugat",
				render: function (data, type, row, meta) {
					return data == null ? "" : data;
				},
			},
			{ data: "ruang" },
			{ data: "ruang_sidang_id" },
			{ data: "tanggal_sidang" },
			{ data: "agenda" },
		],
		columnDefs: [
			{
				targets: [0, 5, 6, 7],
				visible: false,
			},
			{
				responsivePriority: 1,
				targets: [1, 2],
			},
		],
		responsive: true,
		autoWidth: false,
	});

	$("#dt_antrian tbody").on("click", "tr", function (e) {
		e.preventDefault();
		var currentRow = $(this).closest("li").length
			? $(this).closest("li")
			: $(this).closest("tr");
		var data = $("#dt_antrian").DataTable().row(currentRow).data();
		if (typeof data !== "undefined") {
			let id = data["id"];
			let perkara = data["perkara"];
			let p = data["penggugat"];
			p = replaceApos(p);
			let t = data["tergugat"];
			console.log(t + "ini data t");
			if (t == null) {
				t = "";
			} else {
				t = replaceApos(t);
			}
			let tgl = data["tanggal_sidang"];
			let agenda = data["agenda"];
			let ruang_id = data["ruang_sidang_id"];
			let ruang = data["ruang"];
			$("#modal_title").html("Ambil antrian");
			$("#ambil_modal").modal({ backdrop: "static", keyboard: false });
			$("#modal_footer").show();
			if (data["tergugat"]) {
				$("#ambil_modal")
					.find(".modal-body")
					.html(
						"<p>Ambil antrian nomor perkara " +
							data["perkara"] +
							"<br>Penggugat : " +
							data["penggugat"] +
							"<br>Tergugat : " +
							data["tergugat"]
					);
			} else {
				$("#ambil_modal")
					.find(".modal-body")
					.html(
						"<p>Ambil antrian nomor perkara " +
							data["perkara"] +
							"<br>Penggugat : " +
							data["penggugat"]
					);
			}
			// $("#ambil_modal").find("#ambil_button").attr("onclick", "ambil("+data['id']+",'"+data['perkara']+"','"+data['penggugat']+"','"+data['tergugat']+"','"+data['tanggal_sidang']+"','"+data['agenda']+"',"+data['ruang_sidang_id']+",'"+data['ruang']+"')");
			$("#ambil_modal")
				.find("#ambil_button")
				.attr(
					"onclick",
					"ambil(" +
						id +
						",'" +
						perkara +
						"','" +
						p +
						"','" +
						t +
						"','" +
						tgl +
						"','" +
						agenda +
						"'," +
						ruang_id +
						",'" +
						ruang +
						"')"
				);
		} else {
			// alert('kosong');
		}
	});

	setInterval(function () {
		dt_antrian.ajax.reload(null, false);
	}, 30000);
});

const replaceApos = (text) => {
	try {
		return text.replaceAll(/'/g, "\\'");
	} catch (error) {
		return text;
	}
};
