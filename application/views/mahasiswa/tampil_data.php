<!-- DataTables -->
<link href="<?= base_url()?>horizontal/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url()?>horizontal/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="<?= base_url()?>horizontal/assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive DataTable Mobile -->
<link rel="stylesheet" href="<?= base_url()?>horizontal/assets/plugins/datatables/rowReorder.dataTables.min.css">
<link rel="stylesheet" href="<?= base_url()?>horizontal/assets/plugins/datatables/responsive.dataTables.min.css">

<!-- Required datatable js -->
<script src="<?= base_url()?>horizontal/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>horizontal/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Responsive Data Table Mobile -->
<script src="<?= base_url()?>horizontal/assets/plugins/datatables/dataTables.rowReorder.min.js"></script>
<script src="<?= base_url()?>horizontal/assets/plugins/datatables/dataTables.responsive.min.js"></script>
<div class="col-lg-12">
    <div class="card">
    <div class="card-header">
        <div class="pull-left">
            <h4>Data Mashasiswa</h4>
        </div>
        <div class="pull-right">
            <button type="button" name="" class="btn btn-primary btn-md" id="tomboltambah">
                <i class="fa fa-plus"></i> Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered text-center display nowrap" id="datamahasiswa" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NOBP</th>
                    <th>Nama Mahasiswa</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
    </div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    $(document).ready(function(){
        // function untuk menampilkan data serverSide
        table = $('#datamahasiswa').DataTable({
            responsive: true,
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "order": [],
    
            "ajax": {
                "url": "<?= site_url('mahasiswa/ambildata') ?>",
                "type": "POST"
            },
    
    
            "columnDefs": [{
                "targets": [0],
                "orderable": false,
                "width": 5
            }],
    
        });

        // function untuk menampilkan modal tambah
        $('#tomboltambah').click(function(e){
            $.ajax({
                url: "<?= base_url('mahasiswa/formtambah')?>",
                dataType: "json",
                success: function(response){
                    if(response.sukses){
                        $('.viewmodal').html(response.sukses).show();
                        $('#modaltambah').modal('show');
                    }
                }
            });
        });
    });
</script>