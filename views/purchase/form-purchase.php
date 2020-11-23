<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <strong>Form Penjualan</strong>
            </div>
            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="card-body card-block">
                <div class="row form-group">
                  <div class="col col-md-3">
                    <label for="select" class=" form-control-label">Pelanggan</label>
                  </div>
                  <div class="col-12 col-md-8">
                    <input type="hidden" name="customer_id" id="customer2">
                    <input type="hidden" id="customer3">
                    <input type="text" id="text-input" name="text-input" placeholder="Pelanggan" class="form-control form-input customer">
                    <small class="form-text text-muted rescus" style="display: none;"id="receiver"><input type="checkbox" id="same-customer"> Penerima sama dengan pelanggan</small>
                  </div>
                  <div class="col-12 col-md-1">
                    <button type="button" style="border-radius: 50px;" onclick="newTab('customer-form');" class="btn btn-outline-success btn-md" title="Tambah Data Pelanggan"><i class="fa fa-user-plus"></i></button>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3">
                    <label for="text-input" class=" form-control-label">Tanggal</label>
                  </div>
                  <div class="col-12 col-md-9">
                    <input type="text" id="text-input" name="text-input" placeholder="<?php echo date('d/m/Y'); ?>" class="form-control form-input datetimepicker">
                  </div>
                </div>
                <div class="row form-group rescus" style="display: none;">
                  <div class="col col-md-3">
                    <label for="text-input" class=" form-control-label">Nama Penerima</label>
                  </div>
                  <div class="col-12 col-md-9">
                    <input type="text" id="name" name="text-input" placeholder="Nama Penerima" class="form-control form-input">
                  </div>
                </div>
                <div class="row form-group rescus" style="display: none;">
                  <div class="col col-md-3">
                    <label for="text-input" class=" form-control-label">Telepon Penerima</label>
                  </div>
                  <div class="col-12 col-md-9">
                    <input type="text" id="phone" name="text-input" placeholder="0897654321" class="form-control form-input">
                  </div>
                </div>
                <div class="row form-group rescus" style="display: none;">
                  <div class="col col-md-3">
                    <label for="email-input" class=" form-control-label">Rekening</label>
                  </div>
                  <div class="col-12 col-md-3">
                     <select name="account[0]" id="code" class="js-select2 form-control form-input">
                      <option value="0" disabled="disabled" selected="selected">Pilih Kode Bank</option>
                      <?php foreach ($bank as $key => $val) { ?>
                        <option value="<?php echo $val['code']; ?>"><?php echo $val['code'] . ' - ' . $val['bank']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="dropDownSelect2"></div>
                  </div>
                  <div class="col-12 col-md-6">
                    <input type="text" id="account" name="account[1]" value="" placeholder="098765" class="number form-control form-input">
                  </div>
                </div>
                <div class="row form-group rescus" style="display: none;">
                  <div class="col col-md-3">
                    <label for="select" class=" form-control-label">Kecamatan</label>
                  </div>
                  <div class="col-12 col-md-9">
                    <input type="text" id="subdistrict_name" placeholder="Gambir" class="form-control form-input subdistrict">
                    <input type="hidden" id="subdistrict_id" name="subdistrict_id" value="<?php echo $subdistrict_id; ?>">
                  </div>
                </div>
                <div class="row form-group rescus" style="display: none;">
                  <div class="col col-md-3">
                    <label for="textarea-input" class=" form-control-label">Alamat Penerima</label>
                  </div>
                  <div class="col-12 col-md-9">
                    <textarea name="textarea-input" id="address" rows="9" placeholder="Jalan Aspal Gang Buntu ..." class="form-control form-input"></textarea>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3">
                    <label for="disabled-input" class=" form-control-label">Ekspedisi</label>
                  </div>
                  <div class="col-12 col-md-5">
                    <select name="expedition" class="js-select2 form-control form-input">
                      <option value="0" disabled="disabled" selected="selected">Pilih Expedisi</option>
                      <?php foreach ($exp as $key => $val) { ?>
                        <option value="<?php echo $val['exp']; ?>"><?php echo $val['exp']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="dropDownSelect2"></div>
                  </div>
                  <div class="col-12 col-md-4 input-group">
                    <div class="input-group-addon" style="border-radius:50px 0px 0px 50px">Rp</div>
                    <input type="text" id="password-input" name="shipping" placeholder="10000" class="form-control form-input number">
                    <div class="input-group-addon" style="border-radius:0px 50px 50px 0px">.00</div>
                  </div>
                </div>
                <!-- <div class="row form-group">
                  <div class="col col-md-3">
                    <label for="password-input" class=" form-control-label">Ongkir</label>
                  </div>
                  <div class="col-12 col-md-4">
                    <input type="text" id="password-input" name="shipping" placeholder="10000" class="form-control form-input number">
                  </div>
                </div> -->
                <div id="items">
                  <div class="row form-group">
                    <div class="col col-md-3">
                      <label for="selectLg" class=" form-control-label">Item</label>
                    </div>
                    <div class="col-12 col-md-4">
                      <select name="selectLg" id="selectLg" class="form-control form-input form-control form-input">
                        <option value="0">Please select</option>
                        <option value="1">Option #1</option>
                        <option value="2">Option #2</option>
                        <option value="3">Option #3</option>
                      </select>
                    </div>
                    <div class="col-12 col-md-4">
                      <input type="text" id="disabled-input" name="disabled-input" placeholder="Disabled" disabled="" class="form-control form-input">
                    </div>
                    <div class="col-12 col-md-1 text-center">
                      <button type="reset" class="btn btn-outline-danger btn-sm">
                        <i class="fa fa-close"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fa fa-dot-circle-o"></i> Submit</button>
                <button type="reset" class="btn btn-outline-danger btn-sm"><i class="fa fa-undo"></i> Reset</button>
                <button type="button" class="btn btn-outline-warning btn-sm" onclick="goBack();"><i class="fa fa-long-arrow-left"></i> Kembali</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="copyright">
            <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>