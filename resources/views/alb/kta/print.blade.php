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
		<div class="kadin-border" style="background-color: #fffbe2;">
			<!-- header -->
			<div style="text-align: center; margin-left: 281px;">
				<table>
					<tr valign="middle">
						<td><img src="{{ url('resources/img/icon144-128x128-10.png') }}" width="95px"></td>
						<td style="text-align: center; line-height: 25px">
							<b style="font-size:19px;">KAMAR DAGANG DAN INDUSTRI</b><br>
							<i style="font-size:17px;">Chamber of Commerce and Industry</i><br>
							<b style="font-size:22px;">KARTU TANDA ANGGOTA LUAR BIASA</b><br>
							<i style="font-size:17px;">Certificate of Extra - Ordinary Member</i>
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
					  <b style="font-size:15px;">NAMA ORGANISASI</b><br>
					  <i style="font-size:14px;">Name of Company</i>
					</td>
					<td width="3%">:</td>
					<td style="font-size:14px;" width="30%">{{ $orgname }}</td>
					
					<td colspan="4">&nbsp;</td>
				  </tr>                              
				  <tr>
					<td>
					  <b style="font-size:15px;">PEMIMPIN ORGANISASI</b><br>
					  <i style="font-size:14px;">Person in Charge</i>
					</td>
					<td>:</td>					
					<td style="font-size:14px;">{{ $orglead }}</td>
					
					<td width="7%">&nbsp;</td>					
					<td width="15%">
					  <b style="font-size:15px;">KODE POS</b><br>
					  <i style="font-size:14px;">Zip Code</i>
					</td>
					<td width="3%">:</td>				
					<td style="font-size:14px;" width="30%">{{ $postcode }}</td>
				  </tr>
				  <tr>
					<td>
					  <b style="font-size:15px;">ALAMAT PERUSAHAAN</b><br>
					  <i style="font-size:14px;">Company's Address</i>
					</td>
					<td>:</td>					
					<td style="font-size:14px;">{{ $orgaddr}}</td>
					
					<td width="7%">&nbsp;</td>
					<td>
					  <b style="font-size:15px;">NOMOR KBLI</b><br>
					  <i style="font-size:14px;">ISIC Code</i>
					</td>
					<td>:</td>					
					<td style="font-size:14px;">{{ $kblicode }}</td>
				  </tr>
				  <tr>
					<td>
					  <b style="font-size:15px;">KLASIFIKASI USAHA</b><br>
					  <i style="font-size:14px;">Industrial Classification</i>
					</td>
					<td>:</td>					
					<td style="font-size:14px;">{{ $orgclass }}</td>
					
					<td colspan="4">&nbsp;</td>
				  </tr>				  
				</table>
				
				<div style="text-align: center; margin-top: 10px; margin-bottom: 5px">
				  <b style="font-size:15px;">ADALAH ANGGOTA LUAR BIASA KAMAR DAGANG DAN INDUSTRI (KADIN)</b><br>
				  <i style="font-size:14px;">is an Extra - Ordinary Member of Chamber of Commerce and Industry (CCI)</i>				  
				</div>
				<br>
				<table align="center">
				  <tr>
					<td style="padding-right:25px">
					  <strong style="font-size: 12px">Di Daerah Provinsi</strong><br>
					  <i style="font-size: 11px">Registered in Province</i>
					</td>
					<td style="padding-right:10px">:</td>
					<td style="font-size: 12px;padding-right:10px">{{ $provinsi }}</td>
				  </tr>
				</table>
				<br>
				<table width="100%">
					<tr>
						<td align="center" width="15%">						
						</td>
						<td align="center" width="30%">
							<b style="font-size:13px;">Dewan Pengurus Kadin Propinsi</b><br>
							<i style="font-size:12px;">Board of Directors, Kadin Province</i>
							<div style="text-align: center; margin-top: 80px">
								<b style="font-size:13px;">Ir. H. Eddy Kuntadi</b><br>
								<hr style="border-top: dashed 2px;margin: 0 0;" />
								<i style="font-size:12px;">Ketua Umum / Chairman</i>
							</div>
						</td>
						<td align="center" width="10%">							
						</td>
						<td align="center" width="30%">
							<b style="font-size:13px;">Dewan Pengurus Kadin Indonesia</b><br>
							<i style="font-size:12px;">Board of Directors, Kadin Indonesia</i>
							<div style="text-align: center; margin-top: 80px">
								<b style="font-size:13px;">Rosan P. Roeslani</b><br>                  
								<hr style="border-top: dashed 2px;margin: 0 0;" />
								<i style="font-size:12px;">Ketua Umum / President</i>
							</div>
						</td>
						<td align="center" width="15%">							
						</td>
					</tr>
				</table>
				<div style="text-align: center; margin-top:20px;">
					<b style="font-size:12px;">KARTU TANDA ANGGOTA INI TIDAK SAH JIKA TIDAK ADA DATA REGISTRASINYA DI: www.anggotakadin.com</b><br>
					<i style="font-size:11px;">This Certificate is not valid if there is no registration data at: www.anggotakadin.com</i>
				</div>				
			</div>
		</div>		
	</body>
</html>