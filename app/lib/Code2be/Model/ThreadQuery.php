<?php

namespace Code2be\Model;

use Code2be\Model\om\BaseThreadQuery;
use Code2be\Model\Thread;


/**
 * Skeleton subclass for performing query and update operations on the 'thread' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.
 */
class ThreadQuery extends BaseThreadQuery
{
    public static function findOrCreate($id)
    {
        if (is_null($id) || empty($id)) {
            $thread = new Thread();
        } else {
            $thread = ThreadQuery::create()
                ->findPk($id);
        }

        return $thread;
    }
}
