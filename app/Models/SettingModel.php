<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Builder;

    class SettingModel extends Model
    {
        public $table = 'settings';

        public $timestamps = false;

        public function scopeActual(Builder $query){
			return $query->whereNotIn('key', config('app.settings_exclude'));
        }

	    public function scopeSettingByLocale(Builder $query, string $locale)
	    {
		    return $query->where(function ($query) use ($locale){
			    $query->where('locale', $locale)
				    ->orWhereNull('locale');
		    })->whereNotNull('value')
			    ->orderBy('locale');
	    }
    }
