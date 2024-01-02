( function ( $ ) {
    'use strict';


		var ebtnpos = $(".pt-editorbuttons").offset();

		$( window ).scroll(function() {
			if( $(window).scrollTop() > ebtnpos.top){
				$(".pt-surveyeditor .pt-editorbuttons ul").removeClass("position-relative").addClass("position-fixed");
			} else {
      	$(".pt-surveyeditor .pt-editorbuttons ul").removeClass("position-fixed").addClass('position-relative');
    	}
		});


		$(".pt-editornavs a").livequery("click", function(){
			var rel = $(this).attr("rel");

			$(".pt-editorbody").removeClass("pt-active");
			$("."+rel).addClass("pt-active");
			setTimeout(function(){
				$(".pt-editorbody").css("display","none");
				$("."+rel).css("display","block");
			}, 300);

			$(".pt-editornavs a").removeClass("pt-active");
			$(this).addClass("pt-active");

			return false;
		});


		$(".pt-getanswerstarget").livequery("change", function(){
			var rel = $(this).val();

			$.get(path+"/ajax.php?pg=getanswers&id="+rel, function(puerto){
				$(".pt-getanswerscontent").html(puerto);
				$(".pt-getanswerscontent select").selectpicker('refresh');
			});

			return false;
		});

		$(".pt-sendlogics").livequery("click", function(){
			var rel = $(this).val();

			var ser = { survey: $("[name=survey_id]").val(), action: $("[name=action]").val(), question1: $("[name=question1]").val(), question2: $("[name=question2]").val(), condition1: $("[name=condition1]").val(), condition2: $("[name=condition2]").val(), answer: $("[name=answer]").val() };


			$.post(path+"/ajax.php?pg=sendlogics", ser, function(puerto){
				try {
					var puerto = JSON.parse(puerto);
					$(".pt-editornavlogics").append(puerto.html);

				} catch(e) {
					console.log(lang['error']+' == '+puerto);
				}

			});

			return false;
		});








		$( ".pt-editorbuttons a" ).draggable({
			helper: "clone",
			revert: "invalid"
		});


		$( ".pt-droppable" ).droppable({
			accept: ".pt-editorbuttons a",
			classes: {
				"ui-droppable-active": "ui-state-active",
				"ui-droppable-hover": "ui-state-hover"
			},
			drop: function( event, ui ) {

				var thisID = $(this).attr("id");
				var questionType = ui.draggable.attr("rel");
				var step = 1;
				var qst = 1;

				var questionsCount = ($(".pt-question").length ? $(".pt-question").length+1 : 1 );
				var pagesCount = ($(".pt-new-break").length ? $(".pt-new-break").length+1 : 1 );
				var stepsCount = ($(".pt-new-break").length ? $(".pt-new-break").length : 1 );


				var irelID = 'i'+stepsCount+'i'+questionsCount;

				var questionTypes = [];
						questionTypes["radio"]    = lang['editor']["radio"];
						questionTypes["checkbox"] = lang['editor']["checkbox"];
						questionTypes["input"]    = lang['editor']["input"];
						questionTypes["text"]     = lang['editor']["text"];
						questionTypes["dropdown"] = lang['editor']["dropdown"];
						questionTypes["textarea"] = lang['editor']["textarea"];
						questionTypes["image"]    = lang['editor']["image"];
						questionTypes["rating"]   = lang['editor']["rating"];
						questionTypes["date"]     = lang['editor']["date"];
						questionTypes["phone"]    = lang['editor']["phone"];
						questionTypes["country"]  = lang['editor']["country"];
						questionTypes["email"]    = lang['editor']["email"];
						questionTypes["break"]    = lang['editor']["break"];
						questionTypes["scale"]    = lang['editor']["scale"];
						questionTypes["file"]     = lang['editor']["file"];

				var questionColors = [];
						questionColors["radio"]    = "o";
						questionColors["checkbox"] = "gr";
						questionColors["input"]    = "v";
						questionColors["text"]     = "gy";
						questionColors["dropdown"] = "bl";
						questionColors["textarea"] = "or";
						questionColors["image"]    = "grr";
						questionColors["rating"]   = "pn";
						questionColors["date"]     = "vv";
						questionColors["phone"]    = "bb";
						questionColors["country"]  = "gr1";
						questionColors["email"]    = "yy";
						questionColors["break"]    = "Break";
						questionColors["scale"]    = "bro";
						questionColors["file"]     = "bro";

				if( questionType == "break" && pagesCount >= maxsteps ){
					$.puerto_confirm(lang['error'], lang['alerts']['maxsteps'], "red");
					return false;
				}

				if( questionType != "break" && $(".pt-new-step-content.pt-question").length >= maxquestions ){
					$.puerto_confirm(lang['error'], lang['alerts']['maxquestion'], "red");
					return false;
				}

				$(".pt-drageinfo").hide().remove();

				if( !$(".pt-editorbody div").length ){
					$("#"+thisID).append(
						'<div class="pt-new-break"><span>Page '+pagesCount+'</span></div>'
					);
				}

				if( questionType == "text" ){
					$("#"+thisID).append(
						'<div class="pt-new-step-content pt-question" rel="'+irelID+'">'+
						'<div class="relative">'+
							'<span class="pt-badge bg-'+questionColors[questionType]+' pt-badge-qn">Q'+questionsCount+': </span>'+
							'<span class="pt-badge bg-'+questionColors[questionType]+'">'+questionTypes[questionType]+'</span>'+
							'<div class="pt-options">'+
								'<a class="pt-badge bg-r pt-edelete" rel="'+irelID+'"><i class="fas fa-trash-alt"></i></a>'+
								'<a class="pt-badge bg-gy '+(questionsCount == 1 ? 'pt-disabled' : '')+' pt-up" rel="'+irelID+'"><i class="fas fa-arrow-up"></i></a>'+
							'</div>'+
						'</div>'+
						'<div><textarea name="question['+irelID+'][answers]" id="wysibb'+irelID+'" rel="'+irelID+'" placeholder="Write your Paragraph"></textarea></div>'+
						"<script>sceditor.create(document.getElementById('wysibb"+irelID+"'), {style: path+'/assets/js/minified/themes/content/default.min.css',format: 'bbcode', toolbar: 'bold,italic,underline,strike,|,left,center,right,justify,|,copy,paste,|,size,color,|,bulletlist,orderedlist,|,image,link,unlink,|,source',icons: 'material',height: 200});</script>"+
						'<p class="pt-pnote"><i class="fas fa-exclamation-circle"></i> BBCodes are allowed (Exemple: [B][/B], [P][/P], [H1][/H1]...)</p>'+
						'<input type="hidden" name="question['+irelID+'][type]" value="'+questionType+'">'+
						'<input type="hidden" name="question['+irelID+'][state]" value="new">'+
						'</div>'
					);
				}

				var blockedTile = ['radio', 'checkbox', 'input', 'dropdown', 'textarea', 'country', 'phone', 'date', 'email', 'image', 'rating', 'scale', 'file'];

				if( blockedTile.indexOf(questionType) != -1 ){
					$("#"+thisID).append(
						'<div class="pt-new-step-content pt-question" rel="'+irelID+'">'+
						'<div class="relative">'+
							'<span class="pt-badge bg-'+questionColors[questionType]+' pt-badge-qn">Q'+questionsCount+': </span>'+
							'<span class="pt-badge bg-'+questionColors[questionType]+'">'+questionTypes[questionType]+'</span>'+
							'<div class="pt-options">'+
								'<a class="pt-badge bg-r pt-edelete" rel="'+irelID+'"><i class="fas fa-trash-alt"></i></a>'+
								'<a class="pt-badge bg-gy '+(questionsCount == 1 ? 'pt-disabled' : '')+' pt-up" rel="'+irelID+'"><i class="fas fa-arrow-up"></i></a>'+
							'</div>'+
							'<input type="text" name="question['+irelID+'][question]" placeholder="Your question" />'+
							'<input type="hidden" name="question['+irelID+'][type]" value="'+questionType+'">'+
							'<input type="hidden" name="question['+irelID+'][state]" value="new">'+
						'</div>'+
						'<div class=""><input type="text" name="question['+irelID+'][description]" placeholder="Your question brief description (optional)" /></div>'+
						( questionType == "rating" ?
						'<div><input type="text" name="question['+irelID+'][icon]" value="fas fa-star" class="my" placeholder="Choose an icon" /></div>'+
						'<div><input type="text" name="question['+irelID+'][rows]" value="5" placeholder="Number of icons" /></div>'+
						"<script>$('.my').iconpicker({placement: 'bottom'}); $('.my').on('iconpickerSelected', function(event){ $(this).next('.changeicon').html('<i class=\"'+event.iconpickerValue+'\"></i>'); $('span[role=\"'+$(this).attr('name')+'\"]').html('<i class=\"'+$( this ).val()+'\"></i>');});</script>"
						: ( questionType != "scale" && questionType != "file" ? '<div><textarea name="question['+irelID+'][answers]" rel="'+irelID+'" class="pt-answers-text" placeholder="Write in each line an answer"></textarea></div>' : '')
					 	)+
						( questionType == "scale" ?
						'<div><input type="text" name="question['+irelID+'][rows]" value="10" placeholder="Number of scales" /></div>'+
						'<div class="row">'+
							'<div class="col"><input type="text" name="question['+irelID+'][scale1]" value="Not at all likely" placeholder="Scale 1" /></div>'+
							'<div class="col"><input type="text" name="question['+irelID+'][scale2]" value="Neutral" placeholder="Scale 2" /></div>'+
							'<div class="col"><input type="text" name="question['+irelID+'][scale3]" value="Extremely likely" placeholder="Scale 3" /></div>'+
							'<div class="col"><input type="text" name="question['+irelID+'][scale4]" value="" placeholder="Scale 4" /></div>'+
							'<div class="col"><input type="text" name="question['+irelID+'][scale5]" value="" placeholder="Scale 5" /></div>'+
						'</div>'
						: ''
					 	)+
						( questionType == "file" ?
							'<div class="pt-survey-answers pt-form-inline">'+
								'<div class="pt-form-group">'+
									'<b>File type:</b>'+
								'</div>'+
								'<div class="pt-form-group">'+
									'<input type="radio" name="question['+irelID+'][filetype]" value="image" id="fileimage'+irelID+'" class="choice" checked>'+
									'<label for="fileimage'+irelID+'">Image</label>'+
								'</div>'+
								'<div class="pt-form-group">'+
									'<input type="radio" name="question['+irelID+'][filetype]" value="zip" id="filezip'+irelID+'" class="choice">'+
									'<label for="filezip'+irelID+'">Zip</label>'+
								'</div>'+
								'<div class="pt-form-group">'+
									'<input type="radio" name="question['+irelID+'][filetype]" value="rar" id="filerar'+irelID+'" class="choice">'+
									'<label for="filerar'+irelID+'">Rar</label>'+
								'</div>'+
							'</div>'
						: "" )+
						( questionType == "image" ?
							'<div class="pt-images-up" rel="'+irelID+'">'+
							'<div class="pt-image-upload" rel="'+irelID+'">'+
								'<div class="file-select">'+
									'<div class="file-select-button" id="answerImageSel'+irelID+'">'+lang['details']['image_c']+'</div>'+
									'<input type="file" name="chooseFile" id="answerImageInp'+irelID+'">'+
									'<input type="hidden" name="question['+irelID+'][images][]" rel="#answerImageInp'+irelID+'">'+
								'</div>'+
								'<div class="pt-image-thumb" id="answerImageTmb'+irelID+'"><img src="" class="nophoto" /></div>'+
								'<script>$.puertoAnswerImage("#answerImageZone'+irelID+'", "#answerImageInp'+irelID+'", "#answerImageTmb'+irelID+'", "#answerImageTmb'+irelID+'", false);</script>'+
							'</div>'+
							'</div>'
						: "" )+
						'<div class="pt-radio-slide">'+
							'<input name="question['+irelID+'][status]" class="tgl tgl-light" id="cbr'+irelID+'" type="checkbox"/>'+
							'<label class="tgl-btn" for="cbr'+irelID+'"></label> '+lang['editor']['new_qre']+
						'</div>'+
						( questionType != 'dropdown' && questionType != 'rating' && questionType != 'scale' && questionType != 'file' ?
						'<div class="pt-radio-slide">'+
							'<input name="question['+irelID+'][inline]" class="tgl tgl-light" id="cbi'+irelID+'" type="checkbox"/>'+
							'<label class="tgl-btn" for="cbi'+irelID+'"></label> '+lang['editor']['new_qln']+
						'</div>'
						: '' ) +
						'</div>'
					);
				}



				if( questionType == "break" && $(".pt-editorbody div").last().attr("class") != "pt-new-break" ){

					$("#"+thisID).append(
						'<div class="pt-new-break" rel="'+pagesCount+'"><span>Page '+pagesCount+'<a class="pt-badge bg-r pt-edelete pt-new-break-d" rel="'+pagesCount+'"><i class="fas fa-trash-alt"></i></a></span><input type="hidden" name="survey_steps[]" value="'+pagesCount+'"></div>'
					);
				}


			}
		});





		$("a[rel='pt-editornavpreview']").livequery("click", function(){


			$.post(path+"/ajax.php?pg=sendsurveypreview", $(".pt-surveyeditorsend").serialize(), function(puerto){
				$(".pt-editornavpreview").html(puerto);
				$('.selectpicker').selectpicker("refresh");
			})


		}),





		$(".pt-up").livequery("click", function(){
			if( !$(this).hasClass("pt-disabled") ){
				var thisStepRel = $(this).attr('rel'),
						thisStep = $(".pt-question[rel='"+thisStepRel+"']"),
						thisStepArray = thisStepRel.split('i');

				var prevStep = thisStep.prev();
				var prevStepRel = prevStep.attr("rel");
				var prevStepRelArray = prevStepRel.split('i');

				if( prevStep.hasClass("pt-question") ){

					prevStep.attr("rel", thisStepRel);
					prevStep.find(".pt-options a").attr("rel", thisStepRel);
					prevStep.find(".pt-badge-qn").text("Q"+thisStepArray[2]+":");
					if(prevStepRelArray[2] == 1) {
						thisStep.find(".pt-options a.pt-up").addClass("pt-disabled");
						prevStep.find(".pt-options a.pt-up").removeClass("pt-disabled");
					}
					prevStep.find("[name^='question["+prevStepRel+"]']").each(function(e, v){
							$(this).attr("name", $(this).attr("name").replace(prevStepRel, thisStepRel));
					})

					//# CHANGING THE STEP IDS
					thisStep.attr("rel", prevStepRel);
					thisStep.find(".pt-options a").attr("rel", prevStepRel);
					thisStep.find(".pt-badge-qn").text(prevStepRel);
					thisStep.find(".pt-badge-qn").text("Q"+prevStepRelArray[2]+":");
					thisStep.find("[name^='question["+thisStepRel+"]']").each(function(e, v){
							$(this).attr("name", $(this).attr("name").replace(thisStepRel, prevStepRel));
					});

					prevStep.insertAfter(thisStep);
				}

				if( prevStep.hasClass("pt-new-break") ){
					var prev2Step = thisStep.prev().prev();
					var prev2StepRel = prev2Step.attr('rel');
					var prev2StepRelArray = prev2StepRel.split('i');
					var newrel = "i"+prev2StepRelArray[1]+"i"+(parseInt(prev2StepRelArray[2])+1);

					//# CHANGING THE STEP IDS
					thisStep.attr("rel", newrel);
					thisStep.find(".pt-options a").attr("rel", newrel);
					thisStep.find(".pt-badge-qn").text(newrel);
					thisStep.find(".pt-badge-qn").text("Q"+(parseInt(prev2StepRelArray[2])+1)+":");

					prevStep.insertAfter(thisStep);
				}


			}
			return false;

		});



		$(".pt-edelete").livequery("click", function(){
			var rel = $(this).attr('rel'),
					th = $(this);

					th.addClass("pt-disabled").removeClass('pt-edelete').html('<i class="fas fa-spinner fa-pulse"></i>');

					var prevST = th.parent().parent().prev();
					prevST = prevST.hasClass("pt-question") ? prevST.attr("rel").split('i') : [0,0];



				$.confirm({
				icon: 'fas fa-exclamation-triangle',
				title: 'Please confirm!',
				content: "Are you sure you want to delete?",
				type: 'orange',
				typeAnimated: true,
				buttons: {
					tryAgain: {
						text: 'Close',
						btnClass: 'btn-dark',
						action: function(){
							th.addClass('pt-edelete').removeClass("pt-disabled").html('<i class="fas fa-trash-alt"></i>');
						}
					},
					conf: {
						text: 'Confirm',
						btnClass: 'btn-green',
						action: function(){
							th.addClass('pt-edelete').removeClass("pt-disabled").html('<i class="fas fa-trash-alt"></i>');
							if( th.hasClass("pt-new-break-d") ){
								$(".pt-new-break[rel='"+rel+"']").fadeOut(330, function(){ $(this).remove(); });
								$(".pt-editornavform").find("[name^='question[i"+rel+"i']").each(function(e, v){
										$(this).attr("name", $(this).attr("name").replace("i"+rel+"i", "i"+prevST[1]+"i"));
								});
							} else {
								$(".pt-question[rel='"+rel+"']").fadeOut(330, function(){ $(this).remove(); });
							}
						}
					}
				}
			});
			return false;
		});



		$("input[id^=cbi]").livequery("change", function(){
			var irelID = $(this).attr("id").replace("cbi", "");
			if( $(this).is(':checked') && !$('input[name="question['+irelID+'][rows]"]').length ){
				$(this).parent().append('<input name="question['+irelID+'][rows]" placeholder="Number of rows (min 2 max 8)" type="text">')
			} else {
				$('input[name="question['+irelID+'][rows]"]').remove();
			}
		});

		$(".pt-answers-text").livequery("change keyup paste", function(){
			var text = $(this).val();
			var lines = text.split(/\r|\r\n|\n/);
			lines = lines.filter(function (el) {
			  return el != "";
			});



						var irelID = $(this).attr("rel");

			var count = lines.length;
			var countTmb = $('.pt-image-upload[rel="'+irelID+'"]').length;

			if( countTmb < count ) {
				for(var x = countTmb; x<count; x++){
					$('.pt-images-up[rel="'+irelID+'"]').append('<div class="pt-image-upload" rel="'+irelID+'">'+
						'<div class="file-select">'+
							'<div class="file-select-button" id="answerImageSel'+irelID+'i'+count+'">'+lang['details']['image_c']+'</div>'+
							'<input type="file" name="chooseFile" id="answerImageInp'+irelID+'i'+count+'">'+
							'<input type="hidden" name="question['+irelID+'][images][]" rel="#answerImageInp'+irelID+'i'+count+'">'+
						'</div>'+
						'<div class="pt-image-thumb" id="answerImageTmb'+irelID+'i'+count+'"><img src="" class="nophoto" /></div>'+
						'<script>$.puertoAnswerImage("#answerImageZone'+irelID+'i'+count+'", "#answerImageInp'+irelID+'i'+count+'", "#answerImageTmb'+irelID+'i'+count+'", "#answerImageTmb'+irelID+'i'+count+'", false);</script>'+
					'</div>');
				}
			}
			if( countTmb > count) {
				for(var x = count; x<countTmb; x++){
					$('.pt-image-upload[rel="'+irelID+'"]').last().remove();
				}
			}

		});




} ( jQuery ) )
