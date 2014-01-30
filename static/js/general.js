$(function() {
	$(".tablesorter").tablesorter();
	
	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		
		return false;
	});
	
	jQuery("#EditForm").validationEngine({promptPosition : "centerRight", scroll: true});
	
	$('.input_birthday').datepicker({
		showOn : "button",
		buttonImage : base_url + "static/images/calendar.gif",
		buttonImageOnly : true,
		dateFormat : 'mm/dd/yy',
		changeMonth : true,
		changeYear : true,
		yearRange: '1920:'
	});
	
	$('.input_date').datepicker({
		showOn : "button",
		buttonImage : base_url + "static/images/calendar.gif",
		buttonImageOnly : true,
		dateFormat : 'yy-mm-dd',
		changeMonth : true,
		changeYear : true
	});
	
	$('.input_time').timepicker({
		showOn : "button",
		buttonImage : base_url + "static/images/calendar.gif",
		buttonImageOnly : true,
		hourGrid: 4,
		minuteGrid: 10
	});
	/*
	if ($('aside#sidebar').height() < $(window).height() - 92) {
		$('aside#sidebar').height(($(window).height() - 92));
	}
	*/
	if ($('section#main').height() < $(window).height() - 92) {
		$('section#main').height(($(window).height() - 92));
	}
	
	$('.column').equalHeight();
	

	
	$(window).resize(function() {
		if ($('section#main').height() < $(window).height() - 92) {
			$('section#main').height(($(window).height() - 92));
		}
		
		$('.column').equalHeight();
		
		return;
	});
})

function find_location() {
	var iframe = '<iframe id="popup_iframe" src="'+base_url+'common/find_location.php" title="Find Location" frameborder="0" style="padding:0;"/>';
	$(iframe).dialog({
		autoOpen: true,
		modal : true,
		width : 710,
		height : 600,
		resizable : false,
		open : function(event, ui) {
			$('#popup_iframe').css("width", "700px").attr('scrolling', 'yes').attr("frameborder", 0);
		},
		close : function(event, ui) {
			$('div.ui-dialog').remove();
			$('#popup_iframe').remove();
		}
	});
}

function view_location(latitude, longitude) {
	var iframe = '<iframe id="popup_iframe" src="'+base_url+'common/view_location.php?latitude='+latitude+'&longitude='+longitude+'" title="Find Location" frameborder="0" style="padding:0;"/>';
	$(iframe).dialog({
		autoOpen: true,
		modal : true,
		width : 710,
		height : 600,
		resizable : false,
		open : function(event, ui) {
			$('#popup_iframe').css("width", "700px").attr('scrolling', 'yes').attr("frameborder", 0);
		},
		close : function(event, ui) {
			$('div.ui-dialog').remove();
			$('#popup_iframe').remove();
		}
	});
}

function send_email(user_id) {
	var iframe = '<iframe id="popup_iframe" src="'+base_url+'common/send_email.php?user_id='+user_id+'" title="Send Email" frameborder="0" style="padding:0;"/>';
	$(iframe).dialog({
		autoOpen: true,
		modal : true,
		width : 710,
		height : 400,
		resizable : false,
		open : function(event, ui) {
			$('#popup_iframe').css("width", "700px").attr('scrolling', 'no').attr("frameborder", 0);
		},
		close : function(event, ui) {
			$('div.ui-dialog').remove();
			$('#popup_iframe').remove();
		}
	});
}

function all_checkbox(all_check) {
	if (all_check.attr('checked') == 'checked') {
		$(".all_check").attr('checked', "checked");
	} else {
		$(".all_check").removeAttr('checked');
	}
}