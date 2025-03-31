<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasksFormRequest;
use App\Models\Clients;
use App\Models\Contragents;
use App\Models\Tasks;
use App\Models\Objects;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        return view("pages.tasks.index");
    }
    public function create()
    {
        $clients = Clients::with('contragents')->get();
        $contragents = Contragents::all();
        return view("pages.tasks.create", compact("clients", "contragents"));
    }
    public function store(TasksFormRequest $request)
    {
        $task = new Tasks($request->validated());
    
        $booleanFields = [
            'mk', 'mkcold', 'osv', 'osvEvak', 'sh', 'shobSgr', 'shokolSr', 'vent', 'klim',
            'f0', 'z', 'm', 'izol', 'dtz', 'mkNext', 'mkcoldNext', 'osvNext', 'osvEvakNext',
            'shNext', 'shobSgrNext', 'shokolSrNext', 'ventNext', 'klimNext', 'f0Next',
            'zNext', 'mNext', 'izolNext', 'dtzNext', 'paid'
        ];

        foreach ($booleanFields as $field) {
            $task->$field = $request->$field ? '1' : '0';
        }

        $task->save();

        return redirect(route('pages.tasks.index'));
    }

    public function action(Request $request)
    {
        $query = $request->input('query');

        $filter_data = Clients::where('client', 'LIKE', '%' . $query . '%')
            ->pluck('client')
            ->toArray();

        return response()->json($filter_data);
    }

    public function getClientData(Request $request)
    {
        $client = null;
        if ($request->has('id')) {
            $client = Clients::with(['contragents', 'objects'])->findOrFail($request->query('id'));
        } elseif ($request->has('name')) {
            $client = Clients::with(['contragents', 'objects'])->where('client', $request->query('name'))->firstOrFail();
        }

        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }

        return response()->json([
            'client_id' => $client->id,
            'client_name' => $client->client,
            'objects' => $client->objects,
            'contragent_name' => $client->contragents ? $client->contragents->contragent_name : null,
        ]);
    }

    public function getContragentData(Request $request)
    {
        $name = $request->query('name');
        $contragent = Contragents::where('contragent_name', $name)->first();

        if (!$contragent) {
            return response()->json(['error' => 'Contragent not found'], 404);
        }

        return response()->json([
            'commission_percentage' => $contragent->commission_percentage,
            'contragent_name' => $contragent->contragent_name,
        ]);
    }
    public function update(TasksFormRequest $request, $id)
    {
        $validatedData = $request->validated();
        $task = Tasks::find($id);

        $task->dateOfMeasurement = $validatedData['dateOfMeasurement'];
        $task->mk = $request->mk == true ? '1' : '0';
        $task->mkcold = $request->mkcold == true ? '1' : '0';
        $task->osv = $request->osv == true ? '1' : '0';
        $task->osvEvak = $request->osvEvak == true ? '1' : '0';
        $task->sh = $request->sh == true ? '1' : '0';
        $task->shobSgr = $request->shobSgr == true ? '1' : '0';
        $task->shokolSr = $request->shokolSr == true ? '1' : '0';
        $task->vent = $request->vent == true ? '1' : '0';
        $task->klim = $request->klim == true ? '1' : '0';
        $task->f0 = $request->f0 == true ? '1' : '0';
        $task->z = $request->z == true ? '1' : '0';
        $task->m = $request->m == true ? '1' : '0';
        $task->izol = $request->izol == true ? '1' : '0';
        $task->dtz = $request->dtz == true ? '1' : '0';
        $task->wayOfShowingDocumentation = $validatedData['wayOfShowingDocumentation'];
        $task->courrierDetails = $validatedData['courrierDetails'];
        $task->certificateNumber = $validatedData['certificateNumber'];
        $task->certificateDate = $validatedData['certificateDate'];
        $task->nextMeasurement = $validatedData['nextMeasurement'];
        $task->mkNext = $request->mkNext == true ? '1' : '0';
        $task->mkcoldNext = $request->mkcoldNext == true ? '1' : '0';
        $task->osvNext = $request->osvNext == true ? '1' : '0';
        $task->osvEvakNext = $request->osvEvakNext == true ? '1' : '0';
        $task->shNext = $request->shNext == true ? '1' : '0';
        $task->shobSgrNext = $request->shobSgrNext == true ? '1' : '0';
        $task->shokolSrNext = $request->shokolSrNext == true ? '1' : '0';
        $task->ventNext = $request->ventNext == true ? '1' : '0';
        $task->klimNext = $request->klimNext == true ? '1' : '0';
        $task->f0Next = $request->f0Next == true ? '1' : '0';
        $task->zNext = $request->zNext == true ? '1' : '0';
        $task->mNext = $request->mNext == true ? '1' : '0';
        $task->izolNext = $request->izolNext == true ? '1' : '0';
        $task->dtzNext = $request->dtzNext == true ? '1' : '0';
        $task->invoice = $validatedData['invoice'];
        $task->payment_method = $validatedData['payment_method'];
        $task->invoice_date = $validatedData['invoice_date'];
        $task->price_without_vat = $validatedData['price_without_vat'];
        $task->paid = $request->paid == true ? '1' : '0';
        $task->contragent_sum = $validatedData['contragent_sum'];
        $task->total_sum = $validatedData['total_sum'];
        $task->client_id = $validatedData['client_id'];
        $task->client_address_1 = $validatedData['client_address_1'];
        $task->contragent = $validatedData['contragent'];

        $task->save();
        return redirect(route('pages.tasks.index'))->with('success', 'Успешно редактиране на задача');
    }

    public function edit($id)
    {
        $task = Tasks::find($id);
        $clients = Clients::all();
        $contragents = Contragents::all();
        return view('pages.tasks.edit', ['task' => $task, 'clients' => $clients, 'contragents' => $contragents]);
    }

    public function view($id)
    {
        $task = Tasks::find($id);
        $client = Clients::all();
        return view('pages.tasks.view', compact('task', 'client'));
    }
}
