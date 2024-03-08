<?php

namespace App\Http\Controllers\Api;

use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CertificateController extends Controller
{
    public function index()
{
    $certificates = Certificate::all();
    return response()->json($certificates);
}

    public function create()
    {
        return view('certificates.create');
    }
    
    public function show(Certificate $certificate)
{
    // Return the certificate as JSON response
    return response()->json($certificate);
}


    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'age' => 'required|numeric',
        'address' => 'required',
        'contact_number' => 'required',
        'gender' => 'required',
        'purpose' => 'required',
        'certificate_type' => 'required',
        'request_date' => 'required|date',
        'issued_date' => 'nullable|date',
        'status' => 'required',
    ]);

    $certificate = Certificate::create($request->all());

    // Return the created certificate object
    return response()->json($certificate);
}

    public function edit(Certificate $certificate)
    {
        return view('certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'name' => 'required',
            'age' => 'required|numeric',
            'address' => 'required',
            'contact_number' => 'required',
            'gender' => 'required',
            'purpose' => 'required',
            'certificate_type' => 'required',
            'request_date' => 'required|date',
            'issued_date' => 'nullable|date',
            'status' => 'required',
        ]);
    
        $certificate->update($request->only([
            'name', 'age', 'address', 'contact_number', 'gender',
            'purpose', 'certificate_type', 'request_date', 'issued_date', 'status'
        ]));
    
        // Return the updated certificate object
        return response()->json($certificate);
    }
    


public function destroy(Certificate $certificate)
{
    try {
        // Store a copy of the deleted certificate
        $deletedCertificate = $certificate->replicate();

        // Delete the certificate
        $certificate->delete();

        // Return success response with the deleted certificate
        return response()->json([
            'success' => true,
            'message' => 'Certificate deleted successfully',
            'certificate' => $deletedCertificate
        ]);
    } catch (\Exception $e) {
        // Return error response if deletion fails
        return response()->json([
            'success' => false,
            'message' => 'Failed to delete certificate',
            'error' => $e->getMessage()
        ], 500); // You can adjust the status code as needed
    }
}

    

}
