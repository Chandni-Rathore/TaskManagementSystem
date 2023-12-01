<?php

/*****
 * 
 * Author : Chandni Rathore <chandni930@gmail.com>
 * Experience: 3.10 years as PHP Developer.
 * 
 */

namespace App\Http\Controllers;

use App\Models\TMSModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{

    /***
     * Storing the task details from form to back-end
     * Apllied server side validations.
     * Using Eloquent ORM to perform insertion.
     * Maintaining logs to keep track on the workflow in testing or production environment
     * 
     */
    public function saveTask(Request $request)
    {

        Log::info("======formdata====" . json_encode($request->all()));

        /***Server side validation start */
        $request->validate([
            'title' => 'required',
            'description' => 'required|max:500',
            'dueDate' => 'required|date'
        ]);

        /***Server side validation end */

        DB::beginTransaction();

        try {

            $model = new TMSModel;
            $model->title = $request->all()['title'];
            $model->description = $request->all()['description'];
            $model->due_date = $request->all()['dueDate'];
            $model->status = 1;

            Log::info('========model attributes========' . json_encode($model->getAttributes()));

            if ($model->save()) {
                Log::info('========data saving========');
                DB::commit();
                session()->flash('msg', 'Task created successfully with title ' . $model->title);
                return redirect('/taskList');
            } else {
                Log::info('========model errors========' . json_encode($model->getErrors()));
                DB::rollBack();
                session()->flash('msg', 'Unable to create task.Please try again.');

                return redirect('/taskList');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info('=======error while creating task=====' . $e->getMessage());
        }
    }

    /****
     *
     * Fetching all the task from database and displaying in form of table.
     * Provided search option get specified data based on user input.
     * Using pagination(displaying 10 task at once) to manage the large list of all tasks.
     * 
     */

    public function taskList(Request $request)
    {

        if (session('msg')) {
            echo '<p style="color: green;"<strong>' . session('msg') . '</strong></p>';
        }
        $search = $request['searchItem'] ?? '';
        if ($search != '') {
            $createdTasks = TMSModel::where('title', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('due_date', 'like', "%$search%")
                ->paginate(10);
        } else {
            $createdTasks = TMSModel::paginate(10);
        }

        return view('taskList', ['createdTasks' => $createdTasks, 'search' => $search]);
    }

    /****
     * 
     * Fetching task details with repect to the id and by default displaying in edit view page resppectively.
     * 
     */
    public function editTask(Request $request)
    {

        $id = $request['id'];

        $taskDetails = TMSModel::find($id)->toArray();
        //print_r($taskDetails);die;
        return view('editTask', ['taskDetails' => $taskDetails, 'id' => $id]);
    }

    /****
     * 
     * Saving modified changes in back-end with respect to the id.
     * 
     */
    public function saveEditTask(Request $request, $id)
    {

        Log::info("======edit task====" . json_encode($request->all()));
        Log::info("======id====" . $id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'dueDate' => 'required|date'
        ]);

        DB::beginTransaction();

        try {

            $model = TMSModel::find($id);
            $model->title = $request->all()['title'];
            $model->description = $request->all()['description'];
            $model->due_date = date('Y-m-d', strtotime($request->all()['dueDate']));

            Log::info('========model attributes========' . json_encode($model->getAttributes()));

            if ($model->save()) {
                Log::info('========data editing========');
                DB::commit();
                session()->flash('msg', 'Task has been modified for title ' . $model->title);
                return redirect('/taskList');
            } else {
                Log::info('========model errors========' . json_encode($model->getErrors()));
                DB::rollBack();
                session()->flash('msg', 'Unable to edit task.Please try again.');

                return redirect('/taskList');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info('=======error while editing task=====' . $e->getMessage());
        }
    }

    /*****
     * 
     * Deleting the selected title from database.
     * Deletion base on id of tms the table.
     * 
     */
    public function deleteTask(Request $request)
    {

        $id = $request->all()['id'];
        Log::info('====id====' . $id);

        $taskData = TMSModel::find($id);
        Log::info('====$taskData====' . json_encode($taskData));

        if (!empty($taskData)) {

            if ($taskData->delete()) {
                Log::info('===task deleted ====');
                return response()->json(['msg' => 'Task deleted with title ' . $taskData['title']]);
            } else {
                Log::info('===Unable to delete task id====' . $id);
                return response()->json(['msg' => 'Unable to delete task.Please try again.']);
            }
        } else {
            Log::info('===task not found for id====' . $id);
            return response()->json(['msg' => 'Task not found for selected title']);
        }
    }

    /***
     * 
     * Complete task status modification inback-end
     * 
     */
    public function completeTask(Request $request)
    {

        $id = $request->all()['id'];
        Log::info('====id====' . $id);

        $taskData = TMSModel::find($id);
        Log::info('====$taskData====' . json_encode($taskData));

        if (!empty($taskData)) {
            $taskData->status = 2;

            if ($taskData->save()) {
                Log::info('===task completed====');
                return response()->json(['msg' => 'Task completed with title ' . $taskData['title']]);
            } else {
                Log::info('===Unable to complete task===id====' . $id);
                return response()->json(['msg' => 'Unable to complete task.Please try again.']);
            }
        } else {
            Log::info('===task not found for id====' . $id);
            return response()->json(['msg' => 'Task not found for selected title']);
        }
    }
}
