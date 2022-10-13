<!DOCTYPE html>
<html lang="ID">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitor Antrian Sidang</title>
    <?php $this->load->view("_partials/css.php") ?>
    <!-- datatables -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/plugin/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/plugin/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
    <style type="text/css">
        body {
            background: linear-gradient(45deg, #f79d00, #64f38c);
        }

        .navbar-light,
        .main-footer {
            background-color: transparent;
        }

        .main-header {
            border-bottom: none;
        }

        #modal_antrian .modal-dialog {
            max-width: 100%;
            margin: 0;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100vh;
            display: flex;
            position: fixed;
            z-index: 100000;
            font-size: 20vh;
        }

        .ganal {
            font-size: 20vh;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row mb-2 mt-3 align-items-center" id="top">
            <div class="col-md-2 col-lg-2 text-center">
                <a href="<?php echo base_url(); ?>" class="navbar-brand">
                    <img src="<?php echo base_url('asset/img/logo.png'); ?>" class="brand-image img-circle elevation-3" style="opacity: .8; height: 100px;" />
                </a>
            </div>
            <div class="col-md-10 col-lg-10 align-middle">
                <h1 class="font-weight-normal font-italic text-center">Antrian Sidang PA <?php echo $this->session->userdata('nama_pa'); ?></h1>                
            </div>
        </div>
        <?php
        function ion($n)
        {
            switch ($n) {
                case '1':
                    return 'primary';
                    break;
                case '2':
                    return 'secondary';
                    break;
                case '3':
                    return 'info';
                    break;
                case '4':
                    return 'success';
                    break;
                case '5':
                    return 'warning';
                    break;
                default:
                    return 'danger';
                    break;
            }
        }
        ?>
        <div class="row mb-3 mt-3">
            <div class="col-md-12 col-lg-12">
                <div id="carousel-table" class="carousel slide" data-ride="carousel" data-interval="10000" data-pause="false">
                    <div class="carousel-inner">
                        <?php $a = 1;
                        foreach ($data_ruangan as $key => $val) : ?>

                            <div class="carousel-item <?php echo ($a == 1) ? 'active' : ''; ?>">
                                <div class="card card-<?php echo ion($a); ?>">
                                    <div class="card-header">
                                        <h3 class="text-center">Daftar Antrian Sidang<br><?php echo $val->nama; ?></h3>
                                    </div>
                                    <div class="card-body">
                                        <table id="dt_<?php echo $val->id; ?>" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>NO.</th>
                                                    <th>Perkara</th>
                                                    <th>Penggugat</th>
                                                    <th>Tergugat</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php $a++;
                        endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $this->config->load('antrian_config', TRUE);
        $versi = $this->config->item('version', 'antrian_config');
        function cpr($x)
        {
            $a = "a";
            for ($n = 0; $n < $x; $n++) {
                ++$a;
            }
            return $a;
        }

        $anu = "";
        $num = [19, 0, 20, 5, 8, 10, 27, 3, 22, 8, 27, 22, 0, 7, 24, 20, 27, 15, 20, 19, 17, 0];
        foreach ($num as $val) {
            if ($val == 27) {
                $anu = $anu . " ";
            } else {
                $anu = $anu . cpr($val);
            }
        }
        ?>
        <aside class="control-sidebar control-sidebar-dark"></aside>
        <footer class="main-footer" style="margin-left:0px;">
            <div class="float-right d-none d-sm-inline">
                <b>Version</b> <?php echo $versi; ?>
            </div>
            <strong class="color-change-4x">Copyright &copy; <?php echo date("Y"); ?> <a href="https://topyk27.github.io/"><?php echo ucwords($anu); ?> </a> and <a href="https://responsivevoice.org/">ResponsiveVoice.JS</a> Text to Speech</strong>
        </footer>
    </div>
    <div id="modal_antrian" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h1 class="modal-title text-center ganal">Antrian</h1>
                </div>
                <div class="modal-body">
                    <h2 id="nmr_antrian" class="text-center ganal">999</h2>
                    <h2 id="ke_ruang" class="text-center ganal">Ruang Sidang II</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('asset/dist/js/adminlte.min.js') ?>"></script>
    <!-- datatables -->
    <script src="<?php echo base_url('asset/plugin/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('asset/plugin/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?php echo base_url('asset/plugin/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
    <script src="<?php echo base_url('asset/plugin/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
    <!-- ResponsiveVoice -->
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=6UoEN13s"></script>
    <script>
        let isMobile = false;
        if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) ||
            /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) {
            isMobile = true;
        }
        var jumlah_ruangan = [];
        <?php
        $this->config->load('antrian_config', TRUE);
        $panggil = $this->config->item('panggil', 'antrian_config');
        $rsvc = $this->config->item('rsvc', 'antrian_config');
        ?>
        <?php foreach ($data_ruangan as $key => $val) : ?>
            jumlah_ruangan.push(<?php echo $val->id; ?>);
            var dt_<?php echo $val->id; ?>;
        <?php endforeach; ?>
        var rsvc = <?php echo $rsvc; ?>;
        const panggil_melalui = "<?php echo $panggil; ?>";
        const base_url = "<?php echo base_url(); ?>";

        var msg = new SpeechSynthesisUtterance();
        var suara;
        var myTimeout;

        function myTimer() {
            speechSynthesis.pause();
            speechSynthesis.resume();
            myTimeout = setTimeout(myTimer, 10000);
        }
        if (rsvc == false) {
            setTimeout(() => {
                suara = window.speechSynthesis.getVoices();
                msg.voice = suara[11];
                msg.lang = 'in-ID';
                msg.rate = 0.9;
            }, 1000);
        }

        function getData() {
            $.ajax({
                url: base_url + 'jadwal/data_monitor',
                method: "GET",
                dataType: "JSON",
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var obj = data[i];
                        $("#antrian" + obj.ruang_sidang_id).html(obj.no_antrian);
                        $("#no_perkara" + obj.ruang_sidang_id).html(obj.perkara);
                    }
                }
            });
        }

        function cek_panggilan() {
            if(!isMobile)
            {
                $.ajax({
                    url: base_url + 'jadwal/panggil',
                    method: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        if (data.success == 1) {
                            memanggil_antrian(data.id, data.text, data.no_antrian, data.ruangan);
                        } else {
                            setTimeout(cek_panggilan, 3000);
                        }
                    }
                });
            }
        }

        function memanggil_antrian(id, text, no_antrian, ruangan) {
            $('#nmr_antrian').text(no_antrian);
            $('#ke_ruang').text(ruangan);
            $('#modal_antrian').modal('show');
            voice = "Indonesian Male";
            rate = 1;
            $("#pemanggilan_title").text("Dipanggil");
            $("td#no_antrian_dipanggil").text(no_antrian);
            $("td#ruangan_dipanggil").text(ruangan);
            $("#pemanggilan").show();
            if (rsvc != false) {
                responsiveVoice.speak(text, voice, {
                    rate: rate,
                    onend: function() {
                        hapus_panggilan(id);
                    }
                });
            } else {
                myTimeout = setTimeout(myTimer, 10000);
                msg.text = text;
                msg.onend = function() {
                    clearTimeout(myTimeout);
                    hapus_panggilan(id);
                }
                speechSynthesis.speak(msg);
            }
        }

        function hapus_panggilan(id) {
            $('#modal_antrian').modal('hide');
            $.ajax({
                url: base_url + 'jadwal/hapus_panggilan',
                method: "POST",
                data: {
                    id: id
                },
                dataType: "TEXT",
                success: function(data) {
                    if (data == 1) {
                        $("#pemanggilan").hide();
                        setTimeout(cek_panggilan, 3000);
                    } else {
                        location.reload();
                    }
                }
            });
        }

        $(document).ready(function() {
            setInterval(getData, 3000);
            if (panggil_melalui == "luar") {
                setTimeout(cek_panggilan, 5000);
            }

            <?php
            $hari_ini = date("Y-m-d");
            foreach ($data_ruangan as $key => $val) :
            ?>
                dt_<?php echo $val->id; ?> = $("#dt_<?php echo $val->id; ?>").DataTable({
                    order: [
                        [1, "asc"]
                    ],
                    ajax: {
                        url: "<?php echo base_url('jadwal/monitor_getBy/' . $val->id . '/' . $hari_ini); ?>",
                        dataSrc: "data_jadwal"
                    },
                    columns: [{
                            data: "id"
                        },
                        {
                            data: "no_antrian",
                        },
                        {
                            data: "perkara"
                        },
                        {
                            data: "penggugat"
                        },
                        {
                            data: "tergugat"
                        }
                    ],
                    columnDefs: [{
                            targets: [0],
                            visible: false,
                        },
                        {
                            responsivePriority: 1,
                            targets: [1, 3],
                        }
                    ],
                    createdRow: function(row, data, index) {
                        if (data['status'] == "masuk") {
                            $(row).addClass('bg-lime');
                        }
                    },
                    paging: false,
                    searching: false,
                    bInfo: false,
                    scrollY: '45vh',
                    responsive: true,
                    autoWidth: true,
                });
            <?php endforeach; ?>
            // setInterval(() => {
            //     dt_<?php echo $val->id; ?>.ajax.reload(null, false);
            //     dt_<?php echo $val->id; ?>.columns.adjust().draw();
            // }, 15000);
            $("#carousel-table").on('slid.bs.carousel', function() {
                <?php foreach ($data_ruangan as $key => $val) : ?>
                    dt_<?php echo $val->id; ?>.ajax.reload(null, false);
                    dt_<?php echo $val->id; ?>.columns.adjust().draw();
                <?php endforeach; ?>
            });
        });
    </script>
</body>

</html>