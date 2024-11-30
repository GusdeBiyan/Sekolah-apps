<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Student;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $kelas = Kelas::all();
        $kelas = DB::table('class')
            ->leftJoin('students', 'class.id', '=', 'students.class_id')
            ->leftJoin('teachers', 'class.id', '=', 'teachers.class_id')
            ->select(
                'class.id',
                'class.nama_kelas',
                'class.kode_kelas',
                DB::raw('COUNT(students.id) as jumlah_murid'),
                DB::raw('COUNT(teachers.id) as jumlah_guru'),


            )
            ->groupBy('class.id', 'class.nama_kelas', 'class.kode_kelas')
            ->get();
        // return response()->json($kelas);

        return view('class-page.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kelas' => 'required|string|max:3|unique:class,nama_kelas',
            'kode_kelas' => 'required|string|max:6|unique:class,kode_kelas',
        ]);



        Kelas::create($validatedData);

        session()->flash('toast_message', 'Data berhasil ditambahkan');
        session()->flash('toast_icon', 'success');

        return redirect()->route('class.index')->with('success', 'Data kelas berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('class-page.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {

        $validatedData = $request->validate([
            'nama_kelas' => 'required|string|max:3|unique:class,nama_kelas,' . $id,
            'kode_kelas' => 'required|string|max:6|unique:class,kode_kelas,' . $id,
        ]);


        $kelas = Kelas::findOrFail($id);
        $kelas->update($validatedData);

        session()->flash('toast_message', 'Data berhasil diubah');
        session()->flash('toast_icon', 'success');


        return redirect()->route('class.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Kelas::find($id);


        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        try {

            $data->delete();

            session()->flash('toast_message', 'Data berhasil dihapus');
            session()->flash('toast_icon', 'success');

            return redirect()->route('class.index');
        } catch (QueryException $e) {
            session()->flash('toast_message', 'Terdapat data terhubung, data tidak dapat dihapus');
            session()->flash('toast_icon', 'error');

            return redirect()->route('class.index');
        }
    }
}
