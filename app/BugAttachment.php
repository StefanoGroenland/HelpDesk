<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class BugAttachment extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bugs_attachments';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bug_id',
        'image',
    ];
    protected $guarded = ['id'];

    public static function uploadToDb($file, $id)
    {
        return DB::table('bugs_attachments')->insert([
            'bug_id' => $id,
            'image' => $file,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
