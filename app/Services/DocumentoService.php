<?php

// app/Services/DocumentoService.php
namespace App\Services;

use App\Models\Documento;
use App\Models\Proceso;
use App\Models\Tipo;
use App\Repositories\DocumentoRepository;

class DocumentoService
{
    protected $documentoRepository;

    public function __construct(DocumentoRepository $documentoRepository)
    {
        $this->documentoRepository = $documentoRepository;
    }

    public function getAll()
    {
        // return $this->documentoRepository->getAll();
        $documentos = $this->documentoRepository->getAll();
        // dd($documentos);
        return response()->json($documentos);
    }

    public function create($data)
    {
        // Lógica para crear código único
        $tipo = Tipo::find($data['DOC_ID_TIPO']);
        $proceso = Proceso::find($data['DOC_ID_PROCESO']);
        $ultimoDocumento = Documento::where('DOC_ID_TIPO', $data['DOC_ID_TIPO'])
            ->where('DOC_ID_PROCESO', $data['DOC_ID_PROCESO'])
            ->orderBy('DOC_CODIGO', 'desc')
            ->first();

        $consecutivo = $ultimoDocumento ? ((int)explode('-', $ultimoDocumento->DOC_CODIGO)[2] + 1) : 1;
        $data['DOC_CODIGO'] = $tipo->TIP_PREFIJO . '-' . $proceso->PRO_PREFIJO . '-' . $consecutivo;

        return $this->documentoRepository->create($data);
    }

    public function find($id)
    {
        return $this->documentoRepository->find($id);
    }

    public function update($id, $data)
    {
        $documento = $this->documentoRepository->find($id);
        // Lógica para actualizar código si tipo o proceso cambian
        if ($documento->DOC_ID_TIPO != $data['DOC_ID_TIPO'] || $documento->DOC_ID_PROCESO != $data['DOC_ID_PROCESO']) {
            $tipo = Tipo::find($data['DOC_ID_TIPO']);
            $proceso = Proceso::find($data['DOC_ID_PROCESO']);
            $ultimoDocumento = Documento::where('DOC_ID_TIPO', $data['DOC_ID_TIPO'])
                ->where('DOC_ID_PROCESO', $data['DOC_ID_PROCESO'])
                ->orderBy('DOC_CODIGO', 'desc')
                ->first();

            $consecutivo = $ultimoDocumento ? ((int)explode('-', $ultimoDocumento->DOC_CODIGO)[2] + 1) : 1;
            $data['DOC_CODIGO'] = $tipo->TIP_PREFIJO . '-' . $proceso->PRO_PREFIJO . '-' . $consecutivo;
        }

        return $this->documentoRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->documentoRepository->delete($id);
    }
}
