<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Proceso;
use App\Models\Tipo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDocumentoRequest;
use App\Services\DocumentoService;

class DocumentoController extends Controller
{
    protected $documentoService;

    public function __construct(DocumentoService $documentoService)
    {
        $this->documentoService = $documentoService;
    }

    public function index()
    {
        $documentos = $this->documentoService->getAll();
        return $documentos;
        // return view('documentos.index', compact('documentos'));
    }

    public function create()
    {
        $tipos = Tipo::all();
        $procesos = Proceso::all();
        return view('documentos.create', compact('tipos', 'procesos'));
    }

    public function store(Request $request)
    {
        $this->documentoService->create($request->all());
        return redirect()->route('documentos.index');
    }

    public function show($id)
    {
        // return Documento::with(['tipo', 'proceso'])->findOrFail($id);
        $documento = $this->documentoService->find($id);
        return $documento;
    }

    public function edit($id)
    {
        $documento = $this->documentoService->find($id);
        $tipos = Tipo::all();
        $procesos = Proceso::all();
        return view('documentos.edit', compact('documento', 'tipos', 'procesos'));
    }

    public function update(Request $request, $id)
    {
        $this->documentoService->update($id, $request->all());
        // return redirect()->route('documentos.index');
        return response()->json(['message' => 'Documento actualizado correctamente.']);
    }

    public function destroy($id)
    {
        $this->documentoService->delete($id);
        // return redirect()->route('documentos.index');
        return response()->json(['message' => 'Documento eliminado correctamente.']);
    }
}
