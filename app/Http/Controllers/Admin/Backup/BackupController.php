<?php

namespace App\Http\Controllers\Admin\Backup;

use App\Http\Controllers\Controller;
use App\Models\DBBackup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\QueryException;
use Symfony\Component\Process\Exception\ProcessFailedException;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $page_name = "Backup";

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DBBackup::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('backup_by', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . url('backups/' . $row->file) . '" title="Download backup"><i class="fas fa-cloud-download-alt"></i></a>';
                })
                ->rawColumns(['backup_by', 'action'])
                ->make(true);
        }
        return view('admin.backup.db-backup', ['page' => $this->page_name]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name = 'backup_' . Carbon::now()->format('YmdHis');
        $file_name = $name . '.sql';

        try {
            $this->backupDatabase($file_name);
            $file_path = public_path('backups/' . $file_name);

            if (!file_exists($file_path)) {
                return response()->json(['error' => 'Backup file not found'], 404);
            }

            $input = [
                'name'      => $name,
                'file'      => $file_name,
                'date_time' => Carbon::now()->format('d-m-y h:i A'),
                'backup_by' => Auth::id(),
            ];

            DBBackup::create($input);
            return response()->json(['success' => true, 'download_url' => url('backups/' . $file_name)]);
        } catch (ProcessFailedException $e) {
            return back()->withError('Failed to create backup: ' . $e->getMessage());
        } catch (QueryException $e) {
            return back()->withError('Failed to create backup: ' . $e->getMessage());
        }
    }

    private function backupDatabase($fileName)
    {
        $backupPath = public_path('backups/');
        if (!file_exists($backupPath)) {
            mkdir($backupPath, 0777, true);
        }
        $backupFile = $backupPath . $fileName;
        $command = "mysqldump --user=" . config('database.connections.mysql.username') .
            " --password=" . config('database.connections.mysql.password') .
            " --host=" . config('database.connections.mysql.host') .
            " " . config('database.connections.mysql.database') .
            " > " . $backupFile;
        exec($command);
    }
}
