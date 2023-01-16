<!--Footer-->
<div id="content" class="content container-fluid">
    <div class="footer">© <?php echo date('Y'); ?> Copyright</div>
    </div>
<!-- CHECK WHY FOOTER NOT BEING DISPLAYED-->
    <!--Welcome notification-->
    <div id="welcome"></div>

    <!--Members Sidebar-->
    <div id="members-sidebar" class="members-sidebar">
      <h4 class="pull-left zero-m">Members</h4>
      <span class="close-members-sidebar"><i class="fa fa-remove pull-right"></i></span>
      <div class="clearfix"></div>
      <ul class="nav">
        <li>
          <div class="messages">
            <div class="member-info">
              <img src="img/team/admin.png" alt="admin" class="img-circle pull-left">
              <span class="member-name">Sash Ficus</span>
              <p class="members-message zero-m">Sushi time)))</p>
            </div>
            <div class="member-info">
              <img src="img/team/admin.png" alt="admin" class="img-circle pull-left">
              <span class="member-name">Sash Ficus</span>
              <p class="members-message zero-m">Working hard</p>
            </div>
          </div>
        </li>
        <li class="members-group">Work</li>
        <li><span class="status online"></span>Sash Ficus</li>
        <li><span class="status online"></span>Sash Ficus</li>
        <li><span class="status not-available"></span>Sash Ficus</li>
        <li><span class="status"></span>Sash Ficus</li>
        <li><span class="status"></span>Sash Ficus</li>
        <li><span class="status"></span>Sash Ficus</li>
        <li><span class="status"></span>Sash Ficus</li>
        <li><span class="status"></span>Sash Ficus</li>
        <li><span class="status"></span>Sash Ficus</li>
        <li class="members-group">Partner</li>
        <li><span class="status"></span>Sash Ficus</li>
        <li><span class="status"></span>Sash Ficus</li>
        <li><span class="status"></span>Sash Ficus</li>
        <li><span class="status"></span>Sash Ficus</li>
      </ul>
    </div>

    </div>
<div class="login-modal modal fade">
      <div class="table-wrapper">
        <div class="table-row">
          <div class="table-cell text-center">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="login i-block">
              <div class="content-box">
                <div class="light-blue-bg biggest-box">

                  <h1 class="zero-m text-uppercase">Welcome</h1>

                </div>
                <div class="big-box text-left login-form">
                  <h4 class="text-center">Login</h4>
                  <form>
                    <div class="form-group">
                      <input type="text" class="form-control material" id="login" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control material" id="password" placeholder="Password">
                    </div>

                    <button type="submit" class="btn btn-block btn-info text-uppercase waves">Login</button>

                  </form>
                  <a href="#" class="green i-block">Forgot password?</a>
                  <p>Do not have an account?</p>
                  <a class="btn btn-block btn-warning text-uppercase waves waves-button">Create an account</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="logout-modal modal fade">
      <div class="table-wrapper">
        <div class="table-row">
          <div class="table-cell text-center">
            <div class="login i-block">
              <div class="content-box">
                <div class="light-blue-bg biggest-box">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h3 class="zero-m text-uppercase">Do you want to exit?</h3>
                  <a href="#" class="i-block" data-dismiss="modal">Yes</a>
                  <a href="#" class="i-block" data-dismiss="modal">No</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>

    <!--Scripts-->
 
  
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>
  <script src="bower_components/Waves/dist/waves.min.js"></script>
  <script src="bower_components/moment/min/moment.min.js"></script>
  <script src="bower_components/jquery.nicescroll/jquery.nicescroll.min.js"></script>
  <script src="bower_components/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.js"></script>
  <script src="bower_components/cta/dist/cta.min.js"></script>
  
  <!--Menu-->
  <script src="js/menu/classie.js"></script>
  <script src="js/menu/gnmenu.js"></script>

  <!--Selects-->
  <script src="js/selects/selectFx.js"></script>

  <!--Flot-->
  <script src="bower_components/flot/jquery.flot.js"></script>
  <script src="bower_components/flot/jquery.flot.resize.js"></script>
  <script src="bower_components/flot.curvedlines/curvedLines.js"></script>
  <script src="js/flot/jquery.flot.orderBars.js"></script>

  <!--Custom Flot Charts-->
  <script src="js/flot/line-chart-1.js"></script>
  <script src="js/flot/line-chart-2.js"></script>
  <script src="js/flot/line-chart-3.js"></script>
  <script src="js/flot/bar-chart.js"></script>
  <!--C3.js-->
  <script src="bower_components/d3/d3.min.js"></script>
  <script src="bower_components/c3/c3.min.js"></script>
  <!--EasyPieChart-->
  <script src="bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
  <!--Zabuto Calendar-->
  <script src="bower_components/zabuto_calendar/zabuto_calendar.min.js"></script>
  <!--Simple Weather-->
  <script src="bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
  <!--Notification-->
  <script src="js/notifications/notificationFx.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/bootstrap-dialog/bootstrap-dialog.js"></script>
  <script src="js/custom.js"></script> 
