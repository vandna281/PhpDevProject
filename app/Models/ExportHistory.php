<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExportHistory extends Model
{
	 /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'export_history';

    public $timestamps = false;

    public function setEmailListAttribute($emails)
    {
        $this->attributes['emailList'] = $emails;
    }

}