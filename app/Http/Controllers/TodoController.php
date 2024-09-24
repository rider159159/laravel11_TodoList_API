<?php

namespace App\Http\Controllers;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    // 獲得所有代辦事項
    public function index()
    {
        return Todo::all();
    }
    // 更新代辦事項是否完成狀態
    public function updateStatus(Request $request)
    {
        $todo = Todo::find($request->id);
        if (!$todo) {
            return response()->json([
                'status' => false,
                'message' => '此 id 沒有代辦事項',
            ], 404);
        }
        $todo->is_completed = !$todo->is_completed;
        $todo->save();

        return response()->json([
            'status' => true,
            'message' => '成功',
            'data' => $todo
        ], 200);
    }

    // 編輯代辦事項的標題與詳細描述
    public function update(Request $request)
    {
        // 使用 validate 方法進行驗證
        $validationData = include(resource_path('lang/zh/TodoValidation.php'));
        $messages = $validationData['messages'];
        $attributes = $validationData['attributes'];

        $validated = Validator::make($request->all(), [
            'title' => 'required|max:30',
            'description' => 'required|max:255',
        ], $messages, $attributes);
        $todo = Todo::find($request->id);
        if (!$todo) {
            return response()->json([
                'status' => false,
                'message' => '此 id 沒有代辦事項',
            ], 404);
        }
        if ($validated->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validated->errors(),
            ], 422);
        }
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->save();

        return response()->json([
            'status' => true,
            'message' => '成功',
            'data' => $todo
        ], 200);
    }

    // 新增代辦事項
    public function store(Request $request)
    {
        $validationData = include(resource_path('lang/zh/TodoValidation.php'));
        $messages = $validationData['messages'];
        $attributes = $validationData['attributes'];
        $validated = Validator::make($request->all(), [
            'title' => 'required|max:30',
            'description' => 'required|max:255',
        ], $messages, $attributes); // 將 $attributes 作為第四個參數

        if ($validated->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validated->errors(),
                'data'=> null
            ], 422);
        }

        $todo = Todo::create($request->all());
        return response()->json([
            'status' => true,
            'message' => '成功',
            'data' => $todo
        ], 201);
    }
}
