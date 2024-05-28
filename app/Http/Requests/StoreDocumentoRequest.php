<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'DOC_NOMBRE' => 'required|string|min:3',
            'DOC_ID_TIPO' => 'required|exists:tipos,TIP_ID',
            'DOC_ID_PROCESO' => 'required|exists:procesos,PRO_ID',
            'DOC_CONTENIDO' => 'required|string|min:10',
        ];
    }

    public function messages()
    {
        return [
            'DOC_NOMBRE.required' => 'El nombre es obligatorio.',
            'DOC_NOMBRE.min' => 'El nombre debe tener al menos 3 caracteres.',
            'DOC_ID_TIPO.required' => 'El tipo es obligatorio.',
            'DOC_ID_TIPO.exists' => 'El tipo seleccionado no es válido.',
            'DOC_ID_PROCESO.required' => 'El proceso es obligatorio.',
            'DOC_ID_PROCESO.exists' => 'El proceso seleccionado no es válido.',
            'DOC_CONTENIDO.required' => 'El contenido es obligatorio.',
            'DOC_CONTENIDO.min' => 'El contenido debe tener al menos 10 caracteres.',
        ];
    }
}