<script src="bower_components/DataTables/media/js/jquery.dataTables.js"></script>
  <script src="bower_components/datatables.net-responsive/js/dataTables.responsive.js"></script>
  <script src="bower_components/datatables-tabletools/js/dataTables.tableTools.js"></script>
  
  
  <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>
 
    <!--Custom Scripts-->
  <script src="js/common.js"></script>
<!--<script src="js/jquery.maskedinput.min.js"></script>-->
  
  
  
  <script>
    $(function () {
      //Data Tables
      $('#datatable').DataTable({
        displayLength: 25,
        dom: 'T<"clear">lfrtip',
        tableTools: {
          "sSwfPath": "js/datatables/copy_csv_xls_pdf.swf"
        },
        responsive: true
      });
    });
    
    $(function () {
      // show the notification
//      setTimeout(function () {
//        // create the notification
//        var notification = new NotificationFx({
//          message: '<span>Welcome back,Admin!</span>',
//          layout: 'attached',
//          effect: 'bouncyflip',
//          ttl: 4000,
//          wrapper: document.getElementById("welcome"),
//          type: 'notice', // notice, warning, success or error
//        });
//        notification.show();
//      }, 1200);

      /*c3.js*/
      var chart = c3.generate({
        bindto: '#reg-history',
        size: {
          height: 90
        },
        data: {
          columns: [
            ['New users', 30, 35, 45, 33, 48, 54, 41, 66, 49, 43, 38, 46]
          ]
        },
        legend: {
          show: false
        },
        color: {
          pattern: ['#fff']
        },
        point: {
          r: 3
        },
        axis: {
          x: {
            show: false
          },
          y: {
            show: false
          }
        }
      });
      //EasyPieChart
//      $('.easypiechart').easyPieChart({
//        lineCap: 'square',
//        trackColor: '#cccccc',
//        barColor: '#42b382',
//        lineWidth: 5,
//        scaleLength: 0
//      });

      //Zabuto Calendar
//      $("#calendar-widget").zabuto_calendar({
//        language: "en",
//        cell_border: false,
//        today: true,
//        show_days: true,
//        nav_icon: {
//          prev: '<i class="fa fa-chevron-left"></i>',
//          next: '<i class="fa fa-chevron-right"></i>'
//        }
//      });

      //Simple Weather
      /* Does your browser support geolocation? */
//      if ("geolocation" in navigator) {
//        $('#weather').show();
//      } else {
//        $('#weather').hide();
//      }

//      function geolocation() {
//        navigator.geolocation.getCurrentPosition(positionFound, positionNotFound)
//      }
//      geolocation();

//      function positionFound(position) {
//        loadWeather(position.coords.latitude + ',' + position.coords.longitude); //load weather using your lat/lng coordinates
//      }

//      function positionNotFound(error) {
//        $("#weather").html('<div class="big-box yellow">Permission to check your location is denied. To allow it go to your browser settings.</div>'); //showing warning message about browsers permissions
//      }


//      function loadWeather(location, woeid) {
//        $.simpleWeather({
//          location: location,
//          woeid: woeid,
//          unit: 'c',
//          success: function (weather) {
//            //Weather widget markup
//            html = '<div class="weather-container text-center"><h4 class="weather-city zero-m">Weather forecast in ' + weather.city + '</h4><div class="i-block big-box"><i class="block yellow icon-' + weather.forecast[0].code + '"></i>' + weather.forecast[0].day + ' / ' + weather.forecast[0].high + '&deg;C</div>';
//            html += '<div class="i-block big-box"><i class="block blue icon-' + weather.forecast[1].code + '"></i>' + weather.forecast[1].day + ' / ' + weather.forecast[1].high + '&deg;C</div>';
//            html += '<div class="i-block big-box"><i class="block red icon-' + weather.forecast[2].code + '"></i>' + weather.forecast[2].day + ' / ' + weather.forecast[2].high + '&deg;C</div></div>';
//
//
//            $("#weather").html(html);
//          },
//          error: function (error) {
//            $("#weather").html('<p>' + error + '</p>');
//          }
//        });
//      }

      //Tooltips for Flot Charts
//      if ($(".flot-chart")[0]) {
//        $(".flot-chart").bind("plothover", function (event, pos, item) {
//          if (item) {
//          var x = item.datapoint[0].toFixed(2),
//            y = item.datapoint[1].toFixed(2);
//
//          $(".flot-tooltip").html(x + " of " + y)
//            .css({top: item.pageY+5, left: item.pageX+5})
//            .fadeIn(200);
//        } else {
//          $(".flot-tooltip").hide();
//        }
//        });
//
//        $("<div class='flot-tooltip'></div>").appendTo("body");
//      }
    });
  </script>


</body>


<!-- Mirrored from 91.234.35.26/advantage-admin/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Aug 2016 05:19:36 GMT -->
</html>
