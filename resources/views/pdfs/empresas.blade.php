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
				  Indicadores de Operación por Empresas en los Módulos SARE del Mes de Enero
			</div>
			</div

			<table class="table table-bordered mt-5">
				<thead>
					<tr>
						<th scope="col">Municipios</th>
						<th scope="col">Inversión Generada</th>
						<th scope="col">Nomero de empleos</th>
						<th scope="col">No. Empresas</th>
					</tr>
				</thead>
				<tbody>
					@foreach ( $empresas as $key => $empresa )
					<tr >
						<th scope="row"> {{ $key }} </th>
						<td>{{ $empresa->municipio }}</td>
						<td>{{ $empresa->inversion }}</td>
						<td>{{ $empresa->empleos }}</td>
						<td>{{ $empresa->empresas }}</td>
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
