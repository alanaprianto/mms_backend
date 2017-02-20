<!-- Bootstrap core CSS -->
<link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('resources/assets/css/table_styles.css') }}" rel="stylesheet">

			@if ($kta)
                @if ($kta->kta=="")
                  <table class="main" width="100%" cellpadding="0" cellspacing="0">
	                <tr>
	                  <td class="alert alert-good">
	                    Your KTA Information
	                  </td>
	                </tr>
	                <tr>
	                  <td class="content-wrap">
	                    <table width="100%" cellpadding="0" cellspacing="0">
	                      <tr>
	                        <td class="content-block">
	                          Berikut Keterangan KTA Anda.
	                        </td>
	                      </tr>
	                      <tr>
	                        <td class="content-block" align="center">
	                          <strong>Permintaan KTA belum diinisialisasi.</strong>
	                        </td>
	                      </tr>
	                      <tr>
	                        <td class="content-block">
	                          Silahkan inisialisasi permintaan KTA pada halaman KTA di akun member kadin anda.
	                        </td>
	                      </tr>
	                      <tr>
	                        <td class="content-block">
	                          Terima Kasih atas kepercayaan anda pada kami.
	                        </td>
	                      </tr>
	                    </table>
	                  </td>
	                </tr>
	              </table>
                @elseif ($kta->kta=="requested")
                  <table class="main" width="100%" cellpadding="0" cellspacing="0">
	                <tr>
	                  <td class="alert alert-good">
	                    Your KTA Information
	                  </td>
	                </tr>
	                <tr>
	                  <td class="content-wrap">
	                    <table width="100%" cellpadding="0" cellspacing="0">
	                      <tr>
	                        <td class="content-block">
	                          Berikut Keterangan KTA Anda.
	                        </td>
	                      </tr>
	                      <tr>
	                        <td class="content-block" align="center">
	                          <strong>Permintaan KTA Telah Terkirim !</strong>
	                        </td>
	                      </tr>
	                      <tr>
	                        <td class="content-block" align="justify">                          
	                          Permintaan KTA anda telah berhasil dikirimkan. Proses registrasi dan implementasi KTA akan memakan waktu beberapa saat. Kami ucapkan terima kasih atas pengertian dan kesabaran anda.
	                        </td>
	                      </tr>
	                      <tr>
	                        <td class="content-block">
	                          Terima Kasih atas kepercayaan anda pada kami.
	                        </td>
	                      </tr>
	                    </table>
	                  </td>
	                </tr>
	              </table>
                @elseif ($kta->kta=="validated")
                  <table class="main" width="100%" cellpadding="0" cellspacing="0">
	                <tr>
	                  <td class="alert alert-good">
	                    Your KTA Information
	                  </td>
	                </tr>
	                <tr>
	                  <td class="content-wrap">
	                    <table width="100%" cellpadding="0" cellspacing="0">
	                      <tr>
	                        <td class="content-block">
	                          Berikut Keterangan KTA Anda.
	                        </td>
	                      </tr>
	                      <tr>
	                        <td class="content-block" align="center">
	                          <strong>Permintaan KTA Telah Terkirim !</strong>
	                        </td>
	                      </tr>
	                      <tr>
	                        <td class="content-block" align="justify">                          
	                          Permintaan KTA anda telah berhasil dikirimkan. Permintaan KTA anda saat ini sedang dalam proses validasi pada Kadin Kabupaten/Kota dimana anda terdaftar. Proses registrasi dan implementasi KTA akan memakan waktu beberapa saat. Kami ucapkan terima kasih atas pengertian dan kesabaran anda.
	                        </td>
	                      </tr>
	                      <tr>
	                        <td class="content-block">
	                          Terima Kasih atas kepercayaan anda pada kami.
	                        </td>
	                      </tr>
	                    </table>
	                  </td>
	                </tr>
	              </table>
                @elseif ($kta->kta=="cancelled")
                  <table class="main" width="100%" cellpadding="0" cellspacing="0">
	                <tr>
	                  <td class="alert alert-bad">
	                    Your KTA Information
	                  </td>
	                </tr>
	                <tr>
	                  <td class="content-wrap">
	                    <table width="100%" cellpadding="0" cellspacing="0">
	                      <tr>
	                        <td class="content-block">
	                          Berikut Keterangan KTA Anda.
	                        </td>
	                      </tr>
	                      <tr>
	                        <td class="content-block" align="center">
	                          <strong>Permintaan KTA Ditolak !</strong>
	                        </td>
	                      </tr>
	                      <tr>
	                        <td class="content-block" align="justify">
	                          Permintaan KTA anda telah ditolak. Harap perhatikan syarat dan ketentuan anggota kadin. Untuk pengajuan ulang dan bantuan silahkan...
	                        </td>
	                      </tr>
	                      <tr>
	                        <td class="content-block">
	                          Terima Kasih atas kepercayaan anda pada kami.
	                        </td>
	                      </tr>
	                    </table>
	                  </td>
	                </tr>
	              </table>
                @else
                  <table class="main" width="100%" cellpadding="0" cellspacing="0">
	                <tr>
	                  <td class="alert alert-good">
	                    Your KTA Information
	                  </td>
	                </tr>
	                <tr>
	                  <td class="content-wrap">
	                    <table width="100%" cellpadding="0" cellspacing="0">
	                      <tr>
	                        <td class="content-block">
	                          Berikut Keterangan KTA Anda.
	                        </td>
	                      </tr>
	                      <tr>
	                        <td class="content-block" align="center">
	                          <strong>KTA Anda telah Dibuat !</strong>
	                        </td>
	                      </tr>
	                      <tr>
	                        <td class="content-block" align="justify">
	                          Permintaan KTA anda telah berhasil digenerate. Berikut adalah nomor KTA Anda
	                          <br><br>
	                          <table class="table table-striped table-bordered table-hover dataTables-example" id="kta-table">
	                            <thead align="center">
	                              <tr>
	                                <th style="text-align: center">No KTA</th>
	                                <th style="text-align: center">Requested At</th>
	                                <th style="text-align: center">Granted At</th>
	                                <th style="text-align: center">Expired At</th>                                    
	                              </tr>
	                            </thead>
	                            <tbody>
	                              <tr align="center">
	                                <td>{{ $kta->kta }}</td>
	                                <td>{{ $kta->requested_at }}</td>
	                                <td>{{ $kta->granted_at }}</td>
	                                <td>{{ $kta->expired_at }}</td>
	                              </tr>
	                            </tbody>
	                          </table>

	                          @if ($exp_show)
	                            <table class="table table-striped table-bordered table-hover dataTables-example" id="setting-table">
	                              <tr>
	                                <td style="background:#f7ecb5;font-weight:bold;text-align:center;">
	                                  Perhatian !!
	                                </td> 
	                              </tr>
	                              <tr>
	                                <td align="center">
	                                  <p>{{ $exp_text1 }}</p>
	                                  <p>{{ $exp_text2 }} <strong>{{ $exp_text3 }}</strong></p>
	                                  <br>
	                                  @if($ext_show)
	                                    <p>Anda belum melakukan request perpanjangan KTA!!</p>
	                                  @else
	                                    <p>Request perpanjangan KTA sedang di proses</p>
	                                  @endif
	                                </td>
	                              </tr>
	                            </table>
	                          @endif
	                          Mohon diperhatikan, Nomor KTA bersifat abadi atau nomor yang anda miliki tidak akan digenerate lagi. Bila nomor KTA anda tidak tervalidasi, kemungkinan nomor KTA anda telah habis masa berlaku. Gunakan fitur perpanjangan KTA untuk memperpanjang masa berlaku KTA anda. 
	                        </td>
	                      </tr>
	                      <tr>
	                        <td class="content-block">
	                          Terima Kasih atas kepercayaan anda pada kami.
	                        </td>
	                      </tr>
	                    </table>
	                  </td>
	                </tr>
	              </table>                  
                @endif
            @else
			  <table class="main" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="alert alert-bad">
                    Your KTA Information
                  </td>
                </tr>
                <tr>
                  <td class="content-wrap">
                    <table width="100%" cellpadding="0" cellspacing="0">
                      <tr>
                        <td class="content-block">
                          Berikut Keterangan KTA Anda.
                        </td>
                      </tr>
                      <tr>
                        <td class="content-block" align="center">
                          <strong>Tracking Code Tidak Terdaftar !</strong>
                        </td>
                      </tr>
                      <tr>
                        <td class="content-block" align="justify">
                          Tracking Code anda tidak terdaftar pada Sistem. Silahkan cek kembali informasi pendaftaran anda, atau silahkan menghubungi....
                        </td>
                      </tr>
                      <tr>
                        <td class="content-block">
                          Terima Kasih atas kepercayaan anda pada kami.
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>              
            @endif