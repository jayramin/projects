<html>
<title>::Home Page</title>
<link rel="stylesheet" type="text/css" href="css/homepage.css">
<link rel="stylesheet" type="text/css" href="css/commmon_css.css">
<style type="text/css">
		* { margin: 0; outline: none; }
		body {  }
		.c { clear: both; }
		#wrapper { margin: 0 auto; padding: 0 40px 60px 40px; width: 960px; }
		h2 { padding: 20px 0 10px 0; font-size: 24px; line-height: 40px; font-weight: normal; color: #adc276; text-shadow: 0 1px 3px #222222; }
	</style>

	<!-- sliderman.js -->
	<script type="text/javascript" src="js/sliderman.1.3.7.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sliderman.css" />
</head>
<body>
<div id="bodymain">
	<?php
	include "menu1.php";
	?>
	<div id="frame">
	<div id="body">
	<div id="slider">
		<div id="wrapper">
		<div id="examples_outer">
			
			<div id="slider_container_1">

				<div id="SliderName">

					<a href="#1">
						<img src="img/1.jpg" title="Description from Image Title" />
					</a>
					<div class="SliderNameDescription">
						<img src="img/2.jpg" height="40" style="float:left;margin-right:5px;" />
						<strong>Nulla luctus congue fermentum.</strong><br />Integer <a href="javascript:void(0);">elementum</a> convallis lorem eu volutpat. Suspendisse fermentum arcu in lorem fringilla ultricies. Nam vel diam nisi.
					</div>
					<a href="#2">
						<img src="img/2.jpg" />
					</a>
					<img src="img/3.jpg" />
					<div class="SliderNameDescription"><a href="#3">Link</a></div>
					<img src="img/4.jpg" />
					<div class="SliderNameDescription"><strong>Nullam nec velit vel leo tristique commodo.</strong><br />Nulla facilisi. Fusce lacus massa, ullamcorper sed hendrerit quis, venenatis eget tortor.</div>
				</div>
				<div class="c"></div>
				<div id="SliderNameNavigation"></div>
				<div class="c"></div>

				<script type="text/javascript">

					// we created new effect and called it 'demo01'. We use this name later.
					Sliderman.effect({name: 'demo01', cols: 10, rows: 5, delay: 10, fade: true, order: 'straight_stairs'});

					var demoSlider = Sliderman.slider({container: 'SliderName', width: 670, height: 224, effects: 'demo01',
					display: {
						pause: true, // slider pauses on mouseover
						autoplay: 3000, // 3 seconds slideshow
						always_show_loading: 200, // testing loading mode
						description: {background: '#ffffff', opacity: 0.5, height: 50, position: 'bottom'}, // image description box settings
						loading: {background: '#000000', opacity: 0.2, image: 'img/loading.gif'}, // loading box settings
						buttons: {opacity: 1, prev: {className: 'SliderNamePrev', label: ''}, next: {className: 'SliderNameNext', label: ''}}, // Next/Prev buttons settings
						navigation: {container: 'SliderNameNavigation', label: '&nbsp;'} // navigation (pages) settings
					}});

				</script>

				<div class="c"></div>
			</div>
			<div class="c"></div>
		</div>

		<div class="c"></div>
	</div>
	</div>
	<div id="login"> 
	<div id="line">
	<center><caption ><h3 style="margin-top:5px;color:white;">Login</h3></caption></center>
	</div>
	<form action="Login_Action.php" method="POST" >
	<table align="center" style="margin-top:20px;">
	<tr>
  	<td>Username</td> <td> <input type="text" name="uname" placeholder="User name" id="uname" style="width:200px; height:30px; border-radius:5px;">
	</td>
	</tr>
  	<tr>
  	<td>password</td> <td> <input type="password" name="pass" placeholder="********" style="width:200px; height:30px; border-radius:5px;" id="pass"></td>
  	</tr>
	<tr>
  	<td>Type</td>
	<td>
	<select name="type" style="width:200px; height:30px; border-radius:5px;"> 
	<option value="Admin">Admin</option>
	<option value="Faculty">Faculty</option>
	<option value="Student">Student</option>
	</select>
	</td>
	</tr>
	<tr>
	<td><center><input type="Submit" value="Login" style="height:30px; width:90px; background-color:#666;
    color:white; margin-right:-90px"></center></td>
    <td><center><input type="Reset" value="Reset" style="height:30px; width:90px; background-color:#666;
    color:white;"></center></td>
	</tr>
	
	</tr>
	</table>
	</form>
	</div>
	<div id="body1"> <div id="line"><center><p style="  font-size:20px; color:white;">Notice-Board</p></center></div>
	<marquee direction="down" scrollamount="4" height="170px" width="200px" style="margin-left:20px; margin-top:10px;"
	onmouseover=stop() onmouseout=start()>
	<p>Message 1</p><br>
	<p>Message 1</p><br>
	<p>Message 1</p><br>
	<p>Message 1</p><br>
	<p>Message 1</p><br>
	</marquee>
	</div>
	<div id="body2"> <div id="line"></div>
	</div>
	<div id="body3"> <div id="line"></div>
	</div> </div>
</div>
<div id="footer"> <div style="text-align:center; color:white; font-size:18px; "> All Rights Reserved@WWW.onlineexam.com </div>
</div>
</div>
</body>
</html>