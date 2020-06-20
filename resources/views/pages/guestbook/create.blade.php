@extends('layouts.global')

@section('content')
<div style="display:flex">
	<div style="flex:1">
		<div class="site__hiw">
			<div class="site__hiw-header">
				<h1 class="site__hiw-header-title">Buku Tamu</h1>
				<div class="site__hiw-header-subtitle">
					Terima kasih telah mengunjungi TravelSpot,<br />
					silahkan mengisi buku tamu berikut.<br />
					Nomor telp &amp; email yang Anda masukkan<br />
					akan kami rahasiakan dan tidak akan ditampilkan di daftar tamu<br />
				</div>

				<div style="margin:0 auto;" class="signup-form">
					<form action="{{ route('guestbook.store') }}" accept-charset="UTF-8" method="post">
						@csrf

						<label class="input-label">Nama Lengkap</label>
						<input placeholder="Nama Lengkap" class="input margin" tabindex="100" name="fullname" type="text">
						<div class="validation-errors"><small><em>
							@error('fullname')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</em></small></div>

						<label class="input-label">Email</label>
						<input placeholder="Email" class="input margin" tabindex="101" name="email" type="text">
						<div class="validation-errors"><small><em>
							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</em></small></div>

						<label class="input-label">Nomor Telp / HP</label>
						<input placeholder="Nomor Telp/HP" class="input margin" tabindex="102" name="phone" type="text">
						<div class="validation-errors"><small><em>
							@error('phone')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</em></small></div>

						<label class="input-label">Pekerjaan Anda</label>
						<div class="signup-form__select">
							<select class="input margin" tabindex="105" name="role">
								<option selected="selected" disabled="disabled" hidden="hidden" value="">Pilih pekerjaan yang sesuai...</option>
								<option value="1">Mahasiswa</option>
								<option value="2">Dosen</option>
								<option value="3">ASN / TNI / POLRI</option>
								<option value="4">Swasta</option>
								<option value="5">Wiraswasta</option>
								<option value="6">Lain-lain</option>
							</select>
							<div class="down-caret"></div>
						</div>
						<div class="validation-errors"><small><em>
							@error('rating')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</em></small></div>

						<label class="input-label">Pendapat Anda mengenai TravelSpot</label>
						<div class="signup-form__select">
							<select class="input margin" tabindex="105" name="rating"><option selected="selected" disabled="disabled" hidden="hidden" value="">Berikan penilaian Anda...</option><option value="5">Bagus Sekali</option><option value="4">Bagus</option><option value="3">Biasa Saja</option><option value="2">Kurang</option><option value="1">Kurang Sekali</option></select>
							<div class="down-caret"></div>
						</div>
						<div class="validation-errors"><small><em>
							@error('rating')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</em></small></div>

						<label class="input-label">Masukan dan Saran</label>
						<textarea class="input margin" placeholder="Masukan dan saran" name="opinion"></textarea>
						<div class="validation-errors"><small><em>
							@error('opinion')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</em></small></div>

						<input type="submit" name="commit" value="Kirim" class="submit submit_color_green" tabindex="106" data-disable-with="Kirim">
					</form>
				</div>
			</div>
		<p>&nbsp;</p>
		</div>
	</div>
	<div style="flex:1">
		<div class="site__hiw">
			<div class="site__hiw-header">
				<h1 class="site__hiw-header-title">Daftar Tamu</h1>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Pengunjung</th>
							<th>Pekerjaan</th>
							<th>Rating Pengunjung</th>
							<th>Masukan / Saran</th>
						</tr>
					</thead>
					<tbody>
						@foreach($guests as $index => $guest)
						<?php
                            $rating = ['','Kurang Sekali','Kurang','Biasa Saja','Bagus','Bagus Sekali'];
                            $role = ['','Mahasiswa','Dosen','ASN / TNI / POLRI','Pegawai Swasta','Wiraswasta','Lain-lain'];
						?>
						<tr>
							<td>{{ $index+1 }}</td>
							<td>{{ $guest->fullname }}</td>
							<td>{{ $role[$guest->role] }}</td>
							<td>{{ $rating[$guest->rating] }}</td>
							<td>{{ $guest->opinion }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		<p>&nbsp;</p>
		</div>
	</div>
</div>
@endsection

@section('headscript')
	<style type="text/css">
		.signup-form{width:500px;}
		.signup-form form .submit{margin-top:1em;}
		.signup-form form .input-label{
			margin: 1em 0 0 0;
			text-align: left;
			width:100%;
		}
		.signup-form form textarea{height: 10em;}
		.signup-form form .validation-errors{
			text-align: right;
			width:100%;
		}
		.table-bordered tr {
			border-top:1px solid #727272;
			border-left:1px solid #727272;
		}
		.table-bordered tr td, .table-bordered tr th {
			border-bottom:1px solid #727272;
			border-right:1px solid #727272;
			padding:0.5em;
		}
		th{text-align: center;}
	</style>
@endsection