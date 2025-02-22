<?php

namespace App\Exports;

Use App\Models\PajaklsModel;
Use App\Models\PotonganModel;
Use App\Models\BelanjalsguModel;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class DataExport2 implements FromArray, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            'No',
            'Nomor SPM',
            'Tanggal SP2D',
            'Nomor SP2D',
            'Nilai SP2D',
            'Rek. Belanja',
            'Akun Pajak',
            'Jenis Pajak',
            'Nilai Pajak',
            'E-Biling',
            'NTPN',
            'Ket',
            'Bulan',
        ];
    }
    
    public function array(): array
    {
        return $this->data->toArray();
    }
}
