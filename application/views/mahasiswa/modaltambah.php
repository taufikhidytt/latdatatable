<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Mahasiswa</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="pesan" style="display: none;"></div>
      <form action="<?= base_url('mahasiswa/simpandata')?>" method="post" class="formsimpan">
        <div class="modal-body">
            <div class="form-group row">
                <label for="nobd" class="col-sm-3 col-form-label">NOBP:</label>
                <div class="col-sm-9">
                    <input type="text" name="nobp" id="nobp" class="form-control" autocomplete="off" placeholder="Masukan NOBP">
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Nama Mahasiswa:</label>
                <div class="col-sm-9">
                    <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" placeholder="Masukan Nama Mahasiswa">
                </div>
            </div>
            <div class="form-group row">
                <label for="tmp_lahir" class="col-sm-3 col-form-label">Tempat Lahir:</label>
                <div class="col-sm-9">
                    <input type="text" name="tmp_lahir" id="tmp_lahir" class="form-control" autocomplete="off" placeholder="Masukan Tempat Lahir">
                </div>
            </div>
            <div class="form-group row">
                <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir:</label>
                <div class="col-sm-9">
                    <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" >
                </div>
            </div>
            <div class="form-group row">
                <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin:</label>
                <div class="col-sm-9">
                  <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                    <option value="">--Pilih--</option>
                    <option value="Pria">Pria</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
            </div>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    $('.formsimpan').submit(function(e){
      $.ajax({
        type: 'post',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: "json",
        success: function(response){
          if(response.error){
            $('.pesan').html(response.error).show();
          }

          if(response.sukses){
            alert(response.sukses);
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });
  });
</script>