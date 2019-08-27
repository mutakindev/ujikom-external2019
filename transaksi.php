<?php $this->load->view('templates/header',$title); ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-credit-card"></i> Transaksi</h1>
    </div>
    <hr>
    <!-- row content -->
    <div class="row">
        <div class="col-lg-12">
            <!-- keranjang belanja -->
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="font-weight-bold p-0"><i class="fas fa-shopping-cart"></i> Keranjang</h6>
                </div>
                <div class="card-body">
                    <!-- data pesanan -->
                    <a href="#" data-toggle="modal" data-target="#daftarPesanan" class="btn btn-default"><i class="fas fa-search"></i> Daftar Pesanan</a>
                    <hr>
                    <?= $this->session->flashdata('pesan'); ?>
                    <!-- tabel keranjang -->
                    <?php echo form_open('admin/simpan_transaksi'); ?>
                    <input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user');?>">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm" width="100%">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>ID Order</th>
                                    <th>Nama Masakan</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="tampil_keranjang">
                            </tbody>
                            <tr>
	    	            		<th colspan="5">Tunai</th>
	    	            		<th colspan="2"><input type="text" id="jml_uang" name="jml_uang" class="form-control"></th>
	    	            	</tr>
	    	            	<tr>
	    	            		<th colspan="5">Kembalian</th>
	    	            		<th colspan="2"><input type="text" id="kembalian" name="kembalian" class="form-control"></th>
	    	            	</tr>
                        </table>
                    </div>
                    <!-- // tabel keranjang -->
                    <button class="btn btn-primary"><i class="fas fa-check"></i> Simpan Transaksi</button>
                    <?php echo form_close(); ?>
                </div>
                <!-- // card-body -->
            </div>
            <!-- // card -->
        </div>
        <!-- // col -->
    </div>
    <!-- // row content -->

    <!-- Daftar Makanan Modal-->
  <div class="modal fade" id="daftarPesanan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Daftar Pesanan</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>No</th>
                            <th>No Pesanan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($pesanan->result_object() as $item) :?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $item->id_order; ?></td>
                            <td><?= date('d/m/y',$item->tanggal); ?></td>
                            <td class="text-center"><button class="id_order btn btn-success btn-sm" id="<?= $item->id_order; ?>" >
                            <i class="fas fa-hand-pointer"></i> Pilih</button></td>
                        </tr>
                        <?php $no++; endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('templates/footer'); ?>


<script>
  $(function(){
            $('#jml_uang').on("input",function(){
                var total=$('#total').val();
                var jumuang=$('#jml_uang').val();
                var hsl=jumuang.replace(/[^\d]/g,"");
                $('#jml_uang').val(hsl);
                $('#kembalian').val(hsl-total);
            });

            $('.id_order').on("click",function(){
            	$('#tampil_keranjang').load("<?php echo base_url()?>admin/load_detail_pesanan/"+$(this).attr('id'));
            });
        });

</script>
