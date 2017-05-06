<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'size'];


    public function add($users)
    {
        $this->guardAgainstTooManyMembers($users);
        $method = $users instanceof User ? 'save' : 'saveMany';
        $this->members()->$method($users);
    }



    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function count()
    {
        return $this->members()->count();
    }

    public function removeMany($users)
    {

    //Update wird jedesmal aufgerufen
    // $users->each(function($user) {
    //   $user->leaveTeam();
    // });
      $userIds =$users->pluck('id');
        $this->members()
        ->whereIn('id', $userIds)
        ->update(['team_id' => null]);
    }

    public function remove($users =null)
    {
        if ($users instanceof User) {
            return $users->leaveTeam();
        }

        return $this->removeMany($users);
    }

    public function restart($user =null)
    {
        return $this->members()->update(['team_id' =>null]);
    }

    protected function guardAgainstTooManyMembers($users)
    {
        $numUsersToAdd =( $users instanceof User) ? 1 :  $users->count();
        $newTeamCount = $this->count() + $numUsersToAdd;
        if ($newTeamCount > $this->size) {
            throw new \Exception();
        }
    }
}
