
<!-- Latest compiled and minified jQuery Library -->
<script src="<?=path?>/assets/js/jquery.min.js"></script>


<?php if ($pg == "editor"): ?>
<script src="<?=path?>/assets/js/jquery-ui.js"></script>
<script src="<?=path?>/assets/js/jquery.ui.touch-punch.min.js"></script>
<?php endif; ?>

<!-- Bootstrap -->
<script src="<?=path?>/assets/js/popper.min.js"></script>
<script src="<?=path?>/assets/js/bootstrap.min.js"></script>

<!-- Livequery plugin -->
<script src="<?=path?>/assets/js/jquery.livequery.js"></script>

<!-- jConfirm plugin -->
<script src="<?=path?>/assets/js/jquery-confirm.min.js"></script>

<!-- Iconpicker plugin -->
<script src="<?=path?>/assets/js/fontawesome-iconpicker.min.js"></script>

<!-- Mask plugin -->
<script type="text/javascript" src="<?=path?>/assets/js/jquery.mask.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="<?=path?>/assets/js/bootstrap-select.min.js"></script>

<!--sceditor -->
<script src="<?=path?>/assets/js/minified/sceditor.min.js"></script>
<script src="<?=path?>/assets/js/minified/formats/bbcode.js"></script>
<script src="<?=path?>/assets/js/minified/icons/material.js"></script>

<!--Scroll -->
<script src="<?=path?>/assets/js/jquery.scrollbar.js"></script>

<!--Charts -->
<script src="<?=path?>/assets/js/Chart.min.js"></script>

<!--Upload -->
<script src="<?=path?>/assets/js/jquery.uploader.js"></script>

<!--Color Picker -->
<script src="<?=path?>/assets/js/spectrum.js"></script>

<script src="<?=path?>/assets/js/select2.min.js"></script>
<script src="<?=path?>/assets/js/jquery.steps.min.js"></script>

<script>
	var path         = '<?=path?>';
	var lang         = <?=json_encode($lang)?>;
	var maxsteps     = <?=surveys_steps?>;
	var maxquestions = <?=surveys_questions?>;
	var maxanswers   = <?=surveys_answers?>;
	var nophoto      = '<?=nophoto?>';
	var privacy_link = '<?=privacy_link?>';
	var terms_link   = '<?=terms_link?>';
	var phonemask    = '<?=site_phonemask?>';
</script>

<?php if ($pg == "editor"): ?>
<script src="<?=path?>/assets/js/editor.js"></script>
<?php endif; ?>

<!-- Datepicker plugin -->
<script src="<?=path?>/assets/js/datepicker.min.js"></script>
<script src="<?=path?>/assets/js/datepicker.en.js"></script>


<script src="<?=path?>/assets/js/popupConsent.min.js"></script>

<!-- <script src="<?=path?>/assets/js/question.js"></script> -->
<script src="<?=path?>/assets/js/custom.js"></script>
