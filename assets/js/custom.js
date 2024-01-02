( function ( $ ) {
    'use strict';

//####################################
//#####                          #####
//#####         General          #####
//#####                          #####
//####################################

$.puertosend = function(Fid, Faj, Fty = 'modal', Fred = ''){
	$(Fid).on("submit", function(){
		var ths = $(this);
		var btn  = ths.find('button[type=submit]');
		var msg  = ths.find('.pt-msg');
		var btxt = btn.html();
		var form = Faj == "sendpaypalitem" ? $("#payment-form") : $(this);

		btn.prop('disabled', true).html('<i class="fas fa-spinner fa-pulse fa-fw"></i> Loading..');

		$.post(path+"/ajax.php?pg="+ Faj, form.serialize(), function(puerto){
			try {
				var puerto = JSON.parse(puerto);
				if(Fty == 'modal'){
					if(puerto.type == 'success'){
						$.puerto_confirm("Success!", puerto.alert, "green");
						setTimeout(function () {
							if(Faj == 'sendpaypalitem' || Faj == 'sendpaypalplan') $(location).attr('href', puerto.url);
							else {
								if(Fred) $(location).attr('href', path+"/"+Fred);
								else location.reload();
							}
						}, 2000);
					} else {
						$.puerto_confirm("Error!", puerto.alert, "red");
						btn.html(btxt).prop('disabled', false);
					}
				} else {
					msg.before(puerto.alert);
					if(puerto.type == "danger"){
						setTimeout(function () {
							$(".alert").fadeOut('slow').remove();
							btn.html(btxt).prop('disabled', false);
						}, 3000);
					} else {
						setTimeout(function () {
							$(".alert").fadeOut('slow').remove();
							if(Faj == "sendsignup"){
								$("#registerModal").modal("hide");
								$("input[name=sign_name]").val($("input[name=reg_name]").val());
								$("input[name=sign_pass]").val($("input[name=reg_pass]").val());
							} else {
								if(Fred) $(location).attr('href', path+"/"+Fred);
								else location.reload();
							}
						}, 3000);
					}
				}
			} catch (e) {
				console.log(puerto);
			}

		});
		return false;
	});
}

//- Droped menu

$.puerto_droped = function( prtclick, prtlist = "ul.pt-drop" ){
	$(prtclick).livequery('click', function(){
		var ul = $(this).parent();
		if( ul.find(prtlist).hasClass('open') ){
			ul.find(prtlist).removeClass('open');
			$(this).removeClass('active');
			if(prtclick == ".pl-mobile-menu") $('body').removeClass('active');
		} else {
			$("ul.pt-drop").parent().find(".active").removeClass('active');
			$("ul.pt-drop").removeClass('open');
			ul.find(prtlist).addClass('open');
			$(this).addClass('active');
			if(prtclick == ".pl-mobile-menu") $('body').addClass('active');
		}
		return false;
	});
	$("html, body").livequery('click', function(){
		$("ul.pt-drop").parent().find(".active").removeClass('active');
		$("ul.pt-drop").removeClass('open');
		if(prtclick == ".pl-mobile-menu") $('body').removeClass('active');
	});
}

$.puerto_droped(".pt-options-link");
$.puerto_droped(".pt-user");
$.puerto_droped(".pt-mobile-menu");


//- Textarea auto resize


if($(".pt-countries select").length){
$(".pt-countries select").livequery("change", function(){
	$(".pt-countries").find('.pt-icon i').attr('class', 'flag-icon flag-icon-'+$(this).val().toLowerCase().replace(/<[^>]+>/g, ''));
});
}

//- Datepicker
if($('#datepicker, .datepicker-here, [id^=datepicker]').length){
$('#datepicker, .datepicker-here, [id^=datepicker]').datepicker({ language:'en', timepicker: true, timeFormat:"hh:ii aa" });
if($('#datepicker, .datepicker-here, [id^=datepicker]').val()){
	$('#datepicker, .datepicker-here, [id^=datepicker]').each(function(){
		var ths_d = $(this);
		var ths_dv = $(this).val();
		setTimeout(function () {
			ths_d.val(ths_dv);
		}, 3010);
	});
}
}

//- Phone Mask
if($('[type=phone], [type=email]').length){
$('[type=phone]').mask(phonemask);
$('[type=email]').mask("A", {
	translation: {
		"A": { pattern: /[\w@\-.+]/, recursive: true }
	}
});
}

//- Puerto Confirm

$.puerto_confirm = function( tit, aler, col) {
	$.confirm({
			icon: ( col == 'green' ? 'far fa-laugh-wink' : 'far fa-surprise'),
			theme: 'modern',
			closeIcon: true,
			animation: 'scale',
			type: col,
			title: tit,
			content: aler,
			buttons: false
	});
}


//- Scroll Bar
if($('.pt-scroll').length){
$(document).ready(function(){
  $('.pt-scroll').scrollbar();
});
}


//- Tooltip
$('[data-toggle="tooltip"]').tooltip();



//####################################
//#####                          #####
//#####       New Survey         #####
//#####                          #####
//####################################


//- Wysibb Editor
if($("#wysibb-editor").length){
	var textarea = document.getElementById('wysibb-editor');
	sceditor.create(textarea, {
		format: 'bbcode',
		style: path+'/assets/js/minified/themes/content/default.min.css',
		emoticonsRoot: path+'/assets/js/minified/',
		height: 400,
		toolbarExclude: 'indent,outdent,email,date,time,ltr,rtl,print,subscript,superscript,table,code,quote,emoticon',
		icons: 'material',
	});
	var body = sceditor.instance(textarea).getBody();
	sceditor.instance(textarea).keyUp(function(e) {
		$('.textarea-welcome').html($(body).html());
	});
}

if($("#wysibb-editor1").length){
	var textarea1 = document.getElementById('wysibb-editor1');
	sceditor.create(textarea1, {
		format: 'bbcode',
		style: path+'/assets/js/minified/themes/content/default.min.css',
		emoticonsRoot: path+'/assets/js/minified/',
		height: 400,
		toolbarExclude: 'indent,outdent,email,date,time,ltr,rtl,print,subscript,superscript,table,code,quote,emoticon',
		icons: 'material',
	});
	var body1 = sceditor.instance(textarea1).getBody();
	sceditor.instance(textarea1).keyUp(function(e) {
		$('.textarea-thank').html($(body1).html());
	});
}

if($("#wysibb-editor3").length){
	var textarea3 = document.getElementById('wysibb-editor3');
	sceditor.create(textarea3, {
		format: 'bbcode',
		style: path+'/assets/js/minified/themes/content/default.min.css',
		emoticonsRoot: path+'/assets/js/minified/',
		height: 400,
		toolbarExclude: 'indent,outdent,email,date,time,ltr,rtl,print,subscript,superscript,table,code,quote,emoticon',
		icons: 'material',
	});
}

$("[id^='wysibbs']").each(function(){
	var id = $(this).attr('id');
	console.log(id);
	sceditor.create(document.getElementById(id), {style: path+'/assets/js/minified/themes/content/default.min.css',format: 'bbcode', toolbar: 'bold,italic,underline,strike,|,left,center,right,justify,|,copy,paste,|,size,color,|,bulletlist,orderedlist,|,image,link,unlink,|,source',icons: 'material',height: 200});
});



//- Icon Picker

if($('.my').length){
 $('.my').iconpicker({placement: 'bottom'});
}

if($('.pt-editsurveypage').length){
	$('.my').on('iconpickerSelected', function(event){
 	 	$(this).next('.changeicon').html('<i class="'+event.iconpickerValue+'"></i>');
 	 	$('span[role="'+$(this).attr('name')+'"]').html('<i class="'+$( this ).val().replace(/<[^>]+>/g, '')+'"></i>');
  });
}


//- Design Color Picker

var ptLinkSp = $(".pt-surveybg .pt-link a");
if($("#colorpicker-popup, .colorpicker-popup").length){
$("#colorpicker-popup, .colorpicker-popup").spectrum({
    color: $(this).val(),
		showInput: true,
    allowEmpty:true,
		preferredFormat: "hex",
		change: function(rr){
		},
		move: function(color) {
			if($(this).attr('name') == 'design[button_border1_color]'){
				ptLinkSp.first().css("border-color", color.toHexString());
				$(this).attr('value', color.toHexString());
			}
			if($(this).attr('name') == 'design[button_border2_color]'){
				ptLinkSp.last().css("border-color", color.toHexString());
				$(this).attr('value', color.toHexString());
			}

			if($(this).attr('name') == 'design[bg1_color1]'){
				if($("[name='design[bg_gradient]']:checked").val() == 0){
					var clr2 = ($("[name='design[bg1_color2]']").val() ? $("[name='design[bg1_color2]']").val():'#00e2fa');
					ptLinkSp.first().css("background", "linear-gradient(to right, "+color.toHexString()+" 0%, "+clr2+" 80%, "+clr2+" 100%)");
				} else {
					ptLinkSp.first().css("background", color.toHexString());
				}
			}
			if($(this).attr('name') == 'design[bg1_color2]'){
				if($("[name='design[bg_gradient]']:checked").val() == 0){
					var clr1 = ($("[name='design[bg1_color1]']").val()?$("[name='design[bg1_color1]']").val():'#52A0FD');
					ptLinkSp.first().css("background", "linear-gradient(to right, "+clr1+" 0%, "+color.toHexString()+" 80%, "+color.toHexString()+" 100%)");
				} else {
					ptLinkSp.first().css("background", color.toHexString());
				}
			}

			if($(this).attr('name') == 'design[bg2_color1]'){
				if($("[name='design[bg_gradient]']:checked").val() == 0){
					var clr2 = ($("[name='design[bg2_color2]']").val() ? $("[name='design[bg2_color2]']").val():'#00e2fa');
					ptLinkSp.last().css("background", "linear-gradient(to right, "+color.toHexString()+" 0%, "+clr2+" 80%, "+clr2+" 100%)");
				} else {
					ptLinkSp.last().css("background", color.toHexString());
				}
			}
			if($(this).attr('name') == 'design[bg2_color2]'){
				if($("[name='design[bg_gradient]']:checked").val() == 0){
					var clr1 = ($("[name='design[bg2_color1]']").val()?$("[name='design[bg2_color1]']").val():'#52A0FD');
					ptLinkSp.last().css("background", "linear-gradient(to right, "+clr1+" 0%, "+color.toHexString()+" 80%, "+color.toHexString()+" 100%)");
				} else {
					ptLinkSp.last().css("background", color.toHexString());
				}
			}

			if($(this).attr('name') == 'design[txt_color1]'){
				ptLinkSp.first().css("color", color.toHexString());
			}
			if($(this).attr('name') == 'design[txt_color2]'){
				ptLinkSp.last().css("color", color.toHexString());
			}

			if($(this).attr('name') == 'design[survey_bg]'){
				$(".pt-surveybg").css("background", color.toHexString());
			}

			if($(this).attr('name') == 'design[input_bg]'){
				$(".pt-surveybg input[type=text]").css("border-bottom-color", color.toHexString());

			}

			if($(this).attr('name') == 'design[label_bg]'){
				$(".pt-surveybg .choice + label").css("background", color.toHexString());
			}

		}
});
}


//- Design Change
$("[name=button_shadow]").on("change", function(){
	if($(this).val() == 1){
		$(".pt-link .fancy-button").addClass("noshadow");
	} else {
		$(".pt-link .fancy-button").removeClass("noshadow");
	}
});
$("[name='design[button_border_width]']").on("change", function(){
	$(".pt-surveybg .pt-link a").css("border-width", $(this).val().replace(/<[^>]+>/g, ''));
});
$("[name='design[button_border_style]']").on("change", function(){
	$(".pt-surveybg .pt-link a").css("border-style", $(this).val().replace(/<[^>]+>/g, ''));
	$(".pt-surveybg .pt-link a").css("line-height", "34px");
});
$("[name='design[button_border_color]'], [name=pg_bg_v], [name=sp-input]").on("change", function(){
	$(".pt-surveybg .pt-link a").css("border-color", $(this).val().replace(/<[^>]+>/g, ''));
});
$("[name='design[bg_gradient]']").on("change", function(){
	$("[name='design[bg_gradient]']").removeAttr("checked");
	$(this).attr("checked", "checked");
	var clr1 = ($("[name=bg_v1]").val()?$("[name=bg_v1]").val().replace(/<[^>]+>/g, ''):'#52A0FD');
	var clr2 = ($("[name=bg_v2]").val()?$("[name=bg_v2]").val().replace(/<[^>]+>/g, ''):'#00e2fa');
	if($("[name='design[bg_gradient]']:checked").val() == 0){
		ptLinkSp.css("background", "linear-gradient(to right, "+clr1+" 0%, "+clr2+" 80%, "+clr2+" 100%)");
		ptLinkSp.after().css("background", "linear-gradient(to right, "+clr1+" 0%, "+clr2+" 80%, "+clr2+" 100%)");
	} else {
		ptLinkSp.css("background", clr1);
		ptLinkSp.after().css("background", clr1);
	}

});






//####################################
//#####                          #####
//#####      4) Index Page       #####
//#####                          #####
//####################################

if($(".js-example-tokenizer").length){
$(".js-example-tokenizer").select2({
    tags: true,
    tokenSeparators: [',', ' ']
})
}

//- Update Status

$(".pt-status input").on('change', function() {
	$.get(path+"/ajax.php?pg=changesurveystatus&id="+ $(this).val(),function(puerto){console.log(puerto);});
});

$(".pt-userstatus input").on('change', function() {
	var id = $(this).val();
	var th = $(this);
	var tit = !th.prop("checked") ? lang['alerts']['unactive'] : lang['alerts']['activate'];
	$.confirm({
		icon: 'fas fa-exclamation-triangle', type: 'orange', typeAnimated: true,
		title: lang['alerts']['pconfirm'], content: lang['alerts']['uban'].replace("{var}", tit),
		buttons: {
			tryAgain: { text: lang['close'], btnClass: 'btn-dark', action: function(){
					if ( th.prop("checked") ) th.prop("checked", false);
					else if ( !th.prop("checked") ) th.prop("checked", true);
				}
			},
			conf: {
				text: lang['confirm'], btnClass: 'btn-green', action: function(){
					$.get(path+"/ajax.php?pg=changeuserstatus&id="+ id, function(puerto){ console.log(puerto); });
				}
			}
		}
	});

});



//- Lang

$(".pt-lang a").on('click', function() {
	$.post(path+"/ajax.php?pg=lang", {id:$(this).attr('rel')}, function(puerto){ location.reload(); console.log(puerto);});
	return false;
});


//####################################
//#####                          #####
//#####      Responses Page      #####
//#####                          #####
//####################################

//- responses

$(".pt-response").on("click", function(){
	var ths = $(this);
	var response = ths.data('response');
	$.get(path+"/ajax.php?pg=respense&id="+response, function(puerto){
		try {
			var puerto = JSON.parse(puerto);
			if(puerto.type == 'success'){
				$(".pt-response-m").html(puerto.html);
				$('#exampleModal').modal('show');
			} else {
				$.puerto_confirm(lang['error'], puerto.alert, "red");
			}
		} catch (e) {
			console.log(lang['error']+' == '+puerto);
		}

	});
});


//####################################
//#####                          #####
//#####       Report Page        #####
//#####                          #####
//####################################

$(".showchart, .showpie, .showresults").on("click", function(){
	var id = $(this).parent().parent().next('.pt-content').data('answer');
	var que = $(this).parent().parent().next('.pt-content').data('question');
	var ths = $(this);
	$.get(path+"/ajax.php?pg=rapport-stats&id="+id+"&s="+que, function(puerto) {

		try {
			var as = JSON.parse(puerto);
			if(as.type == 'error'){
				$.puerto_confirm("Error!", as.alert, "red");
			} else {

				if(ths.attr('class') == 'showresults'){
					$(".pt-results").remove();
					var aa='';
					var i;
					for (i = 0; i < as.data.length; ++i) {
						aa += '<div class="r"><b>#'+(parseInt(i)+parseInt(1))+'/</b> &nbsp;'+as.data[i]+'</div>';
					}
					ths.parent().parent().parent().find('.pt-content').first().after('<div class="pt-results">'+aa+'</div>');
				}

				if(as.chartshow){
					$(".pt-chart-bar").remove();
					ths.parent().parent().parent().find('.pt-content').after('<div class="pt-chart-bar"><canvas id="bar-chart-horizontal" width="800" height="450"></canvas></div>');
					var DataLabels = as.labels;
					var DataClrs = as.colors;
					var DataCnt = as.data;

					if(ths.attr('class') == 'showchart'){
						new Chart(document.getElementById("bar-chart-horizontal"), {
						    type: 'horizontalBar',
						    data: {
						      labels: DataLabels,
						      datasets: [
						        {
						          label: "Partisipate of",
						          backgroundColor: DataClrs,
						          data: DataCnt
						        }
						      ]
						    },
						    options: {
						      legend: { display: false },
									scales: {
						        xAxes: [{
					            ticks: { beginAtZero: true }
						        }]
							    }
						    },
						});
					} else {
						new Chart(document.getElementById("bar-chart-horizontal"), {
					    type: 'doughnut',
					    data: {
					      labels: DataLabels,
					      datasets: [
					        {
					          label: "Partisipate of",
					          backgroundColor: DataClrs,
					          data: DataCnt
					        }
					      ]
					    }
						});
					}
				}

			}
		} catch (e) {
			console.log(lang['error']+' == '+puerto);
		}

	});

	return false;
});


$('.exportEx').on("click", function(e){
	var ths = $(this);
	var id = $(this).parent().parent().next('.pt-content').data('answer');
	var ths = $(this);

	var excel_data = '';
	$.get(path+"/ajax.php?pg=rapport-stats&id="+id, function(puerto) {
		try {
			var as = JSON.parse(puerto);
			if(as.type == 'error'){
				$.puerto_confirm("Error!", as.alert, "red");
			} else {
				var i;
				for (i = 0; i < as.data.length; ++i) {
					excel_data += as.data[i]+'|';
				}
				console.log(excel_data);
				console.log(puerto);
				$.puerto_confirm(lang['success'], lang['alerts']['fileready'], "green");
		    window.location = path+"/ajax.php?pg=exexcel&request=" + excel_data;
			}
		} catch (e) {
			console.log(lang['error']+' == '+puerto);
		}

	});

	e.preventDefault();
});

$('.pt-exportall').on("click", function(e){
	var id = $(this).attr("rel");
	var ths = $(this);

	$.get(path+"/ajax.php?pg=exportall&id="+id, function(puertos) {
		$.post(path+"/ajax.php?pg=exexcel&s=1" , {jsn: puertos}, function(puerto) {
			var csvFile = puerto;

			var d = new Date();
			var filename = 'export_data'+d.getTime()+'.csv';

	    var blob = new Blob([csvFile], { type: 'text/csv;charset=utf-8;' });
	    if (navigator.msSaveBlob) {
        navigator.msSaveBlob(blob, filename);
	    } else {
        var link = document.createElement("a");
        if (link.download !== undefined) {
          var url = URL.createObjectURL(blob);
          link.setAttribute("href", url);
          link.setAttribute("download", filename);
          link.style.visibility = 'hidden';
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);
        }
	    }

		});
	});

	return false;

});

$('.pt-choose-template').on("click", function(e){
	var id = $(this).attr("rel");
	var ths = $(this);

	$.get(path+"/ajax.php?pg=choose_template&id="+id, function(puerto) {
		try {
			var puerto = JSON.parse(puerto);
			console.log(puerto);

			if( puerto.type == 'success'){
				$.puerto_confirm(lang['success'], puerto.alert, "green");
				setTimeout(function () {
					$(location).attr('href', puerto.url);
				}, 2000);

			} else {
				$.puerto_confirm(lang['error'], puerto.alert, "red");
			}

		} catch (e) {
			console.log(puerto);
		}
	});

	return false;

});

$('.pt-tmps-click').on("click", function(e){
	var id = $(".pt-alltemplates");
	var ths = $(this);

	if(id.hasClass('show')){
		id.removeClass('show');
	} else {
		id.addClass('show');
	}

	return false;

});


//- Rapport Stats

$.barChart = function(ChartID, DataLabelss, DataCnts, DataClrs, DataTitle){
	new Chart(document.getElementById(ChartID), {
	    type: 'bar',
	    data: {
	      labels: DataLabelss,
	      datasets: [ { label: DataTitle, backgroundColor: DataClrs, data: DataCnts } ]
	    },
	    options: {
	      legend: { display: false },
	      title: { display: true, text: DataTitle }
	    }
	});
}

$.lineChart = function(DataLabelss, DataCnts, DataTitle){
	new Chart(document.getElementById("line-chart"), {
		type: 'line',
		data: {
			labels: DataLabelss,
			datasets: [{ data: DataCnts, label: false, borderColor: "#5f90fa", backgroundColor: 'rgba(95, 144, 250, 0.65)' } ]
		},
		options: {
			legend: { display: false },
			title: { display: true, text: DataTitle },
			scales: {
					xAxes: [{ ticks: { autoSkip: false, maxRotation: 40, minRotation: 40 } }]
			}
	}
	});
}


if($(".pt-surveystats").length){
	var ids = $(".pt-surveystats").attr('rel');
	$.get(path+"/ajax.php?pg=surveystats&request=daily&id="+ids, function(puerto) {
		var ass = JSON.parse(puerto);
		var DataLabelss = ass.labels;
		var DataCnts = ass.data;
		var DataTitle = ass.title;
		$.lineChart(DataLabelss,DataCnts,DataTitle);
	});
}

$(".pt-surveystatslinks a").on("click", function(){
	var t = $(this).attr('href').replace('#','');
	var ids = $(this).attr('rel');
	$.get(path+"/ajax.php?pg=surveystats&request="+t+"&id="+ids, function(puerto) {
		var ass = JSON.parse(puerto);
		var DataLabelss = ass.labels;
		var DataCnts = ass.data;
		var DataTitle = ass.title;
		$.lineChart(DataLabelss,DataCnts,DataTitle);
	});
	return false;
});


//####################################
//#####                          #####
//#####        Login Page        #####
//#####                          #####
//####################################

//- Sign in & up

$( ".clickme" ).on("click",function() {
  $( ".pt-signin" ).animate({ opacity: 0, left: "50%" }, 200).css("z-index","0");
	$( ".pt-signup" ).animate({ opacity: 1, left: "0%" }, 550).css("z-index","1");
	return false;
});

$( ".clickme2" ).on("click",function() {
  $( ".pt-signup" ).animate({ opacity: 0, left: "-50%" }, 200).css("z-index","0");
	$( ".pt-signin" ).animate({ opacity: 1, left: "0%" }, 550).css("z-index","1");
	return false;
});

$("#pt-send-signup").on("submit", function(){
	var ths = $(this);
	var btn  = ths.find('button[type=submit]');
	var btxt = btn.html();

	btn.prop('disabled', true).html('<i class="fas fa-spinner fa-pulse fa-fw"></i> '+lang['loading']);

	$.post(path+"/ajax.php?pg=register", $(this).serialize(), function(puerto){
		try {
			var puerto = JSON.parse(puerto);
			ths.find("button").before(puerto.alert);
			if(puerto.type == "danger"){
				setTimeout(function () {
					$(".alert").fadeOut('slow').remove();
					btn.html(btxt).prop('disabled', false);
				}, 3000);
			} else {
				setTimeout(function () {
					$(".alert").fadeOut('slow').remove();
					$( ".pt-signup" ).animate({ opacity: 0, left: "-50%" }, 200).css("z-index","0");
					$( ".pt-signin" ).animate({ opacity: 1, left: "0%" }, 550).css("z-index","1");
					$("[name=sign_name]").val($("[name=reg_name]").val());
					$("[name=sign_pass]").val($("[name=reg_pass]").val());
					$("#registrationModal").modal("hide");
					btn.html(btxt);
				}, 3000);
			}
				console.log(puerto);
		} catch (e) {
			console.log(lang['error']+' == '+puerto);
		}
	});
	return false;
});


$("#pt-send-signin").on("submit", function(){
	var ths = $(this);
	var btn  = ths.find('button[type=submit]');
	var btxt = btn.html();

	btn.prop('disabled', true).html('<i class="fas fa-spinner fa-pulse fa-fw"></i> '+lang['loading']);

	$.post(path+"/ajax.php?pg=login", $(this).serialize(), function(puerto){
		try {
			var puerto = JSON.parse(puerto);
			ths.find(".pt-login-footer .form-row").before(puerto.alert);
			ths.find(".pt-msg").before(puerto.alert);
			if(puerto.type == "danger"){
				setTimeout(function () {
					$(".alert").fadeOut('slow').remove();
					btn.html(btxt).prop('disabled', false);
				}, 3000);
			} else {
				setTimeout(function () {
					$(".alert").fadeOut('slow').remove();
					if( $("body").hasClass("pt-planspage") ) location.reload();
					else $(location).attr('href', path+"/mysurveys");
				}, 3000);
			}
		} catch (e) {
			console.log(lang['error']+' == '+puerto);
		}

	});
	return false;
});

/** Logout **/
$('.pt-logout').livequery('click', function(){
	$.confirm({
		icon: 'fas fa-exclamation-triangle', type: 'orange', typeAnimated: true,
		title: lang['alerts']['pconfirm'], content: lang['alerts']['logout'],
		buttons: {
			tryAgain: { text: lang['close'], btnClass: 'btn-dark', action: function(){} },
			conf: {
				text: lang['confirm'], btnClass: 'btn-green', action: function(){
					$.post(path+"/ajax.php?pg=logout", {type: 1}, function(puerto){
						$(location).attr('href', path);
					});
				}
			}
		}
	});
});




//####################################
//#####                          #####
//#####       User Details       #####
//#####                          #####
//####################################


$('#chooseFile').bind('change', function () {
  var filename = $("#chooseFile").val();
  if (/^\s*$/.test(filename)) {
    $(".file-upload").removeClass('active');
    $("#noFile").text(lang['nofile']);
  }
  else {
    $(".file-upload").addClass('active');
    $("#noFile").text(filename.replace("C:\\fakepath\\", ""));
  }
});


//- Image Upload
if($('#dropZone').length){
$('#dropZone').imageUploader({
  fileField: '#chooseFile',
  urlField: '#url',
  hideFileField: false,
  hideUrlField: false,
  url: path+'/ajax.php?pg=imageupload',
  thumbnails: { div: '#thumbnails', crop: 'zoom', width: 150, height: 150 },
	afterUpload: function (data) {
		try {
			var puerto = JSON.parse(data);
			if(puerto.error){
				console.log('error', puerto.error);
			} else {
				$("[name=reg_photo]").val(puerto.url);
			}
		} catch (e) {
			$("[name=reg_photo]").val(data);
		}

	},
  beforeUpload: function()           { console.log('before upload'); $("#thumbnails").html(""); return true; },
  error: function(msg) { alert(msg); },
});
}




//- Send User Details

$(".pt-senduserdetails").on("submit", function(){
	$.post(path+"/ajax.php?pg=senduserdetails", $(this).serialize(), function(puerto) {
		try {
			var puerto = JSON.parse(puerto);
			if(puerto.type == 'success'){
				$.puerto_confirm(lang['success'], puerto.alert, "green");
			} else {
				$.puerto_confirm(lang['error'], puerto.alert, "red");
			}
		} catch (e) {
			console.log(lang['error']+' == '+puerto);
		}
	});
	return false;
});




//####################################
//#####                          #####
//#####        Dashboard         #####
//#####                          #####
//####################################

$.puertoAnswerImage = function(id, choose, thumb, thumb2, crop = true, type=false){
	var id = id, choose = choose, name = $("input[rel='"+choose+"']"), thumb = thumb;
	$(id).imageUploader({
	  fileField: choose,
	  urlField: '#url',
	  hideFileField: false,
	  hideUrlField: false,
	  url: path+'/ajax.php?pg=imageupload'+(!crop ? '&request=crop' : '')+(type ? '&t='+type : ''),
	  thumbnails: {
	    div: thumb,
	    crop: 'zoom',
	    width: 150,
	    height: 150
	  },
	  afterUpload: function (data) {
			try {
				var puerto = JSON.parse(data);
				if(puerto.error){
					$(choose).parent().parent().parent().parent().parent().addClass("pt-error");
					$(choose).parent().parent().parent().parent().append('<p class="pt-warning-badge"><i class="fas fa-exclamation-triangle"></i> '+puerto.error+'!</p>');
				} else {
					$(choose).parent().parent().parent().parent().parent().removeClass("pt-error");
					$(choose).parent().parent().parent().parent().find(".pt-warning-badge").remove();
					name.val(puerto.url);
					$(thumb2).attr("src",puerto.url);
				}

			} catch (e) {
				console.log('after uploadee', data);
				name.val(data);
				$(thumb2).attr("src",data);
			}

		},
	  beforeUpload: function()           { console.log('before upload'); $(thumb).html("");  return true; },
	  error: function(msg) { alert(msg); },
	});
}

$.puertoAnswerImage('#dropZone1', '#chooseFile1', '#thumbnails1', '#thumbnails1', false);
$.puertoAnswerImage('#dropZone2', '#chooseFile2', '#thumbnails2', '#thumbnails2', false);
$.puertoAnswerImage('#dropZone3', '#chooseFile3', '#thumbnails', '#thumbnails', false);


$('[name=chooseFile]').livequery('change', function (e) {

	var filename = e.target.files[0] ? e.target.files[0].name : lang['nofile'];
	if($(".file-select-name").length){
		$(this).parent().find(".file-select-name").text(filename);
	} else {
		$(this).parent().find(".file-select-button").text(filename);
	}

});

if( $(".pt-image-upload[data-image]").length ){
	$(".pt-image-upload[data-image] .pt-image-thumb").each(function(){
		var id = $(this).attr("id").replace("answerImageTmb", "");
		$.puertoAnswerImage('#answerImageZone'+id, '#answerImageInp'+id, '#answerImageTmb'+id, '#answerImageTmb'+id, false);
	});
}


if($(".pt-adminstats").length){
	$.get(path+"/ajax.php?pg=adminstats&request=daily", function(puerto) {
		var ass = JSON.parse(puerto);
		var DataLabelss = ass.labels;
		var DataCnts = ass.data;
		var DataTitle = ass.title;
		$.lineChart(DataLabelss,DataCnts,DataTitle);

	});

	$.get(path+"/ajax.php?pg=adminstatsbars&request=daily", function(puerto) {
		var ass = JSON.parse(puerto);
		var DataLabelss = ass.labels;
		var DataCnts = ass.data;
		var DataTitle = ass.title;
		var DataClrs = ass.colors;

		$.barChart("bar-chart", DataLabelss, DataCnts, DataClrs, DataTitle);

	});


	$(".pt-adminlines a").on("click", function(){
		var t = $(this).attr('href').replace('#','');
		var ids = $(this).attr('rel');
		$.get(path+"/ajax.php?pg=adminstats&request="+t, function(puerto) {
			var ass = JSON.parse(puerto);
			var DataLabelss = ass.labels;
			var DataCnts = ass.data;
			var DataTitle = ass.title;

			$.lineChart(DataLabelss,DataCnts, DataTitle);
		});
		return false;
	});


	$(".pt-adminbars a").on("click", function(){
		var t = $(this).attr('href').replace('#','');
		var ids = $(this).attr('rel');
		$.get(path+"/ajax.php?pg=adminstatsbars&request="+t, function(puerto) {
			var ass = JSON.parse(puerto);
			var DataLabelss = ass.labels;
			var DataCnts = ass.data;
			var DataTitle = ass.title;
			var DataClrs = ass.colors;

			$.barChart("bar-chart", DataLabelss, DataCnts, DataClrs, DataTitle);

		});
		return false;
	});
}

$(".pt-sendsettings").on("submit", function(){
	$.post(path+"/ajax.php?pg=sendsettings", $(this).serialize(), function(puerto){
		try {
			var puerto = JSON.parse(puerto);
			if(puerto.type == 'success'){
				$.puerto_confirm("Success!", puerto.alert, "green");
			} else {
				$.puerto_confirm("Error!", puerto.alert, "red");
			}
		} catch (e) {
			console.log(puerto);
		}

	});
	return false;
});

$(".pt-sendplans").on("submit", function(){
	$.post(path+"/ajax.php?pg=sendplans", $(this).serialize(), function(puerto){
		if(puerto.type == 'success'){
			$.puerto_confirm("Success!", puerto.alert, "green");
		} else {
			$.puerto_confirm("Error!", puerto.alert, "red");
		}
	}, 'json');
	return false;
});

$.puertosend("#sendpage", "sendpage");














$(".pt-surveyeditorsend").on("submit", function() {
	$(".pt-error-field").removeClass("pt-error-field");
	$(".pt-warning-badge").remove();
	$.post(path+"/ajax.php?pg=surveyeditorsend", $(this).serialize(), function(puerto){
		try {
			var puerto = JSON.parse(puerto);

			console.log(puerto);
			if( puerto.field ){
				var puerto_field = $("[name='"+puerto.field+"']");
				puerto_field.parent().addClass("pt-error-field");
				puerto_field.after('<p class="pt-warning-badge"><i class="fas fa-exclamation-triangle"></i> '+lang['error']+'</p>');
				$('html,body').animate({scrollTop: puerto_field.offset().top},'slow');
			} else {



			if( puerto.type == "success" ){
				$.puerto_confirm(lang['success'], puerto.alert, "green");
				setTimeout(function () {
					$(location).attr('href', puerto.html);
				}, 2000);
			} else {
				$.puerto_confirm(lang['error'], puerto.alert, "red");
			}
		}

		} catch(e) {
			console.log(puerto);
		}


	});
	return false;
});


$(".pt-delete").livequery('click', function() {
	var pr  = $(this).parent();
	var tbl = $(this).data("table");
	var rel = $(this).attr("rel");
	var th  = $(this);
	if(tbl == "question") pr = $(this).parent().parent().parent();
	if(tbl == "survey" || tbl == "user" || tbl == "page" || tbl == "payment") pr = $(this).parent().parent().parent().parent();
	if(rel == "answer"){
		pr.fadeOut(300, function(){ $(this).remove() });
		return false;
	}

	$.confirm({
		icon: 'fas fa-exclamation-triangle', type: 'orange', typeAnimated: true,
		title: lang['alerts']['pconfirm'], content: lang['alerts']['delete'],
		buttons: {
			tryAgain: { text: lang['close'], btnClass: 'btn-dark', action: function(){} },
			conf: {
				text: lang['confirm'], btnClass: 'btn-green', action: function(){
					$.get(path+"/ajax.php?pg=delete&request="+tbl+"&id="+ rel,function(puerto){
						pr.fadeOut(300, function(){ $(this).remove() });
						if( $(".pt-image-upload[data-image='"+rel+"']").length ) $(".pt-image-upload[data-image='"+rel+"']").fadeOut(300, function(){ $(this).remove() });
						if(tbl == "language") setTimeout(function () { location.reload(); }, 2000);

						console.log(puerto);
					});
				}
			}
		}
	});

	return false;
});



$(".pt-addnewanswer").livequery('click', function() {
		var irelID = $(this).attr("rel");
		var count = $(this).parent().parent().parent().find(".file-select").length;

		$(this).parent().parent().append('<div class="relative"><input type="text" name="question['+ $(this).attr("rel") +'][answers]['+irelID+'i'+count+'11111]" placeholder="'+lang['editor']['answer']+'" /><a class="pt-badge bg-r pt-delete" rel="answer"><i class="fas fa-trash-alt"></i></a></div>');

		if( $(this).hasClass("pt-answerasimage") ){
			$('.pt-images-up[rel="'+irelID+'"]').append('<div class="pt-image-upload" rel="'+irelID+'">'+
				'<div class="file-select">'+
					'<div class="file-select-button" id="answerImageSel'+irelID+'i'+count+'">'+lang['details']['image_c']+'</div>'+
					'<input type="file" name="chooseFile" id="answerImageInp'+irelID+'i'+count+'">'+
					'<input type="hidden" name="question['+irelID+'][images]['+irelID+'i'+count+'11111]" rel="#answerImageInp'+irelID+'i'+count+'">'+
				'</div>'+
				'<div class="pt-image-thumb" id="answerImageTmb'+irelID+'i'+count+'"><img src="" class="nophoto" /></div>'+
				'<script>$.puertoAnswerImage("#answerImageZone'+irelID+'i'+count+'", "#answerImageInp'+irelID+'i'+count+'", "#answerImageTmb'+irelID+'i'+count+'", "#answerImageTmb'+irelID+'i'+count+'", false);</script>'+
			'</div>');
		}
	return false;
});







$("[name^=answer]").livequery('change', function() {
	var rel = $(this).attr('rel');
	var th = $(this);

	$.post(path+"/ajax.php?pg=surveygetlogics", { name: rel, answer: $(this).val() }, function(puerto){
		try {
			var puerto = JSON.parse(puerto);
			if( puerto.takeaction ){
				if( puerto.action == "jump") {
					$('html,body').animate({scrollTop: $('.logincactionstoquestion[rel='+puerto.question+']').offset().top},'slow');
					var idss = $('.logincactionstoquestion[rel='+puerto.question+']').parent().attr("id").replace("example-async-p-","");
					$("#example-async").steps("setStep", idss);
				}

				if( puerto.action == "hide") {
					$('.logincactionstoquestion[rel='+puerto.question+']').hide();
				}

				if( puerto.action == "show") {
					$('.logincactionstoquestion[rel='+puerto.question+']').removeClass("hidden");
				}
			} else {
				if( puerto.action == "hide") {
					$('.logincactionstoquestion[rel='+puerto.question+']').show();
				}
				if( puerto.action == "show") {
					$('.logincactionstoquestion[rel='+puerto.question+']').addClass("hidden");
				}
				if( puerto.action == "jump") {
					$("#example-async").steps('unskip', 1);
				}
			}
		} catch(e) {
			console.log(puerto);
		}

	});

});



var $stopChanging = false;
$("#example-async").steps({
    headerTag: "h5.steptitle",
    bodyTag: "section",
    transitionEffect: "slide",
		labels: {
        finish: lang['finish'],
        next: lang['next'],
        previous: lang['previous'],
        loading: lang['loading']
    },
    onStepChanging: function (event, currentIndex, newIndex)
    {
			var stepnum = parseInt(currentIndex)+1;


			if(stepnum == newIndex){
			if ($stopChanging) {
        return true;
      } else {


				var serial = $("#example-async-p-"+currentIndex).find("select, textarea, input").serialize()+ '&stepnum=' + stepnum;
				var serial2 = $("#sendresponses").serialize()+ '&stepnum=' + stepnum;


        $.ajax({
					url: path+"/ajax.php?pg=checksurveyrequiredresponses",
					data: serial,
					type: 'POST',
					dataType: 'json',
	        success: function (puerto) {
						console.log(puerto);

						$(".logincactionstoquestion").removeClass("pt-error");
						$(".logincactionstoquestion .pt-survey-answers .pt-warning-badge").remove();
						if (puerto.break) {
							$('html,body').animate({scrollTop: $('.logincactionstoquestion[rel='+puerto.break_input+']').offset().top},'slow');
							$(".logincactionstoquestion[rel='"+puerto.break_input+"']").addClass("pt-error");
							$(".logincactionstoquestion[rel='"+puerto.break_input+"'] .pt-survey-answers ").append('<p class="pt-warning-badge"><i class="fas fa-exclamation-triangle"></i> '+lang['required']+'</p>');
						} else {
								$stopChanging = true;
		            $("#example-async").steps("next");
						}

	        },
	        error: function (puerto) {
						console.log(lang['error']+' == '+puerto);
	        }
    		});
			}

		} else {
			return true;
		}




    },
		onStepChanged: function (event, currentIndex) {
       $stopChanging = false;
   },
		onContentLoaded: function (event, currentIndex) {
       $stopChanging = false;
   },
    onFinishing: function (event, currentIndex){

			var stepnum = parseInt(currentIndex)+1;
			var btn = $(this).find("a[href='#finish']");
			var btxt = btn.html();
			$(".afterDisabled").remove();
			btn.addClass('disabled').html('<i class="fas fa-spinner fa-pulse fa-fw"></i> '+lang['loading']);
			btn.after('<span class="afterDisabled"></span>');

				$.post(path+"/ajax.php?pg=sendsurveyresponses", $("#sendresponses").serialize()+ '&stepnum=' + stepnum, function(puerto){
					try {
						var puerto = JSON.parse(puerto);
						console.log(puerto);

						$(".logincactionstoquestion").removeClass("pt-error");
						$(".logincactionstoquestion .pt-survey-answers .pt-warning-badge").remove();
						if (puerto.break) {
							if( puerto.alert.pop ){
								if( puerto.alert.type == "success" ){
									$.puerto_confirm(lang['success'], puerto.alert.alert, "green");
								} else {
									$.puerto_confirm(lang['error'], puerto.alert.alert, "red");
								}
							} else {
								$('html,body').animate({scrollTop: $('.logincactionstoquestion[rel='+puerto.break_input+']').offset().top},'slow');
								$(".logincactionstoquestion[rel='"+puerto.break_input+"']").addClass("pt-error");
								$(".logincactionstoquestion[rel='"+puerto.break_input+"'] .pt-survey-answers ").append('<p class="pt-warning-badge"><i class="fas fa-exclamation-triangle"></i> '+lang['required']+'</p>');
							}
							btn.html(btxt);
							$(".afterDisabled").remove();

						} else {
							if( puerto.alert.type == "success" ){
								$.puerto_confirm(lang['success'], puerto.alert.alert, "green");
								setTimeout(function () {
									if(puerto.url) window.top.location.href = puerto.url;
									else location.reload();
								}, 2000);
							} else {
								$.puerto_confirm(lang['error'], puerto.alert.alert, "red");
								btn.html(btxt);
								$(".afterDisabled").remove();
							}
						}
					} catch (e) {
						console.log(lang['error']+' == '+puerto);
					}
				});
				return false;
    },

});



$.puertosend(".sendsurveypassword", "sendsurveypassword");
$.puertosend("#pt-sendplan", "sendplan");



$("#sendresponses").livequery("submit", function(){

	$.post(path+"/ajax.php?pg=sendsurveyresponses", $("#sendresponses").serialize(), function(puerto){
		try {
			var puerto = JSON.parse(puerto);
			console.log(puerto);

			$(".logincactionstoquestion").removeClass("pt-error");
			$(".logincactionstoquestion .pt-survey-answers .pt-warning-badge").remove();
			if (puerto.break) {
				if( puerto.alert.pop ){
					if( puerto.alert.type == "success" ){
						$.puerto_confirm(lang['success'], puerto.alert.alert, "green");
					} else {
						$.puerto_confirm(lang['error'], puerto.alert.alert, "red");
					}
				} else {
					$('html,body').animate({scrollTop: $('.logincactionstoquestion[rel='+puerto.break_input+']').offset().top},'slow');
					$(".logincactionstoquestion[rel='"+puerto.break_input+"']").addClass("pt-error");
					$(".logincactionstoquestion[rel='"+puerto.break_input+"'] .pt-survey-answers ").append('<p class="pt-warning-badge"><i class="fas fa-exclamation-triangle"></i> '+lang['required']+'</p>');
				}
				btn.html(btxt);

			}
			else {
				if(puerto.alert.type == 'success'){
					$.puerto_confirm(lang['success'], puerto.alert.alert, "green");
					setTimeout(function () {
						if(puerto.url) window.top.location.href = puerto.url;
						else location.reload();
					}, 2000);
				} else {
					$.puerto_confirm(lang['error'], puerto.alert.alert, "red");
					btn.html(btxt).prop('disabled', false);
				}
			}


		} catch (e) {
			console.log(lang['error']+' == '+puerto);
		}

	});
	return false;

});

$("li, ul").prev("br").remove();
$("li, ul").next("br").remove();

if( document.cookie.split(/; */).indexOf("popupConsent=true") == '-1' ){
	popupConsent({
	  'textPopup': lang['home']['cookie1'].replace("{link_privacy}", '<a href="'+privacy_link+'" target="_blank">'+lang['home']['privacy']+'</a>').replace("{link_terms}", '<a href="'+terms_link+'" target="_blank">'+lang['home']['terms']+'</a>'),
	  'textButtonAccept' : lang['home']['cookie2'],
	  'textButtonConfigure' : lang['home']['cookie3'],
	  'textButtonSave' : lang['home']['cookie4'],

	  authorization: [
	    { textAuthorization: lang['home']['cookie5'], nameCookieAuthorization: 'autoriseGeolocation' },
	    { textAuthorization: lang['home']['cookie6'], nameCookieAuthorization: 'targetedAdvertising' },
	    { textAuthorization: lang['home']['cookie7'], nameCookieAuthorization: 'cookieConsent' }
	  ]

	});
}


$('textarea.pt-nowhitespaces').each(function() {
  var html = $(this).html().trim().replace(/  +/g, ' '),
      height = this.scrollHeight;

  $(this).html(html);
});

$(".pt-sendlanguage").on("submit", function(){
	$.post(path+"/ajax.php?pg=sendlanguage", $(this).serialize(), function(puerto){
		try {
			var puerto = JSON.parse(puerto);

			console.log(puerto);
			if(puerto.type == 'success'){
				$.puerto_confirm(lang.success, puerto.alert, "green");
			} else {
				$.puerto_confirm(lang.error, puerto.alert, "red");
			}

		} catch (e) {
			console.log(puerto);
		}

	});
	return false;
});

$(".pt-newlang").on("click", function(){
	$.get(path+"/ajax.php?pg=newlang", function(puerto){
		location.reload();
	});

	return false;
});



if( $(".pt-images-up").length ){
$(".pt-images-up").each(function(){
	var e = $(this).attr("rel");
	var t = $(this).data("type");
	$.puertoAnswerImage("#answerImageZoneirel"+e, "#answerImageInpirel"+e, "#answerImageTmbirel"+e, "#answerImageTmbirel"+e, false, t);
});
}








//####################################
//#####                          #####
//#####        SURVEY           #####
//#####                          #####
//####################################


//- Send Survey to Email

$(".sendtoemail").on("click", function(){
	$('[name=id]').val($(this).attr('rel'));
});

$(".pt-sendsurveyemail").on("submit", function(){
	$.post(path+"/ajax.php?pg=sendsurveyemail", $(this).serialize(), function(puerto){
		if(puerto.type == 'success'){
			$.puerto_confirm("Success!", puerto.alert, "green");
		} else {
			$.puerto_confirm("Error!", puerto.alert, "red");
		}
		console.log(puerto);
	}, 'json');
	return false;
});


$("input[id^=rating]").livequery('change', function() {
	var rel = $(this).attr('rel');
	$("input[name='"+rel+"']").val($(this).val().replace(/<[^>]+>/g, ''));
});


$(".choice").livequery('change', function() {
	var vl  = $(this).val();
	var id  = $(this).attr('id').replace('a', '');
	var rel = $(this).attr('rel');
	var ar = [];
	var arr = ($("input[name='"+rel+"']").length ? $("input[name='"+rel+"']").val().replace(/<[^>]+>/g, '').split(',') : [] );

  if($(this).is(":checked")) {
		if($(this).attr('type') == 'checkbox'){
			arr.push(id);
			$("input[name='"+rel+"']").val(arr);
		} else {
			$("input[name='"+rel+"']").val(id);
		}
  } else {
		var fii = arr.filter(function(value, index, arrs){ return value != id;});
		$("input[name='"+rel+"']").val(fii);
	}
});


//- Steps Nav

$("form button[type=submit]").livequery('click', function() {
   $("button[type=submit]").removeAttr("clicked");
   $(this).attr("clicked", "true");
});




} ( jQuery ) )
