<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!-- DATA TABLE -->
          <h3 class="title-5 m-b-35">data pelanggan</h3>
          <div class="table-data__tool">
            <div class="table-data__tool-left">
              <button style="border-radius: 50px;" onclick="redirect('customer-form')" class="btn btn-outline-success btn-md"><i class="zmdi zmdi-plus"></i> Tambah Data</button>
              <!--<div class="rs-select2--light rs-select2--md">
                <select class="js-select2" name="property">
                  <option selected="selected">All Properties</option>
                  <option value="">Option 1</option>
                  <option value="">Option 2</option>
                </select>
                <div class="dropDownSelect2"></div>
              </div>
              <div class="rs-select2--light rs-select2--sm">
                <select class="js-select2" name="time">
                  <option selected="selected">Today</option>
                  <option value="">3 Days</option>
                  <option value="">1 Week</option>
                </select>
                <div class="dropDownSelect2"></div>
              </div>
              <button class="au-btn-filter"><i class="zmdi zmdi-filter-list"></i>filters</button>-->
            </div>
            <div class="table-data__tool-right">
              <!-- <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                <div class="dropDownSelect2"></div>
              </div> -->
              <div class="input-group">
                <input type="text" id="data-search" name="text-input" placeholder="Text" class="form-input form-control">
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
                  <th>telepon</th>
                  <th>rekening</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="data-customer">
                <tr class="tr-shadow">
                  <td>Lori Lynch</td>
                  <td>
                    <span class="block-email">lori@example.com</span>
                  </td>
                  <td class="desc">Samsung S8 Black</td>
                  <td>2018-09-27 02:12</td>
                  <td>
                    <div class="table-data-feature">
                      <button class="item" data-toggle="modal" data-target="#scrollmodal" title="Edit">
                        <i class="zmdi zmdi-edit"></i>
                      </button>
                      <button class="item" data-toggle="modal" data-target="#scrollmodal" title="Detail">
                        <i class="fa fa-address-card"></i>
                      </button>
                    </div>
                  </td>
                </tr>
                <tr class="spacer"></tr>
                <tr class="tr-shadow">
                  <td>Lori Lynch</td>
                  <td>
                    <span class="block-email">john@example.com</span>
                  </td>
                  <td class="desc">iPhone X 64Gb Grey</td>
                  <td>2018-09-29 05:57</td>
                  <td>
                    <div class="table-data-feature">
                      <button class="item" data-toggle="modal" data-target="#scrollmodal" title="Edit">
                        <i class="zmdi zmdi-edit"></i>
                      </button>
                      <button class="item" data-toggle="modal" data-target="#scrollmodal" title="Detail">
                        <i class="fa fa-address-card"></i>
                      </button>
                    </div>
                  </td>
                </tr>
                <tr class="spacer"></tr>
                <tr class="tr-shadow">
                  <td>Lori Lynch</td>
                  <td>
                    <span class="block-email">lyn@example.com</span>
                  </td>
                  <td class="desc">iPhone X 256Gb Black</td>
                  <td>2018-09-25 19:03</td>
                  <td>
                    <div class="table-data-feature">
                      <button class="item" title="Edit">
                        <i class="zmdi zmdi-edit"></i>
                      </button>
                      <button class="item" data-toggle="modal" data-target="#scrollmodal" title="Detail">
                        <i class="fa fa-address-card"></i>
                      </button>
                    </div>
                  </td>
                </tr>
                <tr class="spacer"></tr>
                <tr class="tr-shadow">
                  <td>Lori Lynch</td>
                  <td>
                    <span class="block-email">doe@example.com</span>
                  </td>
                  <td class="desc">Camera C430W 4k</td>
                  <td>2018-09-24 19:10</td>
                  <td>
                    <div class="table-data-feature">
                      <button class="item" data-toggle="modal" data-target="#scrollmodal" title="Edit">
                        <i class="zmdi zmdi-edit"></i>
                      </button>
                      <button class="item" data-toggle="modal" data-target="#scrollmodal" title="Detail">
                        <i class="fa fa-address-card"></i>
                      </button>
                    </div>
                  </td>
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
          <!-- END DATA TABLE -->
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

<div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scrollmodalLabel">Detail Pelanggan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body row">
        <div class="col-md-6">
          <aside class="profile-nav alt">
            <section class="card">
              <ul class="list-group list-group-flush">
                <li class="list-group-item row">
                  <i class="col-md-2 fa fa-user"></i>
                  <label class="col-md-10 pull-right" id="customer-name"> Mail Inbox</label>
                </li>
                <li class="list-group-item row">
                  <i class="col-md-2 fa fa-credit-card"></i>
                  <span class="col-md-10 pull-right" id="customer-account">15</span>
                </li>
                <li class="list-group-item row">
                  <i class="col-md-2 fa fa-tablet"></i>
                  <span class="col-md-10 pull-right" id="customer-phone">11</span>
                </li>
                <li class="list-group-item row">
                  <i class="col-md-2 fa fa-sitemap"></i>
                  <span class="col-md-10 pull-right" id="customer-status">03</span>
                </li>
              </ul>
            </section>
          </aside>
        </div>
        <div class="col-md-6">
          <aside class="profile-nav alt">
            <section class="card">
              <ul class="list-group list-group-flush">
                <li class="list-group-item row">
                  <i class="col-md-2 fa fa-home"></i>
                  <label class="col-md-10 pull-right" id="customer-address">asdasd</label>
                </li>
              </ul>
            </section>
          </aside>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Confirm</button>
      </div> -->
    </div>
  </div>
</div>