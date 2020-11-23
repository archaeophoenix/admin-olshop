<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <strong>Form Komisi</strong>
            </div>
            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="card-body card-block">
                <div class="row form-group">
                  <div class="col col-md-3">
                    <label for="text-input" class=" form-control-label">persen</label>
                  </div>
                  <div class="col-12 col-md-9 input-group">
                    <input type="text" id="text-input" name="percent" placeholder="10" class="form-control form-input number">
                    <div class="input-group-addon" style="border-radius:0px 50px 50px 0px">
                      <i class="fa fa-percent"></i>
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
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <strong>Riwayat Komisi</strong>
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
                      <th>persen</th>
                      <th>tanggal</th>
                      <th>status</th>
                    </tr>
                  </thead>
                  <tbody id="data-commission">
                    <tr class="tr-shadow">
                      <td>Lori Lynch</td>
                      <td>120</td>
                      <td>120</td>
                    </tr>
                    <tr class="spacer"></tr>
                    <tr class="tr-shadow">
                      <td>Lori Lynch</td>
                      <td>120</td>
                      <td>120</td>
                    </tr>
                    <tr class="spacer"></tr>
                    <tr class="tr-shadow">
                      <td>Lori Lynch</td>
                      <td>120</td>
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