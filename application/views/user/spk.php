<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Surya Sumatera | Adminstrasi</title>

    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <?php include('akunlogin.php') ?>
                <?php include('sidebar.php') ?>
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>

        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Administration</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url();?>user/administration">Beranda</a>
                        </li>
                        <li class="active">
                            <strong>Surat Perintah Kerja</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $this->session->flashdata('msg'); ?>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">

                            <div class="row">
                                <div class="col-lg-6">
                                    <h5>Daftar SPK</h5>
                                </div>
                                <div class="col-lg-6 text-right">
                                    
                                    <a class="btn btn-xs btn-primary" href="<?php echo base_url();?>user/createSPK">
                                        <span class="fa fa-pencil"></span><strong> TAMBAH SPK</strong>
                                    </a>
                                    <button data-toggle="modal" data-target="#kloter" class="btn btn-xs btn-white"><i class="fa fa-qrcode"></i><strong> TAMBAH KLOTER</strong></button>

                                </div>
                            </div>

                            <div class="modal inmodal fade" id="kloter" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h3 class="modal-title">Tambah Kloter SPK</h3><br>


                                        </div>
                                        <div class="modal-body">

                                            <?php echo form_open('user/setKloter')?>

                                            <div class="row">
                                            <div class="col-lg-9">
                                                <input type="text" name="namakloter" class=" form-control" placeholder="Nama Kloter">
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="number" min="0" name="kadar" class=" form-control" placeholder="kadar">
                                            </div>
                                            <br><br><hr>
                                            <?php $b=count($klot); for ($i=0; $i < $b ; $i++) { ?> 
                                                
                                                    <div class="col-sm-10 col-sm-offset-2">
                                                        <div class="i-checks">
                                                            <label>
                                                                <input class="form-control" type="checkbox" value="<?php echo $klot[$i]->idSPK?>" name="idSPK[]">
                                                                &nbsp&nbsp&nbspNo Faktur : <b><?php echo $klot[$i]->nomorFaktur?></b> - Kadar : <b><?php echo $klot[$i]->kadarBahan?></b> %
                                                            </label>
                                                        </div>
                                                        
                                                    </div>
                                                
                                            <?php } ?>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Tambahkan</button>

                                            <?php echo form_close()?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>

                        <div class="ibox-content">
                            <input type="text" class="form-control input-sm m-b-xs" id="filter"
                                   placeholder="Search in table">
                            <div class="table-responsive">
                            <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                                <thead>
                                <tr>
                                    <th class="text-center">Faktur</th>
                                    <th class="text-center">Kloter</th>
                                    <th>Konsumen</th>
                                    <th data-hide="phone,tablet">Produk</th>
                                    <th class="text-center">Kadar</th>
                                    
                                    
                                    <th class="text-center" data-hide="phone,tablet">Tambahkan</th>
                                    <th class="text-center" data-hide="phone,tablet">Persetujuan</th>
                                    
                                    <th class="text-center" data-hide="phone,tablet">Action</th>
                                    <th class="text-center" data-hide="phone,tablet">Status </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($listSPK as $hasil) : ?>
                                <tr>
                                    <td class="text-center"><?php echo $hasil->nomorFaktur?></td>
                                    <td class="text-center">
                                        <?php

                                        $namakloter = "-";
                                        for ($g=0; $g < count($cekklot) ; $g++) { 
                                            if($cekklot[$g]->idSPK == $hasil->idSPK) {
                                                $namakloter = $cekklot[$g]->nama ;
                                            }
                                        } 
                                        echo $namakloter;

                                        ?>
                                        

                                    </td>
                                    <td><?php echo $hasil->namaCustomer?></td>
                                    <td ><?php echo $hasil->namaProduk?></td>
                                    <td class="text-center" ><?php echo $hasil->kadarBahan?> %</td>
                                    
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a data-toggle="dropdown" class="btn btn-info btn-xs dropdown-toggle" href="#o">
                                                <span class="block "> Tambahkan</a>
                                            <ul class="dropdown-menu m-t-xs">

                                                <?php

                                                $jadwal = 0;
                                                for ($g=0; $g < count($cekjadwal) ; $g++) { 
                                                    if($cekjadwal[$g]->idSPK == $hasil->idSPK) {
                                                        $jadwal++;
                                                    }
                                                } 

                                                ?>
                                                
                                                <?php if($jadwal == 0) { ?>
                                                    <li><a href="<?php base_url();?>tambahJadwal/<?php echo $hasil->nomorFaktur;?>">Jadwal</a></li>
                                                

                                                <?php } else if($hasil->statusDesain == 'Proses Desain') { ?>
                                                    <li><a href="<?php base_url();?>tambahDesain/<?php echo $hasil->nomorFaktur;?>">Desain</a></li>
                                                <?php } ?>

                                            </ul>       
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a data-toggle="dropdown" class="btn btn-xs btn-success dropdown-toggle" href="#t">
                                                <span class="block ">Persetujuan</a>
                                            <ul class="dropdown-menu m-t-xs">
                                                <?php if($hasil->statusDesain == 'Menunggu Persetujuan') { ?>

                                                    <li><a href="#" data-toggle="modal" data-target="#desain<?php echo $hasil->nomorFaktur;?>">Desain</a></li>

                                                <?php } ?>

                                                <?php if($hasil->statusDesain == 'Disetujui' ) { ?>

                                                    <!-- <li><a href="<?php echo base_url('user/invoice/'.$hasil->nomorFaktur)?>" >Akhir</a></li> -->
                                                    
                                                <?php } ?>
                                                
                                                
                                            </ul>
                                        </div>
                                    </td>
                                   
                                    
                                    <td class="text-center">

                                        <a href="<?php echo base_url('user/invoice/' . $hasil->nomorFaktur) ?>" class="btn btn-xs btn-primary" >Lihat</a>
                                        
                                        <a href="<?php echo base_url('user/editSPK/' . $hasil->nomorFaktur) ?>" class="btn btn-xs btn-warning" >Edit</a>

                                        
                                        <?=anchor('user/hapusSPK/' . $hasil->idSPK, 'Hapus', [
                                          'class' => 'btn btn-danger btn-xs',
                                          'role'  => 'button',
                                          'onclick'=>'return confirm(\'Apakah Anda Yakin?\')'
                                        ])?>
                                    </td>
                                    <td class="text-center">
                                        

                                        <?php

                                        $jadwal = 0;
                                        for ($g=0; $g < count($cekjadwal) ; $g++) { 
                                            if($cekjadwal[$g]->idSPK == $hasil->idSPK) {
                                                $jadwal++;
                                            }
                                        } 

                                        ?>

                                        <?php if ($jadwal == 0) { ?>
                                            <span class="fa fa-calendar text-muted" ></span>
                                        <?php } ?>

                                        <?php if ($jadwal > 0) { ?>

                                            <?php if($hasil->statusJadwal !== 'Disetujui') { ?>
                                                <span class="fa fa-calendar text-warning" ></span>
                                            <?php } else { ?>
                                                <span class="fa fa-calendar text-success" ></span>
                                            <?php } ?>

                                        <?php } ?>

                                        <?php if($hasil->statusDesain == 'Proses Desain') { ?>
                                            <span class="fa fa-file-image-o text-muted" ></span>
                                        <?php } ?>
                                        <?php if($hasil->statusDesain == 'Menunggu Persetujuan') { ?>
                                            <span class="fa fa-file-image-o text-warning" ></span>
                                        <?php } ?>
                                        <?php if($hasil->statusDesain == 'Disetujui') { ?>
                                            <span class="fa fa-file-image-o text-success" ></span>
                                        <?php } ?>
                                        <?php if($hasil->statusDesain == 'Proses Desain Ulang') { ?>
                                            <span class="fa fa-file-image-o text-danger" ></span>
                                        <?php } ?>

                                        <?php

                                        $klot = 0;
                                        for ($g=0; $g < count($cekklot) ; $g++) { 
                                            if($cekklot[$g]->idSPK == $hasil->idSPK) {
                                                $klot++;
                                            }
                                        } 

                                        ?>

                                        <?php if ($klot == 0) { ?>
                                            <span class="fa fa-qrcode text-muted" ></span>
                                        <?php } ?>

                                        <?php if ($klot > 0) { ?>
                                        <span class="fa fa-qrcode text-success" ></span>
                                        <?php } ?>

                                        <?php 

                                        $asd = 0;

                                        for ($d=0; $d < count($cb) ; $d++) {
                                            if($hasil->idSPK == $cb[$d]->idSPK) {
                                                $asd++;
                                            }}
                                        ?>
                                            

                                        <?php if($asd == 0) {?>
                                            <span class="fa fa-cubes text-muted" ></span>
                                        <?php } else { ?>
                                            <?php if($hasil->statusBOM !== 'Disetujui') { ?>
                                                <span class="fa fa-cubes text-warning" ></span>
                                            <?php } else { ?>
                                                <span class="fa fa-cubes text-success" ></span>
                                            <?php } ?>
                                        <?php } ?>

                                        
                                        <?php if($hasil->statusPersetujuan == 'Belum Disetujui') { ?>
                                            <span class="fa fa-check-square-o text-muted" ></span>
                                        <?php } ?>

                                        <?php if($hasil->statusPersetujuan == 'Disetujui') { ?>
                                            <span class="fa fa-check-square-o text-success" ></span>
                                        <?php } ?>
                                            
                                        
                                        
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="desain<?php echo $hasil->nomorFaktur;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Persetujuan Desain - No. Faktur #<?php echo $hasil->nomorFaktur ?></h4>
                                      </div>
                                      <div class="modal-body">
                                        <?php if($hasil->statusDesain !== 'Proses Desain') {?>
                                            <div class="row">
                                               <div class="col-lg-4">
                                                   <img src="<?php echo base_url('uploads/gambarDesain/'.$hasil->kodeGambar.'-d1.jpg')?>" class="img img-responsive">
                                               </div>
                                               <div class="col-lg-4">
                                                   <img src="<?php echo base_url('uploads/gambarDesain/'.$hasil->kodeGambar.'-d2.jpg')?>" class="img img-responsive">
                                               </div>
                                               <div class="col-lg-4">
                                                   <img src="<?php echo base_url('uploads/gambarDesain/'.$hasil->kodeGambar.'-d3.jpg')?>" class="img img-responsive">
                                               </div>
                                           </div>
                                        <?php } else { ?>

                                        <?php } ?>
                                       
                                      </div>
                                      <div class="modal-footer">
                                        <?php if($hasil->statusDesain == 'Disetujui' ) { ?>

                                            <a disabled class="btn btn-primary" type="button">Telah Disetuju</a>
                                            
                                        <?php } else {?>
                                            <a href="<?php base_url();?>setujuDesain/<?php echo $hasil->nomorFaktur;?>" class="btn btn-primary" type="button">Setuju</a>
                                        <?php } ?>
                                        
                                        <a href="<?php base_url();?>tidakSetujuDesain/<?php echo $hasil->nomorFaktur;?>" class="btn btn-danger" type="button">Tidak Setuju</a>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- End of Modal -->

                                <!-- End of Modal -->
                                <!-- Modal -->
                                
                                <!-- End of Modal -->
                                <?php endforeach;?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="10">
                                        <ul class="pagination pull-right"></ul>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div>
                <strong>Copyright</strong> Surya Sumatera &copy; <?php echo date('Y')?>
            </div>
        </div>

        </div>
        </div>


    <!-- Mainly scripts -->
    <script src="<?php echo base_url();?>assets/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url();?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url();?>assets/js/inspinia.js"></script>
    <script src="<?php echo base_url();?>assets/js/plugins/pace/pace.min.js"></script>

    <!-- FooTable -->
    <script src="<?php echo base_url();?>assets/js/plugins/footable/footable.all.min.js"></script>
    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {

            $('.footable').footable();
            $('.footable2').footable();

        });

    </script>
    <script src="<?php echo base_url();?>assets/js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
</body>

</html>
