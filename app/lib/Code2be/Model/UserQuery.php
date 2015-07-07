<?php

namespace Code2be\Model;

use Code2be\Model\om\BaseUserQuery;
use Code2be\Model\User;

/**
 * Skeleton subclass for performing query and update operations on the 'user' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class UserQuery extends BaseUserQuery
{
    public static function findOrCreate($id) {
        if (is_null($id) || empty($id)) {
            $user = new User();
        } else {
            $user = UserQuery::create()
                ->findPk($id);
        }

        return $user;
    }

}
