<!DOCTYPE html>
<html>
	<head>
		<title>Generate PDF Laravel 8 - phpcodingstuff.com</title>
		<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
	</head>
	<style type="text/css">
		h2 {
			text-align: center;
			font-size: 22px;
			margin-bottom: 50px;
		}
		body {
			background: #f2f2f2;
		}
		.section {
			margin-top: 30px;
			padding: 50px;
			background: #fff;
		}
		.pdf-btn {
			margin-top: 30px;
		}
		.logo{    width: 12em;
		}
		.footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 60px;
    line-height: 60px;
    background-color: #f5f5f5;
  }
	.linea {
   position: relative;
        border-top: 3px solid black;
        border-radius: 2px 2px 3px 3px;
        width: 10em;
        height: 10px;
       	bottom: 20px;
        margin-left: auto;
      	margin-right: auto
      }
	</style>
	<body>
		{{-- <div class="container"> --}}
			<div class="mb-3">
      <img class="logo float-left" src="img/COESMER.png">
			<div class="text-center">
				Reporte Mensual Correspondiente a "Mes" de Año Municipio "OCOSINGO"
			</div>
			</div

			<table class="table table-bordered mt-5">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Mes a reportar</th>
						<th scope="col">Nombre de la empresa</th>
						<th scope="col">Giro</th>
						<th scope="col">Inversion Generada</th>
						<th scope="col">Numero de empleos</th>
						<th scope="col">Municipio</th>
					</tr>
				</thead>
				<tbody>
					@foreach ( $capturas as $key => $captura )
					<tr >
						<th scope="row"> {{ $key }} </th>
						<td>{{ $captura->Mes }}</td>
						<td>{{ $captura->Empresa }}</td>
						<td>{{ $captura->Giro }}</td>
						<td>{{ $captura->Inversion }}</td>
						<td>{{ $captura->No_Empleo }}</td>
						<td>{{ $captura->municipio->Enlace_Municipal }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		<footer class="footer">
      <div class="container">
        <span class="text-muted">Place sticky footer content here.</span>
				<div class="linea"></div>
      </div>
    </footer>
	</body>
</html>
