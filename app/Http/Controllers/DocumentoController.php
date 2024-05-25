<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Proceso;
use App\Models\Tipo;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentos = Documento::all();
        return view('documentos.index', compact('documentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // método para guardar los documentos
        // se validan los datos necesarios para la inserción
        $request->validate([
            'DOC_NOMBRE' => 'required',
            'DOC_ID_TIPO' => 'required|exists:tip_tipo_doc,TIP_ID',
            'DOC_ID_PROCESO' => 'required|exists:pro_proceso,PRO_ID',
            'DOC_CONTENIDO' => 'required',
        ]);

        $tipo = Tipo::find($request->DOC_ID_TIPO);
        $proceso = Proceso::find($request->DOC_ID_PROCESO);

        // se concatena para generar un código 
        $codigo = $tipo->TIP_PREFIJO . '-' . $proceso->PRO_PREFIJO . '-' . (Documento::where('DOC_ID_TIPO', $request->DOC_ID_TIPO)->where('DOC_ID_PROCESO', $request->DOC_ID_PROCESO)->count() + 1);

        $documento = new Documento([
            'DOC_NOMBRE' => $request->DOC_NOMBRE,
            'DOC_CODIGO' => $codigo,
            'DOC_CONTENIDO' => $request->DOC_CONTENIDO,
            'DOC_ID_TIPO' => $request->DOC_ID_TIPO,
            'DOC_ID_PROCESO' => $request->DOC_ID_PROCESO,
        ]);

        $documento->save();

        return response()->json($documento, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Documento::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // método para actualizar un documento
        // se validan los datos requeridos para la actualización
        $request->validate([
            'DOC_NOMBRE' => 'required',
            'DOC_ID_TIPO' => 'required|exists:tip_tipo_doc,TIP_ID',
            'DOC_ID_PROCESO' => 'required|exists:pro_proceso,PRO_ID',
            'DOC_CONTENIDO' => 'required',
        ]);

        // se busca si existe el registro y se guarda en la variable $documento
        $documento = Documento::findOrFail($id);

        // se valida el siguiente punto: No se deben repetir los consecutivos, es decir, si el consecutivo 1 ya fue usado en un documento con el mismo Tipo y Proceso, este número no debe volver a utilizarse.
        if ($documento->DOC_ID_TIPO != $request->DOC_ID_TIPO || $documento->DOC_ID_PROCESO != $request->DOC_ID_PROCESO) {
            $tipo = Tipo::find($request->DOC_ID_TIPO);
            $proceso = Proceso::find($request->DOC_ID_PROCESO);
            $codigo = $tipo->TIP_PREFIJO . '-' . $proceso->PRO_PREFIJO . '-' . (Documento::where('DOC_ID_TIPO', $request->DOC_ID_TIPO)->where('DOC_ID_PROCESO', $request->DOC_ID_PROCESO)->count() + 1);
            $documento->DOC_CODIGO = $codigo;
        }

        $documento->DOC_NOMBRE = $request->DOC_NOMBRE;
        $documento->DOC_CONTENIDO = $request->DOC_CONTENIDO;
        $documento->DOC_ID_TIPO = $request->DOC_ID_TIPO;
        $documento->DOC_ID_PROCESO = $request->DOC_ID_PROCESO;

        $documento->save();

        return response()->json($documento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documento = Documento::findOrFail($id);
        $documento->delete();

        return response()->json(null, 204);
    }
}
