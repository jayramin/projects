/*
	Industrious by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
*/
(function($) {

	var	$window = $(window),
		$banner = $('#banner'),
		$body = $('body');

	// Breakpoints.
		breakpoints({
			default:   ['1681px',   null       ],
			xlarge:    ['1281px',   '1680px'   ],
			large:     ['981px',    '1280px'   ],
			medium:    ['737px',    '980px'    ],
			small:     ['481px',    '736px'    ],
			xsmall:    ['361px',    '480px'    ],
			xxsmall:   [null,       '360px'    ]
		});

	// Play initial animations on page load.
		$window.on('load', function() {
			window.setTimeout(function() {
				$body.removeClass('is-preload');
			}, 100);
		});

	// Menu.
		$('#menu')
			.append('<a href="#menu" class="close"></a>')
			.appendTo($body)
			.panel({
				target: $body,
				visibleClass: 'is-menu-visible',
				delay: 500,
				hideOnClick: true,
				hideOnSwipe: true,
				resetScroll: true,
				resetForms: true,
				side: 'right'
			});

})(jQuery);

function checkButons(frm) {

	var re = false; 
 	var err = ''; 

 	var gender = frm.Gender;
 	var hobby = [frm.hobby1, frm.hobby2, frm.hobby3, frm.hobby4];
 	var dob = document.getElementById('dob').value;
	var today = new Date();

	var todayMonth = today.getMonth()+1;
	var todayDay = today.getDate();

	if (todayMonth.toString().length == 1) {
        todayMonth = "0" + todayMonth;
    }
    if (todayDay.toString().length == 1) {
        todayDay = "0" + todayDay;
   	}

	var currentDate = today.getFullYear()+'-'+(todayMonth)+'-'+todayDay;

	if (dob > currentDate) {

		err += '- You should not be select greater than today date \n';
	}

	for(var i=0; i<hobby.length; i++) {
		 if(hobby[i].checked == true) {

			re = true;
		 	break;
	 	}
	}

	if(re == false) {

	  	err += '- You must check at least one hobby \n';
	}

	for(var i=0; i<gender.length; i++) {
		if(gender[i].checked == true) {
			re = true;
			break;
		}
	}

	if (re == false) {
	 	err += '- You must check at least one Gender';
	} 
	if(err != '') {
		alert(err);
	 	return false;
	} else {
		return re;
	} 
}




