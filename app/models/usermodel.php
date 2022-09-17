<?php
namespace PHPMVC\Models; 
use PHPMVC\Models\UsersGroupsPrivilegesModel;

class UserModel extends AbstractModel
{
    public $id;
    public $username;
    public $password;
    public $email;
    public $phone_number;
    public $subscription_date;
    public $last_login;
    public $group_id;
    public $status;

    /**
     * @var UserProfileModel
     */
   /*public $profile;
    public $privileges;
*/
    protected static $tableName = 'app_users';

    protected static $tableSchema = array(
        'id'            => self::DATA_TYPE_INT,
        'username'          => self::DATA_TYPE_STR,
        'password'          => self::DATA_TYPE_STR,
        'email'             => self::DATA_TYPE_STR,
        'phone_number'       => self::DATA_TYPE_STR,
        'subscription_date'  => self::DATA_TYPE_STR,
        'last_login'         => self::DATA_TYPE_STR,
        'group_id'           => self::DATA_TYPE_INT,
        'status'            => self::DATA_TYPE_INT,
    );

    protected static $primaryKey = 'id';
	
	public static function cryptPassword($password) {
		
		return crypt($password, APP_SALT);
	} 
    
    
    public static function userExists($username)
    {
        //self instead of UserModel because we already inside UderModel
        //get is function inside the abstract model take one paramter as string resembles the $sql
        //if user doesn't exist return false , if exists return the user
        return self::get(
            "SELECT * FROM app_users WHERE username ='" . $username ."'" 
        ); 
    }
    
    
    public static function getUsers()
    {
        //inner join
        //aug.group_name group_name means we will call this output by the name group_name
        $sql = 'SELECT au.*, aug.group_name group_name FROM app_users au INNER JOIN app_users_groups aug ON aug.id = au.group_id';
        return self::get($sql);
    }
	
	//function to check the login validity of the user
	public static function authenticate($username, $password, $session)
	{
		
		 $password = crypt($password, APP_SALT);
		 $sql = 'SELECT *, (SELECT group_name FROM app_users_groups WHERE app_users_groups.id = app_users.group_id) group_name FROM '. self::$tableName . ' WHERE username = "' . $username. '" AND password= "'. $password . '"';
		 $foundUser = self::getOne($sql);
	
		if($foundUser !== false) {
			
			if($foundUser->status == 2) {
				//to know that this user is suspended
				return 2;
			}
			//update the last login
			$foundUser->last_login = date('Y-m-d H:i:s');
			$foundUser->save();
            
            //we can get the profile table of the user too
            $profile = UserProfileModel::getByPK($foundUser->id);
            //add the result inside the foundUser array
            $foundUser->profile = $profile;
			
			$privileges = UsersGroupsPrivilegesModel::getPrivilegesByGroup($foundUser->group_id);
			$foundUser->privileges = $privileges;
                
			//then send the user for the session
            $session->u = $foundUser;
            
			//return 1 to know that the user valid and active not suspended
			return 1;
		} 
		//if there is not user valid in this username and this password
		return false;
	}

   /* 

    // TODO:: FIX THE TABLE ALIASING
    public static function getUsers(UserModel $user)
    {
        return self::get(
        'SELECT au.*, aug.GroupName GroupName FROM ' . self::$tableName . ' au INNER JOIN app_users_groups aug ON aug.GroupId = au.GroupId WHERE au.UserId != ' . $user->UserId
        );
    }


    public static function authenticate ($username, $password, $session)
    {
        $password = crypt($password, APP_SALT) ;
        $sql = 'SELECT *, (SELECT GroupName FROM app_users_groups WHERE app_users_groups.GroupId = ' . self::$tableName . '.GroupId) GroupName FROM ' . self::$tableName . ' WHERE Username = "' . $username . '" AND Password = "' .  $password . '"';
        $foundUser = self::getOne($sql);
        if(false !== $foundUser) {
            if($foundUser->Status == 2) {
                return 2;
            }
            $foundUser->LastLogin = date('Y-m-d H:i:s');
            $foundUser->save();
            $foundUser->profile = UserProfileModel::getByPK($foundUser->UserId);
            $foundUser->privileges = UserGroupPrivilegeModel::getPrivilegesForGroup($foundUser->GroupId);
            $session->u = $foundUser;
            return 1;
        }
        return false;
    }
	
	
	*/
}