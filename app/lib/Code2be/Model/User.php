<?php

namespace Code2be\Model;

use Code2be\Model\om\BaseUser;


/**
 * Skeleton subclass for representing a row from the 'user' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.
 */
class User extends BaseUser
{
    private $sendMail = false;

    public function preSave(\PropelPDO $con = NULL) {
        if (
            $this->isColumnModified(\Code2be\Model\UserPeer::PASSWORD) &&
            $this->password != '' &&
            \Code2be\Helper\Auth::mailerPasswordExists($this->getEmail())
        ) {
            $this->sendMail = true;
        }
        return true;
    }


    public function postSave(\PropelPDO $con = NULL) {
        if ($this->sendMail) {
            \Code2be\Helper\Auth::sendPasswordByMail($this->getEmail());
        }
        return true;
    }
}
