<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class UserJob extends Model {

        // name of table
        protected $table = 'tbluserjob';
        // column of table
        protected $fillable = [
            'jobid', 'jobname',
        ];

        // The code below will not require the field create_at and update_at in lumen
        public $timestamps = false;

        // the code will customized your primary key field name, default in lumen is id
        protected $primaryKey = 'jobid';
    }
