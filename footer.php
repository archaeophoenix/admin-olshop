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
  let cur_page = window.location.href.replace(base_url, '');
  // console.log(window.location.href);
  $(function () {
    $('.datetimepicker').datetimepicker({
      format: 'DD/MM/YYYY'
    });

    $('.number').on('input blur paste', function(){
     $(this).val($(this).val().replace(/\D/g, ''));
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
    }

  });

  function redirect(url){
    window.location = base_url + url;
  }

  function rupiah(number){
    number = (isNaN(number)) ? 0 : number ;
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
  }

  function customerDetail(id){
    // $('.customer-' + id).each(function(){});
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
    let name = ($('#data-search').val()) ? '&name=' + $('#data-search').val() : '' ;
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

  async function getData(url){
    let data = await $.get(base_url + url);
    return JSON.parse(data);
  }

  async function postData(url, datas){
    let data = await $.get(base_url + url, datas);
    return JSON.parse(data);
  }
  </script>

</body>

</html>
<!-- end document-->
