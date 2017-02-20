<html>
	<head>
		<title>KTA PRINT</title>
		<link media="print" rel="Alternate" href="print.pdf">
		<style>
			body{
				text-align: center;
				font-family: arial;
				font-size: 11px;
			}
			.kadin-border {
				min-height: 18cm;
				max-height: 21cm;
				width: 29.7cm;
				position: absolute;
				border-style: solid;
				border-width: 50px 50px 50px 50px;
				-moz-border-image: url("{{ url('resources/assets/images/kadin-border.gif') }}") 68 77 71 67 fill round repeat;
				-webkit-border-image: url("{{ url('resources/assets/images/kadin-border.gif') }}") 68 77 71 67 fill round repeat;
				-o-border-image: url("{{ url('resources/assets/images/kadin-border.gif') }}") 68 77 71 67 fill round repeat;
				border-image: url("{{ url('resources/assets/images/kadin-border.gif') }}") 68 77 71 67 fill round repeat;*/
				border-image: url("{{ url('resources/assets/images/kb.gif') }}") fill round repeat;
			}
			
			.col-centered{
				float: none;
				margin: 0 auto;
			}

			.test{
				height: 4cm;
				width: 3cm;
				border-style: solid;
				border-width: 3px;    
				margin-left: auto;
				margin-right: auto;
			}

			.center-in-parent {
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translateX(-50%) translateY(-50%);
			}
			
			@media print{
				@page {
					size: landscape;
					margin: 5px 5px; 5px 5px;
				}
			}
		</style>
	</head>
	<body onload="window.print()">	
		<div class="kadin-border">
			<!-- header -->
			<div style="text-align: center; margin-left: 281px;margin-top: 20px;">
				<table>
					<tr valign="middle">
						<td><img src="{{ url('resources/img/icon144-128x128-10.png') }}" width="95px"></td>
						<td style="text-align: center; line-height: 25px">
							<b style="font-size:19px;">KAMAR DAGANG DAN INDUSTRI</b><br>
							<i style="font-size:17px;">Chamber of Commerce and Industry</i><br>
							<b style="font-size:22px;">KARTU TANDA ANGGOTA BIASA</b><br>
							<i style="font-size:17px;">Certificate of Ordinary Member</i>
						</td>
					</tr>
				</table>
			</div>
			<!-- end of header -->
			<br/><br/>
			<table width="100%">
				<tr>
					<td align="center" width="30%">
						<b style="font-size:15px;">Nomor Anggota</b><br>
						<i style="font-size:14px;">Membership Number</i><br><br>
						<b style="font-size:15px;">{{ $kta }}</b>
					</td>
					<td align="center" width="30%">
						<b style="font-size:15px;">Berlaku Sampai Dengan</b><br>
						<i style="font-size:14px;">Valid Until</i><br><br>
						<b style="font-size:15px;">{{ $exp }}</b>
					</td>
					<td align="center" width="30%">
						<b style="font-size:15px;">Nomor Registrasi Nasional</b><br>
						<i style="font-size:14px;">National Registered Number</i><br><br>
						<b style="font-size:15px;">{{ $rn }}</b>
					</td>
				</tr>
			</table>
			
			<!-- content -->
			<div style="padding: 10px 30px">
				<table width="100%">
				  <tr>
					<td width="25%">					
					  <b style="font-size:15px;">NAMA PERUSAHAAN</b><br>
					  <i style="font-size:14px;">Name of Company</i>
					</td>
					<td width="3%">:</td>
					<td style="font-size:14px;" width="30%">{{ $compname }}</td>
					
					<td colspan="4">&nbsp;</td>
				  </tr>                              
				  <tr>
					<td>
					  <b style="font-size:15px;">PEMIMPIN PERUSAHAAN</b><br>
					  <i style="font-size:14px;">Person in Charge</i>
					</td>
					<td>:</td>					
					<td style="font-size:14px;">{{ $complead }}</td>
					
					<td width="7%">&nbsp;</td>
					<td width="15%">
					  <b style="font-size:15px;">JABATAN</b><br>
					  <i style="font-size:14px;">Position</i>
					</td>
					<td width="3%">:</td>				
					<td style="font-size:14px;" width="30%">{{ $jabatan }}</td>
				  </tr>
				  <tr>
					<td>
					  <b style="font-size:15px;">ALAMAT PERUSAHAAN</b><br>
					  <i style="font-size:14px;">Company's Address</i>
					</td>
					<td>:</td>					
					<td style="font-size:14px;">{{ $compaddr}}</td>
					
					<td width="7%">&nbsp;</td>
					<td>
					  <b style="font-size:15px;">KODE POS</b><br>
					  <i style="font-size:14px;">Zip Code</i>
					</td>
					<td>:</td>					
					<td style="font-size:14px;">{{ $postcode }}</td>
				  </tr>
				  <tr>
					<td>
					  <b style="font-size:15px;">BIDANG USAHA</b><br>
					  <i style="font-size:14px;">Line of Business</i>
					</td>
					<td>:</td>					
					<td style="font-size:14px;">{{ $compbdus }}</td>
					
					<td colspan="4">&nbsp;</td>
				  </tr>
				  <tr>
					<td>
					  <b style="font-size:15px;">SURAT IZIN USAHA</b><br>
					  <i style="font-size:14px;">Bussiness Permit Number</i>
					</td>
					<td>:</td>					
					<td style="font-size:14px;">{{ $comppermit }}</td>
					
					<td colspan="4">&nbsp;</td>
				  </tr>
				  <tr>
					<td>
						<b style="font-size:15px;">KUALIFIKASI PERUSAHAAN</b><br>
						<i style="font-size:14px;">Company's Qualification</i>
					</td>
					<td>:</td>					
					<td style="font-size:14px;">{{ $compqual }}</td>
					
					<td colspan="2">
						<b style="font-size:15px;">NPWP PERUSAHAAN</b><br>
						<i style="font-size:14px;">Tax Registration Number</i>
					</td>
					<td>:</td>					
					<td style="font-size:14px;">{{ $compnpwp }}</td>
				  </tr>
				</table>
				
				<div style="text-align: center; margin-top: 10px; margin-bottom: 5px">
				  <b style="font-size:15px;">ADALAH ANGGOTA BIASA KAMAR DAGANG DAN INDUSTRI (KADIN)</b><br>
				  <i style="font-size:14px;">is an Ordinary Member of Chamber of Commerce and Industry (Kadin)</i>
				</div>  
				
				<table width="100%">
					<tr>
					  <td width="25%">
						<strong style="font-size: 12px">Kabupaten/Kota</strong><br>
						<i style="font-size: 11px">District/Municipality</i>
					  </td>
					  <td width="3%">:</td>					  
					  <td style="font-size: 12px">{{ $daerah }}</td>
					  
					  <td width="25%">
						<strong style="font-size: 12px">Provinsi</strong><br>
						<i style="font-size: 11px">Province</i>
					  </td>
					  <td width="3%">:</td>
					  <td style="font-size: 12px">{{ $provinsi }}</td>
					</tr>
				</table>
				<table width="100%">
					<tr>
						<td colspan="3" style="padding-top: 10px">
							<div style="font-size:10px; text-align: center; border: 1px solid #000; width: 3cm; height: 4cm;">
								<div style="top: 50%; left: 50%; transform: translateX(0%) translateY(50%);">
								  Pasfoto<br>
								  Pemimpin<br>
								  Perusahaan<br>
								  <br>
								  3 x 4
								</div>
							</div> 
						</td>
						<td colspan="3">
							<table width="100%">
								<tr>
									<td style="padding-right: 20px">
										<b style="font-size:13px;">Dewan Pengurus Kadin Kabupaten/Kota</b><br>
										<i style="font-size:12px;">Board of Directors, Kadin District/Municipality</i>
										<div style="text-align: center; margin-top: 80px">
											<b style="font-size:13px;text-align: center">Romi Lesmana</b><br>
											<hr style="border-top: dashed 2px;margin: 0 0;" />
											<i style="font-size:12px;">Ketua / Chairman</i>
										</div>
									</td>
									<td style="padding-right: 20px">
										<b style="font-size:13px;">Dewan Pengurus Kadin Propinsi</b><br>
										<i style="font-size:12px;">Board of Directors, Kadin Province</i>
										<div style="text-align: center; margin-top: 80px">
											<b style="font-size:13px;">Ir. H. Eddy Kuntadi</b><br>
											<hr style="border-top: dashed 2px;margin: 0 0;" />
											<i style="font-size:12px;">Ketua Umum / Chairman</i>
										</div>
									</td>
									<td style="padding-right: 20px">
										<b style="font-size:13px;">Dewan Pengurus Kadin Indonesia</b><br>
										<i style="font-size:12px;">Board of Directors, Kadin Indonesia</i>
										<div style="text-align: center; margin-top: 80px">
											<b style="font-size:13px;">Rosan P. Roeslani</b><br>                  
											<hr style="border-top: dashed 2px;margin: 0 0;" />
											<i style="font-size:12px;">Ketua Umum / President</i>
										</div>
									</td>
								</tr>
							</table>
							
							<div style="text-align: center; margin-top:20px;">
								<b style="font-size:12px;">KARTU TANDA ANGGOTA INI TIDAK SAH JIKA TIDAK ADA DATA REGISTRASINYA DI: www.anggotakadin.com</b><br>
								<i style="font-size:11px;">This Certificate is not valid if there is no registration data at: www.anggotakadin.com</i>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>		
	</body>
</html>