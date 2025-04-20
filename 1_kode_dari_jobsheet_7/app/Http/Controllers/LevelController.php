<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Http\Requests\StoreLevelRequest;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class LevelController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'level']
        ];

        $page = (object) [
            'title' => 'Daftar level yang tersedia '
        ];

        $activeMenu = 'level'; // set menu yang sedang aktif


        return view('level.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
    public function list()
    {
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama');

        return DataTables::of($levels)
            ->addIndexColumn()
            ->addColumn('aksi', function ($level) {
                $btn  = '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];
        $page = (object)[
            'title' => 'Tambah Level',
        ];
        $activeMenu = 'level';

        return view('level.create', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function create_ajax()
    {
        return view('level.create_ajax');
    }
    public function store_ajax(Request $request)
    {

        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_nama' => 'required|string|min:3|unique:m_level,level_nama',
                'level_kode' => 'required|string|max:10|unique:m_level,level_kode'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Proses gagal',
                    'msgField' => $validator->errors()->messages()
                ]);
            }
            LevelModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Proses berhasil'
            ]);
        }
        redirect('/');
    }


    public function store(Request $request)
    {
        $request->validate([
            'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:10|unique:m_level,level_nama'
        ]);

        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama
        ]);

        return redirect("/level")->with("success", "Data level berhasil disimpan");
    }

    public function show(string $id)
    {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Level',
            'list' => ['Home', 'Level', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Level'
        ];

        $activeMenu = 'level';

        return view('level.show', compact('breadcrumb', 'level', 'page', 'activeMenu'));
    }

    public function edit(string $id)
    {
        $level = LevelModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Level',
            'list' => ['Home', 'Level', "Edit"]
        ];
        $page = (object)[
            'title' => "Edit Level"
        ];
        $activeMenu = 'level';

        return view('level.edit', compact('breadcrumb', 'page', 'level', 'activeMenu'));
    }
    public function edit_ajax(string $id)
    {
        $level = LevelModel::find($id);
        return view('level.edit_ajax', compact('level'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'level_nama' => 'required|string|min:3|unique:m_level,level_nama,' . $id . ',id',
            'level_kode' => 'required|string|max:10|unique:m_level,level_kode,' . $id . ',id'
        ]);

        LevelModel::find($id)->update([
            'level_nama' => $request->level_nama,
            'level_kode' => $request->level_kode
        ]);

        return redirect('/level')->with("success", "Data level berhasil diubah");
    }

    public function update_ajax(Request $request, $id)
    {
        // Cek apakah request dari AJAX
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_kode' => 'required|string|min:3|unique:m_level,level_kode,' . $id . ',level_id',
                'level_nama' => 'required|string|max:10|unique:m_level,level_nama,' . $id . ',level_id'
            ];

            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Proses gagal',
                    'msgField' => $validator->errors()->messages()
                ]);
            }

            $check = LevelModel::find($id);
            if ($check) {
                $check->update($request->all());

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $level = LevelModel::find($id);
        return view('level.confirm_ajax', compact('level'));
    }
    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $level = LevelModel::find($id);
            if ($level) {
                $level->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        redirect('/');
    }

    public function destroy(string $id)
    {
        $check = LevelModel::find($id);
        if (!$check) {
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }

        try {
            LevelModel::destroy($id);
            return redirect('/level')->with('success', 'Data level berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $se) {
            return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function import()
    {
        return view('level.import');
    }
    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'file_level' => ['required', 'mimes:xlsx', 'max:1024']
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $file = $request->file('file_level');
            $reader = IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, false, true, true);

            $insert = [];
            if (count($data) > 1) {
                foreach ($data as $baris => $value) {
                    if ($baris > 1) {
                        $insert[] = [
                            'level_kode' => $value['A'],
                            'level_nama' => $value['B'],
                            'created_at' => now()
                        ];
                    }
                }

                if (count($insert) > 0) {
                    LevelModel::insertOrIgnore($insert);
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Data level berhasil diimport'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang diimport'
                ]);
            }
        }

        return redirect('/');
    }
    public function export_excel()
    {
        $level = LevelModel::select('level_id', 'level_kode', 'level_nama')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Level');
        $sheet->setCellValue('C1', 'Nama Level');

        $sheet->getStyle('A1:C1')->getFont()->setBold(true);

        $no = 1;
        $baris = 2;

        foreach ($level as $value) {
            $sheet->setCellValue('A' . $baris, $no++);
            $sheet->setCellValue('B' . $baris, $value->level_kode);
            $sheet->setCellValue('C' . $baris, $value->level_nama);
            $baris++;
        }

        foreach (range('A', 'C') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $sheet->setTitle('Data Level');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Level ' . date('Y-m-d H:i:s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
    public function export_pdf()
    {
        $level = LevelModel::select('level_kode', 'level_nama')
            ->orderBy('level_kode')
            ->get();
    
        $pdf = Pdf::loadView('level.export_pdf', ['level' => $level]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream('Data Level ' . date('Y-m-d H:i:s') . '.pdf');
    }
    
}
