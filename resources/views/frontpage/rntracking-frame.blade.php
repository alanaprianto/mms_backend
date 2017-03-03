<!-- Bootstrap core CSS -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/table_styles.css') }}" rel="stylesheet">

@if (!$rn||$rn=='requested'||$rn=='cancelled')
    <table class="main" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="alert alert-bad">
                Your Registration Number Information
            </td>
        </tr>
        <tr>
            <td class="content-wrap">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center" class="content-block">
                            Berikut Keterangan Nomor Registrasi <u>{{ $norn }}</u>.
                        </td>
                    </tr>
                    <tr>
                        <td class="content-block" align="center">
                            <i class="fa fa-cross"></i>
                            <strong>Not Valid !</strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="content-block" align="center">
                            Silahkan cek kembali informasi pendaftaran anda, atau silahkan menghubungi....
                        </td>
                    </tr>
                    <tr>
                        <td class="content-block" align="center">
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
                Your Registration Number Information
            </td>
        </tr>
        <tr>
            <td class="content-wrap">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="content-block" align="center">
                            Berikut Keterangan Nomor Registrasi <u>{{ $norn }}</u>.
                        </td>
                    </tr>
                    <tr>
                        <td class="content-block" align="center">
                            <i class="fa fa-cross"></i>
                            <strong>Valid !</strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="content-block" align="justify">
                        </td>
                    </tr>
                    <tr>
                        <td class="content-block" align="center">
                            Terima Kasih atas kepercayaan anda pada kami.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endif