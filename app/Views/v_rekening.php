<div class="col-md-12">
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">Data
        <?= $judul ?>
      </h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-tambah"><i
            class="fas fa-plus"></i> Tambah
        </button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive table table-bordered">
      <?php
      if (session()->getFlashdata('pesan')) {
        echo '<div class="alert alert-success">';
        echo session()->getFlashdata('pesan');
        echo '</div>';
      }
      ?>
      <table class="table table-bordered text-nowrap" id="example2">
        <tread>
          <tr>
            <th width='50px'>No</th>
            <th>Nama Rekening</th>
            <th>No Rekening</th>
            <th>Atas Nama</th>
            <th width='100px'>Action</th>
          </tr>
        </tread>
        <tbody>
          <?php $no = 1;
          foreach ($rek as $key => $value) { ?>
            <tr>
              <td>
                <?= $no++ ?>
              </td>
              <td>
                <i class='fas fa-credit-card text-success'></i>
                <?= $value['nama_rek'] ?>
              </td>
              <td>
                <?= $value['no_rek'] ?>
              </td>
              <td>
                <?= $value['atas_nama'] ?>
              </td>
              <td>
                <button class="btn btn-flat btn-sm btn-warning" data-toggle="modal"
                  data-target="#modal-edit<?= $value['id_rek'] ?>"><i class="fas fa-pencil-alt"></i></button>
                <button class="btn btn-flat btn-sm btn-danger" data-toggle="modal"
                  data-target="#modal-hapus<?= $value['id_rek'] ?>"><i class="fas fa-trash"></i></button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>


<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah
          <?= $judul ?>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open('Rekening/InsertData') ?>
        <div class='form-group'>
          <label>Nama Bank</label>
          <select name="nama_rek" class="form-control" required onchange="setAccountNumber(this)">
            <option value="">Pilih Bank</option>
            <option value="BRI">BRI</option>
            <option value="BCA">BCA</option>
            <option value="BTN">BTN</option>
            <option value="BSI">BSI</option>
            <option value="Yang Lain">Yang Lain</option>
          </select>
        </div>
        <div class='form-group'>
          <label>No Rekening</label>
          <input type='text' name="no_rek" class="form-control" placeholder="123412341234" pattern="\d{10,16}"
            title="Masukkan No Rekening Yang Valid" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>
        <div class='form-group'>
          <label>Atas Nama</label>
          <input type='char' name="atas_nama" class="form-control" placeholder="Andhika" required></input>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-success">Simpan</button>
      </div>
      <?php echo form_close() ?>
    </div>
    <!-- /.modal-content -->
  </div>
</div>

<?php foreach ($rek as $key => $value) { ?>
  <div class="modal fade" id="modal-edit<?= $value['id_rek'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit
            <?= $judul ?>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo form_open('Rekening/UpdateData/' . $value['id_rek']) ?>
          <div class='form-group'>
            <label>Nama Bank</label>
            <select name="nama_rek" class="form-control" required>
              <option>BRI</option>
              <option>BCA</option>
              <option>BTN</option>
              <option>Lainnya</option>
            </select>
          </div>
          <div class='form-group'>
            <label>No Rekening</label>
            <input type='number' name="no_rek" value='<?= $value['no_rek'] ?>' class="form-control" required></input>
          </div>
          <div class='form-group'>
            <label>Atas Nama</label>
            <input type='char' name="atas_nama" value='<?= $value['atas_nama'] ?>' class="form-control" required></input>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
        <?php echo form_close() ?>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>

  <div class="modal fade" id="modal-hapus<?= $value['id_rek'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus
            <?= $judul ?>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah Ingin Hapus Data ?<br>
          <b>
            <?= $value['nama_rek'] ?>
          </b>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <a href="<?= base_url('Rekening/HapusData/' . $value['id_rek']) ?>" class="btn btn-danger">Hapus</a>
        </div>
        <?php echo form_close() ?>
      </div>
      <!-- /.modal-content -->
    </div>

  </div>
<?php } ?>
<!-- 
<script>
  function validateAccountNumber(input) {
    // Menghapus semua karakter selain angka
    var accountNumber = input.value.replace(/[^0-9]/g, '');

    // Memastikan panjang angka dalam rentang 10-16 digit
    if (accountNumber.length < 10 || accountNumber.length > 16) {
      input.setCustomValidity("No Rekening harus terdiri dari 10 hingga 16 digit angka.");
    } else {
      input.setCustomValidity("");
    }
  } -->
</script>
<script>
  function setAccountNumber(select) {
    const accountNumberInput = document.querySelector('input[name="no_rek"]');
    const selectedBank = select.value;
    let accountNumber = "";

    if (selectedBank === "BRI") {
      accountNumber = "002";
    } else if (selectedBank === "BCA") {
      accountNumber = "014";
      // Add account number for BCA if desired
    } else if (selectedBank === "BTN") {
      accountNumber = "200";
      // Add account number for BTN if desired
    } else if (selectedBank === "BSI") {
      accountNumber = "451";
      // Add account number for BSI if desired
    } else {
      accountNumber = "";
    }
    accountNumberInput.value = accountNumber;
  }
</script>