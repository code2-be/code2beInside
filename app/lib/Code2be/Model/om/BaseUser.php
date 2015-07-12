<?php

namespace Code2be\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelDateTime;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Code2be\Model\Post;
use Code2be\Model\PostQuery;
use Code2be\Model\Thread;
use Code2be\Model\ThreadQuery;
use Code2be\Model\User;
use Code2be\Model\UserPeer;
use Code2be\Model\UserQuery;

/**
 * Base class that represents a row from the 'user' table.
 *
 *
 *
 * @package    propel.generator..om
 */
abstract class BaseUser extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Code2be\\Model\\UserPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        UserPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the first_name field.
     * @var        string
     */
    protected $first_name;

    /**
     * The value for the last_name field.
     * @var        string
     */
    protected $last_name;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the password field.
     * @var        string
     */
    protected $password;

    /**
     * The value for the phone_number field.
     * @var        string
     */
    protected $phone_number;

    /**
     * The value for the role field.
     * @var        string
     */
    protected $role;

    /**
     * The value for the created_by field.
     * @var        int
     */
    protected $created_by;

    /**
     * The value for the updated_by field.
     * @var        int
     */
    protected $updated_by;

    /**
     * The value for the created_at field.
     * @var        string
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     * @var        string
     */
    protected $updated_at;

    /**
     * @var        User
     */
    protected $aUserRelatedByCreatedBy;

    /**
     * @var        User
     */
    protected $aUserRelatedByUpdatedBy;

    /**
     * @var        PropelObjectCollection|User[] Collection to store aggregation of User objects.
     */
    protected $collUsersRelatedById0;
    protected $collUsersRelatedById0Partial;

    /**
     * @var        PropelObjectCollection|User[] Collection to store aggregation of User objects.
     */
    protected $collUsersRelatedById1;
    protected $collUsersRelatedById1Partial;

    /**
     * @var        PropelObjectCollection|Thread[] Collection to store aggregation of Thread objects.
     */
    protected $collThreadsRelatedByCreatedBy;
    protected $collThreadsRelatedByCreatedByPartial;

    /**
     * @var        PropelObjectCollection|Thread[] Collection to store aggregation of Thread objects.
     */
    protected $collThreadsRelatedByUpdatedBy;
    protected $collThreadsRelatedByUpdatedByPartial;

    /**
     * @var        PropelObjectCollection|Post[] Collection to store aggregation of Post objects.
     */
    protected $collPostsRelatedByCreatedBy;
    protected $collPostsRelatedByCreatedByPartial;

    /**
     * @var        PropelObjectCollection|Post[] Collection to store aggregation of Post objects.
     */
    protected $collPostsRelatedByUpdatedBy;
    protected $collPostsRelatedByUpdatedByPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $usersRelatedById0ScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $usersRelatedById1ScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $threadsRelatedByCreatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $threadsRelatedByUpdatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $postsRelatedByCreatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $postsRelatedByUpdatedByScheduledForDeletion = null;

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Get the [first_name] column value.
     *
     * @return string
     */
    public function getFirstName()
    {

        return $this->first_name;
    }

    /**
     * Get the [last_name] column value.
     *
     * @return string
     */
    public function getLastName()
    {

        return $this->last_name;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {

        return $this->email;
    }

    /**
     * Get the [password] column value.
     *
     * @return string
     */
    public function getPassword()
    {

        return $this->password;
    }

    /**
     * Get the [phone_number] column value.
     *
     * @return string
     */
    public function getPhoneNumber()
    {

        return $this->phone_number;
    }

    /**
     * Get the [role] column value.
     *
     * @return string
     */
    public function getRole()
    {

        return $this->role;
    }

    /**
     * Get the [created_by] column value.
     *
     * @return int
     */
    public function getCreatedBy()
    {

        return $this->created_by;
    }

    /**
     * Get the [updated_by] column value.
     *
     * @return int
     */
    public function getUpdatedBy()
    {

        return $this->updated_by;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = 'Y-m-d H:i:s')
    {
        if ($this->created_at === null) {
            return null;
        }

        if ($this->created_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->created_at);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = 'Y-m-d H:i:s')
    {
        if ($this->updated_at === null) {
            return null;
        }

        if ($this->updated_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->updated_at);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = UserPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [first_name] column.
     *
     * @param  string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setFirstName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->first_name !== $v) {
            $this->first_name = $v;
            $this->modifiedColumns[] = UserPeer::FIRST_NAME;
        }


        return $this;
    } // setFirstName()

    /**
     * Set the value of [last_name] column.
     *
     * @param  string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setLastName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->last_name !== $v) {
            $this->last_name = $v;
            $this->modifiedColumns[] = UserPeer::LAST_NAME;
        }


        return $this;
    } // setLastName()

    /**
     * Set the value of [email] column.
     *
     * @param  string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[] = UserPeer::EMAIL;
        }


        return $this;
    } // setEmail()

    /**
     * Set the value of [password] column.
     *
     * @param  string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[] = UserPeer::PASSWORD;
        }


        return $this;
    } // setPassword()

    /**
     * Set the value of [phone_number] column.
     *
     * @param  string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setPhoneNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone_number !== $v) {
            $this->phone_number = $v;
            $this->modifiedColumns[] = UserPeer::PHONE_NUMBER;
        }


        return $this;
    } // setPhoneNumber()

    /**
     * Set the value of [role] column.
     *
     * @param  string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setRole($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->role !== $v) {
            $this->role = $v;
            $this->modifiedColumns[] = UserPeer::ROLE;
        }


        return $this;
    } // setRole()

    /**
     * Set the value of [created_by] column.
     *
     * @param  int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setCreatedBy($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->created_by !== $v) {
            $this->created_by = $v;
            $this->modifiedColumns[] = UserPeer::CREATED_BY;
        }

        if ($this->aUserRelatedByCreatedBy !== null && $this->aUserRelatedByCreatedBy->getId() !== $v) {
            $this->aUserRelatedByCreatedBy = null;
        }


        return $this;
    } // setCreatedBy()

    /**
     * Set the value of [updated_by] column.
     *
     * @param  int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setUpdatedBy($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->updated_by !== $v) {
            $this->updated_by = $v;
            $this->modifiedColumns[] = UserPeer::UPDATED_BY;
        }

        if ($this->aUserRelatedByUpdatedBy !== null && $this->aUserRelatedByUpdatedBy->getId() !== $v) {
            $this->aUserRelatedByUpdatedBy = null;
        }


        return $this;
    } // setUpdatedBy()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return User The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = UserPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return User The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = UserPeer::UPDATED_AT;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->first_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->last_name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->email = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->password = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->phone_number = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->role = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->created_by = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->updated_by = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->created_at = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->updated_at = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 11; // 11 = UserPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating User object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->aUserRelatedByCreatedBy !== null && $this->created_by !== $this->aUserRelatedByCreatedBy->getId()) {
            $this->aUserRelatedByCreatedBy = null;
        }
        if ($this->aUserRelatedByUpdatedBy !== null && $this->updated_by !== $this->aUserRelatedByUpdatedBy->getId()) {
            $this->aUserRelatedByUpdatedBy = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = UserPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUserRelatedByCreatedBy = null;
            $this->aUserRelatedByUpdatedBy = null;
            $this->collUsersRelatedById0 = null;

            $this->collUsersRelatedById1 = null;

            $this->collThreadsRelatedByCreatedBy = null;

            $this->collThreadsRelatedByUpdatedBy = null;

            $this->collPostsRelatedByCreatedBy = null;

            $this->collPostsRelatedByUpdatedBy = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = UserQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // blamable behavior
                if (!$this->isColumnModified(UserPeer::CREATED_BY)) {
                    $this->setCreatedBy(\Code2be\Helper\Auth::getUser()->getId());
                    }
                if (!$this->isColumnModified(UserPeer::UPDATED_BY)) {
                    $this->setUpdatedBy(\Code2be\Helper\Auth::getUser()->getId());
                    }
                // timestampable behavior
                if (!$this->isColumnModified(UserPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(UserPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // blamable behavior
                if ($this->isModified() && !$this->isColumnModified(UserPeer::UPDATED_BY)) {
                    $this->setUpdatedBy(\Code2be\Helper\Auth::getUser()->getId());
                    }
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(UserPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                UserPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUserRelatedByCreatedBy !== null) {
                if ($this->aUserRelatedByCreatedBy->isModified() || $this->aUserRelatedByCreatedBy->isNew()) {
                    $affectedRows += $this->aUserRelatedByCreatedBy->save($con);
                }
                $this->setUserRelatedByCreatedBy($this->aUserRelatedByCreatedBy);
            }

            if ($this->aUserRelatedByUpdatedBy !== null) {
                if ($this->aUserRelatedByUpdatedBy->isModified() || $this->aUserRelatedByUpdatedBy->isNew()) {
                    $affectedRows += $this->aUserRelatedByUpdatedBy->save($con);
                }
                $this->setUserRelatedByUpdatedBy($this->aUserRelatedByUpdatedBy);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->usersRelatedById0ScheduledForDeletion !== null) {
                if (!$this->usersRelatedById0ScheduledForDeletion->isEmpty()) {
                    foreach ($this->usersRelatedById0ScheduledForDeletion as $userRelatedById0) {
                        // need to save related object because we set the relation to null
                        $userRelatedById0->save($con);
                    }
                    $this->usersRelatedById0ScheduledForDeletion = null;
                }
            }

            if ($this->collUsersRelatedById0 !== null) {
                foreach ($this->collUsersRelatedById0 as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->usersRelatedById1ScheduledForDeletion !== null) {
                if (!$this->usersRelatedById1ScheduledForDeletion->isEmpty()) {
                    foreach ($this->usersRelatedById1ScheduledForDeletion as $userRelatedById1) {
                        // need to save related object because we set the relation to null
                        $userRelatedById1->save($con);
                    }
                    $this->usersRelatedById1ScheduledForDeletion = null;
                }
            }

            if ($this->collUsersRelatedById1 !== null) {
                foreach ($this->collUsersRelatedById1 as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->threadsRelatedByCreatedByScheduledForDeletion !== null) {
                if (!$this->threadsRelatedByCreatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->threadsRelatedByCreatedByScheduledForDeletion as $threadRelatedByCreatedBy) {
                        // need to save related object because we set the relation to null
                        $threadRelatedByCreatedBy->save($con);
                    }
                    $this->threadsRelatedByCreatedByScheduledForDeletion = null;
                }
            }

            if ($this->collThreadsRelatedByCreatedBy !== null) {
                foreach ($this->collThreadsRelatedByCreatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->threadsRelatedByUpdatedByScheduledForDeletion !== null) {
                if (!$this->threadsRelatedByUpdatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->threadsRelatedByUpdatedByScheduledForDeletion as $threadRelatedByUpdatedBy) {
                        // need to save related object because we set the relation to null
                        $threadRelatedByUpdatedBy->save($con);
                    }
                    $this->threadsRelatedByUpdatedByScheduledForDeletion = null;
                }
            }

            if ($this->collThreadsRelatedByUpdatedBy !== null) {
                foreach ($this->collThreadsRelatedByUpdatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->postsRelatedByCreatedByScheduledForDeletion !== null) {
                if (!$this->postsRelatedByCreatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->postsRelatedByCreatedByScheduledForDeletion as $postRelatedByCreatedBy) {
                        // need to save related object because we set the relation to null
                        $postRelatedByCreatedBy->save($con);
                    }
                    $this->postsRelatedByCreatedByScheduledForDeletion = null;
                }
            }

            if ($this->collPostsRelatedByCreatedBy !== null) {
                foreach ($this->collPostsRelatedByCreatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->postsRelatedByUpdatedByScheduledForDeletion !== null) {
                if (!$this->postsRelatedByUpdatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->postsRelatedByUpdatedByScheduledForDeletion as $postRelatedByUpdatedBy) {
                        // need to save related object because we set the relation to null
                        $postRelatedByUpdatedBy->save($con);
                    }
                    $this->postsRelatedByUpdatedByScheduledForDeletion = null;
                }
            }

            if ($this->collPostsRelatedByUpdatedBy !== null) {
                foreach ($this->collPostsRelatedByUpdatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = UserPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UserPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UserPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(UserPeer::FIRST_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`first_name`';
        }
        if ($this->isColumnModified(UserPeer::LAST_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`last_name`';
        }
        if ($this->isColumnModified(UserPeer::EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`email`';
        }
        if ($this->isColumnModified(UserPeer::PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = '`password`';
        }
        if ($this->isColumnModified(UserPeer::PHONE_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = '`phone_number`';
        }
        if ($this->isColumnModified(UserPeer::ROLE)) {
            $modifiedColumns[':p' . $index++]  = '`role`';
        }
        if ($this->isColumnModified(UserPeer::CREATED_BY)) {
            $modifiedColumns[':p' . $index++]  = '`created_by`';
        }
        if ($this->isColumnModified(UserPeer::UPDATED_BY)) {
            $modifiedColumns[':p' . $index++]  = '`updated_by`';
        }
        if ($this->isColumnModified(UserPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(UserPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `user` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`first_name`':
                        $stmt->bindValue($identifier, $this->first_name, PDO::PARAM_STR);
                        break;
                    case '`last_name`':
                        $stmt->bindValue($identifier, $this->last_name, PDO::PARAM_STR);
                        break;
                    case '`email`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case '`password`':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
                        break;
                    case '`phone_number`':
                        $stmt->bindValue($identifier, $this->phone_number, PDO::PARAM_STR);
                        break;
                    case '`role`':
                        $stmt->bindValue($identifier, $this->role, PDO::PARAM_STR);
                        break;
                    case '`created_by`':
                        $stmt->bindValue($identifier, $this->created_by, PDO::PARAM_INT);
                        break;
                    case '`updated_by`':
                        $stmt->bindValue($identifier, $this->updated_by, PDO::PARAM_INT);
                        break;
                    case '`created_at`':
                        $stmt->bindValue($identifier, $this->created_at, PDO::PARAM_STR);
                        break;
                    case '`updated_at`':
                        $stmt->bindValue($identifier, $this->updated_at, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUserRelatedByCreatedBy !== null) {
                if (!$this->aUserRelatedByCreatedBy->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aUserRelatedByCreatedBy->getValidationFailures());
                }
            }

            if ($this->aUserRelatedByUpdatedBy !== null) {
                if (!$this->aUserRelatedByUpdatedBy->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aUserRelatedByUpdatedBy->getValidationFailures());
                }
            }


            if (($retval = UserPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collUsersRelatedById0 !== null) {
                    foreach ($this->collUsersRelatedById0 as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collUsersRelatedById1 !== null) {
                    foreach ($this->collUsersRelatedById1 as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collThreadsRelatedByCreatedBy !== null) {
                    foreach ($this->collThreadsRelatedByCreatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collThreadsRelatedByUpdatedBy !== null) {
                    foreach ($this->collThreadsRelatedByUpdatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPostsRelatedByCreatedBy !== null) {
                    foreach ($this->collPostsRelatedByCreatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPostsRelatedByUpdatedBy !== null) {
                    foreach ($this->collPostsRelatedByUpdatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getFirstName();
                break;
            case 2:
                return $this->getLastName();
                break;
            case 3:
                return $this->getEmail();
                break;
            case 4:
                return $this->getPassword();
                break;
            case 5:
                return $this->getPhoneNumber();
                break;
            case 6:
                return $this->getRole();
                break;
            case 7:
                return $this->getCreatedBy();
                break;
            case 8:
                return $this->getUpdatedBy();
                break;
            case 9:
                return $this->getCreatedAt();
                break;
            case 10:
                return $this->getUpdatedAt();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['User'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['User'][$this->getPrimaryKey()] = true;
        $keys = UserPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getFirstName(),
            $keys[2] => $this->getLastName(),
            $keys[3] => $this->getEmail(),
            $keys[4] => $this->getPassword(),
            $keys[5] => $this->getPhoneNumber(),
            $keys[6] => $this->getRole(),
            $keys[7] => $this->getCreatedBy(),
            $keys[8] => $this->getUpdatedBy(),
            $keys[9] => $this->getCreatedAt(),
            $keys[10] => $this->getUpdatedAt(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aUserRelatedByCreatedBy) {
                $result['UserRelatedByCreatedBy'] = $this->aUserRelatedByCreatedBy->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUserRelatedByUpdatedBy) {
                $result['UserRelatedByUpdatedBy'] = $this->aUserRelatedByUpdatedBy->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collUsersRelatedById0) {
                $result['UsersRelatedById0'] = $this->collUsersRelatedById0->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUsersRelatedById1) {
                $result['UsersRelatedById1'] = $this->collUsersRelatedById1->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collThreadsRelatedByCreatedBy) {
                $result['ThreadsRelatedByCreatedBy'] = $this->collThreadsRelatedByCreatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collThreadsRelatedByUpdatedBy) {
                $result['ThreadsRelatedByUpdatedBy'] = $this->collThreadsRelatedByUpdatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPostsRelatedByCreatedBy) {
                $result['PostsRelatedByCreatedBy'] = $this->collPostsRelatedByCreatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPostsRelatedByUpdatedBy) {
                $result['PostsRelatedByUpdatedBy'] = $this->collPostsRelatedByUpdatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setFirstName($value);
                break;
            case 2:
                $this->setLastName($value);
                break;
            case 3:
                $this->setEmail($value);
                break;
            case 4:
                $this->setPassword($value);
                break;
            case 5:
                $this->setPhoneNumber($value);
                break;
            case 6:
                $this->setRole($value);
                break;
            case 7:
                $this->setCreatedBy($value);
                break;
            case 8:
                $this->setUpdatedBy($value);
                break;
            case 9:
                $this->setCreatedAt($value);
                break;
            case 10:
                $this->setUpdatedAt($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = UserPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setFirstName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setLastName($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setEmail($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setPassword($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setPhoneNumber($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setRole($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setCreatedBy($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setUpdatedBy($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setCreatedAt($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setUpdatedAt($arr[$keys[10]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(UserPeer::DATABASE_NAME);

        if ($this->isColumnModified(UserPeer::ID)) $criteria->add(UserPeer::ID, $this->id);
        if ($this->isColumnModified(UserPeer::FIRST_NAME)) $criteria->add(UserPeer::FIRST_NAME, $this->first_name);
        if ($this->isColumnModified(UserPeer::LAST_NAME)) $criteria->add(UserPeer::LAST_NAME, $this->last_name);
        if ($this->isColumnModified(UserPeer::EMAIL)) $criteria->add(UserPeer::EMAIL, $this->email);
        if ($this->isColumnModified(UserPeer::PASSWORD)) $criteria->add(UserPeer::PASSWORD, $this->password);
        if ($this->isColumnModified(UserPeer::PHONE_NUMBER)) $criteria->add(UserPeer::PHONE_NUMBER, $this->phone_number);
        if ($this->isColumnModified(UserPeer::ROLE)) $criteria->add(UserPeer::ROLE, $this->role);
        if ($this->isColumnModified(UserPeer::CREATED_BY)) $criteria->add(UserPeer::CREATED_BY, $this->created_by);
        if ($this->isColumnModified(UserPeer::UPDATED_BY)) $criteria->add(UserPeer::UPDATED_BY, $this->updated_by);
        if ($this->isColumnModified(UserPeer::CREATED_AT)) $criteria->add(UserPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(UserPeer::UPDATED_AT)) $criteria->add(UserPeer::UPDATED_AT, $this->updated_at);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(UserPeer::DATABASE_NAME);
        $criteria->add(UserPeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of User (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFirstName($this->getFirstName());
        $copyObj->setLastName($this->getLastName());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setPhoneNumber($this->getPhoneNumber());
        $copyObj->setRole($this->getRole());
        $copyObj->setCreatedBy($this->getCreatedBy());
        $copyObj->setUpdatedBy($this->getUpdatedBy());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getUsersRelatedById0() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserRelatedById0($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUsersRelatedById1() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserRelatedById1($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getThreadsRelatedByCreatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addThreadRelatedByCreatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getThreadsRelatedByUpdatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addThreadRelatedByUpdatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPostsRelatedByCreatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPostRelatedByCreatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPostsRelatedByUpdatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPostRelatedByUpdatedBy($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return User Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return UserPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new UserPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param                  User $v
     * @return User The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUserRelatedByCreatedBy(User $v = null)
    {
        if ($v === null) {
            $this->setCreatedBy(NULL);
        } else {
            $this->setCreatedBy($v->getId());
        }

        $this->aUserRelatedByCreatedBy = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the User object, it will not be re-added.
        if ($v !== null) {
            $v->addUserRelatedById0($this);
        }


        return $this;
    }


    /**
     * Get the associated User object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return User The associated User object.
     * @throws PropelException
     */
    public function getUserRelatedByCreatedBy(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aUserRelatedByCreatedBy === null && ($this->created_by !== null) && $doQuery) {
            $this->aUserRelatedByCreatedBy = UserQuery::create()->findPk($this->created_by, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUserRelatedByCreatedBy->addUsersRelatedById0($this);
             */
        }

        return $this->aUserRelatedByCreatedBy;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param                  User $v
     * @return User The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUserRelatedByUpdatedBy(User $v = null)
    {
        if ($v === null) {
            $this->setUpdatedBy(NULL);
        } else {
            $this->setUpdatedBy($v->getId());
        }

        $this->aUserRelatedByUpdatedBy = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the User object, it will not be re-added.
        if ($v !== null) {
            $v->addUserRelatedById1($this);
        }


        return $this;
    }


    /**
     * Get the associated User object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return User The associated User object.
     * @throws PropelException
     */
    public function getUserRelatedByUpdatedBy(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aUserRelatedByUpdatedBy === null && ($this->updated_by !== null) && $doQuery) {
            $this->aUserRelatedByUpdatedBy = UserQuery::create()->findPk($this->updated_by, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUserRelatedByUpdatedBy->addUsersRelatedById1($this);
             */
        }

        return $this->aUserRelatedByUpdatedBy;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('UserRelatedById0' == $relationName) {
            $this->initUsersRelatedById0();
        }
        if ('UserRelatedById1' == $relationName) {
            $this->initUsersRelatedById1();
        }
        if ('ThreadRelatedByCreatedBy' == $relationName) {
            $this->initThreadsRelatedByCreatedBy();
        }
        if ('ThreadRelatedByUpdatedBy' == $relationName) {
            $this->initThreadsRelatedByUpdatedBy();
        }
        if ('PostRelatedByCreatedBy' == $relationName) {
            $this->initPostsRelatedByCreatedBy();
        }
        if ('PostRelatedByUpdatedBy' == $relationName) {
            $this->initPostsRelatedByUpdatedBy();
        }
    }

    /**
     * Clears out the collUsersRelatedById0 collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addUsersRelatedById0()
     */
    public function clearUsersRelatedById0()
    {
        $this->collUsersRelatedById0 = null; // important to set this to null since that means it is uninitialized
        $this->collUsersRelatedById0Partial = null;

        return $this;
    }

    /**
     * reset is the collUsersRelatedById0 collection loaded partially
     *
     * @return void
     */
    public function resetPartialUsersRelatedById0($v = true)
    {
        $this->collUsersRelatedById0Partial = $v;
    }

    /**
     * Initializes the collUsersRelatedById0 collection.
     *
     * By default this just sets the collUsersRelatedById0 collection to an empty array (like clearcollUsersRelatedById0());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsersRelatedById0($overrideExisting = true)
    {
        if (null !== $this->collUsersRelatedById0 && !$overrideExisting) {
            return;
        }
        $this->collUsersRelatedById0 = new PropelObjectCollection();
        $this->collUsersRelatedById0->setModel('User');
    }

    /**
     * Gets an array of User objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|User[] List of User objects
     * @throws PropelException
     */
    public function getUsersRelatedById0($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collUsersRelatedById0Partial && !$this->isNew();
        if (null === $this->collUsersRelatedById0 || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsersRelatedById0) {
                // return empty collection
                $this->initUsersRelatedById0();
            } else {
                $collUsersRelatedById0 = UserQuery::create(null, $criteria)
                    ->filterByUserRelatedByCreatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collUsersRelatedById0Partial && count($collUsersRelatedById0)) {
                      $this->initUsersRelatedById0(false);

                      foreach ($collUsersRelatedById0 as $obj) {
                        if (false == $this->collUsersRelatedById0->contains($obj)) {
                          $this->collUsersRelatedById0->append($obj);
                        }
                      }

                      $this->collUsersRelatedById0Partial = true;
                    }

                    $collUsersRelatedById0->getInternalIterator()->rewind();

                    return $collUsersRelatedById0;
                }

                if ($partial && $this->collUsersRelatedById0) {
                    foreach ($this->collUsersRelatedById0 as $obj) {
                        if ($obj->isNew()) {
                            $collUsersRelatedById0[] = $obj;
                        }
                    }
                }

                $this->collUsersRelatedById0 = $collUsersRelatedById0;
                $this->collUsersRelatedById0Partial = false;
            }
        }

        return $this->collUsersRelatedById0;
    }

    /**
     * Sets a collection of UserRelatedById0 objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $usersRelatedById0 A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setUsersRelatedById0(PropelCollection $usersRelatedById0, PropelPDO $con = null)
    {
        $usersRelatedById0ToDelete = $this->getUsersRelatedById0(new Criteria(), $con)->diff($usersRelatedById0);


        $this->usersRelatedById0ScheduledForDeletion = $usersRelatedById0ToDelete;

        foreach ($usersRelatedById0ToDelete as $userRelatedById0Removed) {
            $userRelatedById0Removed->setUserRelatedByCreatedBy(null);
        }

        $this->collUsersRelatedById0 = null;
        foreach ($usersRelatedById0 as $userRelatedById0) {
            $this->addUserRelatedById0($userRelatedById0);
        }

        $this->collUsersRelatedById0 = $usersRelatedById0;
        $this->collUsersRelatedById0Partial = false;

        return $this;
    }

    /**
     * Returns the number of related User objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related User objects.
     * @throws PropelException
     */
    public function countUsersRelatedById0(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collUsersRelatedById0Partial && !$this->isNew();
        if (null === $this->collUsersRelatedById0 || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsersRelatedById0) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUsersRelatedById0());
            }
            $query = UserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByCreatedBy($this)
                ->count($con);
        }

        return count($this->collUsersRelatedById0);
    }

    /**
     * Method called to associate a User object to this object
     * through the User foreign key attribute.
     *
     * @param    User $l User
     * @return User The current object (for fluent API support)
     */
    public function addUserRelatedById0(User $l)
    {
        if ($this->collUsersRelatedById0 === null) {
            $this->initUsersRelatedById0();
            $this->collUsersRelatedById0Partial = true;
        }

        if (!in_array($l, $this->collUsersRelatedById0->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddUserRelatedById0($l);

            if ($this->usersRelatedById0ScheduledForDeletion and $this->usersRelatedById0ScheduledForDeletion->contains($l)) {
                $this->usersRelatedById0ScheduledForDeletion->remove($this->usersRelatedById0ScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	UserRelatedById0 $userRelatedById0 The userRelatedById0 object to add.
     */
    protected function doAddUserRelatedById0($userRelatedById0)
    {
        $this->collUsersRelatedById0[]= $userRelatedById0;
        $userRelatedById0->setUserRelatedByCreatedBy($this);
    }

    /**
     * @param	UserRelatedById0 $userRelatedById0 The userRelatedById0 object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeUserRelatedById0($userRelatedById0)
    {
        if ($this->getUsersRelatedById0()->contains($userRelatedById0)) {
            $this->collUsersRelatedById0->remove($this->collUsersRelatedById0->search($userRelatedById0));
            if (null === $this->usersRelatedById0ScheduledForDeletion) {
                $this->usersRelatedById0ScheduledForDeletion = clone $this->collUsersRelatedById0;
                $this->usersRelatedById0ScheduledForDeletion->clear();
            }
            $this->usersRelatedById0ScheduledForDeletion[]= $userRelatedById0;
            $userRelatedById0->setUserRelatedByCreatedBy(null);
        }

        return $this;
    }

    /**
     * Clears out the collUsersRelatedById1 collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addUsersRelatedById1()
     */
    public function clearUsersRelatedById1()
    {
        $this->collUsersRelatedById1 = null; // important to set this to null since that means it is uninitialized
        $this->collUsersRelatedById1Partial = null;

        return $this;
    }

    /**
     * reset is the collUsersRelatedById1 collection loaded partially
     *
     * @return void
     */
    public function resetPartialUsersRelatedById1($v = true)
    {
        $this->collUsersRelatedById1Partial = $v;
    }

    /**
     * Initializes the collUsersRelatedById1 collection.
     *
     * By default this just sets the collUsersRelatedById1 collection to an empty array (like clearcollUsersRelatedById1());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsersRelatedById1($overrideExisting = true)
    {
        if (null !== $this->collUsersRelatedById1 && !$overrideExisting) {
            return;
        }
        $this->collUsersRelatedById1 = new PropelObjectCollection();
        $this->collUsersRelatedById1->setModel('User');
    }

    /**
     * Gets an array of User objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|User[] List of User objects
     * @throws PropelException
     */
    public function getUsersRelatedById1($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collUsersRelatedById1Partial && !$this->isNew();
        if (null === $this->collUsersRelatedById1 || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsersRelatedById1) {
                // return empty collection
                $this->initUsersRelatedById1();
            } else {
                $collUsersRelatedById1 = UserQuery::create(null, $criteria)
                    ->filterByUserRelatedByUpdatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collUsersRelatedById1Partial && count($collUsersRelatedById1)) {
                      $this->initUsersRelatedById1(false);

                      foreach ($collUsersRelatedById1 as $obj) {
                        if (false == $this->collUsersRelatedById1->contains($obj)) {
                          $this->collUsersRelatedById1->append($obj);
                        }
                      }

                      $this->collUsersRelatedById1Partial = true;
                    }

                    $collUsersRelatedById1->getInternalIterator()->rewind();

                    return $collUsersRelatedById1;
                }

                if ($partial && $this->collUsersRelatedById1) {
                    foreach ($this->collUsersRelatedById1 as $obj) {
                        if ($obj->isNew()) {
                            $collUsersRelatedById1[] = $obj;
                        }
                    }
                }

                $this->collUsersRelatedById1 = $collUsersRelatedById1;
                $this->collUsersRelatedById1Partial = false;
            }
        }

        return $this->collUsersRelatedById1;
    }

    /**
     * Sets a collection of UserRelatedById1 objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $usersRelatedById1 A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setUsersRelatedById1(PropelCollection $usersRelatedById1, PropelPDO $con = null)
    {
        $usersRelatedById1ToDelete = $this->getUsersRelatedById1(new Criteria(), $con)->diff($usersRelatedById1);


        $this->usersRelatedById1ScheduledForDeletion = $usersRelatedById1ToDelete;

        foreach ($usersRelatedById1ToDelete as $userRelatedById1Removed) {
            $userRelatedById1Removed->setUserRelatedByUpdatedBy(null);
        }

        $this->collUsersRelatedById1 = null;
        foreach ($usersRelatedById1 as $userRelatedById1) {
            $this->addUserRelatedById1($userRelatedById1);
        }

        $this->collUsersRelatedById1 = $usersRelatedById1;
        $this->collUsersRelatedById1Partial = false;

        return $this;
    }

    /**
     * Returns the number of related User objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related User objects.
     * @throws PropelException
     */
    public function countUsersRelatedById1(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collUsersRelatedById1Partial && !$this->isNew();
        if (null === $this->collUsersRelatedById1 || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsersRelatedById1) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUsersRelatedById1());
            }
            $query = UserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByUpdatedBy($this)
                ->count($con);
        }

        return count($this->collUsersRelatedById1);
    }

    /**
     * Method called to associate a User object to this object
     * through the User foreign key attribute.
     *
     * @param    User $l User
     * @return User The current object (for fluent API support)
     */
    public function addUserRelatedById1(User $l)
    {
        if ($this->collUsersRelatedById1 === null) {
            $this->initUsersRelatedById1();
            $this->collUsersRelatedById1Partial = true;
        }

        if (!in_array($l, $this->collUsersRelatedById1->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddUserRelatedById1($l);

            if ($this->usersRelatedById1ScheduledForDeletion and $this->usersRelatedById1ScheduledForDeletion->contains($l)) {
                $this->usersRelatedById1ScheduledForDeletion->remove($this->usersRelatedById1ScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	UserRelatedById1 $userRelatedById1 The userRelatedById1 object to add.
     */
    protected function doAddUserRelatedById1($userRelatedById1)
    {
        $this->collUsersRelatedById1[]= $userRelatedById1;
        $userRelatedById1->setUserRelatedByUpdatedBy($this);
    }

    /**
     * @param	UserRelatedById1 $userRelatedById1 The userRelatedById1 object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeUserRelatedById1($userRelatedById1)
    {
        if ($this->getUsersRelatedById1()->contains($userRelatedById1)) {
            $this->collUsersRelatedById1->remove($this->collUsersRelatedById1->search($userRelatedById1));
            if (null === $this->usersRelatedById1ScheduledForDeletion) {
                $this->usersRelatedById1ScheduledForDeletion = clone $this->collUsersRelatedById1;
                $this->usersRelatedById1ScheduledForDeletion->clear();
            }
            $this->usersRelatedById1ScheduledForDeletion[]= $userRelatedById1;
            $userRelatedById1->setUserRelatedByUpdatedBy(null);
        }

        return $this;
    }

    /**
     * Clears out the collThreadsRelatedByCreatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addThreadsRelatedByCreatedBy()
     */
    public function clearThreadsRelatedByCreatedBy()
    {
        $this->collThreadsRelatedByCreatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collThreadsRelatedByCreatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collThreadsRelatedByCreatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialThreadsRelatedByCreatedBy($v = true)
    {
        $this->collThreadsRelatedByCreatedByPartial = $v;
    }

    /**
     * Initializes the collThreadsRelatedByCreatedBy collection.
     *
     * By default this just sets the collThreadsRelatedByCreatedBy collection to an empty array (like clearcollThreadsRelatedByCreatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initThreadsRelatedByCreatedBy($overrideExisting = true)
    {
        if (null !== $this->collThreadsRelatedByCreatedBy && !$overrideExisting) {
            return;
        }
        $this->collThreadsRelatedByCreatedBy = new PropelObjectCollection();
        $this->collThreadsRelatedByCreatedBy->setModel('Thread');
    }

    /**
     * Gets an array of Thread objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Thread[] List of Thread objects
     * @throws PropelException
     */
    public function getThreadsRelatedByCreatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collThreadsRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collThreadsRelatedByCreatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collThreadsRelatedByCreatedBy) {
                // return empty collection
                $this->initThreadsRelatedByCreatedBy();
            } else {
                $collThreadsRelatedByCreatedBy = ThreadQuery::create(null, $criteria)
                    ->filterByUserRelatedByCreatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collThreadsRelatedByCreatedByPartial && count($collThreadsRelatedByCreatedBy)) {
                      $this->initThreadsRelatedByCreatedBy(false);

                      foreach ($collThreadsRelatedByCreatedBy as $obj) {
                        if (false == $this->collThreadsRelatedByCreatedBy->contains($obj)) {
                          $this->collThreadsRelatedByCreatedBy->append($obj);
                        }
                      }

                      $this->collThreadsRelatedByCreatedByPartial = true;
                    }

                    $collThreadsRelatedByCreatedBy->getInternalIterator()->rewind();

                    return $collThreadsRelatedByCreatedBy;
                }

                if ($partial && $this->collThreadsRelatedByCreatedBy) {
                    foreach ($this->collThreadsRelatedByCreatedBy as $obj) {
                        if ($obj->isNew()) {
                            $collThreadsRelatedByCreatedBy[] = $obj;
                        }
                    }
                }

                $this->collThreadsRelatedByCreatedBy = $collThreadsRelatedByCreatedBy;
                $this->collThreadsRelatedByCreatedByPartial = false;
            }
        }

        return $this->collThreadsRelatedByCreatedBy;
    }

    /**
     * Sets a collection of ThreadRelatedByCreatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $threadsRelatedByCreatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setThreadsRelatedByCreatedBy(PropelCollection $threadsRelatedByCreatedBy, PropelPDO $con = null)
    {
        $threadsRelatedByCreatedByToDelete = $this->getThreadsRelatedByCreatedBy(new Criteria(), $con)->diff($threadsRelatedByCreatedBy);


        $this->threadsRelatedByCreatedByScheduledForDeletion = $threadsRelatedByCreatedByToDelete;

        foreach ($threadsRelatedByCreatedByToDelete as $threadRelatedByCreatedByRemoved) {
            $threadRelatedByCreatedByRemoved->setUserRelatedByCreatedBy(null);
        }

        $this->collThreadsRelatedByCreatedBy = null;
        foreach ($threadsRelatedByCreatedBy as $threadRelatedByCreatedBy) {
            $this->addThreadRelatedByCreatedBy($threadRelatedByCreatedBy);
        }

        $this->collThreadsRelatedByCreatedBy = $threadsRelatedByCreatedBy;
        $this->collThreadsRelatedByCreatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Thread objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Thread objects.
     * @throws PropelException
     */
    public function countThreadsRelatedByCreatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collThreadsRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collThreadsRelatedByCreatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collThreadsRelatedByCreatedBy) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getThreadsRelatedByCreatedBy());
            }
            $query = ThreadQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByCreatedBy($this)
                ->count($con);
        }

        return count($this->collThreadsRelatedByCreatedBy);
    }

    /**
     * Method called to associate a Thread object to this object
     * through the Thread foreign key attribute.
     *
     * @param    Thread $l Thread
     * @return User The current object (for fluent API support)
     */
    public function addThreadRelatedByCreatedBy(Thread $l)
    {
        if ($this->collThreadsRelatedByCreatedBy === null) {
            $this->initThreadsRelatedByCreatedBy();
            $this->collThreadsRelatedByCreatedByPartial = true;
        }

        if (!in_array($l, $this->collThreadsRelatedByCreatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddThreadRelatedByCreatedBy($l);

            if ($this->threadsRelatedByCreatedByScheduledForDeletion and $this->threadsRelatedByCreatedByScheduledForDeletion->contains($l)) {
                $this->threadsRelatedByCreatedByScheduledForDeletion->remove($this->threadsRelatedByCreatedByScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	ThreadRelatedByCreatedBy $threadRelatedByCreatedBy The threadRelatedByCreatedBy object to add.
     */
    protected function doAddThreadRelatedByCreatedBy($threadRelatedByCreatedBy)
    {
        $this->collThreadsRelatedByCreatedBy[]= $threadRelatedByCreatedBy;
        $threadRelatedByCreatedBy->setUserRelatedByCreatedBy($this);
    }

    /**
     * @param	ThreadRelatedByCreatedBy $threadRelatedByCreatedBy The threadRelatedByCreatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeThreadRelatedByCreatedBy($threadRelatedByCreatedBy)
    {
        if ($this->getThreadsRelatedByCreatedBy()->contains($threadRelatedByCreatedBy)) {
            $this->collThreadsRelatedByCreatedBy->remove($this->collThreadsRelatedByCreatedBy->search($threadRelatedByCreatedBy));
            if (null === $this->threadsRelatedByCreatedByScheduledForDeletion) {
                $this->threadsRelatedByCreatedByScheduledForDeletion = clone $this->collThreadsRelatedByCreatedBy;
                $this->threadsRelatedByCreatedByScheduledForDeletion->clear();
            }
            $this->threadsRelatedByCreatedByScheduledForDeletion[]= $threadRelatedByCreatedBy;
            $threadRelatedByCreatedBy->setUserRelatedByCreatedBy(null);
        }

        return $this;
    }

    /**
     * Clears out the collThreadsRelatedByUpdatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addThreadsRelatedByUpdatedBy()
     */
    public function clearThreadsRelatedByUpdatedBy()
    {
        $this->collThreadsRelatedByUpdatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collThreadsRelatedByUpdatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collThreadsRelatedByUpdatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialThreadsRelatedByUpdatedBy($v = true)
    {
        $this->collThreadsRelatedByUpdatedByPartial = $v;
    }

    /**
     * Initializes the collThreadsRelatedByUpdatedBy collection.
     *
     * By default this just sets the collThreadsRelatedByUpdatedBy collection to an empty array (like clearcollThreadsRelatedByUpdatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initThreadsRelatedByUpdatedBy($overrideExisting = true)
    {
        if (null !== $this->collThreadsRelatedByUpdatedBy && !$overrideExisting) {
            return;
        }
        $this->collThreadsRelatedByUpdatedBy = new PropelObjectCollection();
        $this->collThreadsRelatedByUpdatedBy->setModel('Thread');
    }

    /**
     * Gets an array of Thread objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Thread[] List of Thread objects
     * @throws PropelException
     */
    public function getThreadsRelatedByUpdatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collThreadsRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collThreadsRelatedByUpdatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collThreadsRelatedByUpdatedBy) {
                // return empty collection
                $this->initThreadsRelatedByUpdatedBy();
            } else {
                $collThreadsRelatedByUpdatedBy = ThreadQuery::create(null, $criteria)
                    ->filterByUserRelatedByUpdatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collThreadsRelatedByUpdatedByPartial && count($collThreadsRelatedByUpdatedBy)) {
                      $this->initThreadsRelatedByUpdatedBy(false);

                      foreach ($collThreadsRelatedByUpdatedBy as $obj) {
                        if (false == $this->collThreadsRelatedByUpdatedBy->contains($obj)) {
                          $this->collThreadsRelatedByUpdatedBy->append($obj);
                        }
                      }

                      $this->collThreadsRelatedByUpdatedByPartial = true;
                    }

                    $collThreadsRelatedByUpdatedBy->getInternalIterator()->rewind();

                    return $collThreadsRelatedByUpdatedBy;
                }

                if ($partial && $this->collThreadsRelatedByUpdatedBy) {
                    foreach ($this->collThreadsRelatedByUpdatedBy as $obj) {
                        if ($obj->isNew()) {
                            $collThreadsRelatedByUpdatedBy[] = $obj;
                        }
                    }
                }

                $this->collThreadsRelatedByUpdatedBy = $collThreadsRelatedByUpdatedBy;
                $this->collThreadsRelatedByUpdatedByPartial = false;
            }
        }

        return $this->collThreadsRelatedByUpdatedBy;
    }

    /**
     * Sets a collection of ThreadRelatedByUpdatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $threadsRelatedByUpdatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setThreadsRelatedByUpdatedBy(PropelCollection $threadsRelatedByUpdatedBy, PropelPDO $con = null)
    {
        $threadsRelatedByUpdatedByToDelete = $this->getThreadsRelatedByUpdatedBy(new Criteria(), $con)->diff($threadsRelatedByUpdatedBy);


        $this->threadsRelatedByUpdatedByScheduledForDeletion = $threadsRelatedByUpdatedByToDelete;

        foreach ($threadsRelatedByUpdatedByToDelete as $threadRelatedByUpdatedByRemoved) {
            $threadRelatedByUpdatedByRemoved->setUserRelatedByUpdatedBy(null);
        }

        $this->collThreadsRelatedByUpdatedBy = null;
        foreach ($threadsRelatedByUpdatedBy as $threadRelatedByUpdatedBy) {
            $this->addThreadRelatedByUpdatedBy($threadRelatedByUpdatedBy);
        }

        $this->collThreadsRelatedByUpdatedBy = $threadsRelatedByUpdatedBy;
        $this->collThreadsRelatedByUpdatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Thread objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Thread objects.
     * @throws PropelException
     */
    public function countThreadsRelatedByUpdatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collThreadsRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collThreadsRelatedByUpdatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collThreadsRelatedByUpdatedBy) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getThreadsRelatedByUpdatedBy());
            }
            $query = ThreadQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByUpdatedBy($this)
                ->count($con);
        }

        return count($this->collThreadsRelatedByUpdatedBy);
    }

    /**
     * Method called to associate a Thread object to this object
     * through the Thread foreign key attribute.
     *
     * @param    Thread $l Thread
     * @return User The current object (for fluent API support)
     */
    public function addThreadRelatedByUpdatedBy(Thread $l)
    {
        if ($this->collThreadsRelatedByUpdatedBy === null) {
            $this->initThreadsRelatedByUpdatedBy();
            $this->collThreadsRelatedByUpdatedByPartial = true;
        }

        if (!in_array($l, $this->collThreadsRelatedByUpdatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddThreadRelatedByUpdatedBy($l);

            if ($this->threadsRelatedByUpdatedByScheduledForDeletion and $this->threadsRelatedByUpdatedByScheduledForDeletion->contains($l)) {
                $this->threadsRelatedByUpdatedByScheduledForDeletion->remove($this->threadsRelatedByUpdatedByScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	ThreadRelatedByUpdatedBy $threadRelatedByUpdatedBy The threadRelatedByUpdatedBy object to add.
     */
    protected function doAddThreadRelatedByUpdatedBy($threadRelatedByUpdatedBy)
    {
        $this->collThreadsRelatedByUpdatedBy[]= $threadRelatedByUpdatedBy;
        $threadRelatedByUpdatedBy->setUserRelatedByUpdatedBy($this);
    }

    /**
     * @param	ThreadRelatedByUpdatedBy $threadRelatedByUpdatedBy The threadRelatedByUpdatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeThreadRelatedByUpdatedBy($threadRelatedByUpdatedBy)
    {
        if ($this->getThreadsRelatedByUpdatedBy()->contains($threadRelatedByUpdatedBy)) {
            $this->collThreadsRelatedByUpdatedBy->remove($this->collThreadsRelatedByUpdatedBy->search($threadRelatedByUpdatedBy));
            if (null === $this->threadsRelatedByUpdatedByScheduledForDeletion) {
                $this->threadsRelatedByUpdatedByScheduledForDeletion = clone $this->collThreadsRelatedByUpdatedBy;
                $this->threadsRelatedByUpdatedByScheduledForDeletion->clear();
            }
            $this->threadsRelatedByUpdatedByScheduledForDeletion[]= $threadRelatedByUpdatedBy;
            $threadRelatedByUpdatedBy->setUserRelatedByUpdatedBy(null);
        }

        return $this;
    }

    /**
     * Clears out the collPostsRelatedByCreatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addPostsRelatedByCreatedBy()
     */
    public function clearPostsRelatedByCreatedBy()
    {
        $this->collPostsRelatedByCreatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collPostsRelatedByCreatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collPostsRelatedByCreatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialPostsRelatedByCreatedBy($v = true)
    {
        $this->collPostsRelatedByCreatedByPartial = $v;
    }

    /**
     * Initializes the collPostsRelatedByCreatedBy collection.
     *
     * By default this just sets the collPostsRelatedByCreatedBy collection to an empty array (like clearcollPostsRelatedByCreatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPostsRelatedByCreatedBy($overrideExisting = true)
    {
        if (null !== $this->collPostsRelatedByCreatedBy && !$overrideExisting) {
            return;
        }
        $this->collPostsRelatedByCreatedBy = new PropelObjectCollection();
        $this->collPostsRelatedByCreatedBy->setModel('Post');
    }

    /**
     * Gets an array of Post objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Post[] List of Post objects
     * @throws PropelException
     */
    public function getPostsRelatedByCreatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPostsRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collPostsRelatedByCreatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPostsRelatedByCreatedBy) {
                // return empty collection
                $this->initPostsRelatedByCreatedBy();
            } else {
                $collPostsRelatedByCreatedBy = PostQuery::create(null, $criteria)
                    ->filterByUserRelatedByCreatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPostsRelatedByCreatedByPartial && count($collPostsRelatedByCreatedBy)) {
                      $this->initPostsRelatedByCreatedBy(false);

                      foreach ($collPostsRelatedByCreatedBy as $obj) {
                        if (false == $this->collPostsRelatedByCreatedBy->contains($obj)) {
                          $this->collPostsRelatedByCreatedBy->append($obj);
                        }
                      }

                      $this->collPostsRelatedByCreatedByPartial = true;
                    }

                    $collPostsRelatedByCreatedBy->getInternalIterator()->rewind();

                    return $collPostsRelatedByCreatedBy;
                }

                if ($partial && $this->collPostsRelatedByCreatedBy) {
                    foreach ($this->collPostsRelatedByCreatedBy as $obj) {
                        if ($obj->isNew()) {
                            $collPostsRelatedByCreatedBy[] = $obj;
                        }
                    }
                }

                $this->collPostsRelatedByCreatedBy = $collPostsRelatedByCreatedBy;
                $this->collPostsRelatedByCreatedByPartial = false;
            }
        }

        return $this->collPostsRelatedByCreatedBy;
    }

    /**
     * Sets a collection of PostRelatedByCreatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $postsRelatedByCreatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setPostsRelatedByCreatedBy(PropelCollection $postsRelatedByCreatedBy, PropelPDO $con = null)
    {
        $postsRelatedByCreatedByToDelete = $this->getPostsRelatedByCreatedBy(new Criteria(), $con)->diff($postsRelatedByCreatedBy);


        $this->postsRelatedByCreatedByScheduledForDeletion = $postsRelatedByCreatedByToDelete;

        foreach ($postsRelatedByCreatedByToDelete as $postRelatedByCreatedByRemoved) {
            $postRelatedByCreatedByRemoved->setUserRelatedByCreatedBy(null);
        }

        $this->collPostsRelatedByCreatedBy = null;
        foreach ($postsRelatedByCreatedBy as $postRelatedByCreatedBy) {
            $this->addPostRelatedByCreatedBy($postRelatedByCreatedBy);
        }

        $this->collPostsRelatedByCreatedBy = $postsRelatedByCreatedBy;
        $this->collPostsRelatedByCreatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Post objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Post objects.
     * @throws PropelException
     */
    public function countPostsRelatedByCreatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPostsRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collPostsRelatedByCreatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPostsRelatedByCreatedBy) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPostsRelatedByCreatedBy());
            }
            $query = PostQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByCreatedBy($this)
                ->count($con);
        }

        return count($this->collPostsRelatedByCreatedBy);
    }

    /**
     * Method called to associate a Post object to this object
     * through the Post foreign key attribute.
     *
     * @param    Post $l Post
     * @return User The current object (for fluent API support)
     */
    public function addPostRelatedByCreatedBy(Post $l)
    {
        if ($this->collPostsRelatedByCreatedBy === null) {
            $this->initPostsRelatedByCreatedBy();
            $this->collPostsRelatedByCreatedByPartial = true;
        }

        if (!in_array($l, $this->collPostsRelatedByCreatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPostRelatedByCreatedBy($l);

            if ($this->postsRelatedByCreatedByScheduledForDeletion and $this->postsRelatedByCreatedByScheduledForDeletion->contains($l)) {
                $this->postsRelatedByCreatedByScheduledForDeletion->remove($this->postsRelatedByCreatedByScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	PostRelatedByCreatedBy $postRelatedByCreatedBy The postRelatedByCreatedBy object to add.
     */
    protected function doAddPostRelatedByCreatedBy($postRelatedByCreatedBy)
    {
        $this->collPostsRelatedByCreatedBy[]= $postRelatedByCreatedBy;
        $postRelatedByCreatedBy->setUserRelatedByCreatedBy($this);
    }

    /**
     * @param	PostRelatedByCreatedBy $postRelatedByCreatedBy The postRelatedByCreatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removePostRelatedByCreatedBy($postRelatedByCreatedBy)
    {
        if ($this->getPostsRelatedByCreatedBy()->contains($postRelatedByCreatedBy)) {
            $this->collPostsRelatedByCreatedBy->remove($this->collPostsRelatedByCreatedBy->search($postRelatedByCreatedBy));
            if (null === $this->postsRelatedByCreatedByScheduledForDeletion) {
                $this->postsRelatedByCreatedByScheduledForDeletion = clone $this->collPostsRelatedByCreatedBy;
                $this->postsRelatedByCreatedByScheduledForDeletion->clear();
            }
            $this->postsRelatedByCreatedByScheduledForDeletion[]= $postRelatedByCreatedBy;
            $postRelatedByCreatedBy->setUserRelatedByCreatedBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related PostsRelatedByCreatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Post[] List of Post objects
     */
    public function getPostsRelatedByCreatedByJoinThread($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PostQuery::create(null, $criteria);
        $query->joinWith('Thread', $join_behavior);

        return $this->getPostsRelatedByCreatedBy($query, $con);
    }

    /**
     * Clears out the collPostsRelatedByUpdatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addPostsRelatedByUpdatedBy()
     */
    public function clearPostsRelatedByUpdatedBy()
    {
        $this->collPostsRelatedByUpdatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collPostsRelatedByUpdatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collPostsRelatedByUpdatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialPostsRelatedByUpdatedBy($v = true)
    {
        $this->collPostsRelatedByUpdatedByPartial = $v;
    }

    /**
     * Initializes the collPostsRelatedByUpdatedBy collection.
     *
     * By default this just sets the collPostsRelatedByUpdatedBy collection to an empty array (like clearcollPostsRelatedByUpdatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPostsRelatedByUpdatedBy($overrideExisting = true)
    {
        if (null !== $this->collPostsRelatedByUpdatedBy && !$overrideExisting) {
            return;
        }
        $this->collPostsRelatedByUpdatedBy = new PropelObjectCollection();
        $this->collPostsRelatedByUpdatedBy->setModel('Post');
    }

    /**
     * Gets an array of Post objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Post[] List of Post objects
     * @throws PropelException
     */
    public function getPostsRelatedByUpdatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPostsRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collPostsRelatedByUpdatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPostsRelatedByUpdatedBy) {
                // return empty collection
                $this->initPostsRelatedByUpdatedBy();
            } else {
                $collPostsRelatedByUpdatedBy = PostQuery::create(null, $criteria)
                    ->filterByUserRelatedByUpdatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPostsRelatedByUpdatedByPartial && count($collPostsRelatedByUpdatedBy)) {
                      $this->initPostsRelatedByUpdatedBy(false);

                      foreach ($collPostsRelatedByUpdatedBy as $obj) {
                        if (false == $this->collPostsRelatedByUpdatedBy->contains($obj)) {
                          $this->collPostsRelatedByUpdatedBy->append($obj);
                        }
                      }

                      $this->collPostsRelatedByUpdatedByPartial = true;
                    }

                    $collPostsRelatedByUpdatedBy->getInternalIterator()->rewind();

                    return $collPostsRelatedByUpdatedBy;
                }

                if ($partial && $this->collPostsRelatedByUpdatedBy) {
                    foreach ($this->collPostsRelatedByUpdatedBy as $obj) {
                        if ($obj->isNew()) {
                            $collPostsRelatedByUpdatedBy[] = $obj;
                        }
                    }
                }

                $this->collPostsRelatedByUpdatedBy = $collPostsRelatedByUpdatedBy;
                $this->collPostsRelatedByUpdatedByPartial = false;
            }
        }

        return $this->collPostsRelatedByUpdatedBy;
    }

    /**
     * Sets a collection of PostRelatedByUpdatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $postsRelatedByUpdatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setPostsRelatedByUpdatedBy(PropelCollection $postsRelatedByUpdatedBy, PropelPDO $con = null)
    {
        $postsRelatedByUpdatedByToDelete = $this->getPostsRelatedByUpdatedBy(new Criteria(), $con)->diff($postsRelatedByUpdatedBy);


        $this->postsRelatedByUpdatedByScheduledForDeletion = $postsRelatedByUpdatedByToDelete;

        foreach ($postsRelatedByUpdatedByToDelete as $postRelatedByUpdatedByRemoved) {
            $postRelatedByUpdatedByRemoved->setUserRelatedByUpdatedBy(null);
        }

        $this->collPostsRelatedByUpdatedBy = null;
        foreach ($postsRelatedByUpdatedBy as $postRelatedByUpdatedBy) {
            $this->addPostRelatedByUpdatedBy($postRelatedByUpdatedBy);
        }

        $this->collPostsRelatedByUpdatedBy = $postsRelatedByUpdatedBy;
        $this->collPostsRelatedByUpdatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Post objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Post objects.
     * @throws PropelException
     */
    public function countPostsRelatedByUpdatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPostsRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collPostsRelatedByUpdatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPostsRelatedByUpdatedBy) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPostsRelatedByUpdatedBy());
            }
            $query = PostQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByUpdatedBy($this)
                ->count($con);
        }

        return count($this->collPostsRelatedByUpdatedBy);
    }

    /**
     * Method called to associate a Post object to this object
     * through the Post foreign key attribute.
     *
     * @param    Post $l Post
     * @return User The current object (for fluent API support)
     */
    public function addPostRelatedByUpdatedBy(Post $l)
    {
        if ($this->collPostsRelatedByUpdatedBy === null) {
            $this->initPostsRelatedByUpdatedBy();
            $this->collPostsRelatedByUpdatedByPartial = true;
        }

        if (!in_array($l, $this->collPostsRelatedByUpdatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPostRelatedByUpdatedBy($l);

            if ($this->postsRelatedByUpdatedByScheduledForDeletion and $this->postsRelatedByUpdatedByScheduledForDeletion->contains($l)) {
                $this->postsRelatedByUpdatedByScheduledForDeletion->remove($this->postsRelatedByUpdatedByScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	PostRelatedByUpdatedBy $postRelatedByUpdatedBy The postRelatedByUpdatedBy object to add.
     */
    protected function doAddPostRelatedByUpdatedBy($postRelatedByUpdatedBy)
    {
        $this->collPostsRelatedByUpdatedBy[]= $postRelatedByUpdatedBy;
        $postRelatedByUpdatedBy->setUserRelatedByUpdatedBy($this);
    }

    /**
     * @param	PostRelatedByUpdatedBy $postRelatedByUpdatedBy The postRelatedByUpdatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removePostRelatedByUpdatedBy($postRelatedByUpdatedBy)
    {
        if ($this->getPostsRelatedByUpdatedBy()->contains($postRelatedByUpdatedBy)) {
            $this->collPostsRelatedByUpdatedBy->remove($this->collPostsRelatedByUpdatedBy->search($postRelatedByUpdatedBy));
            if (null === $this->postsRelatedByUpdatedByScheduledForDeletion) {
                $this->postsRelatedByUpdatedByScheduledForDeletion = clone $this->collPostsRelatedByUpdatedBy;
                $this->postsRelatedByUpdatedByScheduledForDeletion->clear();
            }
            $this->postsRelatedByUpdatedByScheduledForDeletion[]= $postRelatedByUpdatedBy;
            $postRelatedByUpdatedBy->setUserRelatedByUpdatedBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related PostsRelatedByUpdatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Post[] List of Post objects
     */
    public function getPostsRelatedByUpdatedByJoinThread($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PostQuery::create(null, $criteria);
        $query->joinWith('Thread', $join_behavior);

        return $this->getPostsRelatedByUpdatedBy($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->first_name = null;
        $this->last_name = null;
        $this->email = null;
        $this->password = null;
        $this->phone_number = null;
        $this->role = null;
        $this->created_by = null;
        $this->updated_by = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collUsersRelatedById0) {
                foreach ($this->collUsersRelatedById0 as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUsersRelatedById1) {
                foreach ($this->collUsersRelatedById1 as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collThreadsRelatedByCreatedBy) {
                foreach ($this->collThreadsRelatedByCreatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collThreadsRelatedByUpdatedBy) {
                foreach ($this->collThreadsRelatedByUpdatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPostsRelatedByCreatedBy) {
                foreach ($this->collPostsRelatedByCreatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPostsRelatedByUpdatedBy) {
                foreach ($this->collPostsRelatedByUpdatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aUserRelatedByCreatedBy instanceof Persistent) {
              $this->aUserRelatedByCreatedBy->clearAllReferences($deep);
            }
            if ($this->aUserRelatedByUpdatedBy instanceof Persistent) {
              $this->aUserRelatedByUpdatedBy->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collUsersRelatedById0 instanceof PropelCollection) {
            $this->collUsersRelatedById0->clearIterator();
        }
        $this->collUsersRelatedById0 = null;
        if ($this->collUsersRelatedById1 instanceof PropelCollection) {
            $this->collUsersRelatedById1->clearIterator();
        }
        $this->collUsersRelatedById1 = null;
        if ($this->collThreadsRelatedByCreatedBy instanceof PropelCollection) {
            $this->collThreadsRelatedByCreatedBy->clearIterator();
        }
        $this->collThreadsRelatedByCreatedBy = null;
        if ($this->collThreadsRelatedByUpdatedBy instanceof PropelCollection) {
            $this->collThreadsRelatedByUpdatedBy->clearIterator();
        }
        $this->collThreadsRelatedByUpdatedBy = null;
        if ($this->collPostsRelatedByCreatedBy instanceof PropelCollection) {
            $this->collPostsRelatedByCreatedBy->clearIterator();
        }
        $this->collPostsRelatedByCreatedBy = null;
        if ($this->collPostsRelatedByUpdatedBy instanceof PropelCollection) {
            $this->collPostsRelatedByUpdatedBy->clearIterator();
        }
        $this->collPostsRelatedByUpdatedBy = null;
        $this->aUserRelatedByCreatedBy = null;
        $this->aUserRelatedByUpdatedBy = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UserPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     User The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = UserPeer::UPDATED_AT;

        return $this;
    }

}
