<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\User;

class Application extends Model
{
    use CrudTrait;
    use RevisionableTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'applications';
    // protected $primaryKey = 'id';
    // protected $increments = false;
    // public $timestamps = false;
    protected $guarded = ['id', 'status'];
    // protected $fillable = [];
    // protected $hidden = ['user_id'];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public static function boot(){
      parent::boot();
      self::creating(function ($model) {
          $model->uuid = Str::uuid()->toString();
      });
    }

    public function identifiableName()
    {
        return $this->name;
    }

    public function getSystemUserId(){
      return backpack_user()->id;
    }

    public function canSubmit(){
      return $this->status == 'draft' && $this->contacts->count() > 0;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function state(){
      return $this->belongsTo(State::class);
    }

    public function appgroup(){
      return $this->belongsTo(ApplicantGroup::class, 'applicant_group_id');
    }

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function contacts(){
      return $this->hasMany(Application_contact::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
