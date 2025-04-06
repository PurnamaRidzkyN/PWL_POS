<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KategoriController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'kategori']
        ];

        $page = (object) [
            'title' => 'Daftar kategori yang tersedia '
        ];

        $activeMenu = 'kategori'; // set menu yang sedang aktif

        return view('kategori.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list()
    {
        $kategoris = KategoriModel::all(); // Ambil semua data kategori

        return DataTables::of($kategoris)
            ->addIndexColumn() // Tambahkan kolom indeks otomatis
            ->addColumn('aksi', function ($kategori) { // Menambahkan kolom aksi
                $btn = '<a href="' . url('/kategori/' . $kategori->kategori_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/kategori/' . $kategori->kategori_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . 
                    url('/kategori/' . $kategori->kategori_id) . '">'
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
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ];
        $page = (object)[
            'title' => 'Tambah Kategori',
        ];
        $activeMenu = 'kategori';

        return view('kategori.create', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_nama' => 'required|string|min:3|unique:m_kategori,kategori_nama',
            'kategori_kode' => 'required|string|max:10|unique:m_kategori,kategori_kode'
        ]);

        KategoriModel::create([
            'kategori_nama' => $request->kategori_nama,
            'kategori_kode' => $request->kategori_kode
        ]);

        return redirect("/kategori")->with("success", "Data kategori berhasil disimpan");
    }

    public function show(string $id)
    {
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Kategori',
            'list' => ['Home', 'Kategori', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Kategori'
        ];

        $activeMenu = 'kategori';

        return view('kategori.show', compact('breadcrumb', 'kategori', 'page', 'activeMenu'));
    }

    public function edit(string $id)
    {
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Kategori', "Edit"]
        ];
        $page = (object)[
            'title' => "Edit Kategori"
        ];
        $activeMenu = 'kategori';

        return view('kategori.edit', compact('breadcrumb', 'page', 'kategori', 'activeMenu'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_nama' => 'required|string|min:3|unique:m_kategori,kategori_nama,' . $id . ',kategori_id',
            'kategori_kode' => 'required|string|max:10|unique:m_kategori,kategori_kode,' . $id . ',kategori_id'
        ]);

        KategoriModel::find($id)->update([
            'kategori_nama' => $request->kategori_nama,
            'kategori_kode' => $request->kategori_kode
        ]);

        return redirect('/kategori')->with("success", "Data kategori berhasil diubah");
    }

    public function destroy(string $id)
    {
        $check = KategoriModel::find($id);
        if (!$check) {
            return redirect('/kategori')->with('error', 'Data kategori tidak ditemukan');
        }

        try {
            KategoriModel::destroy($id);
            return redirect('/kategori')->with('success', 'Data kategori berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $se) {
            return redirect('/kategori')->with('error', 'Data kategori gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
