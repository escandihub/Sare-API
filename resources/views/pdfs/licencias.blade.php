<!DOCTYPE html>
<html>
	<head>
		<title>Generate PDF Laravel 8 - phpcodingstuff.com</title>
		<link
			rel="stylesheet"
			href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		/>
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
						<th scope="col">Total de licencias</th>
            <th scope="col">Municipio</th>
            <th scope="col">Numero de empleos</th>
						<th scope="col">Inversion Generada</th>
						<th scope="col">Total de Asesorias</th>
						
						
					</tr>
				</thead>
				<tbody>
					@foreach ( $licencias as $key => $licencia )
					<tr >
						<th scope="row"> {{ $key + 1 }} </th>
						<td>{{ $licencia->Mes }}</td>
						<td>{{ $licencia->Licencias_Emitidas }}</td>
            <td>{{ $licencia->municipio->Enlace_Municipal }}</td>
            <td>{{ $licencia->Empleos_Generados }}</td>
						<td>{{ $licencia->Inversion_Generada }}</td>
						<td>{{ $licencia->No_Asesorias }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		{{-- </div> --}}
	</body>
</html>
