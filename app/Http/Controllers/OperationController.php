<?php

namespace App\Http\Controllers;

use App\UseCase\OperationUseCase;
use App\Models\Operation;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    public function index()
    {
        $operations = OperationUseCase::getOperationsAll();
        return view('operations.index', compact('operations'));
    }

    public function create()
    {
        return view('operations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:3',
        ]);

        Operation::create([
            'name' => $request->name,
            'unit' => $request->unit,
            'sort' => 0,
        ]);

        return redirect()->route('operations.index')->with('success', '作業が登録されました。');
    }

    public function show(Operation $operation)
    {
        return view('operations.show', compact('operation'));
    }

    public function edit(Operation $operation)
    {
        return view('operations.edit', compact('operation'));
    }

    public function update(Request $request, Operation $operation)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:3',
        ]);

        $operation->update([
            'name' => $request->name,
            'unit' => $request->unit,
        ]);

        return redirect()->route('operations.index')->with('success', '作業情報が更新されました。');
    }

    public function destroy(Operation $operation)
    {
        $operation->delete();
        return redirect()->route('operations.index')->with('success', '作業が削除されました。');
    }

    public function updateSortOrder(Request $request)
    {
        $request->validate([
            'operation_ids' => 'required|array',
            'operation_ids.*' => 'exists:operations,id',
        ]);

        foreach ($request->operation_ids as $index => $operationId) {
            Operation::where('id', $operationId)->update(['sort' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
