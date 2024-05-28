<?php

// app/Services/DocumentoService.php
// app/Repositories/DocumentoRepository.php
namespace App\Repositories;

use App\Models\Documento;

class DocumentoRepository
{
    public function getAll()
    {
        return Documento::all();
    }

    public function create($data)
    {
        return Documento::create($data);
    }

    public function find($id)
    {
        return Documento::findOrFail($id);
    }

    public function update($id, $data)
    {
        $documento = Documento::findOrFail($id);
        $documento->update($data);
        return $documento;
    }

    public function delete($id)
    {
        $documento = Documento::findOrFail($id);
        $documento->delete();
        return $documento;
    }
}
