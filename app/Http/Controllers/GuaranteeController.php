<?php

namespace App\Http\Controllers;

use App\Models\Guarantee;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class GuaranteeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $guarantees = Guarantee::all();
        } else {
            $guarantees = Auth::user()->guarantees; 
        }
    
        return view('guarantees.index', compact('guarantees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guarantees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'corporate_reference_number' => 'required|unique:guarantees',
            'guarantee_type' => 'required|in:Bank,Bid Bond,Insurance,Surety',
            'nominal_amount' => 'required|numeric|min:0',
            'nominal_amount_currency' => 'required',
            'expiry_date' => 'required|date|after:today',
            'applicant_name' => 'required',
            'applicant_address' => 'required',
            'beneficiary_name' => 'required',
            'beneficiary_address' => 'required',
        ]);

        $guarantee = new Guarantee();
        $guarantee->corporate_reference_number = $request->corporate_reference_number;
        $guarantee->guarantee_type = $request->guarantee_type;
        $guarantee->nominal_amount = $request->nominal_amount;
        $guarantee->nominal_amount_currency = $request->nominal_amount_currency;
        $guarantee->expiry_date = $request->expiry_date;
        $guarantee->applicant_name = $request->applicant_name;
        $guarantee->applicant_address = $request->applicant_address;
        $guarantee->beneficiary_name = $request->beneficiary_name;
        $guarantee->beneficiary_address = $request->beneficiary_address;
        $guarantee->user_id = Auth::id();
        $guarantee->status = 'submitted';

        $guarantee->save();

        return redirect()->route('guarantees.index')->with('success', 'Guarantee created successfully!');
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guarantee = Guarantee::find($id);
        $guarantee->delete();
        return redirect()->route('guarantees.index')->with('success', 'Guarantee deleted successfully.');
    }


    public function approve($id)
    {
        $guarantee = Guarantee::find($id);
        $guarantee->status = 'approved';
        $guarantee->save();

    return redirect()->route('guarantees.index')->with('success', 'Guarantee approved successfully.');
    }
    
    
    public function showUploadForm()
    {
        return view('guarantees.bulk_upload');
    }


    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,json,xml|max:2048',  // Adjust max size if needed
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->storeAs('uploads', $file->getClientOriginalName(), 'public');

            $this->parseFile($filePath, $file->getClientOriginalExtension());

            return back()->with('success', 'File uploaded successfully.');
        }

        return back()->with('error', 'No file selected.');
    }

    private function parseFile($filePath, $extension)
    {
        switch (strtolower($extension)) {
            case 'csv':
                $this->parseCSV(Storage::get($filePath));
                break;
            case 'json':
                dd(Storage::get($filePath));
                $this->parseJSON(Storage::get($filePath));
                break;
            case 'xml':
                $this->parseXML(Storage::get($filePath));
                break;
            default:
                return back()->with('error', 'Unsupported file type.');
        }
    }

    private function parseCSV($fileContent)
    {
        $lines = explode(PHP_EOL, $fileContent);
        foreach ($lines as $line) {
            $fields = str_getcsv($line);
            if (count($fields) >= 5) { 
                try {
                    Guarantee::create([
                        'corporate_reference_number' => $fields[0],
                        'guarantee_type' => $fields[1],
                        'nominal_amount' => $fields[2],
                        'nominal_amount_currency' => $fields[3],
                        'expiry_date' => $fields[4],
                        'applicant_name' => $fields[5],
                        'applicant_address' => $fields[6],
                        'beneficiary_name' => $fields[7],
                        'beneficiary_address' => $fields[8],
                        'user_id' => Auth::id(),
                        'status' => 'submitted',
                    ]);
                } catch (\Exception $e) {
                    Log::error('Error inserting guarantee: ' . $e->getMessage());
                }   
            }
        }
    }

    private function parseJSON($fileContent)
    {
        $data = json_decode($fileContent, true);

        if ($data === null) {
            return response()->json(['error' => 'Invalid JSON data'], 400);
        }
    
        foreach ($data as $record) {
            if (isset($record['corporate_reference_number'], $record['guarantee_type'], $record['nominal_amount'], $record['nominal_amount_currency'], $record['expiry_date'], $record['applicant_name'], $record['applicant_address'], $record['beneficiary_name'], $record['beneficiary_address'])) {
                Guarantee::create([
                    'corporate_reference_number' => $record['corporate_reference_number'],
                    'guarantee_type' => $record['guarantee_type'],
                    'nominal_amount' => $record['nominal_amount'],
                    'nominal_amount_currency' => $record['nominal_amount_currency'],
                    'expiry_date' => $record['expiry_date'],
                    'applicant_name' => $record['applicant_name'],
                    'applicant_address' => $record['applicant_address'],
                    'beneficiary_name' => $record['beneficiary_name'],
                    'beneficiary_address' => $record['beneficiary_address'],
                    'user_id' => Auth::id(),
                    'status' => 'submitted',
                ]);
            }
        }
    }
    

    private function parseXML($fileContent)
{
    $xml = simplexml_load_string($fileContent);

    foreach ($xml->guarantee as $record) {
        Guarantee::create([
            'corporate_reference_number' => (string) $record->corporate_reference_number,
            'guarantee_type' => (string) $record->guarantee_type,
            'nominal_amount' => (string) $record->nominal_amount,
            'nominal_amount_currency' => (string) $record->nominal_amount_currency,
            'expiry_date' => (string) $record->expiry_date,
            'applicant_name' => (string) $record->applicant_name,
            'applicant_address' => (string) $record->applicant_address,
            'beneficiary_name' => (string) $record->beneficiary_name,
            'beneficiary_address' => (string) $record->beneficiary_address,
            'user_id' => Auth::id(),
            'status' => 'submitted',
        ]);
    }
}

    
}
