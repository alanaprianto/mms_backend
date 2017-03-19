<div marginheight="0" marginwidth="0" style="background:#f8f8f8;margin:0;padding:0;width:100%!important" bgcolor="#f8f8f8">
  <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
    <tbody>
      <tr>
        <td align="left">
          <br>
          <img src="https://devtes.com/mms/frontend/images/logo_kadin.png" alt="KADIN" title="Kamar Dagang Indonesia" border="0">
          <br>
          <br>
        </td>
      </tr>
      <tr>
        <td bgcolor="#ffffff" id="m_-4581711903985989275contentContainer" style="border-collapse:collapse;border-spacing:0;color:#999;font-family:'Arial',sans-serif;line-height:1.5;margin:0;padding:0">
          <table align="left" width="100%" style="border-collapse:collapse;border-spacing:0;margin:0;padding:0">
            <tbody>
              <tr>
                <td style="padding:15px;background-color:white;" valign="top">
                  <p style="color:#555;font-family:'Arial',sans-serif;font-size:14px;line-height:1.5;margin:0;padding:0">
                    Dear {{ $name }},</p><br/>
                  <p align="justify" style="color:#555;font-family:'Arial',sans-serif;font-size:14px;line-height:1.5;margin:0;padding:0">
                    Pendaftaran Anda sudah diterima dan saat ini sedang dalam proses verifikasi. Mohon kesediaannya untuk segera melunasi biaya-biaya yang diperlukan, rincian biaya yang perlu segera dilunasi tertera pada tabel di bawah. Dalam melakukan pembayaran, anda diwajibkan menyertakan code berikut: <strong>{{ $code }}</strong>. Code tersebut untuk menandai form pendaftaran anda pada sistem.
                  </p><br/>
                  <p align="justify" style="color:#555;font-family:'Arial',sans-serif;font-size:14px;line-height:1.5;margin:0;padding:0">
                    Untuk petunjuk selanjutnya setelah pembayaran, Mohon kesediaannya menunggu email kami dalam waktu 1x24 jam, dimana kami akan memberikan informasi akun anda. Jika dalam waktu tersebut anda belum mendapatkan e-mail berisi informasi akun anda, silahkan ....
                  </p><br/>
                  <p style="color:#555;font-family:'Arial',sans-serif;font-size:14px;line-height:1.5;margin:0;padding:0">
                    Berikut adalah rincian biaya pendaftaran anda:
                  </p><br/>
                  <p align="right" style="color:#555;font-family:'Arial',sans-serif;font-size:12px;line-height:1.5;margin:0;padding:0">
                    Registered at {{ $date }}
                  </p>
                  <table style="width: 100%;max-width: 100%;margin-bottom: 20px;background-color: #f9f9f9;border: 1px solid #ddd !important;">
                    <tr>
                      <td colspan="2" valign="top">
                        <div align="left">
                          <span style="color:#555;font-family:'Arial',sans-serif;font-size:14px;line-height:1.5;margin:0;padding:5px;">
                            Tracking Code : {{ $code }}
                          </span>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size:12px;background:#dceff5;font-weight:bold;">
                        <span style="color:#555;font-family:'Arial',sans-serif;font-size:14px;line-height:1.5;margin:0;padding:5px;">
                          Jenis Biaya
                        </span>
                      </td>
                      <td style="font-size:12px;background:#dceff5;font-weight:bold;">
                        <span style="color:#555;font-family:'Arial',sans-serif;font-size:14px;line-height:1.5;margin:0;padding:5px;">
                          Jumlah
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td valign="top" style="font-size:11px;border-bottom:1px solid #dee2e3;">
                        <span style="color:#555;font-family:'Arial',sans-serif;font-size:14px;line-height:1.5;margin:0;padding:5px;">
                          Biaya Pendaftaran Tahun Pertama
                        </span>
                      </td>
                      <td valign="top" style="font-size:11px;border-bottom:1px solid #dee2e3;">
                        <span style="color:#555;font-family:'Arial',sans-serif;font-size:14px;line-height:1.5;margin:0;padding:5px;">
                          250.000
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" style="font-size:12px;border-bottom:1px solid #dee2e3;">
                        <span style="color:#555;font-family:'Arial',sans-serif;font-size:14px;line-height:1.5;margin:0;padding:5px;">
                          <strong>Total Harga</strong>
                        </span>
                      </td>
                      <td align="right" valign="top" style="font-size:12px;border-bottom:1px solid #dee2e3;">
                        <span style="color:#555;font-family:'Arial',sans-serif;font-size:14px;line-height:1.5;margin:0;padding:5px;">
                          <strong>Rp 250.000</strong>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2" align="right" valign="top">
                        <a target="_blank" href="{{ url('/register1pay') }}" style="padding:5px;">
                          <input type="button" value="Lakukan Pembayaran" style="display: inline-block;
                                      padding: 6px 12px;
                                      margin-bottom: 0;
                                      font-size: 14px;
                                      font-weight: normal;
                                      line-height: 1.42857143;
                                      text-align: center;
                                      white-space: nowrap;
                                      vertical-align: middle;
                                      -ms-touch-action: manipulation;
                                          touch-action: manipulation;
                                      cursor: pointer;
                                      -webkit-user-select: none;
                                         -moz-user-select: none;
                                          -ms-user-select: none;
                                              user-select: none;
                                      background-image: none;
                                      border: 1px solid transparent;
                                      border-radius: 4px;
                                      color: #fff;
                                      background-color: #337ab7;
                                      border-color: #2e6da4;
                                      ">
                        </a>
                      </td>
                    </tr>
                  </table>
                  <p align="justify" style="color:#555;font-family:'Arial',sans-serif;font-size:14px;line-height:1.5;margin:0;padding:0">
                    Terima kasih telah mendaftar di Kamar Dagang Indonesia.
                  </p>
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
      <tr>
        <td style="border-collapse:collapse;border-spacing:0;color:#999;font-family:'Arial',sans-serif;line-height:1.5;margin:0;padding:0">
          <table width="100%" style="background:#f0f0f0;border-collapse:collapse;border-spacing:0;font-size:12px;margin:0;padding:10px 0 10px 0" bgcolor="#f0f0f0">
            <tbody>
              <tr>
                <td width="10%"></td>
                <td width="80%" align="center">
                  <table>
                    <tr>
                      <td>
                        <img src="https://devtes.com/mms/frontend/images/icon_warning.png" alt="KADIN" title="Kamar Dagang Indonesia" border="0">
                      </td>
                      <td align="center">
                        <p style="color:#999;font-family:'Arial',sans-serif;font-size:12px;line-height:1.5;margin:5px 0 5px 5px;padding:0">
                          Jangan lupa untuk menyertakan tracking code anda pada keterangan transfer.<br/>
                          Tracking Code anda adalah: <strong>{{ $code }}</strong>
                        </p>
                      </td>
                    </tr>
                  </table>
                </td>
                <td width="10%"></td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <br>
          <table style="font-family:Arial, Helvetica, Sans-Serif;text-align:justify;font-size:12px;line-height:18px;color:rgb(0, 0, 0);" align="center" border="0" cellpadding="0" cellspacing="0" width="700">
            <tbody>
              <tr>
                <td height="" valign="middle" width="250">
                  <p style="font-family:Arial, Helvetica, sans-serif;font-size:16px;color:rgb(91, 91, 91);margin-left:10px;margin-top:10px;">
                    <strong>Ada Pertanyaan?</strong>
                  </p>
                  <p style="margin-top:6px;font-family:Arial, Helvetica, sans-serif;font-size:11px;color:rgb(91, 91, 91);margin-left:10px;">
                    Silahkan kunjungi
                    <a rel="nofollow" target="_blank" href="https://devtes.com/mms/">FAQ</a>
                    kami untuk tips terbaru dan pertanyaan yang sering diajukan.
                    Kami bisa bantu Anda. Hubungi
                    Customer Service kami
                    <a rel="nofollow" target="_blank" href="https://devtes.com/mms/">disini</a>.
                    Jika Anda ingin menghubungi kami, jangan ragu untuk memberikan informasi
                    <a rel="nofollow" target="_blank" href="https://devtes.com/mms/">disini</a>.
                  </p>
                </td>
                <td width="7">&nbsp;
                </td>
                <td align="left" valign="top" width="220">
                  <p style="font-family:Arial, Helvetica, sans-serif;font-size:11px;color:rgb(91, 91, 91);margin-top:10px;" align="right">
                    <strong>Email ini dikirim oleh</strong>
                    <br>
                    Kamar Dagang Indonesia<br>
                    Menara Kadin Indonesia Lantai 29.<br>
                    Jl. H.R. Rasuna Said X-5 Kav. 2-3 Jakarta 12950 Indonesia<br>
                    Telepon: (62-21) 5274484 ext 126<br>
                    Fax: (62-21) 5274331, 5274332
                  </p>
                </td>
              </tr>
            </tbody>
          </table>
          <br>
        </td>
      </tr>
      <tr>
        <td style="border-collapse:collapse;border-spacing:0;color:#999;font-family:'Arial',sans-serif;line-height:1.5;margin:0;padding:0">
          <table id="m_-4581711903985989275footerSeparator" width="100%" style="border-collapse:collapse;border-spacing:0;border-top-color:#ccc;border-top-style:solid;border-top-width:2px;margin:0;padding:0;table-layout:fixed">
            <tbody><tr>
              <td height="2" style="border-collapse:collapse;border-spacing:0;color:#999;font-family:'Arial',sans-serif;line-height:1.5;margin:0;padding:0"></td>
            </tr>
            </tbody></table>
        </td>
      </tr>
      <tr>
        <td align="center" style="border-collapse:collapse;border-spacing:0;color:#999;font-family:'Arial',sans-serif;line-height:1.5;margin:0;padding:0">
          <p style="margin-top:10px;font-family:Arial, Helvetica, sans-serif;font-size:11px;color:rgb(91, 91, 91);margin-left:10px;">
            Informasi Anda aman bersama kami. Silakan lihat
            <a rel="nofollow" target="_blank" href="https://devtes.com/mms/">Kebijakan Privasi</a> kami.<br>
            Harap jangan membalas e-mail ini, karena e-mail ini dikirimkan secara otomatis oleh sistem.
          </p>
        </td>
      </tr>
    </tbody></table>
</div>