<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreLevelRequest;

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
        $levels = LevelModel::all(); // Ambil semua data level

        return DataTables::of($levels)
            ->addIndexColumn() // Tambahkan kolom indeks otomatis
            ->addColumn('aksi', function ($level) { // Menambahkan kolom aksi
                $btn = '<a href="' . url('/level/' . $level->level_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/level/' . $level->level_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' .
                    url('/level/' . $level->id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // Agar HTML tombol bisa ditampilkan
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

    public function store(Request $request)
    {
        $request->validate([
            'nama_level' => 'required|string|min:3|unique:m_level,nama_level',
            'kode_level' => 'required|string|max:10|unique:m_level,kode_level'
        ]);

        LevelModel::create([
            'nama_level' => $request->nama_level,
            'kode_level' => $request->kode_level
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

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_level' => 'required|string|min:3|unique:m_level,nama_level,' . $id . ',id',
            'kode_level' => 'required|string|max:10|unique:m_level,kode_level,' . $id . ',id'
        ]);

        LevelModel::find($id)->update([
            'nama_level' => $request->nama_level,
            'kode_level' => $request->kode_level
        ]);

        return redirect('/level')->with("success", "Data level berhasil diubah");
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
}
