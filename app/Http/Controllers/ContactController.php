<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactConfirmation;
use App\Mail\ContactAdmin;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|in:tour,reservation,price,custom,other',
            'message' => 'required|string|min:10|max:5000',
        ], [
            'name.required' => 'El nombre es requerido',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email debe ser válido',
            'subject.required' => 'El asunto es requerido',
            'message.required' => 'El mensaje es requerido',
            'message.min' => 'El mensaje debe tener al menos 10 caracteres',
        ]);

        try {
            // Enviar email al usuario
            Mail::to($validated['email'])
                ->send(new ContactConfirmation(
                    $validated['name'],
                    $validated['email'],
                    $validated['message']
                ));

            // Enviar email al equipo
            Mail::to(env('MAIL_CONTACT_EMAIL', 'info@costaricatrips.com'))
                ->send(new ContactAdmin(
                    $validated['name'],
                    $validated['email'],
                    $validated['phone'],
                    $this->getSubjectLabel($validated['subject']),
                    $validated['message']
                ));

            return response()->json([
                'success' => true,
                'message' => '¡Mensaje enviado exitosamente! Te responderemos pronto.'
            ]);

        } catch (\Exception $e) {
            \Log::error('Error enviando email de contacto: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al enviar el mensaje. Por favor, intenta de nuevo.'
            ], 500);
        }
    }

    private function getSubjectLabel($subject)
    {
        $labels = [
            'tour' => 'Consulta sobre tours',
            'reservation' => 'Reserva',
            'price' => 'Información de precios',
            'custom' => 'Paquete personalizado',
            'other' => 'Otro'
        ];

        return $labels[$subject] ?? 'Contacto';
    }
}
