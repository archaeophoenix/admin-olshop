<?php
$id = (empty($data['id'])) ? '' : $data['id'] ;
$name = (empty($data['name'])) ? '' : $data['name'] ;
$phone = (empty($data['phone'])) ? '' : $data['phone'] ;
$status = (empty($data['status'])) ? '' : $data['status'] ;
$address = (empty($data['address'])) ? '' : $data['address'] ;
$subdistrict_id = (empty($data['subdistrict_id'])) ? '' : $data['subdistrict_id'] ;
?>
<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <strong>Form Pelanggan</strong>
            </div>
            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="card-body card-block">
                <div class="row form-group">
                  <div class="col col-md-3">
                    <label class=" form-control-label">Nama</label>
                  </div>
                  <div class="col-12 col-md-9">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Nama Customer" class="form-control form-input">
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3">
                    <label class=" form-control-label">Telepon</label>
                  </div>
                  <div class="col-12 col-md-9">
                    <input type="text" name="phone" value="<?php echo $phone; ?>" placeholder="098765" class="form-control form-input number">
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3">
                    <label class=" form-control-label">Rekening</label>
                  </div>
                  <div class="col-12 col-md-3">
                     <select name="account[0]" id="select" class="js-select2 form-control">
                      <?php if(empty($id)){ ?>
                        <option value="0" disabled="disabled" selected="selected">Pilih Kode Bank</option>
                      <?php }
                      $account = (empty($id)) ? null : explode(' - ', $data['account']);
                      foreach ($bank as $key => $val) { ?>
                        <option <?php echo (!empty($id) && isset($account[0]) && $account[0] == $val['code']) ? 'selected="selected"' : '' ; ?> value="<?php echo $val['code']; ?>"><?php echo $val['code'] . ' - ' . $val['bank']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="dropDownSelect2"></div>
                  </div>
                  <div class="col-12 col-md-6">
                    <input type="text" name="account[1]" value="<?php echo (isset($account[1])) ? $account[1] : '' ; ?>" placeholder="098765" class="number form-control form-input">
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3">
                    <label for="select" class=" form-control-label">Kecamatan</label>
                  </div>
                  <div class="col-12 col-md-9">
                    <select name="subdistrict_id" id="select" class="js-select2 form-control">
                      <?php if(empty($id)){ ?>
                      <option value="0" disabled="disabled" selected="selected">Pilih Kecamatan</option>
                      <?php }
                      foreach ($subdistrict as $key => $val) { ?>
                        <option <?php echo (!empty($id) && $subdistrict_id == $val['subdistrict_id']) ? 'selected="selected"' : '' ; ?> value="<?php echo $val['subdistrict_id']; ?>"><?php echo $val['subdistrict_name'] . ' - ' . $val['type'] . ' ' . $val['city_name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="dropDownSelect2"></div>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3">
                    <label class=" form-control-label">Alamat</label>
                  </div>
                  <div class="col-12 col-md-9">
                    <textarea name="address" style="border-radius: 15px;" rows="3" placeholder="Jalan Aspal Gang Buntu ..." class="form-control"><?php echo $address; ?></textarea>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3">
                    <label class=" form-control-label">Status</label>
                  </div>
                  <div class="col col-md-9">
                    <div class="form-check-inline form-check">
                      <?php foreach ($statusc as $key => $val) {?>
                      <label for="inline-radio<?php echo $key; ?>" class="form-check-label ">
                        <input <?php echo (!empty($id) && $status == $val['status']) ? 'checked="checked"' : '' ; ?> type="radio" id="inline-radio<?php echo $key; ?>" name="status" value="<?php echo $val['status'];?>" class="form-check-input"> <?php echo $val['status'];?>
                      </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fa fa-dot-circle-o"></i> Submit</button>
                <button type="reset" class="btn btn-outline-danger btn-sm"><i class="fa fa-ban"></i> Reset</button>
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