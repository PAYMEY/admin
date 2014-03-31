<?php

class AdminWebUser extends CWebUser {

    // let authentication expire if user is inactive for this number of seconds
    public $authExpires;

    /**
     * 
     */
	public function getIsGuest()
	{
		$isGuest = $this->getState('__id') === null;
		$expires = $this->getState('__expires');

		if(!$isGuest && $this->authExpires !== null)
		{
			if($expires !== null && $expires < time())  // authentication expired
			{
				// TODO:
				//   - Either always (true) or never (false) destroys session data! Not what everyone wants...
				//   - Make sure __expires is also cleared from session in logout()
				$this->logout();
				$isGuest = true;
			} else {    // update expiration timestamp
				$this->setState('__expires', time() + $this->authExpires);
			}
		}

		return $isGuest;
	}
}
