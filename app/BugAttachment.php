<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public static function uploadPicture($id,$img){
        return DB::table('bug_attachments')
            ->insert([
                'bug_id' => $id,
                'image' => $img,
            ]);
    }

}
