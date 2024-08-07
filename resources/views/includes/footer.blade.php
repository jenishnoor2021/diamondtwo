<!--Start footer-->
<footer class="footer">
  <div class="container">
    <div class="text-center">
      Copyright © 2023 Dashtreme Admin
    </div>
  </div>
</footer>
<!--End footer-->

<!--start color switcher-->
<!-- <div class="right-sidebar">
  <div class="switcher-icon">
    <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
  </div>
  <div class="right-sidebar-content">

    <p class="mb-0">Gaussion Texture</p>
    <hr>

    <ul class="switcher">
      <li id="theme1"></li>
      <li id="theme2"></li>
      <li id="theme3"></li>
      <li id="theme4"></li>
      <li id="theme5"></li>
      <li id="theme6"></li>
    </ul>

    <p class="mb-0">Gradient Background</p>
    <hr>

    <ul class="switcher">
      <li id="theme7"></li>
      <li id="theme8"></li>
      <li id="theme9"></li>
      <li id="theme10"></li>
      <li id="theme11"></li>
      <li id="theme12"></li>
      <li id="theme13"></li>
      <li id="theme14"></li>
      <li id="theme15"></li>
    </ul>

  </div>
</div> -->
<!--end color switcher-->

</div><!--End wrapper-->

<!-- Bootstrap core JavaScript-->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

<!-- simplebar js -->
<script src="{{asset('assets/plugins/simplebar/js/simplebar.js')}}"></script>
<!-- sidebar-menu js -->
<script src="{{asset('assets/js/sidebar-menu.js')}}"></script>
<!-- loader scripts -->
<script src="{{asset('assets/js/jquery.loading-indicator.js')}}"></script>
<!-- Custom scripts -->
<script src="{{asset('assets/js/app-script.js')}}"></script>
<!-- Chart js -->

<script src="{{asset('assets/plugins/Chart.js/Chart.min.js')}}"></script>

<!-- Index js -->
<script src="{{asset('assets/js/index.js')}}"></script>
<!-- form validation -->
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
@yield('script')

<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'csrftoken': '{{ csrf_token() }}'
    }
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#master').on('click', function(e) {
      if ($(this).is(':checked', true)) {
        $(".sub_chk").prop('checked', true);
      } else {
        $(".sub_chk").prop('checked', false);
      }
    });
    $('.delete_all').on('click', function(e) {
      var allVals = [];
      $(".sub_chk:checked").each(function() {
        allVals.push($(this).attr('data-id'));
      });
      if (allVals.length <= 0) {
        alert("Please select row.");
      } else {
        var check = confirm("Are you sure you want to delete this row?");
        if (check == true) {
          var join_selected_values = allVals.join(",");
          $.ajax({
            url: $(this).data('url'),
            type: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: 'ids=' + join_selected_values,
            success: function(data) {
              if (data['success']) {
                $(".sub_chk:checked").each(function() {
                  $(this).parents("tr").remove();
                });
                alert(data['success']);
              } else if (data['error']) {
                alert(data['error']);
              } else {
                alert('Whoops Something went wrong!!');
              }
            },
            error: function(data) {
              alert(data.responseText);
            }
          });
          $.each(allVals, function(index, value) {
            $('table tr').filter("[data-row-id='" + value + "']").remove();
          });
        }
      }
    });
    $('[data-toggle=confirmation]').confirmation({
      rootSelector: '[data-toggle=confirmation]',
      onConfirm: function(event, element) {
        element.trigger('confirm');
      }
    });
    $(document).on('confirm', function(e) {
      var ele = e.target;
      e.preventDefault();
      $.ajax({
        url: ele.href,
        type: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
          if (data['success']) {
            $("#" + data['tr']).slideUp("slow");
            alert(data['success']);
          } else if (data['error']) {
            alert(data['error']);
          } else {
            alert('Whoops Something went wrong!!');
          }
        },
        error: function(data) {
          alert(data.responseText);
        }
      });
      return false;
    });
  });
</script>

<!-- read more button in database -->
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">
  $('.read-more-content').addClass('hide_content')
  $('.read-more-show, .read-more-hide').removeClass('hide_content')

  // Set up the toggle effect:
  $('.read-more-show').on('click', function(e) {
    $(this).next('.read-more-content').removeClass('hide_content');
    $(this).addClass('hide_content');
    e.preventDefault();
  });

  // Changes contributed by @diego-rzg
  $('.read-more-hide').on('click', function(e) {
    var p = $(this).parent('.read-more-content');
    p.addClass('hide_content');
    p.prev('.read-more-show').removeClass('hide_content'); // Hide only the preceding "Read More"
    e.preventDefault();
  });
</script>
<!-- read more button end in database -->

<script>
  function formatAadharInput(input) {
    // Remove any non-numeric characters
    input.value = input.value.replace(/\D/g, '');

    // Limit the input length to 12 characters
    if (input.value.length > 12) {
      input.value = input.value.slice(0, 12);
    }

    // Format the input with spaces after every 4 digits
    input.value = input.value.replace(/(\d{4})/g, '$1 ').trim();
  }
</script>
<script>
  $(document).ready(function() {
    // Toggle submenu when clicking on a menu item with class 'has-submenu'
    $('.has-submenu > a').click(function(e) {
      e.preventDefault();
      $(this).parent().toggleClass('active');
      $(this).parent().find('.submenu').toggleClass('active');
    });
  });
</script>

<!-- datatable -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

<script>
  $(document).ready(function() {
    $("#partytable").DataTable();
    $("#workertable").DataTable();
    $("#dailytable").DataTable();
    $("#dimondtable").DataTable();
    $("#dimondprocesstable").DataTable();
    $(".data-table").DataTable();
    $(".data-table1").DataTable();
    $("#workerbarcodelist").DataTable();
  });
</script>

</body>

</html>