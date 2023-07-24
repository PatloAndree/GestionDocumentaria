<script src="<?php echo base_url() . 'src/'; ?>vendor/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url() . 'src/'; ?>vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() . 'src/'; ?>vendor/js-cookie/js.cookie.js"></script>
<script src="<?php echo base_url() . 'src/'; ?>vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?php echo base_url() . 'src/'; ?>vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Argon JS -->
<script src="<?php echo base_url(); ?>src/js/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>src/js/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>src/js/paginator.js"></script>
<script src="<?php echo base_url(); ?>src/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>src/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>src/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>src/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>src/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>src/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>src/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>src/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
<script src="<?php echo base_url(); ?>src/js/jquery.numeric.min.js"></script>
<script>
	site_url = "<?php echo base_url(); ?>";
</script>

<?php if ($current_controller == 'marcas' || $current_controller == 'proveedores' || $current_controller == 'monedas' || $current_controller == 'ubicaciones' ||  $current_controller == 'usuarios' ||  $current_controller == 'locales' || $current_controller == 'unidades') : ?>

<?php endif ?>

<?php if ($current_controller == 'productos') : ?>
	<script src="<?php echo base_url(); ?>src/js/jquery.numeric.min.js"></script>
	<script src="<?php echo base_url(); ?>src/vendor/quill/dist/quill.min.js"></script>
<?php endif ?>

<?php if ($current_controller == 'compras') : ?>
	<?php if ($current_metodo == 'nuevo') : ?>
		<script src="<?php echo base_url(); ?>src/vendor/select2/dist/js/select2.min.js"></script>
		<script src="<?php echo base_url(); ?>src/js/jquery.numeric.min.js"></script>
		<script src="<?php echo base_url(); ?>src/vendor/quill/dist/quill.min.js"></script>
	<?php elseif ($current_metodo == "detalle") : ?>
		<script src="<?php echo base_url(); ?>src/js/lc_switch.js"></script>
	<?php endif ?>
<?php endif ?>

<?php if ($current_controller == 'atenciones') : ?>
	<?php if ($current_metodo == 'atencion') : ?>
		<script src="<?php echo base_url(); ?>src/vendor/select2/dist/js/select2.min.js"></script>
		<script src="<?php echo base_url(); ?>src/js/jquery.numeric.min.js"></script>
	<?php elseif ($current_metodo == "detalle") : ?>
		<script src="<?php echo base_url(); ?>src/js/lc_switch.js"></script>
	<?php elseif ($current_metodo == "citas") : ?>
		<script src="<?php echo base_url(); ?>src/vendor/select2/dist/js/select2.min.js"></script>
		<script src="<?php echo base_url(); ?>src/js/jquery.numeric.min.js"></script>
		<script src="<?php echo base_url(); ?>src/js/moment.min.js"></script>
		<script src='<?php echo base_url(); ?>src/fullcalendar/fullcalendar.min.js'></script>
		<script src='<?php echo base_url(); ?>src/fullcalendar/fullcalendar.js'></script>
		<script src='<?php echo base_url(); ?>src/fullcalendar/locale/es.js'></script>

	<?php endif ?>
<?php endif ?>

<?php if ($current_controller == 'cotizaciones') : ?>

	<?php if ($current_metodo == 'nuevo') : ?>
		<script src="<?php echo base_url(); ?>src/vendor/select2/dist/js/select2.min.js"></script>
		<script src="<?php echo base_url(); ?>src/js/jquery.numeric.min.js"></script>
	<?php elseif ($current_metodo == 'detalle') : ?>
		<script src="<?php echo base_url(); ?>src/js/jquery.numeric.min.js"></script>
	<?php endif ?>
<?php endif ?>

<?php if ($current_controller == 'cobros' || $current_controller == 'pagos') : ?>
	<script src="<?php echo base_url(); ?>src/js/lc_switch.js"></script>
	<script src="<?php echo base_url(); ?>src/js/jquery.numeric.min.js"></script>

<?php endif ?>

<?php if ($current_controller == 'panel') : ?>
	<script src="<?php echo base_url(); ?>src/vendor/chart.js/dist/Chart.min.js"></script>
<?php endif ?>

<?php if ($current_controller == 'reportes') : ?>
	<script src="<?php echo base_url(); ?>src/js/jszip.min.js"></script>
	<script src="<?php echo base_url(); ?>src/js/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>src/js/daterangepicker.js"></script>
	<script src="<?php echo base_url(); ?>src/vendor/chart.js/dist/Chart.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js" integrity="sha256-JG6hsuMjFnQ2spWq0UiaDRJBaarzhFbUxiUTxQDA9Lk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js" integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js" integrity="sha256-J2sc79NPV/osLcIpzL3K8uJyAD7T5gaEFKlLDM18oxY=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js" integrity="sha256-CfcERD4Ov4+lKbWbYqXD6aFM9M51gN4GUEtDhkWABMo=" crossorigin="anonymous"></script>    
<?php endif ?>

<?php if ($current_controller == 'registros') : ?>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>



	<script src="<?php echo base_url();?>src/js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="<?php echo base_url();?>src/js/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	<!-- nuevos -->
	<!-- <script type="text/javascript" src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script> -->
	<script src="<?php echo base_url(); ?>src/js/dateTime.min.js"></script>
	<script src="<?php echo base_url(); ?>src/js/registro.js"></script>


	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css" />
	<!-- autocomplete -->
	<script src="<?php echo base_url(); ?>src/js/jquery-ui.min.js"></script>
	<script src="<?php echo base_url(); ?>src/js/jquery.ui.autocomplete.scroll.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>src/css/jquery-ui.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>src/css/jquery-ui.theme.min.css" />
	
<?php endif ?>

<?php if ($current_controller == 'generales') : ?>
	<script src="<?php echo base_url(); ?>src/js/jquery.numeric.min.js"></script>
	<script src="<?php echo base_url(); ?>src/vendor/quill/dist/quill.min.js"></script>
<?php endif ?>

<?php if ($current_controller == 'perfil') : ?>

	<script src="<?php echo base_url(); ?>src/js/jquery-ui.min.js"></script>
	<script src="<?php echo base_url(); ?>src/js/jquery.ui.autocomplete.scroll.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>src/css/jquery-ui.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>src/css/jquery-ui.theme.min.css" />
<?php endif ?>

<?php if ($current_controller == 'usuarios') : ?>
	<!-- viejos -->
	<script src="<?php echo base_url(); ?>src/js/jquery-ui.min.js"></script>
	<script src="<?php echo base_url(); ?>src/js/jquery.ui.autocomplete.scroll.min.js"></script>
	<!-- <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> -->
	<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>src/css/jquery-ui.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>src/css/jquery-ui.theme.min.css" />
  
<?php endif ?>

<?php if ($current_controller == 'caja') : ?>
	<script src="<?php echo base_url(); ?>src/js/jquery.numeric.min.js"></script>
<?php endif ?>

<script src="<?php echo base_url() . 'src/'; ?>js/argon.js?v=1.1.0"></script>

<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js "></script>