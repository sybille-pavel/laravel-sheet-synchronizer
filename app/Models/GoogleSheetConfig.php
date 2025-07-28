<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class GoogleSheetConfig extends Model
    {
        protected $fillable = ['sheet_url', 'sheet_id', 'sheet_name'];

        public static function getActive(): ?self
        {
            return self::first();
        }
    }
