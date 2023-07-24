<?php $current_controller = $this->router->fetch_class(); ?>
<?php $current_metodo = $this->router->fetch_method(); ?>
<!-- Icons -->
<link rel="stylesheet" href="<?php echo base_url() . 'src/'; ?>vendor/nucleo/css/nucleo.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url() . 'src/'; ?>vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">


<link rel="stylesheet" href="<?php echo base_url() . 'src/'; ?>css/parsley.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>src/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>src/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>src/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">

<!-- NUEVOS SCRIPTS	 -->

<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">  -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css"> -->

<!-- <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<!-- <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

<!-- NUEVOS SCRIPTS	 -->


<!--lOGIN CSS -->

<?php if ($current_controller == 'generales') : ?>
	<link rel="stylesheet" href="<?php echo base_url() . 'src/'; ?>css/login.css" type="text/css">
<?php endif ?>
<?php if ($current_controller == 'productos') : ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>src/vendor/quill/dist/quill.snow.css" type="text/css">
<?php endif ?>

<?php if ($current_controller == 'atenciones' && $current_metodo == 'atencion') : ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>src/vendor/select2/dist/css/select2.min.css">

<?php endif ?>

<?php if ($current_controller == 'atenciones' && $current_metodo == 'citas') : ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>src/vendor/select2/dist/css/select2.min.css">

	<link href='<?php echo base_url(); ?>src/fullcalendar/fullcalendar.css' rel='stylesheet' />
<?php endif ?>

<?php if (($current_controller == 'compras' || $current_controller == 'atenciones' || $current_controller == 'cotizaciones') && $current_metodo == 'detalle') : ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>src/css/lc_switch.css">

<?php endif ?>

<?php if ($current_controller == 'cobros' || $current_controller == 'pagos') : ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>src/css/lc_switch.css">
<?php endif ?>
<?php if ($current_controller == 'reportes') : ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>src/css/daterangepicker.css">
<?php endif ?>
<!-- Argon CSS -->
<link rel="stylesheet" href="<?php echo base_url() . 'src/'; ?>css/argon.css?v=1.1.0" type="text/css">

<?php if (($current_controller == 'compras' || $current_controller == 'atenciones' || $current_controller == 'cotizaciones') && $current_metodo == 'nuevo') : ?>
	<style>
		.minplud {
			width: 28px;
			height: 28px;
		}

		.table input {
			min-width: 88px;
			max-width: 88px;
			padding-top: 0px;
			padding-bottom: 0px;
			max-height: 30px;
		}

		.card .table td,
		.card .table th {
			padding-right: 0.5rem;
			padding-left: 0.5rem;
		}

		.table td,
		.table th {
			font-size: .8125rem;
			white-space: none;
		}
	</style>
<?php endif ?>


<?php if ($current_controller == 'productos') : ?>
	<style>
		.table th,
		.table td {
			padding-right: 0rem;
			padding-left: 0rem;
		}

		.card .table td,
		.card .table th {
			padding-right: 0rem;
			padding-left: 0rem;
		}
	</style>
<?php endif ?>

<?php if ($current_controller == 'cotizaciones' && $current_metodo == 'detalle') : ?>
	<style>
		.minplud {
			width: 28px;
			height: 28px;
		}

		.table input {
			min-width: 88px;
			max-width: 88px;
			padding-top: 0px;
			padding-bottom: 0px;
			max-height: 30px;
		}

		.card .table td,
		.card .table th {
			padding-right: 0.5rem;
			padding-left: 0.5rem;
		}

		.table td,
		.table th {
			font-size: .8125rem;
			white-space: none;
		}
	</style>
<?php endif ?>
<style>
	.buttons-html5 {
		background-color: #fff !important;
		/* color: black ; */
		border:1px solid #fff;
		margin-bottom: 2rem !important;
	}
	/* .buttons-html5 {
		background-color: #fff !important;
		color: white !important;
		border:1px solid #DDD9DA;
		margin-bottom: 2rem !important;
	} */
	hr {
		border: 0;
		border-top: 2px solid #99999973;
		border-bottom: 2px solid #99999973;
		height: 0;
		width: 100%;
	}

	.buttons-html5::hover {
		background-color: #5e72e4 !important;
		color: white !important;
		margin-bottom: 2rem !important;
	}

	.table tbody td {
		vertical-align: middle;
		text-align: center;
	}

	.spinner {
		left: 50%;
		margin-left: -20px;
		margin-top: -20px;
		position: absolute;
		z-index: 19 !important;
		animation: loading-bar-spinner 400ms linear infinite;
	}

	#loading-bar-spinner.spinner .spinner-icon {
		width: 40px;
		height: 40px;
		border: solid 4px transparent;
		border-top-color: #00C8B1 !important;
		border-left-color: #00C8B1 !important;
		border-radius: 50%;
	}



	@keyframes loading-bar-spinner {
		0% {
			transform: rotate(0deg);
			transform: rotate(0deg);
		}

		100% {
			transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}
</style>

<?php if ($current_controller == 'generales') : ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>src/vendor/quill/dist/quill.snow.css" type="text/css">

<?php endif ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">