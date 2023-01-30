<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('rupiah'))
{
	function rupiah($rupiah)
    {
        return 'Rp '.number_format($rupiah, 0, ",", ".");
    }
}

if ( ! function_exists('tanggal'))
{
	function tanggal($tanggal)
    {
        $exp_tanggal = explode('-', $tanggal);
        $tahun       = $exp_tanggal[0];
        $bulan       = bulan($exp_tanggal[1]);
        $tanggal     = $exp_tanggal[2];
        return $tanggal.' '.$bulan.' '.$tahun;
    }
}

if ( ! function_exists('bulan'))
{
	function bulan($bulan)
    {
        switch ($bulan) {
            case '01':
                return 'Januari';
                break;
            case '02':
                return 'Februari';
                break;
            case '03':
                return 'Maret';
                break;
            case '04':
                return 'April';
                break;
            case '05':
                return 'Mei';
                break;
            case '06':
                return 'Juni';
                break;
            case '07':
                return 'Juli';
                break;
            case '08':
                return 'Agustus';
                break;
            case '09':
                return 'September';
                break;
            case '10':
                return 'Oktober';
                break;
            case '11':
                return 'November';
                break;
            case '12':
                return 'Desember';
                break;
            default:
                return '';
                break;
        }
    }
}
