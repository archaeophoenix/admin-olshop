    </div>

  </div>

  <div id="customer-data" style="display: none;">
    [tr class="tr-shadow"]
      [td]
        [div class="table-data-feature"]
          [input type="hidden" id="customer-{{id}}-name" value="{{name}}"]
          [input type="hidden" id="customer-{{id}}-account" value="{{account}}"]
          [input type="hidden" id="customer-{{id}}-phone" value="{{phone}}"]
          [input type="hidden" id="customer-{{id}}-status" value="{{status}}"]
          [input type="hidden" id="customer-{{id}}-subdistrict_name" value="{{subdistrict_name}}"]
          [input type="hidden" id="customer-{{id}}-province" value="{{province}}"]
          [input type="hidden" id="customer-{{id}}-type" value="{{type}}"]
          [input type="hidden" id="customer-{{id}}-city_name" value="{{city_name}}"]
          [input type="hidden" id="customer-{{id}}-address" value="{{address}}"]
          [input type="hidden" id="customer-{{id}}-bank" value="{{bank}}"]
          [button class="item" onclick="redirect('customer-form/{{id}}')" title="Edit"]
            [i class="zmdi zmdi-edit"][/i]
          [/button]
          [button class="item" data-toggle="modal" onclick="customerDetail({{id}});" data-target="#scrollmodal" title="Detail"]
            [i class="fa fa-address-card"][/i]
          [/button]
        [/div]
      [/td]
      [td]{{name}}[/td]
      [td]
        [span class="block-email"]{{phone}}[/span]
      [/td]
      [td class="desc"]
        [span class="block-email"]{{account}}[/span]
      [/td]
      [td]{{status}}[/td]
    [/tr]
    [tr class="spacer"][/tr]
  </div>

  <div id="item-data" style="display: none;">
    [tr class="tr-shadow"]
      [td]
        [div class="table-data-feature"]
          [button class="item" onclick="redirect('item/{{id}}');" title="Edit Nama Item"]
            [i class="zmdi zmdi-edit"][/i]
          [/button]
          [button class="item" data-toggle="modal" onclick="redirect('item/{{id}}/price');" data-target="#scrollmodal" title="Harga Baru"]
            [i class="fa fa-money"][/i]
          [/button]
        [/div]
      [/td]
      [td]{{name}}[/td]
      [td class="desc"]
        [span class="block-email"]{{value}}[/span]
      [/td]
    [/tr]
    [tr class="spacer"][/tr]
  </div>

  <div id="commission-data" style="display: none;">
    [tr class="tr-shadow"]
      [td]{{percent}}%[/td]
      [td class="desc"]
        [span class="badge badge-{{lbl}}"]{{created_at}}[/span]
      [/td]
      [td]{{status}}[/td]
    [/tr]
    [tr class="spacer"][/tr]
  </div>

  <input type="hidden" id="base_url" value="<?php echo $base_url; ?>">

  <!-- Jquery JS-->
  <script src="<?php echo $base_url; ?>vendor/jquery-3.2.1.min.js"></script>
  <script src="<?php echo $base_url; ?>vendor/jquery-ui.min.js"></script>
  <!-- Bootstrap JS-->
  <script src="<?php echo $base_url; ?>vendor/bootstrap-4.1/popper.min.js"></script>
  <script src="<?php echo $base_url; ?>vendor/bootstrap-4.1/bootstrap.min.js"></script>
  <!-- Vendor JS     -->
  <script src="<?php echo $base_url; ?>vendor/slick/slick.min.js">
  </script>
  <script src="<?php echo $base_url; ?>vendor/wow/wow.min.js"></script>
  <script src="<?php echo $base_url; ?>vendor/animsition/animsition.min.js"></script>
  <script src="<?php echo $base_url; ?>vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
  </script>
  <script src="<?php echo $base_url; ?>vendor/counter-up/jquery.waypoints.min.js"></script>
  <script src="<?php echo $base_url; ?>vendor/counter-up/jquery.counterup.min.js">
  </script>
  <script src="<?php echo $base_url; ?>vendor/circle-progress/circle-progress.min.js"></script>
  <script src="<?php echo $base_url; ?>vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="<?php echo $base_url; ?>vendor/chartjs/Chart.bundle.min.js"></script>
  <script src="<?php echo $base_url; ?>vendor/select2/select2.min.js"></script>
  <script src="<?php echo $base_url; ?>js/moment.min.js"></script>
  <script src="<?php echo $base_url; ?>js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?php echo $base_url; ?>js/bootstrap-datetimepicker.js"></script>

  <!-- Main JS-->
  <script src="<?php echo $base_url; ?>js/main.js"></script>

  <script type="text/javascript">
  let base_url = $('#base_url').val();
  let cur_url = window.location.href.replace(base_url, '').split('/');
  let cur_page = cur_url[0];

  $(function () {

    select2css();

    $('#same-customer').click(function(){
      if($(this)[0].checked){
        bindcus();
      } else {
        emptycus();
      }
      select2css();
    });

    $(".customer").autocomplete({
      source:base_url + 'customer-data',
      minLength:1,
      select: function (event, ui) {

        emptycus();

        $('.rescus').hide();
        $("#customer").val(ui.item.label);
        $("#customer2").val(ui.item.id);
        $("#customer3").val(JSON.stringify(ui.item));

        if (ui.item.status == 'Reseller') {

          $('.rescus').show();

          if($('#same-customer')[0].checked){
            bindcus();
          }

          select2css();

        } else {
          emptycus();
          $('.rescus').hide();
        }
      }
    });

    $(".subdistrict").autocomplete({
      source:base_url + 'subdistrict-data',
      minLength:3,
      select: function (event, ui) {
        $("#subdistrict_name").val(ui.item.label);
        $("#subdistrict_id").val(ui.item.subdistrict_id);
      }
    });

    $('.datetimepicker').datetimepicker({
      format: 'DD/MM/YYYY'
    });

    $('.number').on('input blur paste', function(){
     $(this).val($(this).val().replace(/[^0-9.]/g, '').replace(/\.(?=.*\.)/g, ''));
    });

    $('#data-search').on('input blur paste', function(){
      customer();
    });

    $('#first-page').click(function(){
      customer(1);
    });

    $('#previous-page').click(function(){
      customer(parseInt($('#data-page').val()) - 1);
    });

    $('#next-page').click(function(){
      customer(parseInt($('#data-page').val()) + 1);
    });

    $('#last-page').click(function(){
      customer($('#data-last').val());
    });

    switch (cur_page) {
      case 'customer':
        customer();
      break;

      case 'item':
        item();
      break;

      case 'commission':
        commission();
      break;
    }

  });

  function emptycus(){
    $('#name').val('');
    $('#phone').val('');
    $('#code').select2().val('').trigger('change');
    $('#account').val('');
    $('#address').val('');
    $('#subdistrict_name').val('');
    $('#subdistrict_id').val('');
  }

  function bindcus(){
    let data = JSON.parse($("#customer3").val());
    $('#name').val(data.name);
    $('#phone').val(data.phone);
    $('#code').select2().val(data.code).trigger('change');
    $('#account').val(data.account);
    $('#address').val(data.address);
    $('#subdistrict_name').val(data.subdistrict_name);
    $('#subdistrict_id').val(data.subdistrict_id);
  }

  function select2css(){
    $('.select2-selection').attr('style','border-radius:50px; height:38px;');
    $('.select2-dropdown').attr('style','border-radius:15px;');
    $('.select2-search').attr('style','border-radius:15px;');
  }

  function newTab(url){
    window.open(base_url + url);
  }

  function redirect(url){
    window.location = base_url + url;
  }

  function goBack() {
    window.history.back();
  }

  function rupiah(number){
    number = (isNaN(number)) ? 0 : number ;
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
  }

  function dateTimeId(string) {
    bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September' , 'Oktober', 'November', 'Desember'];
   
    date = string.split(" ")[0];
    time = string.split(" ")[1];
   
    tanggal = date.split("-")[2];
    bulan = date.split("-")[1];
    tahun = date.split("-")[0];
 
    return tanggal + " " + bulanIndo[Math.abs(bulan)] + " " + tahun + " " + time;
  }

  function customerDetail(id){

    let name = $('#customer-' + id + '-name').val();
    let account = $('#customer-' + id + '-account').val();
    let phone = $('#customer-' + id + '-phone').val();
    let status = $('#customer-' + id + '-status').val();
    let subdistrict_name = $('#customer-' + id + '-subdistrict_name').val();
    let province = $('#customer-' + id + '-province').val();
    let type = $('#customer-' + id + '-type').val();
    let city_name = $('#customer-' + id + '-city_name').val();
    let address = $('#customer-' + id + '-address').val();
    let bank = $('#customer-' + id + '-bank').val();
    
    $('#customer-name').text(name);
    $('#customer-account').text(bank + '  ' + account);
    $('#customer-phone').text(phone);
    $('#customer-status').text(status);
    $('#customer-address').html(address + '<br> Kecamatan ' + subdistrict_name + '<br>' + type + ' ' + city_name + '<br>' + province);
  }

  async function customer(page = 1){
    let html = '';
    let lmth = '';
    let pages = '&page=' + page;
    let name = ($('#data-search').val()) ? '&term=' + $('#data-search').val() + '|' : '' ;
    let data = await $.get(base_url + 'customer-data/?' + pages + name);
    let customer = $('#customer-data').html();
    let datac = data.data;

    for(let q in datac){
      lmth = customer;
      lmth = lmth.replace(/\[/g, '<');
      lmth = lmth.replace(/]/g, '>');
      lmth = lmth.replace(/{{id}}/g, datac[q].id);
      lmth = lmth.replace(/{{name}}/g, datac[q].name);
      lmth = lmth.replace(/{{account}}/g, datac[q].account);
      lmth = lmth.replace(/{{phone}}/g, datac[q].phone);
      lmth = lmth.replace(/{{status}}/g, datac[q].status);
      lmth = lmth.replace(/{{subdistrict_name}}/g, datac[q].subdistrict_name);
      lmth = lmth.replace(/{{province}}/g, datac[q].province);
      lmth = lmth.replace(/{{type}}/g, datac[q].type);
      lmth = lmth.replace(/{{city_name}}/g, datac[q].city_name);
      lmth = lmth.replace(/{{address}}/g, datac[q].address);
      lmth = lmth.replace(/{{bank}}/g, datac[q].bank);
      html += lmth;
    }

    $('#data-page').val(data.page);
    $('#data-last').val(data.pages);
    $('#data-customer').html(html);

    if (data.page == 1) {
      $('#first-page').hide();
      $('#previous-page').hide();
    } else {
      $('#first-page').show();
      $('#previous-page').show();
    }

    if (data.page == data.pages) {
      $('#next-page').hide();
      $('#last-page').hide();
    } else {
      $('#next-page').show();
      $('#last-page').show();
    }
  }

  async function item(page = 1){
    let html = '';
    let lmth = '';
    let pages = '&page=' + page;
    let name = ($('#data-search').val()) ? '&term=' + $('#data-search').val() + '|' : '' ;
    let data = await $.get(base_url + 'item-data/?' + pages + name);
    let customer = $('#item-data').html();
    let datac = data.data;

    for(let q in datac){
      lmth = customer;
      lmth = lmth.replace(/\[/g, '<');
      lmth = lmth.replace(/]/g, '>');
      lmth = lmth.replace(/{{id}}/g, datac[q].id);
      lmth = lmth.replace(/{{name}}/g, datac[q].name);
      lmth = lmth.replace(/{{value}}/g, rupiah(datac[q].value));
      html += lmth;
    }

    $('#data-page').val(data.page);
    $('#data-last').val(data.pages);
    $('#data-item').html(html);

    if (data.page == 1) {
      $('#first-page').hide();
      $('#previous-page').hide();
    } else {
      $('#first-page').show();
      $('#previous-page').show();
    }

    if (data.page == data.pages) {
      $('#next-page').hide();
      $('#last-page').hide();
    } else {
      $('#next-page').show();
      $('#last-page').show();
    }
  }

  async function commission(page = 1){
    let html = '';
    let lmth = '';
    let pages = '&page=' + page;
    let name = ($('#data-search').val()) ? '&term=' + $('#data-search').val() + '|' : '' ;
    let data = await $.get(base_url + 'commission-data/?' + pages + name);
    let customer = $('#commission-data').html();
    let datac = data.data;

    for(let q in datac){
      lmth = customer;
      let sts = (datac[q].status == 'Aktif') ? 'check' : 'times';
      let lbl = (datac[q].status == 'Aktif') ? 'primary' : 'danger';

      lmth = lmth.replace(/\[/g, '<');
      lmth = lmth.replace(/]/g, '>');
      lmth = lmth.replace(/{{lbl}}/g, lbl);
      lmth = lmth.replace(/{{percent}}/g, datac[q].percent);
      lmth = lmth.replace(/{{created_at}}/g, dateTimeId(datac[q].created_at));
      lmth = lmth.replace(/{{status}}/g, '<span class="badge badge-' + lbl + '"><i class="fa fa-' + sts + '"></i></span>');
      html += lmth;
    }

    $('#data-page').val(data.page);
    $('#data-last').val(data.pages);
    $('#data-commission').html(html);

    if (data.page == 1) {
      $('#first-page').hide();
      $('#previous-page').hide();
    } else {
      $('#first-page').show();
      $('#previous-page').show();
    }

    if (data.page == data.pages) {
      $('#next-page').hide();
      $('#last-page').hide();
    } else {
      $('#next-page').show();
      $('#last-page').show();
    }
  }
  </script>

</body>

</html>
<!-- end document-->
