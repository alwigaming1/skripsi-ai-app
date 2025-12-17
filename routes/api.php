use App\Http\Controllers\GeneratorController;
use App\Models\Project;
use Illuminate\Http\Request;

Route::post('/project/create', function (Request $request) {
    $project = Project::create([
        'judul' => $request->judul,
        'session_id' => session()->getId()
    ]);
    return response()->json(['id' => $project->id]);
});

Route::post('/project/{id}/generate', [GeneratorController::class, 'generateChapter']);
Route::get('/project/{id}/download', [GeneratorController::class, 'downloadDocx']);