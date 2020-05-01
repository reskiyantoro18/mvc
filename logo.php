<?php
//Notifikasi
if($this->session->flashdata('sukses')){
    echo '<p class="alert alert-success">';
    echo $this->session->flashdata('sukses');
    echo '<div>';

}
?>
<?php
//eror uplod
if(isset($error)){
    echo '<p class="alert alert-warning">';
    echo $error;
    echo '</p>';
}
// Form Open
echo form_open_multipart(base_url('admin/konfigurasi/logo'), ' class="form-horizontal"');

?>

<div class="form-group">
    <label class="col-md-3 control-label">Nama Website</label>
    <div class="col-md-5">
        <input type="text" name="namaweb" class="form-control" placeholder="Nama Website" value="<?php echo $konfigurasi->namaweb ?>" required>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">upload logo baru</label>
    <div class="col-md-5">
    <input type="file" name="logo" class="form-control" placeholder="Upload logo baru" value="<?php echo $konfigurasi->logo ?>" required>
Logo lama: <br>
 <img src="<?php echo base_url('assets/upload/image/'.$konfigurasi->logo) ?> "class="img img-responsive img-thumbnail" widht="200">        
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label"></label>
    <div class="col-md-5">
        <button class="btn btn-success btn-lg" name="submit" type="submit">
            <i class="fa fa-save"></i> Simpan
        </button>
        <button class="btn btn-info btn-lg" name="reset" type="submit">
            <i class="fa fa-times"></i> Reset
        </button>
    </div>
</div>




<?= form_close();?>
