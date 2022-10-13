<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Antrian Sidang</title>    
    <style>
        body {
            background: #dd3f3e;
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
        }

        .ticket {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            width: 700px;
            margin: 20px auto;
        }

        .ticket .stub,
        .ticket .check {
            box-sizing: border-box;
        }

        .stub {
            background: #ef5658;
            /* background: url("<?php echo base_url('asset/img/logo.png'); ?>");
            background-size: 150px;
            background-repeat: no-repeat;
            background-position: center; */
            height: 250px;
            width: 250px;
            color: white;
            padding: 20px;
            position: relative;
        }

        .stub:before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            border-top: 20px solid #dd3f3e;
            border-left: 20px solid #ef5658;
            width: 0;
        }

        .stub:after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            border-bottom: 20px solid #dd3f3e;
            border-left: 20px solid #ef5658;
            width: 0;
        }

        .stub .top {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            height: 40px;
            text-transform: uppercase;
        }

        .stub .top .line {
            display: block;
            background: #fff;
            height: 40px;
            width: 3px;
            margin: 0 20px;
        }

        .stub .top .num {
            font-size: 10px;
        }

        .stub .top .num span {
            color: #000;
        }

        .stub .number {
            position: absolute;
            left: 40px;
            font-size: 150px;
        }

        .stub .invite {
            position: absolute;
            left: 150px;
            bottom: 45px;
            color: #000;
            width: 20%;
        }

        .stub .invite:before {
            content: '';
            background: #fff;
            display: block;
            width: 40px;
            height: 3px;
            margin-bottom: 5px;
        }

        .check {
            background: #fff;
            height: 250px;
            width: 450px;
            padding: 40px;
            position: relative;
        }

        .check:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            border-top: 20px solid #dd3f3e;
            border-right: 20px solid #fff;
            width: 0;
        }

        .check:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            border-bottom: 20px solid #dd3f3e;
            border-right: 20px solid #fff;
            width: 0;
        }

        .check .big {
            font-size: 60px;
            font-weight: 900;
            line-height: .8em;
        }

        .check .number {
            position: absolute;
            top: 50px;
            right: 50px;
            color: #ef5658;
            font-size: 72px;
        }

        .info {
            position: absolute;
            bottom: 10px;
        }

        .check .info {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: start;
            -ms-flex-pack: start;
            justify-content: flex-start;
            font-size: 12px;
            margin-top: 20px;
            width: 100%;
        }

        .check .info section {
            margin-right: 50px;
        }

        .check .info section:before {
            content: '';
            background: #ef5658;
            display: block;
            width: 40px;
            height: 3px;
            margin-bottom: 5px;
        }

        .check .info section .title {
            font-size: 10px;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <div class="stub">            
            <img src="<?php echo base_url('asset/img/logo.png'); ?>" alt="" style="height: 200px; margin-left:auto; margin-right:auto; display:block;">
        </div>
        <div class="check">
            <div class="big">
                Antrian Sidang
            </div>
            <div class="number"><?php echo $no; ?></div>
            <div class="info">
                <section>
                    <div class="title">Tanggal</div>
                    <div><?php echo $tanggal; ?></div>
                </section>
                <section>
                    <div class="title">Ruang Sidang</div>
                    <div><?php echo $ruang_sidang; ?></div>
                </section>
                <section>
                    <div class="title">Nomor Perkara</div>
                    <div><?php echo $perkara; ?></div>
                </section>
            </div>
        </div>
    </div>
    <!-- jQuery -->
	<script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
	
    <!-- html2canvas -->
    <script src="<?php echo base_url('asset/js/html2canvas/html2canvas.min.js') ?>"></script>
    <script>
        let no_perkara = "<?php echo $perkara; ?>";
        no_perkara = no_perkara.replaceAll("/","_");
        $(document).ready(function(){
            let element = $('.ticket')[0];
            html2canvas(element).then(function(canvas){
                let a = document.createElement('a');
                a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");;
                let nama_file = "<?php echo $perkara; ?>";
                a.download = nama_file+'.jpg';
                a.click();
            });
        });
    </script>
</body>

</html>