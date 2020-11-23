<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <strong>Form Item</strong>
            </div>
            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="card-body card-block">
                <div class="row form-group">
                  <div class="col col-md-3">
                    <label for="text-input" class=" form-control-label">Item</label>
                  </div>
                  <div class="col-12 col-md-9">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="value" value="<?php echo $price; ?>">
                    <input type="text" id="text-input" name="item[name]" <?php echo (empty($price)) ? '' : 'readonly="readonly" disabled="disabled"' ; ?> value="<?php echo $name; ?>" placeholder="Skin Care" class="form-control form-input">
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3">
                    <label for="email-input" class=" form-control-label">Harga</label>
                  </div>
                  <div class="col-12 col-md-9 input-group">
                    <div class="input-group-addon" style="border-radius:50px 0px 0px 50px">Rp</div>
                    <input type="text" id="email-input" name="price[value]" value="<?php echo $value; ?>" placeholder="150000" class="form-control form-input number">
                    <div class="input-group-addon" style="border-radius:0px 50px 50px 0px">.00</div>
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
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <strong>Data Item</strong>
            </div>
            <div class="card-body card-block">
              <div class="table-data__tool">
                <div class="table-data__tool-left">&nbsp;</div>
                <div class="table-data__tool-right">
                  <div class="input-group">
                    <input type="search" id="data-search" name="text-input" placeholder="Text" class="form-input form-control">
                    <div class="input-group-addon" style="border-radius:0px 50px 50px 0px">
                      <i class="fa fa-search"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                  <thead>
                    <tr>
                      <th class="text-center"><i class="fa fa-cogs"></i></th>
                      <th>nama</th>
                      <th>harga</th>
                    </tr>
                  </thead>
                  <tbody id="data-item">
                    <tr class="tr-shadow">
                      <td>
                        <div class="table-data-feature">
                          <button class="item" data-toggle="modal" data-target="#scrollmodal" title="Edit">
                            <i class="zmdi zmdi-edit"></i>
                          </button>
                          <button class="item" data-toggle="modal" data-target="#scrollmodal" title="Detail">
                            <i class="fa fa-money"></i>
                          </button>
                        </div>
                      </td>
                      <td>Lori Lynch</td>
                      <td>120</td>
                    </tr>
                    <tr class="spacer"></tr>
                    <tr class="tr-shadow">
                      <td>
                        <div class="table-data-feature">
                          <button class="item" data-toggle="modal" data-target="#scrollmodal" title="Edit">
                            <i class="zmdi zmdi-edit"></i>
                          </button>
                          <button class="item" data-toggle="modal" data-target="#scrollmodal" title="Detail">
                            <i class="fa fa-money"></i>
                          </button>
                        </div>
                      </td>
                      <td>Lori Lynch</td>
                      <td>120</td>
                    </tr>
                    <tr class="spacer"></tr>
                    <tr class="tr-shadow">
                      <td>
                        <div class="table-data-feature">
                          <button class="item" data-toggle="modal" data-target="#scrollmodal" title="Edit">
                            <i class="zmdi zmdi-edit"></i>
                          </button>
                          <button class="item" data-toggle="modal" data-target="#scrollmodal" title="Detail">
                            <i class="fa fa-money"></i>
                          </button>
                        </div>
                      </td>
                      <td>Lori Lynch</td>
                      <td>120</td>
                    </tr>
                  </tbody>
                </table>
                <div class="text-center">
                  <input type="hidden" id="data-page">
                  <input type="hidden" id="data-last">
                  <button type="button" class="btn btn-outline-info btn-sm btn-nav" id="first-page"><i class="fa fa-angle-double-left"></i></button>
                  <button type="button" class="btn btn-outline-info btn-sm btn-nav" id="previous-page"><i class="fa fa-angle-left"></i></button>
                  <button type="button" class="btn btn-outline-info btn-sm btn-nav" id="next-page"><i class="fa fa-angle-right"></i></button>
                  <button type="button" class="btn btn-outline-info btn-sm btn-nav" id="last-page"><i class="fa fa-angle-double-right"></i></button>
                </div>
              </div>
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