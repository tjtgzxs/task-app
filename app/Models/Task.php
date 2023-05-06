<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * App\Models\Task
 *
 * @property int $id
 * @property string $name
 * @property int $priority
 * @property int $project_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Project $project
 * @method static \Illuminate\Database\Eloquent\Builder|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Task extends Model
{
    use HasFactory;
    public function project(){
        return $this->belongsTo(Project::class);
    }

    /**
     * change task priority
     * @param int $project_id
     * @param array $tasks
     * @return bool
     */
    public static function ChangePriority(int $project_id,array $tasks):int
    {
        $case_sql="";
        foreach ($tasks as $value){
            $case_sql.=" WHEN {$value['id']} THEN {$value['priority']} ";
        }
        $sql="UPDATE `tasks` set priority= CASE id {$case_sql} END WHERE project_id={$project_id} ";
        $affected=DB::update($sql);
        return  $affected;
    }
}
